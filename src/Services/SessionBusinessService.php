<?php

namespace raulsalamanca\adems\Services;

class SessionBusinessService extends WebService{
  public function Start($selectedSchoolId, $selectedPeriodId){
    parent::Start(compact('selectedSchoolId', 'selectedPeriodId'));
    return true;
  }
}
