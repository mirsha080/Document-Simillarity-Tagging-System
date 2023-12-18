<?php

require_once '../../mvc/models/accountsmod.class.php';

class AccountsCont extends AccountsMod{

    public function updateAccnt($accnt_id,$status){

       $result = $this->updateAccntStatus($accnt_id,$status);
       return $result;

    }

    
}