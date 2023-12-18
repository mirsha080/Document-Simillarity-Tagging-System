<?php 
require_once '../../mvc/models/accountsettingmod.class.php';


    class AccountSettingView extends AccountSettingMod{

        public function showAccountInfo(){

            return $this->getAccountInfo();

            
        }

        public function showProfile(){

            $result = $this-> getProfile();
            return $result;

        }
    }

?>