<?php
require_once '../../mvc/models/facultymod.class.php';

class FacultyView extends FacultyMod{

    public function showFaculty(){

        $sqlValidate =  $this->setFaculty();
        
        return $sqlValidate;
        
        
    }

    public function getFaculty($id){

        $sqlValidate =  $this->getFacultyM($id);
        
        return $sqlValidate;
    }



}