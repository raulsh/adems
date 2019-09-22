<?php

namespace raulsalamanca\adems\services;

class AccountingMonthService extends WebService{
  public function SearchMonthToAccount(){
    $response = parent::SearchMonthToAccount();
    if($period = @$response->SearchMonthToAccountResult)
      return $period;
    return false;
  }
}
