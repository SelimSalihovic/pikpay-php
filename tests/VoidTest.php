<?php

namespace SelimSalihovic\PikPay;

use SelimSalihovic\PikPay\Requests\AuthorizationRequest;
use SelimSalihovic\PikPay\Requests\VoidRequest;
use SelimSalihovic\PikPay\Responses\VoidResponse;

class VoidTest extends \PHPUnit_Framework_TestCase
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
            'ip'              => '128.65.108.112',
            'order-info'      => 'Test',
            'ch-address'      => 'Bleh',
            'ch-city'         => 'Lukvc',
            'ch-country'      => 'BiH',
            'ch-email'        => 'bleh@gmail.com',
            'ch-full-name'    => 'Selim',
            'ch-phone'        => '06174234',
            'ch-zip'          => '75300',
            'currency'        => 'BAM',
            'order-number'    => $order_number,
            'language'        => 'en',
        ];
    }

    /**
     * @test
     */
    public function it_returns_a_void_response()
    {
        new AuthorizationRequest($this->httpClient, $this->gateway, $this->data);

        $voidRequest = new VoidRequest($this->httpClient, $this->gateway, $this->data);

        $this->assertInstanceOf(VoidResponse::class, $voidRequest->response());
    }
}
