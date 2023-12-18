<?php

require_once '../../mvc/dbh.class.php';

class FacultyMod extends Dbh{

    protected function setFaculty(){


        $conn = $this->connect();

        $queryValidate = "SELECT  faculty.faculty_id, person.fname, person.mname, person.lname FROM person,faculty WHERE faculty.person_id = person.person_id";
        $sqlValidate = mysqli_query($conn, $queryValidate);
       
        return $sqlValidate;
    }

    protected function AddFaculty($fname,$mname,$lname){

        
        $conn = $this->connect();

        $queryValidate = "INSERT into person(fname, mname, lname) VALUES('$fname','$mname','$lname')";
         if(mysqli_query($conn, $queryValidate)){
            
            $queryValidate = "SELECT  person_id  FROM person WHERE  (fname = '$fname' AND mname = '$mname') AND  lname = '$lname'";
            $sqlValidate = mysqli_query($conn, $queryValidate);
            $rowValidate = mysqli_fetch_assoc($sqlValidate);
            $person_id = $rowValidate["person_id"];
            
            
            $queryValidate = "INSERT into faculty(person_id) VALUE($person_id)";
            mysqli_query($conn, $queryValidate);
           
            return 1;
        }
       
     

    }

    protected function deleteFaculty($faculty_id){

        $conn = $this->connect();

      
        
        $queryValidate = "SELECT  person_id  FROM faculty WHERE  faculty_id = $faculty_id";
        $sqlValidate = mysqli_query($conn, $queryValidate);
        $rowValidate = mysqli_fetch_assoc($sqlValidate);
        $person_id = $rowValidate["person_id"];

        $queryValidate = "DELETE FROM faculty WHERE faculty_id = $faculty_id";
        if(mysqli_query($conn, $queryValidate)){

            $queryValidate = "DELETE FROM person WHERE person_id = $person_id";
            
                return 1;
           
        }

        

    }


    protected function getFacultyM($id){

        $conn = $this->connect();

        $queryValidate = "SELECT  person_id  FROM faculty WHERE  faculty_id = $id";
        $sqlValidate = mysqli_query($conn, $queryValidate);
        $rowValidate = mysqli_fetch_assoc($sqlValidate);
        $person_id = $rowValidate["person_id"];

        $queryValidate = "SELECT person.fname,person.mname, person.lname FROM person WHERE person_id = $person_id";
        if($sqlValidate = mysqli_query($conn, $queryValidate)){

            return mysqli_fetch_assoc($sqlValidate);
           
        }

    }


    public function updateFacu($id,$fname,$mname,$lname){

        $conn = $this->connect();

        $queryValidate = "SELECT  person_id  FROM faculty WHERE  faculty_id = $id";
        $sqlValidate = mysqli_query($conn, $queryValidate);
        $rowValidate = mysqli_fetch_assoc($sqlValidate);
        $person_id = $rowValidate["person_id"];

        $queryValidate = "UPDATE person SET fname = '$fname' ,mname = '$mname', lname = '$lname'  WHERE person_id = $person_id";
        if($sqlValidate = mysqli_query($conn, $queryValidate)){

           return;  
        }

    }

}