<?php
namespace raulsalamanca\adems;

use Goutte\Client as Crawler;
use App\Libraries\Adems\Services\SessionBusinessService;

class Auth{
  private $crawler, $sesscert;

  function __construct(Config $config){
    $this->config  = $config;
  }

  public function login(){
    $username = $this->config->getUsername();
    $password = $this->config->getPassword();

    if($username and $password){
      $crawler = $this->crawler()->request('GET', 'http://www.adems.cl');
      $crawler = $this->crawler()->submit($crawler->selectButton('ctl00$ContentPlaceHolder2$Login1$lgnSignInPassword$btnLoginSingInPassword')->form(), [
        'ctl00$ContentPlaceHolder2$Login1$lgnSignInPassword$UserName' => $username,
        'ctl00$ContentPlaceHolder2$Login1$lgnSignInPassword$Password' => $password
      ]);

      @parse_str($crawler->filter('[name="initParams"]')->attr('value'));

      if($this->setSesscert($sesscert))
        return $this->setDefaultSchool();
    }
    return false;
  }

  public function isConnected(){
    if($this->getSesscert()){
      try{
        return $this->setDefaultSchool();
      }catch(\SoapFault $e){}
    }
    return false;
  }

  private function crawler(){
    if(!$this->crawler)
      $this->crawler = new Crawler();
    return $this->crawler;
  }

  public function setSchool($schoolId, $periodId = false){
    $sessionBusiness = app(SessionBusinessService::class);
    return $sessionBusiness->Start($schoolId, $periodId ? $periodId : $this->config->getPeriodId());
  }

  public function setDefaultSchool(){
    return $this->setSchool($this->config->getSchoolId(), $this->config->getPeriodId());
  }

  private function setSesscert($sesscert){
    return \Session::put('adems.sesscert', $sesscert) == null;
  }

  public function getSesscert(){
    return (string) \Session::get('adems.sesscert');
  }

}

 ?>
