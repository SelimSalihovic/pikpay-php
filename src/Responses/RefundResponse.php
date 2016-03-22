<?php

namespace SelimSalihovic\PikPay\Responses;

/**
 * PikPay RefundResponse.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class RefundResponse extends Response
{
    public function isSuccessfull()
    {
        return $this->httpResponse->getStatusCode() == 200;
    }
}
