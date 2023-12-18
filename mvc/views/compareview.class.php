<?php
    require_once('mvc/models/comparemod.class.php');

    class CompareView extends CompareMod{

        public function showDetails($copy_id){
            $result = $this->getDetails($copy_id);
            return $result;
        }

        public function showTitle($copy_id){

            $result = $this->getTitle($copy_id);
            return $result;
        }


    }





?>