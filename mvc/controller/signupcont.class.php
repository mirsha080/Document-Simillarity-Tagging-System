<?php
require_once '../../mvc/models/signupmod.class.php';



class SignupCont extends SignupMod{

    public function createUser($firstName, $middleName, $lastName, $userName,$accountType,$password){


        // $isUserSet = $this->setUserAccnt($firstName, $middleName, $lastName, $userName,$accountType,$password);
        $isAccntSet = $this->setAccount($userName,$accountType,$password);
     
        
       if ($isAccntSet === 1 ){
            $isUserSet = $this->setUser($firstName, $middleName, $lastName,$userName,$accountType);

            if($isUserSet == 1){
                return 1;
            }
            else return 0;
       }
            
        
    }

    

}