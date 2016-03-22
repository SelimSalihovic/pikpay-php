<?php

namespace SelimSalihovic\PikPay\Requests;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Request as HttpRequest;
use SelimSalihovic\PikPay\Gateway;

/**
 * PikPay Request.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class Request
{
    protected $httpClient;
    protected $httpRequest;
    protected $gateway;

    protected $xml;

    protected $response;

    public function __construct(HttpClient $httpClient, Gateway $gateway, $root, array $params)
    {
        $this->httpClient = $httpClient;
        $this->gateway = $gateway;
        $this->xml = $this->parse($params, $root);
    }

    protected function digest(array $params)
    {
        $paramString = $params['order-number'] . $params['amount'] . $params['currency'];
        return sha1($this->gateway->secretKey() . $paramString);
    }

    public function send()
    {
        $path = $this->httpClient->getConfig('base_uri') . $this->uri;
        $this->httpRequest = new HttpRequest('POST', $path, $this->headers(), $this->xml);

        try {
            $response = $this->httpClient->send($this->httpRequest);
            $this->response = $response;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $this->response = $e->getResponse();
        }
    }

    protected function setInstallments($params, $installments)
    {
        if ($installments !== null) {
            $params['number-of-installments'] = $installments;
        }

        return $this->params = $params;
    }

    protected function parse(array $params, $root)
    {
        $xml = new \SimpleXMLElement('<' . 'transaction' . '/>');
        $xml->addChild('transaction-type', $root);
        $xml->addChild('authenticity-token', $this->gateway->apiKey());

        $xml->addChild('digest', $this->digest($params));

        foreach ($params as $key => $value) {
            $xml->addChild($key, $value);
        }

        return $xml->asXML();
    }

    protected function headers()
    {
        return [
            'Accept'       => 'application/xml',
            'Content-Type' => 'application/xml; charset=UTF8',
        ];
    }
}
