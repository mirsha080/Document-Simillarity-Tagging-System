<?php

require_once '../../mvc/models/researchmod.class.php';
require_once '../../mvc/models/scanmod.class.php';

class ResearchCont extends ResearchMod{

    public function addResearch($researchTitle,$category,$P1Fname,$P1Mname,$P1Lname,$P2Fname,$P2Mname,$P2Lname,$P3Fname,$P3Mname,$P3Lname,$adviser_id,$panel1_id,$panel2_id,$file,$status,$abstract,$date){
        $result = $this->setResearch($researchTitle,$category,$P1Fname,$P1Mname,$P1Lname,$P2Fname,$P2Mname,$P2Lname,$P3Fname,$P3Mname,$P3Lname,$adviser_id,$panel1_id,$panel2_id,$file,$status,$abstract,$date);
        return $result;
    }

    public function UpdateResearch($pan1, $pan2,$p1id,$p2id,$p3id,$id,$researchTitle,$category,$P1Fname,$P1Mname,$P1Lname,$P2Fname,$P2Mname,$P2Lname,$P3Fname,$P3Mname,$P3Lname,$adviser_id,$panel1_id,$panel2_id,$file,$status,$abstract,$date){
        
    
        $result = $this->setUpdateResearch($pan1, $pan2,$p1id,$p2id,$p3id,$id,$researchTitle,$category,$P1Fname,$P1Mname,$P1Lname,$P2Fname,$P2Mname,$P2Lname,$P3Fname,$P3Mname,$P3Lname,$adviser_id,$panel1_id,$panel2_id,$file,$status,$abstract,$date);
        return $result;

    }

    public function scan($string){
 
       $scanobj = new ScanMod();
       return $result = $scanobj->comparepdf($string);


    }

   
}