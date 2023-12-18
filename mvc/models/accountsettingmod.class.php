<?php
require_once '../../mvc/dbh.class.php';


    Class AccountSettingMod extends dbh{
    
     
        protected function getAccountInfo(){
            $conn = $this->connect();
            $id = $_SESSION["account_id"];
            $accntType = $_SESSION['account_type'];

            if($accntType == 'Administrator') {
                $queryValidate = "SELECT  admin.fname, admin.mname, admin.lname, accounts.username
                                  FROM accounts, admin WHERE accounts.account_id = admin.account_id 
                                  AND accounts.account_id = $id";
                $sqlValidate = mysqli_query($conn, $queryValidate);
                return $sqlValidate;
            } else {

                $queryValidate = "SELECT research_coordinator.fname, research_coordinator.mname, research_coordinator.lname, accounts.username
                                  FROM accounts, research_coordinator WHERE accounts.account_id = research_coordinator.account_id 
                                  AND accounts.account_id = $id";
                $sqlValidate = mysqli_query($conn, $queryValidate);
                return $sqlValidate;

            }

        }

        protected function setAccnt($fname, $mname,  $lname , $username,  $password){
            $conn = $this->connect();
            $id = $_SESSION["account_id"];
            $accntType = $_SESSION['account_type'];
            $hashPwd = password_hash( $password, PASSWORD_DEFAULT);

            if($accntType == 'Administrator') {
            
                $queryValidate = "UPDATE admin SET fname = '$fname', mname = '$mname', lname = '$lname' WHERE account_id = $id";
                if(mysqli_query($conn,$queryValidate)){
            
                    if ((!empty($password) && !empty($username)) && !empty($password)){
                        $queryValidate = "UPDATE accounts SET  username = '$username', password = '$hashPwd'
                                          WHERE accounts.account_id = $id";
                        if(mysqli_query($conn, $queryValidate)){
                            
                            return 1;
                            
                        }
                    
                    }

                    if (!empty($username)){
                
                        $queryValidate = "UPDATE accounts SET  username = '$username'
                                          WHERE accounts.account_id = $id";
                        if(mysqli_query($conn, $queryValidate)){
                            
                            return 1;
                            
                        }


                    }
                }
            }
            else {


                $queryValidate = "UPDATE research_coordinator SET fname = '$fname', mname = '$mname', lname = '$lname' WHERE account_id = $id";
                if(mysqli_query($conn,$queryValidate)){
            
                    if ((!empty($password) && !empty($username)) && !empty($password)){
                        $queryValidate = "UPDATE accounts SET  username = '$username', password = '$hashPwd'
                                        WHERE accounts.account_id = $id";
                        if(mysqli_query($conn, $queryValidate)){
                            
                            return 1;
                            
                        }
                    
                    }

                    if (!empty($username)){
                
                        $queryValidate = "UPDATE accounts SET  username = '$username'
                                        WHERE accounts.account_id = $id";
                        if(mysqli_query($conn, $queryValidate)){
                            
                            return 1;
                            
                        }


                    }
                }


            }

            return 0;
      
     }


     protected function setProfile($data){

        $conn = $this->connect();
        $id = $_SESSION["account_id"];
        $accntType = $_SESSION['account_type'];

        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_name = '../../uploads/images/' . time() . '.png';
      
        if(file_put_contents($image_name, $data)){
            if( $accntType == "Administrator"){
            
                $queryValidate = "UPDATE admin SET profile_picture = '$image_name' WHERE account_id = $id";
                mysqli_query($conn, $queryValidate);
            }
            else{
                $queryValidate = "UPDATE research_coordinator SET profile_picture = '$image_name' WHERE account_id = $id";
                mysqli_query($conn, $queryValidate);

            }
            return $image_name;
        }
        else {
            header("Location:  ../admin/research.php?error updating profile"); 
            exit();

        }

     }


     protected function getProfile(){

        $conn = $this->connect();
        $id = $_SESSION["account_id"];
        $accntType = $_SESSION['account_type'];
       
        if($accntType == "Administrator"){

            $queryValidate = "SELECT admin.fname, admin.profile_picture FROM admin WHERE account_id = $id";
            $sqlValidate = mysqli_query($conn, $queryValidate);
            $rowValidate = mysqli_fetch_assoc($sqlValidate);

            return $rowValidate;
        }else{

            
            $queryValidate = "SELECT research_coordinator.fname,research_coordinator.profile_picture FROM research_coordinator WHERE account_id = $id";
            $sqlValidate = mysqli_query($conn, $queryValidate);
            $rowValidate = mysqli_fetch_assoc($sqlValidate);

            return $rowValidate;

        }
    }
}


?>