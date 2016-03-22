<?php

namespace SelimSalihovic\PikPay\Responses;

/**
 * PikPay CaptureResponse.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class CaptureResponse extends Response
{
    public function isSuccessfull()
    {
        return $this->httpResponse->getStatusCode() == 200;
    }
}
