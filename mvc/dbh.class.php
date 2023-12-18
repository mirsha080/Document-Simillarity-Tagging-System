<?php

class Dbh{
    private $conn;
        
     //protected function connect() {
       public function connect() {

        $conn = mysqli_connect("localhost","root","","document_sim");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        else {
            return $conn;  
        }
        
    }
       
}