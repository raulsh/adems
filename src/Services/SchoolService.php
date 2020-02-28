<?php

namespace Raulsalamanca\Adems\Services;

class SchoolService extends WebService
{
    public function GetAuthorized($filter = '')
    {
        $response = parent::GetAuthorized(compact('filter'));
        if ($schools = @$response->GetAuthorizedResult->SchoolLite) {
            return $schools;
        }

        return [];
    }
}
