<?php

namespace Raulsalamanca\Adems\app\Services;

use SoapClient, SoapHeader, SoapVar, SoapFault;
use Raulsalamanca\Adems\Auth;

class WebService extends SoapClient{
  private static $wsUrl    = 'http://www.adems.cl/Services/';

  function __construct(Auth $auth){
    parent::__construct(self::$wsUrl . (new \ReflectionClass($this))->getShortName() . '.svc?singleWsdl', ['trace' => 1]);
    $this->auth = $auth;
  }

  function __call($method, $args){
    $this->__setSoapHeaders(
      new SoapHeader('http://schemas.xmlsoap.org/soap/envelope/', 'sesscert', new SoapVar('<sesscert>' . $this->auth->sesscert . '</sesscert>', XSD_ANYXML))
    );

    try{
      return parent::__call($method, $args);
    }
    catch(SoapFault $e){
      return false;
    }
  }
}
?>
