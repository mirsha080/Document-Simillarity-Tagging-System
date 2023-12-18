<?php

require_once ('../../mvc/models/facultymod.class.php');


    class FacultyCont extends FacultyMod{


        public function createFaculty($fname,$mname,$lname){

         
        
          return  $this->AddFaculty($fname,$mname,$lname);;
        }

        public function removeFaculty($faculty_id){

          return $this->deleteFaculty($faculty_id);
        
         
        }

       public function updateFaculty($id,$fname,$mname,$lname){

        return $this->updateFacu($id,$fname,$mname,$lname);


       }



    }


?>