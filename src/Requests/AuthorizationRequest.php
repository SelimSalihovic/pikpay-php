<?php

namespace SelimSalihovic\PikPay\Requests;

use GuzzleHttp\Client as HttpClient;
use SelimSalihovic\PikPay\Gateway;
use SelimSalihovic\PikPay\Responses\AuthorizationResponse;

/**
 * PikPay AuthorizationRequest.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class AuthorizationRequest extends Request
{
    protected $uri;
    protected $params;
    protected $httpClient;
    protected $httpRequest;
    protected $response;

    public function __construct(HttpClient $httpClient, Gateway $gateway, array $params, $installments = null)
    {
        $this->setInstallments($params, $installments);
        parent::__construct($httpClient, $gateway, 'authorize', $this->params);
        $this->uri = '/api';
        $this->httpClient = $httpClient;
        $this->send();
    }

    public function response()
    {
        return new AuthorizationResponse($this->response);
    }
}
