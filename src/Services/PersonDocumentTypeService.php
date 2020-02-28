<?php

namespace Raulsalamanca\Adems\Services;

class PersonDocumentTypeService extends WebService
{
    public function SearchByPersonId($personId)
    {
        parent::SearchByPersonId(compact('personId'));
        if ($document = @$service->SearchByPersonIdResult->PersonDocumentType->Description01) {
            return $document;
        }

        return null;
    }
}
