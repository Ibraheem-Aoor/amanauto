<?php
namespace App\Services;

use App\Http\Requests\User\PaymentWithCreditCardRequest;
use App\Models\Club;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
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
            throw new Exception(__('general.payment_failed'));
        }
    }


    /**
     * get order data for payment
     * @return array $order_data
     */
    private function getOrderDataForCreditCard($request)
    {
        return [
            'amount' => (int) $this->club->getTotalPrice(),
            'currency' => 'SAR',
            'description' => "AMANAUTO SUBSCRIPTION {$this->club->translate('en')->name} X 1",
            'callback_url' => route('subscribe.payment.credit_card_callback', ['club_id' => $this->club->getEncryptedId()]),
            'source' => [
                'type' => 'creditcard',
                'name' => getAuthUser()->name,
                'number' => $request->card_number,
                'cvc' => $request->cvc,
                'month' => $request->expiration_month,
                'year' => $request->expiration_year,
            ],
            'metadata' => [
                'club_id' => $this->club->getEncryptedId(),
                'vat' => $this->club->vat,
                'vat_type' => $this->club->vat_type,
            ],
        ];
    }


    /**
     * Log Payment
     */

    public function logPayment($payment, $subscription_id, $payment_method)
    {
        Payment::query()->create([
            'payment_id' => $payment->id,
            'status' => $payment->status,
            'method' => $payment_method,
            'amount' => $payment->amount,
            'description' => $payment->description,
            'metadata' => json_encode($payment->metadata),
            'subscription_id' => $subscription_id,
            'user_id' => getAuthUser('web')->id,
        ]);
    }



    public function getMoyasarPaymentLibrary()
    {
        return $this->moyasar_payments_library;
    }
}
