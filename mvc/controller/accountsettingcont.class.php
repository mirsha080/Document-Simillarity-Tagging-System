<?php

require_once '../../mvc/models/accountsettingmod.class.php';

class AccountSettingCont extends AccountSettingMod{

    public function updateAccnt($fname, $mname,  $lname , $username,  $password){

      $result = $this->setAccnt( $fname, $mname,  $lname , $username,  $password);
      return $result;
      

    }

    public function updateProfile($data){

      $result = $this->setProfile($data);
      return $result;
      

    }

    
}