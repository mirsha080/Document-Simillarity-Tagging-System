<?php
    require_once '../mvc/dbh.class.php';


    class ResearchesMod extends dbh{

        protected function getResearch(){

            $conn = $this->connect();
    
            $queryValidate = "SELECT research.research_id, research.research_title, research.category FROM research;";
            $sqlValidate = mysqli_query($conn, $queryValidate);
            
            return $sqlValidate;
        }

        protected function getResearchDetails($research_id){

            $conn = $this->connect();
    
           // $queryValidate = "SELECT research.research_title, research.category, soft_copy.abstract FROM research RIGHT JOIN soft_copy  ON research.copy_id = soft_copy.copy_id";
            $queryValidate = "SELECT research.research_title, research.category, research.status, research.date_completed, soft_copy.abstract
                              FROM research , soft_copy WHERE research.copy_id = soft_copy.copy_id AND research.research_id = $research_id";
            // $queryValidate ="SELECT * FROM research;";
            $sqlValidate = mysqli_query($conn, $queryValidate);
            $row= mysqli_num_rows($sqlValidate);
            
            
    
            return $sqlValidate;
    
        }
    
        protected function getProponents($research_id){
    
            $conn = $this->connect();
    
            $queryValidate = "SELECT  person.fname, person.mname, person.lname FROM person,student WHERE person.person_id = student.person_id   and student.research_id = $research_id;";
            $sqlValidate = mysqli_query($conn, $queryValidate);
    
            return $sqlValidate;
        }
    
        protected function getAdviser($research_id){
            $conn = $this->connect();
    
            $queryValidate = "SELECT faculty.faculty_id, person.fname, person.mname, person.lname FROM person,research,faculty WHERE (research.adviser_id = faculty.faculty_id AND research_id = $research_id) AND faculty.person_id = person.person_id;";
            $sqlValidate = mysqli_query($conn, $queryValidate);
    
            return $sqlValidate;
        }
    
        protected function getPanel($research_id){
            $conn = $this->connect();
    
            $queryValidate = "SELECT faculty.faculty_id, person.fname, person.mname, person.lname FROM research,faculty,person,research_panel WHERE (research_panel.faculty_id = faculty.faculty_id AND research_panel.research_id = research.research_id)  AND ( faculty.person_id = person.person_id AND  research.research_id = $research_id)   ";
            $sqlValidate = mysqli_query($conn, $queryValidate);
    
            return $sqlValidate;
        }



    }


?>