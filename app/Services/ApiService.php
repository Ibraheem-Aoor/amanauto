<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Throwable;

class ApiService
{


    protected $base_url;
    protected $headers;

    protected $token;


    public function __construct($base_url , $token = null , array $headers)
    {
        $this->base_url = $base_url;
        $this->token = $token;
        $this->headers = $headers;
    }



    /**
     * GEt Request
     * @param string $endpoint
     * @param array $params
     */
    public function get(string $endpoint , array $params = [])
    {
        $url = $this->base_url.$endpoint;
        $response = Http::withToken($this->token)
            ->withHeaders($this->headers)
            ->get($url, $params);
        return $response;
    }


    /**
     * POST Request
     * @param string $endpoint
     * @param array $data represents the form data to send
     */
    public function post(string $endpoint , array $data)
    {
        $url = $this->base_url.$endpoint;
        $response = Http::withToken($this->token)
                    ->withHeaders($this->headers)
                    ->post($url  , $data);
        return $response;
    }


    /**
     * PUT Request
     * @param string $endpoint
     * @param array $data represents the form data to send
     */
    public function put(string $endpoint , array $data)
    {
        $url = $this->base_url.$endpoint;
        $response = Http::withToken($this->token)
                    ->withHeaders($this->headers)
                    ->timeout(180)
                    ->put($url  , $data);
        return $response;
    }


    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setHeaders(array $headers)
    {
        $this->headers  = $headers;
    }
    public function getHeaders()
    {
        return $this->headers;
    }
}
