<?php

namespace Raulsalamanca\Adems\app\Services;

class PersonAddressService extends WebService{
  public function SearchByPersonId($personId){
    $response = parent::SearchByPersonId(compact('personId'));
    if($addresses = $response->SearchByPersonIdResult->PersonAddress){
      if(is_array($addresses))
        return $addresses;
      else
        return [$addresses];
    }
    return [];
  }
}
