<?php

namespace Raulsalamanca\Adems\app\Services;

class PaymentTypeService extends WebService{
  public function GetAll(){
    $response = parent::GetAll();
    if($payments = @$response->GetAllResponse->GetAllResult)
      return $payments;
    return [];
  }
}
