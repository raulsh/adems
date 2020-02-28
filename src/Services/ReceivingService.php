<?php

namespace Raulsalamanca\Adems\Services;

class ReceivingService extends WebService
{
    public $debug;

    public function SearchByReceivingFilter($status = 0)
    {
        $response = parent::SearchByReceivingFilter(compact('status'));
        if ($receivings = @$response->SearchByReceivingFilterResult->Receiving) {
            return $receivings;
        }

        return [];
    }

    public function GetReceivingLite($receivingId)
    {
        $response = parent::GetReceivingLite(compact('receivingId'));
        $this->debug = $response;
        if ($receiving = @$response->GetReceivingLiteResult) {
            if (@$receiving->Items->ReceivingItemLite->ReceivingItem) {
                $items = [$receiving->Items->ReceivingItemLite];
            } elseif (is_array($receiving->Items->ReceivingItemLite)) {
                $items = $receiving->Items->ReceivingItemLite;
            } elseif (is_array($receiving->Items)) {
                $items = [];
                foreach ($receiving->Items as $item) {
                    $items[] = $item->ReceivingItemLite;
                }
            } else {
                $items = $receiving;
            }

            return $items;
        }

        return null;
    }
}
