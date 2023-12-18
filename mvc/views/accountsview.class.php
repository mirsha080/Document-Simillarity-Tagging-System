<?php
include_once '../../mvc/models/accountsmod.class.php';

class AccountsView extends AccountsMod {


    public function showAdminAccounts(){

        $sqlValidate =  $this->getAdminAccounts();
        
        return $sqlValidate;
        
        
    }

    public function showCoorAccounts(){

        $sqlValidate =  $this->getCoorAccounts();
        
        return $sqlValidate;
        
        
    }




}