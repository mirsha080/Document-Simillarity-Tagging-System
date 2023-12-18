<?php
// include 'inc/autoloader.inc.php';
require_once '../mvc/dbh.class.php';
session_start();
class LoginMod extends Dbh{
    

    public function login($user, $pass){
        
        $conn = $this->connect();

        $username = mysqli_real_escape_string($conn,$user);
        $password = mysqli_real_escape_string($conn,$pass);
        
        if (empty($username) || empty($password)){
            header("Location: ../pages/login2.php?login=empty"); 
            exit();
        }
        else {

            $queryValidate = "SELECT * FROM accounts WHERE username='$username' AND accounts.status = 'ACTIVE'";
            $sqlValidate = mysqli_query($conn, $queryValidate);
            $resultCheck = mysqli_num_rows($sqlValidate);
           
            if ($resultCheck < 1) {
                $error = "* Invalid username/password";
                $_SESSION["error"] = $error;
                header("Location: ../pages/login2.php?login=error"); 
                exit();
            
                
             }  else {
                
                if ( $rowValidate = mysqli_fetch_array($sqlValidate)){
                    //De-hashing the password
                    $hashedPwdCheck = password_verify($password, $rowValidate['password']);
                    if ($hashedPwdCheck == false ) {
                        $error = "* Invalid username/password";
                        $_SESSION["error"] = $error;
                        header("Location: ../pages/login2.php?login=error"); 
                        exit();
                     
                    } else if ($hashedPwdCheck == true ) {
                         $_SESSION['account_id'] = $rowValidate['account_id'];
                         $_SESSION['account_type'] = $rowValidate['account_type'];
                       
                         return 1;
                    }

                }
                return 1;
               
             } 

        }
       

           
    }
} 