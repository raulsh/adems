<?php

namespace Raulsalamanca\Adems\Services;

class PersonService extends WebService
{
    public function SearchByStudentOrResponsible($filter = '', $birthDate = null, $document = '', $mySchool = true, $isStudent = true, $isResponsible = true, $onlyActive = true)
    {
        $response = parent::SearchByStudentOrResponsible(compact('filter', 'birthDate', 'document', 'mySchool', 'isStudent', 'isResponsible', 'onlyActive'));
        if ($persons = @$response->SearchByStudentOrResponsibleResult->PersonLite) {
            return $persons;
        }

        return [];
    }
}
