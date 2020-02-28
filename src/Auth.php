<?php

namespace Raulsalamanca\Adems;

use Goutte\Client as Crawler;
use Raulsalamanca\Adems\Services\SessionBusinessService;

class Auth
{
    public $sesscert;
    private $crawler;
    private $username;
    private $password;
    private $schoolId;
    private $periodId;

    public function __construct($username, $password, $schoolId, $periodId)
    {
        $this->username = $username;
        $this->password = $password;
        $this->schoolId = $schoolId;
        $this->periodId = $periodId;
    }

    public function login()
    {
        if ($this->username && $this->password) {
            $login = $this->crawler()->request('GET', 'http://www.adems.cl');
            $login = $this->crawler()->submit($login->selectButton('ctl00$ContentPlaceHolder2$Login1$lgnSignInPassword$btnLoginSingInPassword')->form(), [
                'ctl00$ContentPlaceHolder2$Login1$lgnSignInPassword$UserName' => $this->username,
                'ctl00$ContentPlaceHolder2$Login1$lgnSignInPassword$Password' => $this->password,
            ]);

            @parse_str($login->filter('[name="initParams"]')->attr('value'));

            if ($this->sesscert = $sesscert) {
                return $this->setDefaultSchool();
            }
        }

        return false;
    }

    public function isConnected()
    {
        if ($this->sesscert) {
            try {
                return $this->setDefaultSchool();
            } catch (\SoapFault $e) {
                return false;
            }
        }

        return false;
    }

    private function crawler()
    {
        if (!$this->crawler) {
            $this->crawler = new Crawler();
        }

        return $this->crawler;
    }

    public function setSchool($schoolId, $periodId = false)
    {
        $this->schoolId = $schoolId;
        $this->periodId = $periodId ? $periodId : $this->periodId;

        return app(SessionBusinessService::class)->Start($this->schoolId, $this->periodId);
    }

    public function setDefaultSchool()
    {
        return $this->setSchool(\Config::get('adems.default_school_id'), \Config::get('adems.default_period_id'));
    }
}
