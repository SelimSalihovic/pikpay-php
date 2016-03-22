<?php

namespace SelimSalihovic\PikPay\Responses;

/**
 * PikPay PurchaseResponse.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class PurchaseResponse extends Response
{
    public function isSuccessfull()
    {
        return $this->httpResponse->getStatusCode() == 201;
    }

    public function transactionId()
    {
        return (int) preg_replace("/[^0-9]/", "", $this->location());
    }

    public function location()
    {
        return $this->httpResponse->getHeaderLine('location');
    }
}
