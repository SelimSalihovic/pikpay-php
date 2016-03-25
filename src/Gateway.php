<?php

namespace SelimSalihovic\PikPay;

use GuzzleHttp\Client as HttpClient;
use SelimSalihovic\PikPay\Requests;

/**
 * PikPay Gateway.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class Gateway
{
    protected $endpoint;
    protected $httpClient;
    protected $apiKey;
    protected $secretKey;

    public function __construct($endpoint, $apiKey, $secretKey)
    {
        $this->endpoint = $endpoint;
        $this->setApiKey($apiKey);
        $this->setSecretKey($secretKey);
        $this->httpClient = $this->createClient();
    }

    public function authorize(array $params)
    {
        return $this->createRequest(Requests\AuthorizationRequest::class, $params);
    }

    public function authorizeWithInstallments(array $params, $installments = null)
    {
        return $this->createRequest(Requests\AuthorizationRequest::class, $params, $installments);
    }

    public function purchase(array $params)
    {
        return $this->createRequest(Requests\PurchaseRequest::class, $params);
    }

    public function purchaseWithInstallments(array $params, $installments = null)
    {
        return $this->createRequest(Requests\PurchaseRequest::class, $params, $installments);
    }

    public function capture(array $params)
    {
        return $this->createRequest(Requests\CaptureRequest::class, $params);
    }

    public function refund(array $params)
    {
        return $this->createRequest(Requests\RefundRequest::class, $params);
    }

    public function void(array $params)
    {
        return $this->createRequest(Requests\VoidRequest::class, $params);
    }

    protected function createRequest($class, array $params, $installments = null)
    {
        if (is_null($installments)) {
            $obj = new $class($this->httpClient, $this, $params);
        } else {
            $obj = new $class($this->httpClient, $this, $params, $installments);
        }

        return $obj->response();
    }

    protected function createClient()
    {
        return new HttpClient([
            'base_uri' => $this->endpoint,
            'verify'   => false,
        ]);
    }

    public function endpoint()
    {
        return $this->endpoint;
    }

    public function setApiKey($key)
    {
        $this->apiKey = $key;
    }

    public function setSecretKey($key)
    {
        $this->secretKey = $key;
    }

    public function apiKey()
    {
        return $this->apiKey;
    }

    public function secretKey()
    {
        return $this->secretKey;
    }

    public function httpClient()
    {
        return $this->httpClient;
    }
}
