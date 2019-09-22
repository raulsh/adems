<?php
namespace raulsalamanca\adems;

class Config{
  private $username, $password;
  private $schoolId, $periodId;

  function __construct($username, $password, $schoolId, $periodId){
    $this->username = $username;
    $this->password = $password;
    $this->schoolId = $schoolId;
    $this->periodId = $periodId;
  }

  public function set(array $config){
    if(@$config['username'])
      $this->username = $config['username'];
    if(@$config['password'])
      $this->password = $config['password'];
    if(@$config['schoolId'])
      $this->schoolId = $config['schoolId'];
    if(@$config['periodId'])
      $this->periodId = $config['periodId'];
  }

  public function getUsername(){
    return $this->username;
  }

  public function getPassword(){
    return $this->password;
  }

  public function getSchoolId(){
    return $this->schoolId;
  }

  public function getPeriodId(){
    return $this->periodId;
  }
}
