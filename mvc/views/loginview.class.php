<?php
// include '../../inc/autoloader.inc.php';
include '../mvc/models/loginmod.class.php';


 class LoginView extends LoginMod{
          
     
      public function log_in($user, $pass){
       
         
         $result = $this->login($user,$pass);
         return $result;
         
    }

 }

 ?>

 
 
 