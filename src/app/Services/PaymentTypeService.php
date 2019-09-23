<?php

namespace Raulsalamanca\Adems\App\Services;

class PaymentTypeService extends WebService{
  public function GetAll(){
    $response = parent::GetAll();
    if($payments = @$response->GetAllResponse->GetAllResult)
      return $payments;
    return [];
  }
}
