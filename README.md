# pikpay-php

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a2e50041-aa3e-45d0-9647-5024047a6d56/big.png)](https://insight.sensiolabs.com/projects/a2e50041-aa3e-45d0-9647-5024047a6d56)

[![Build Status](https://travis-ci.org/SelimSalihovic/pikpay-php.svg?branch=master)](https://travis-ci.org/SelimSalihovic/pikpay-php)

## Install

Via Composer

``` bash
$ composer require selimsalihovic/pikpay-php
```

## Usage
To use the package first grab your credentials from your PikPay account. You will need your **Authenticity Token** and **Key** (which will just have the value of the company name). The Authenticity Token and the Key are referenced as API KEY and SECRET KEY in the package.

Before any request, an instance of Gateway has to be constructed.
``` php
$gateway = new Gateway(getenv('ENDPOINT'), getenv('API_KEY'), getenv('SECRET_KEY'));
```
For each Request, a data array is needed. See the [PikPay Docs](https://ipgtest.pikpay.ba/hr/documentation/direct "PikPay Docs") to see which values need to be included for which request.  **Note: you do not need to include the 'digest' parameter as it is calculated for you on each request based on the data array**.  

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
$ cd pikpay-php && mv example.phpunit.xml.dist phpunit.xml.dist
$ nano phpunit.xml.dist #update your credentials and save them
$ vendor/bin/phpunit
```
