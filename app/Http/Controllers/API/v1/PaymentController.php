<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\ClubStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PaymentRequest;
use App\Http\Requests\API\v1\PaymentWithCreditCardRequest;
use App\Models\Club;
use App\Models\Payment;
use App\Models\Subscription;
use App\Services\MoyasarPaymentService;
use App\Services\SubscriptionService;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\SubscribedService;
use Throwable;

class PaymentController extends Controller
{
    protected $moyasar_payment_service;

    public function __construct(MoyasarPaymentService $moyasar_payment_service)
    {
        $this->moyasar_payment_service = $moyasar_payment_service;
    }


        /**
     * Make Payment Using \App\Services\MoyasarPaymentService
     */
    public function makePayment(PaymentWithCreditCardRequest $request)
    {

        try {
            $user_id = $request->user()->id;
            $name="subscriptions/{$user_id}";
            $img_vehicle = saveImage($name, $request->file('img_vehicle'));
            Cache::put('img_vehicle_' . $name, $img_vehicle, Carbon::now()->addMinutes(20));
            $data = $this->moyasar_payment_service->pay($request);
            return $data;
            $message = __('general.response_messages.success');
            $response = generateApiResoponse(true, 201, $data, $message);
        } catch (Throwable $e) {
            $data = [$e->getMessage(),$e->getTrace(),];
            $message = __('general.response_messages.error');
            $code = 500;
            $response = generateApiResoponse(false, $code, $data, $message);
        }
        return $response;
    }


    /**
     * Callback for payments.
     */
    public function paymentCreditCardCallback(Request $request)
    {
    
        try {
            $moyasar_payments = $this->moyasar_payment_service->getMoyasarPaymentLibrary();
            $payment = $moyasar_payments->fetch($request->id);

            //check payment id is unique 
            $checkPaymentIsUnique=Payment::where('payment_id',$request->id)->count();
            if($checkPaymentIsUnique > 0){
                $data = [];
                $message = __('general.response_messages.payment_already_exists');
                $code = 500;
                $response = generateApiResoponse(false, $code, $data, $message);
            }
            else{
                if ($payment?->status == 'paid') {
                    DB::beginTransaction();
                    $subscription = (new SubscriptionService($payment->metadata['club_id']))->confirmUserSubscription();
                    $this->moyasar_payment_service->logPayment($payment, $subscription->id, 'creditcard');
                    DB::commit();
                    $data = [];
                    $message = __('general.response_messages.payment_done');
                    $code = 200;
                    $response = generateApiResoponse(true, $code, $data, $message);
    
    
                } elseif ($payment?->status == 'failed') {
                    $this->moyasar_payment_service->logPayment($payment, null, 'creditcard');
                    info('FAILED PAYMENT AT paymentCreditCardCallback');
                    info($payment->toJson());
                    throw new Exception;
                }
            }

            session()->flash('success', __('general.payment_success'));
        } catch (Throwable $e) {
            $data = [$e->getMessage(),$e->getTrace(),];
            $message = __('general.response_messages.error');
            $code = 500;
            $response = generateApiResoponse(false, $code, $data, $message);
        }
        return $response;

    }



}
