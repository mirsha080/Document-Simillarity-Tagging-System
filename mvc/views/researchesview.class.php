<?php 
    require_once '../mvc/models/researchesmod.class.php';

    class ResearchesView extends ResearchesMod {

        public function showResearch(){
            $result = $this->getResearch();
            return $result;
        }

        public function showResearchDetails($research_id){

            $result = $this->getResearchDetails($research_id);
            return $result;
        }
    
        public function showProponents($research_id){
    
           
            $sqlValidate = $this->getProponents($research_id);
            return $sqlValidate;
        }
    
        public function showAdviser($research_id){
           
            $sqlValidate = $this->getAdviser($research_id);
            return $sqlValidate;
        }
    
        public function showPanel($research_id){
          
            $sqlValidate = $this->getPanel($research_id);
            return $sqlValidate;
        }



    }



?>