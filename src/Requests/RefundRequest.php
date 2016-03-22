<?php

namespace SelimSalihovic\PikPay\Requests;

use GuzzleHttp\Client as HttpClient;
use SelimSalihovic\PikPay\Gateway;
use SelimSalihovic\PikPay\Responses\RefundResponse;

/**
 * PikPay RefundRequest.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class RefundRequest extends Request
{
    protected $uri;
    protected $params;
    protected $httpClient;
    protected $httpRequest;
    protected $response;

    public function __construct(HttpClient $httpClient, Gateway $gateway, array $params)
    {
        parent::__construct($httpClient, $gateway, 'refund', $params);
        $this->uri = '/transactions/' . $params['order-number'] . '/refund.xml';
        $this->httpClient = $httpClient;
        $this->params = $params;
        $this->send();
    }

    public function response()
    {
        return new RefundResponse($this->response);
    }
}
