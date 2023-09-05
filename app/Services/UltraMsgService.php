<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Throwable;

class UltraMsgService
{

    protected $ultrams_configs;


    public function __construct()
    {
        $this->ultrams_configs = config('services.ultramsg');
    }


    /**
     * Send Wa message
     */
    public function sendWaMessage(array $data)
    {

        $params = array_merge($data, ['token' => $this->ultrams_configs['token']]);
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $this->ultrams_configs['api_url'] . '/messages/chat',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => $this->ultrams_configs['headers']['message_headers'],
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return throw new Exception($err);
        } else {
            $response = json_decode($response, true);
            if (@$response['error']) {
                info('ULTRA MESSAGE ERROR :');
                info(@$response['error']);
                return throw new Exception(__('general.response_messages.error'));
            } else {
                return $response;
            }
        }
    }

}
