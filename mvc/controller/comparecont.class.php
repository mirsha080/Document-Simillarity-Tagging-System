<?php 
    require_once('mvc/models/comparemod.class.php');


    class CompareCont extends CompareMod{

        public function scan($string){
 
            $scanobj = new CompareMod();
            $result = $scanobj->comparepdf($string);
           
            
    
            return $result;
    
    
        }




    }





?>