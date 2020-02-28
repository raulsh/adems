<?php

namespace Raulsalamanca\Adems\Services;

use Raulsalamanca\Adems\Auth;
use SoapClient;
use SoapFault;
use SoapHeader;
use SoapVar;

class WebService extends SoapClient
{
    private static $wsUrl = 'http://www.adems.cl/Services/';

    public function __construct(Auth $auth)
    {
        parent::__construct(self::$wsUrl.(new \ReflectionClass($this))->getShortName().'.svc?singleWsdl', ['trace' => 1]);
        $this->auth = $auth;
    }

    public function __call($method, $args)
    {
        $this->__setSoapHeaders(
      new SoapHeader('http://schemas.xmlsoap.org/soap/envelope/', 'sesscert', new SoapVar('<sesscert>'.$this->auth->sesscert.'</sesscert>', XSD_ANYXML))
    );

        try {
            return parent::__call($method, $args);
        } catch (SoapFault $e) {
            return false;
        }
    }
}
