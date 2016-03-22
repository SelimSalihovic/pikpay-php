<?php

namespace SelimSalihovic\PikPay\Responses;

use GuzzleHttp\Psr7\Response as HttpResponse;

/**
 * PikPay Response.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class Response
{
    public $httpResponse;

    public function __construct(HttpResponse $httpResponse)
    {
        $this->httpResponse = $httpResponse;
    }

    protected function removeStatusCode($status)
    {
        return $status = preg_replace('/[0-9]+/', '', $status);
    }
}
