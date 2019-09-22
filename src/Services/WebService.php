<?php
namespace raulsalamanca\adems\Services;

use SoapClient, SoapHeader, SoapVar, SoapFault;
use App\Libraries\Adems\Auth;

class WebService extends SoapClient{
  private static $wsUrl    = 'http://www.adems.cl/Services/';

  function __construct(Auth $auth){
    parent::__construct(self::$wsUrl . (new \ReflectionClass($this))->getShortName() . '.svc?singleWsdl', ['trace' => 1]);

    $this->__setSoapHeaders(
      new SoapHeader('http://schemas.xmlsoap.org/soap/envelope/', 'sesscert', new SoapVar('<sesscert>' . $auth->getSesscert() . '</sesscert>', XSD_ANYXML))
    );
  }

  function __call($method, $args){
    try{
      return parent::__call($method, $args);
    }
    catch(SoapFault $e){
      return false;
    }
  }
}
?>
