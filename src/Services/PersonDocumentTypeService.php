<?php

namespace Raulsalamanca\Adems\Services;

class PersonDocumentTypeService extends WebService
{
    public function SearchByPersonId($personId)
    {
        $response = parent::SearchByPersonId(compact('personId'));
        if ($document = $response->SearchByPersonIdResult->PersonDocumentType->Description01) {
            return $document;
        }

        return null;
    }
}
