<?php

require_once '../../mvc/dbh.class.php';

class AccountsMod extends Dbh{

    protected function getAdminAccounts(){

        $conn = $this->connect();

        $queryValidate = "SELECT  admin.fname, admin.mname,  admin.lname, accounts.account_id, accounts.account_type, accounts.status 
                          FROM   admin, accounts WHERE admin.account_id = accounts.account_id;";
        $sqlValidate = mysqli_query($conn, $queryValidate);
        $numRows = mysqli_num_rows($sqlValidate);
       
       
        if ($numRows > 0){
            return $sqlValidate;
        }
    }

    protected function getCoorAccounts(){

        $conn = $this->connect();

        $queryValidate = "SELECT research_coordinator.fname, research_coordinator.mname,  research_coordinator.lname, accounts.account_id, accounts.account_type, accounts.status 
                          FROM   research_coordinator, accounts WHERE  research_coordinator.account_id = accounts.account_id ;";
        $sqlValidate = mysqli_query($conn, $queryValidate);
        $numRows = mysqli_num_rows($sqlValidate);
       
       
        if ($numRows > 0){
            return $sqlValidate;
        }
    }
    
    protected function updateAccntStatus($accnt_id,$status){
        $conn = $this->connect();

        $queryValidate = "UPDATE accounts SET status='$status' WHERE accounts.account_id=$accnt_id;";
        
         if($sqlValidate = mysqli_query($conn, $queryValidate)){;
            return 1;
        }
        return 0;
        
        
    }



}