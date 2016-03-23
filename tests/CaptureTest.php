<?php

namespace SelimSalihovic\PikPay;

use SelimSalihovic\PikPay\Requests\AuthorizationRequest;
use SelimSalihovic\PikPay\Requests\CaptureRequest;
use SelimSalihovic\PikPay\Responses\CaptureResponse;

class CaptureTest extends \PHPUnit_Framework_TestCase
{
    public $gateway;
    public $httpClient;
    public $data;

    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway(getenv('TEST_ENDPOINT'), getenv('API_KEY'), getenv('SECRET_KEY'));
        $this->httpClient = $this->gateway->httpClient();
        $order_number = md5(microtime());

        $this->data = [
            'amount'          => 5500,
            'expiration-date' => 1707,
            'cvv'             => 286,
            'pan'             => 5464000000000008,
            'ip'              => '128.93.108.112',
            'order-info'      => 'Test Order',
            'ch-address'      => '1419 Westwood Blvd',
            'ch-city'         => 'Los Angeles',
            'ch-country'      => 'USA',
            'ch-email'        => 'john.doe@gmail.com',
            'ch-full-name'    => 'John Doe',
            'ch-phone'        => '636-48018',
            'ch-zip'          => '90024',
            'currency'        => 'USD', //EUR, BAM, HRK
            'order-number'    => $order_number,
            'language'        => 'en',
        ];
    }

    /**
     * @test
     */
    public function it_returns_a_capture_response()
    {
        new AuthorizationRequest($this->httpClient, $this->gateway, $this->data);
        $captureRequest = new CaptureRequest($this->httpClient, $this->gateway, $this->data);

        $this->assertInstanceOf(CaptureResponse::class, $captureRequest->response());
    }
}
