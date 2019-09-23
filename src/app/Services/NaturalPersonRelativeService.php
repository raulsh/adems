<?php

namespace Raulsalamanca\Adems\App\Services;

class NaturalPersonRelativeService extends WebService{
  public function SearchByNaturalPersonId($naturalPersonId){
    $response = parent::SearchByNaturalPersonId(compact('naturalPersonId'));
    if($persons = @$response->SearchByNaturalPersonIdResult->NaturalPersonRelativeLite){
      if(is_array($persons))
        return $persons;
      else
        return [$persons];
    }
    return [];
  }
}
