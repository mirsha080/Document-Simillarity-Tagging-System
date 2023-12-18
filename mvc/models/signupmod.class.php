<?php
require_once '../../mvc/dbh.class.php';


class SignupMod extends Dbh{
  
    
    

    protected function setAccount($username,$userType,$password){

        $conn =  $this->connect();
    

        $userName = mysqli_real_escape_string($conn,$username);
        $usertype = mysqli_real_escape_string($conn,$userType);
        $pass= mysqli_real_escape_string($conn,$password);

       $queryValidate = "SELECT * FROM accounts  WHERE username = '$username';";
       $sqlValidate = mysqli_query($conn,$queryValidate);
       $resultCheck = mysqli_num_rows($sqlValidate);

       if ($resultCheck > 0){
            header("Location:  ../admin/accounts.php?signup=usertaken");
            exit();
       }else {
            
            $hashedPwd = password_hash($pass,PASSWORD_DEFAULT);
            
            $queryValidate = "INSERT INTO accounts(account_type,username,password,status) values('$usertype', '$userName', '$hashedPwd','ACTIVE');";
            $sqlValidate = mysqli_query($conn, $queryValidate);
            return 1;
       }

    }


    protected function setUser($firstName, $middleName, $lastName, $username,$userType){
        
        $conn =  $this->connect();
    

        $fname = mysqli_real_escape_string($conn,$firstName);
        $mname = mysqli_real_escape_string($conn,$middleName);
        $lname = mysqli_real_escape_string($conn,$lastName);
        
        if (empty($fname) || empty($mname) || empty($lname)){
            header("Location:  ../admin/accounts.php?signup=empty"); 
            exit();
        }
        //  else {
            
        //     if (!preg_match("/^[a-zA-Z]*$/", $fname) || !preg_match("/^[a-zA-Z]*$/", $mname) || !preg_match("/^[a-zA-Z]*$/", $lname) ){
        //         header("Location:  ../admin/accounts.php?signup=invalid"); 
        //         exit();
        //     }

            else {
                
                $queryValidate = "SELECT account_id FROM accounts WHERE username='$username' LIMIT 1";
                $sqlValidate =  mysqli_query($conn,$queryValidate);
                $rowValidate = mysqli_fetch_array($sqlValidate);
                $AccntId = $rowValidate['account_id'];

                     if ($userType == 'Administrator'){
                        $queryValidate = "INSERT INTO admin(fname,mname,lname,account_id) values('$fname', '$mname', '$lname',$AccntId);";
                        $sqlValidate = mysqli_query($conn, $queryValidate);

                        return 1;
                     } else {
                        $queryValidate = "INSERT INTO research_coordinator(fname,mname,lname,account_id) values('$fname', '$mname', '$lname' , $AccntId);";
                        $sqlValidate = mysqli_query($conn, $queryValidate);
                        return 1;
                    }
                
        //     }
            
           
         }

       
    }
} 