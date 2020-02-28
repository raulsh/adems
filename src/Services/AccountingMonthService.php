<?php

namespace Raulsalamanca\Adems\Services;

class AccountingMonthService extends WebService
{
    public function SearchMonthToAccount()
    {
        $response = parent::SearchMonthToAccount();
        if ($period = @$response->SearchMonthToAccountResult) {
            return $period;
        }

        return false;
    }
}
