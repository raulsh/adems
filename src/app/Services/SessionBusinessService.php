<?php

namespace Raulsalamanca\Adems\App\Services;

class SessionBusinessService extends WebService{
  public function Start($selectedSchoolId, $selectedPeriodId){
    parent::Start(compact('selectedSchoolId', 'selectedPeriodId'));
    return true;
  }
}
