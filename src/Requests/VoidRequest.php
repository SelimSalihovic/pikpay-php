<?php

namespace SelimSalihovic\PikPay\Requests;

use GuzzleHttp\Client as HttpClient;
use SelimSalihovic\PikPay\Gateway;
use SelimSalihovic\PikPay\Responses\VoidResponse;

/**
 * PikPay VoidRequest.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class VoidRequest extends Request
{
    protected $uri;
    protected $params;
    protected $httpClient;
    protected $httpRequest;
    protected $response;

    public function __construct(HttpClient $httpClient, Gateway $gateway, array $params)
    {
        parent::__construct($httpClient, $gateway, 'void', $params);
        $this->uri = '/transactions/' . $params['order-number'] . '/void.xml';
        $this->httpClient = $httpClient;
        $this->params = $params;
        $this->send();
    }

    public function response()
    {
        return new VoidResponse($this->response);
    }
}
