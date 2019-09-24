<?php

namespace Raulsalamanca\Adems\app\Services;

class SessionBusinessService extends WebService{
  public function Start($selectedSchoolId, $selectedPeriodId){
    return parent::Start(compact('selectedSchoolId', 'selectedPeriodId'));
  }
}
