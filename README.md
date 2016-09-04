# PikPay-php

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/9b6f8918-9c22-48a7-9c78-98e868e5b908/big.png)](https://insight.sensiolabs.com/projects/9b6f8918-9c22-48a7-9c78-98e868e5b908)

[![Latest Stable Version](https://img.shields.io/packagist/v/selimsalihovic/pikpay-php.svg?style=flat-square)](https://packagist.org/packages/selimsalihovic/pikpay-php)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.3.0-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://travis-ci.org/SelimSalihovic/pikpay-php.svg?branch=master)](https://travis-ci.org/SelimSalihovic/pikpay-php)
[![StyleCI](https://styleci.io/repos/54515838/shield)](https://styleci.io/repos/54515838)

## Install

Via Composer

``` bash
$ composer require selimsalihovic/pikpay-php
```

## Usage
To use the package first grab your credentials from your PikPay account. You will need your **Authenticity Token** (API_KEY) and **Key** (SECRET_KEY).
Before any request, an instance of Gateway has to be constructed.
``` php
$gateway = new Gateway(getenv('ENDPOINT'), getenv('API_KEY'), getenv('SECRET_KEY'));
```

### Input Data
For each Request, a data array is needed. See the [PikPay Docs](https://ipgtest.pikpay.ba/hr/documentation/direct "PikPay Docs") to see which values need to be included for which request.  **Note**: you do not need to include the 'digest' parameter as it is calculated for you on each request based on the data array.  

Here is an example of a valid data array.
``` php
$data = [
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
    'order-number'    => 'order-d234djflq0wz',
    'language'        => 'en',
];
```
### Sending an Authorization Request
``` php
$response = $gateway->authorize($data);
if ($response->isSuccessfull()) {
    //handle success case
} else {
    //display error
}
```

### Sending a Capture Request
Capture requests are sent only for previously authorized transactions.
``` php
$gateway->authorize($data);
$response = $gateway->capture($data);
```

### Sending a Purchase Request
The purchase request does both.
``` php
$response = $gateway->purchase($data);
```

### Sending a Refund Request
``` php
$response = $gateway->refund($data);
```

### Sending a Void Request
``` php
$response = $gateway->void($data);
```

## Testing

To run the tests be sure to have all the dev dependencies from composer.json installed. 
``` bash
$ cd pikpay-php && cp example.phpunit.xml.dist phpunit.xml.dist
$ nano phpunit.xml.dist #update your credentials and save them
$ vendor/bin/phpunit
```
