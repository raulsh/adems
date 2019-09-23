<?php

namespace Raulsalamanca\Adems;

use Goutte\Client as Crawler;
use Raulsalamanca\Adems\app\Services\SessionBusinessService;

class Auth{
  private $crawler, $sesscert;

  public function __construct(){
    $this->username = config('adems.username');
    $this->password = config('adems.password');
    $this->schoolId = config('adems.default_school_id');
    $this->periodId = config('adems.default_period_id');
  }

  public function login(){
    if($this->username and $this->password){
      $crawler = $this->crawler()->request('GET', 'http://www.adems.cl');
      $crawler = $this->crawler()->submit($crawler->selectButton('ctl00$ContentPlaceHolder2$Login1$lgnSignInPassword$btnLoginSingInPassword')->form(), [
        'ctl00$ContentPlaceHolder2$Login1$lgnSignInPassword$UserName' => $this->username,
        'ctl00$ContentPlaceHolder2$Login1$lgnSignInPassword$Password' => $this->password
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
    $this->schoolId = $schoolId;
    $this->periodId = $periodId ? $periodId : $this->periodId;
    return app(SessionBusinessService::class)->Start($this->schoolId, $this->periodId);
  }

  public function setDefaultSchool(){
    return $this->setSchool(config('adems.default_school_id'), config('adems.default_period_id'));
  }

  private function setSesscert($sesscert){
    return \Session::put('adems.sesscert', $sesscert) == null;
  }

  public function getSesscert(){
    return (string) \Session::get('adems.sesscert');
  }

}

 ?>
