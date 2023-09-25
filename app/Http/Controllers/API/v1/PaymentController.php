<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\ClubStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PaymentRequest;
use App\Http\Requests\API\v1\PaymentWithCreditCardRequest;
use App\Models\Club;
use App\Models\Subscription;
use App\Services\MoyasarPaymentService;
use App\Services\SubscriptionService;
use Exception;
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
            $img_vehicle = saveImage("subscriptions/{$user_id}", $request->file('img_vehicle'));
            // session()->put('img_vehicle', $img_vehicle);
            $data = $this->moyasar_payment_service->pay($request);
            return $data;
            $message = __('general.response_messages.success');
            $response = generateApiResoponse(true, 201, $data, $message);
        } catch (Throwable $e) {
            dd($e);
            $data = [];
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
            if ($payment?->status == 'paid') {
                DB::beginTransaction();
                $subscription = (new SubscriptionService($payment->metadata['club_id']))->confirmUserSubscription();
                $this->moyasar_payment_service->logPayment($payment, $subscription->id, 'creditcard');
                DB::commit();



            } elseif ($payment?->status == 'failed') {
                $this->moyasar_payment_service->logPayment($payment, null, 'creditcard');
                info('FAILED PAYMENT AT paymentCreditCardCallback');
                info($payment->toJson());
                throw new Exception;
            }
            session()->flash('success', __('general.payment_success'));
        } catch (Throwable $e) {
            $data = [];
            $message = __('general.response_messages.error');
            $code = 500;
            $response = generateApiResoponse(false, $code, $data, $message);
        }
        return $response;

    }



}
