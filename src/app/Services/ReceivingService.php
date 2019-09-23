<?php

namespace Raulsalamanca\Adems\App\Services;

class ReceivingService extends WebService{
  var $debug;
  public function SearchByReceivingFilter($status=0){
    $response = parent::SearchByReceivingFilter(compact('status'));
    if($receivings = @$response->SearchByReceivingFilterResult->Receiving)
      return $receivings;
    return [];
  }

  public function GetReceivingLite($receivingId){
    $response = parent::GetReceivingLite(compact('receivingId'));
    $this->debug = $response;
    if($receiving = @$response->GetReceivingLiteResult){
      if(@$receiving->Items->ReceivingItemLite->ReceivingItem){
        return [$receiving->Items->ReceivingItemLite];
      }
      else if(is_array($receiving->Items->ReceivingItemLite)){
              return $receiving->Items->ReceivingItemLite;
      }
      else if(is_array($receiving->Items)){
        $items = [];
        foreach($receiving->Items as $item){
          $items[] = $item->ReceivingItemLite;
        }
        return $items;
      }
      else{
        return $receiving;
      }
    }
    return null;
  }
}
