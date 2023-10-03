<?php
namespace App\Services;

use App\Http\Requests\User\PaymentWithCreditCardRequest;
use App\Models\Club;
use App\Models\CouponUsage;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Cache;
use Throwable;
use \Moyasar\Providers\PaymentService as MoyasarPaymentLibrary;

class MoyasarPaymentService
{
    protected $api_service;
    protected $base_url;

    protected $headers;

    protected $club;

    protected $moyasar_payments_library;

    /**
     * set payment service.
     * we use club here because payment done on only 1 club
     */
    public function __construct(Request $request)
    {
        $this->base_url = config('moyasar.base_url');
        $token = base64_encode(config('moyasar.key'));
        $this->headers = array_merge(config('moyasar.headers'), ['Authorization' => "Basic {$token}"]);
        $this->club = Club::query()->findOrFail(decrypt($request->club_id));
        $this->moyasar_payments_library = new MoyasarPaymentLibrary();
        $this->api_service = new ApiService(base_url: $this->base_url, headers: $this->headers);
    }



    /**
     * make payment
     */
    public function pay(Request $request)
    {
        if ($request->payment_method == 'credit_card') {
            return $this->payWithCreditCard($request);
        }
    }


    /**
     * make payment with credit card
     */
    protected function payWithCreditCard($request)
    {
        $data = $this->getOrderDataForCreditCard($request);
        $response = $this->api_service->post('payments', $data)->json();
        if (@$response['status'] == 'initiated' && isset($response['id']) && isset($response['source']['transaction_url'])) {
            return response()->json(generateResponse(status: true, message: __('general.redirect_to_payment'), redirect: ($response['source']['transaction_url'])));
        } else {
            info('PAYMENT SERVICE ERROR WITH CC:');
            info($response);
            throw new Exception(__('general.payment_failed'));
        }
    }


    /**
     * get order data for payment
     * @return array $order_data
     */
    private function getOrderDataForCreditCard($request)
    {
        // put neccssarry data in metadata for payment info
        $meta_data = [
            'club_id' => $this->club->getEncryptedId(),
            'vat' => $this->club->vat,
            'vat_type' => $this->club->vat_type,
            'total_amount_without_vat' => $this->club->price,
            'total_amount_with_vat' => $this->club->getTotalPrice(),
        ];
        $coupon_data = getCouponCodeDiscountValueAndType($request->coupon_code);
        if (!is_null($coupon_data)) {
            $meta_data['coupon_code'] = $request->coupon_code;
            $meta_data = array_merge($meta_data, $coupon_data);
        }
        return [
            'amount' => calcTotalAmountWithDiscount($this->club->getTotalPrice(), $request->coupon_code),
            'currency' => 'SAR',
            'description' => "AMANAUTO SUBSCRIPTION {$this->club->translate('en')->name} X 1",
            'callback_url' => str_starts_with($request->path(), 'api') ? route('api.payment.credit_card_callback', ['club_id' => $this->club->getEncryptedId(), 'auth_token' => Crypt::encryptString(str_replace('Bearer ', '', $request->header('Authorization')))]) : route('subscribe.payment.credit_card_callback', ['club_id' => $this->club->getEncryptedId()]),
            'source' => [
                'type' => 'creditcard',
                'name' => $request->user()->name,
                'number' => $request->card_number,
                'cvc' => $request->cvc,
                'month' => $request->expiration_month,
                'year' => $request->expiration_year,
            ],
            'metadata' => $meta_data
        ];
    }


    /**
     * Log Payment
     */

    public function logPayment($payment, $subscription_id, $payment_method)
    {

        if (str_starts_with(request()->path(), 'api')) {
            $decrypted = Crypt::decryptString(urldecode(request()->auth_token));
            $user = PersonalAccessToken::findToken($decrypted);
            $user_id = $user->tokenable->id;

        } else {
            $user_id = getAuthUser('web')->id;
        }

        Payment::query()->create([
            'payment_id' => $payment->id,
            'status' => $payment->status,
            'method' => $payment->source->company,
            'amount' => $payment->amount,
            'description' => $payment->description,
            'metadata' => json_encode($payment->metadata),
            'subscription_id' => $subscription_id,
            'user_id' => $user_id,
        ]);
        $this->logCouponUsageIfExists($payment, $user_id);

        $name = "subscriptions/{$user_id}";
        Cache::forget('img_vehicle_' . $name);
    }



    /**
     * Log Coupon Usage if exists
     */
    protected function logCouponUsageIfExists($payment, $user_id)
    {
        if (isset($payment->metadata['coupon_code']) && $payment?->status == 'paid') {
            CouponUsage::query()->create([
                'user_id' => $user_id,
                'coupon_id' => decrypt($payment->metadata['coupon_id']),
            ]);
        }
    }


    public function getMoyasarPaymentLibrary()
    {
        return $this->moyasar_payments_library;
    }
}
