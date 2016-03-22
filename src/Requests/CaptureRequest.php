<?php

namespace SelimSalihovic\PikPay\Requests;

use GuzzleHttp\Client as HttpClient;
use SelimSalihovic\PikPay\Gateway;
use SelimSalihovic\PikPay\Responses\CaptureResponse;

/**
 * PikPay CaptureRequest.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class CaptureRequest extends Request
{
    protected $uri;
    protected $params;
    protected $httpClient;
    protected $httpRequest;
    protected $response;

    public function __construct(HttpClient $httpClient, Gateway $gateway, array $params)
    {
        parent::__construct($httpClient, $gateway, 'capture', $params);
        $this->uri = '/transactions/' . $params['order-number'] . '/capture.xml';
        $this->httpClient = $httpClient;
        $this->params = $params;
        $this->send();
    }

    public function response()
    {
        return new CaptureResponse($this->response);
    }
}
