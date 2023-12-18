<?php

require_once '../../mvc/dbh.class.php';

if(!isset($_SESSION)){
    session_start();
}


class ResearchMod extends Dbh{

    public function setResearch($researchTitle,$category,$P1Fname,$P1Mname,$P1Lname,$P2Fname,$P2Mname,$P2Lname,$P3Fname,$P3Mname,$P3Lname,$adviser_id,$panel1_id,$panel2_id,$file,$status,$abstract,$date){
        $conn =  $this->connect();
        $copy_id;
        $research_id;
        $person1_id;
        $person2_id;
        $person3_id;

        $title =  mysqli_real_escape_string($conn, $researchTitle);
        $categ =  mysqli_real_escape_string($conn, $category);
        
        $p1fname =  mysqli_real_escape_string($conn, $P1Fname);
        $p1mname =  mysqli_real_escape_string($conn, $P1Mname);
        $p1lname =  mysqli_real_escape_string($conn, $P1Lname);
        $p2fname =  mysqli_real_escape_string($conn, $P2Fname);
        $p2mname =  mysqli_real_escape_string($conn, $P2Mname);
        $p2lname =  mysqli_real_escape_string($conn, $P2Lname);
        $p3fname =  mysqli_real_escape_string($conn, $P3Fname);
        $p3mname =  mysqli_real_escape_string($conn, $P3Mname);
        $p3lname =  mysqli_real_escape_string($conn, $P3Lname);
       
      
        $adID=  mysqli_real_escape_string($conn, $adviser_id);
        $pan1_id=  mysqli_real_escape_string($conn, $panel1_id);
        $pan2_id=  mysqli_real_escape_string($conn, $panel2_id);

        $stat =  mysqli_real_escape_string($conn, $status);
        $date = $date;
        // $abs =  mysqli_real_escape_string($conn, $abstract); 

        //INSERT INTO soft_copy    
        $file_name = basename($file["name"]);
        $tar_dir = "../../uploads/chapter 1/";
      
        $uploadNow = 1;
    
        // if(file_exists($target_file)){
        //     header("Location:  ../admin/research.php?file already exist"); 
        //     exit();
        //   $uploadNow = 0;
    
        // } else {
            //$uploadNow = 1;
        //}
    
        if($uploadNow == 1){

            $fileExt =  explode('.', $file_name);
            $fileActualExt = strtolower(end($fileExt));

            if( $fileActualExt == 'pdf'){
                
                $file_name_new = uniqid('',true).".".$fileActualExt;
                $target_file = $tar_dir. $file_name_new; 
                
                if(move_uploaded_file($file["tmp_name"],$target_file)){

                    $target_file2 = "Research Ongoing No Abstract to Show";
                   if(!empty($abstract)  && ($abstract != NULL)){
                        $file_name2 = basename($abstract["name"]);
                        $tar_dir = "../../uploads/abstract/";
                       

                        $fileExt =  explode('.', $file_name2);
                        $fileActualExt = strtolower(end($fileExt));

                        $file_name_new = uniqid('',true).".".$fileActualExt;
                        $target_file2 = $tar_dir. $file_name_new;

                        move_uploaded_file($abstract["tmp_name"],$target_file2);
                        
                        // get value of copy_id to save to research table
                      
                    }

                    $queryValidate = "INSERT INTO soft_copy(file_name, chapter1_path, abstract) values ('$file_name','$target_file','$target_file2')";
                    mysqli_query($conn, $queryValidate);
                
                    $queryValidate = "SELECT copy_id FROM soft_copy WHERE chapter1_path = '$target_file' LIMIT 1;";
                    $sqlValidate = mysqli_query($conn,$queryValidate);
                    $rowValidate = mysqli_fetch_array($sqlValidate);

                    $copy_id = $rowValidate['copy_id'];

                } else {
                    header("Location:  ../admin/research.php?error uploading file"); 
                    exit();
                }
            }

            else{
                header("Location:  ../admin/research.php?error uploading file"); 
                exit();

            }
        }

         //INSERT INTO reseach table
        $queryValidate = "INSERT INTO research(research_title,adviser_id,copy_id,category,status,date_completed) values('$title',$adID, $copy_id, '$categ','$stat','$date');";
        $sqlValidate = mysqli_query($conn, $queryValidate);
      

        //GET ID OF RESEARCH TO SAVE TO STUDENT

        $queryValidate = "SELECT research_id FROM research  WHERE copy_id = $copy_id LIMIT 1;";
        $sqlValidate = mysqli_query($conn,$queryValidate);
        $rowValidate = mysqli_fetch_array($sqlValidate);

        $research_id = $rowValidate['research_id'];

        //INSERT INTO table research_panel

        $queryValidate =  "INSERT INTO research_panel(faculty_id,research_id) values($pan1_id,$research_id);";
        $sqlValidate = mysqli_query($conn,$queryValidate);
        $er = mysqli_error($conn);
        echo "<h1>$er</h1>";

        $queryValidate =  "INSERT INTO research_panel(faculty_id,research_id) values($pan2_id,$research_id);";
        $sqlValidate = mysqli_query($conn,$queryValidate);


        // INSERT INTO firstproponent to PERSON THEN SAVE PERSON ID TO STUDENT
         if (!empty($p1fname) && !empty($p1mname) && !empty($p1lname)){

           
            $queryValidate = "INSERT INTO person(fname,mname,lname) values('$p1fname','$p1mname','$p1lname');";
            $sqlValidate = mysqli_query($conn, $queryValidate);
            
            $queryValidate = "SELECT person.person_id FROM person where (fname='$p1fname' and mname='$p1mname') and (lname='$p1lname');";
            $sqlValidate = mysqli_query($conn, $queryValidate);
            $rowValidate = mysqli_fetch_array($sqlValidate);
            $person1_id = $rowValidate['person_id'];
            $queryValidate = "INSERT INTO student(person_id, research_id) values($person1_id,$research_id);";
            if (mysqli_query($conn,$queryValidate)){

                // INSERT INTO secondproponent PERSON THEN SAVE PERSON ID TO STUDENT
                if (!empty($p2fname) && !empty($p2mname) && !empty($p2lname)){
                    $queryValidate = "INSERT INTO person(fname,mname,lname) values('$p2fname','$p2mname','$p2lname');";
                    
                    if($sqlValidate = mysqli_query($conn, $queryValidate)){
                    
                        $queryValidate = "SELECT person.person_id FROM person where (fname='$p2fname' and mname='$p2mname') and  (lname='$p2lname');";
                        $sqlValidate = mysqli_query($conn, $queryValidate);
                        $rowValidate = mysqli_fetch_array($sqlValidate);
                        $person2_id = $rowValidate['person_id'];
                        $queryValidate = "INSERT INTO student(person_id, research_id) values($person2_id,$research_id);";
                       if(mysqli_query($conn,$queryValidate)){

                                                
                        // INSERT INTO thirdproponent PERSON THEN SAVE PERSON ID TO STUDENT
                            if (!empty($p3fname) && !empty($p3mname) && !empty($p3lname)){
                                $queryValidate = "INSERT INTO person(fname,mname,lname) values('$p3fname','$p3mname','$p3lname');";
                                
                                if($sqlValidate = mysqli_query($conn, $queryValidate)){
                                    
                                    $queryValidate = "SELECT person.person_id FROM person where (fname='$p3fname' and mname='$p3mname') and (lname='$p3lname');";
                                    $sqlValidate = mysqli_query($conn, $queryValidate);
                                    $rowValidate = mysqli_fetch_array($sqlValidate);
                                    $person3_id = $rowValidate['person_id'];
                                    
                                    $queryValidate = "INSERT INTO student(person_id, research_id) values($person3_id,$research_id);";
                                    
                                    if(mysqli_query($conn,$queryValidate)){
                                       
                                      return 1;
                                    }
                                }
                                return 1;
                            }

                          
                       }
                    }
                 return 1;
                }
               

            }
         }
       
    }

    protected function getResearch(){

        $conn = $this->connect();

        $queryValidate = "SELECT research.research_id, research.research_title, research.category, research.status FROM research;";
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

        $queryValidate = "SELECT person.person_id, person.fname, person.mname, person.lname FROM person,student WHERE person.person_id = student.person_id   and student.research_id = $research_id;";
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


    protected function setUpdateResearch($pan1, $pan2,$p1id,$p2id,$p3id,$id,$researchTitle,$category,$P1Fname,$P1Mname,$P1Lname,$P2Fname,$P2Mname,$P2Lname,$P3Fname,$P3Mname,$P3Lname,$adviser_id,$panel1_id,$panel2_id,$file,$status,$abstract,$date){
        $conn =  $this->connect();
        $copy_id;
        $research_id;
        $person1_id;
        $person2_id;
        $person3_id;
        $copyID;

        $title =  mysqli_real_escape_string($conn, $researchTitle);
        $categ =  mysqli_real_escape_string($conn, $category);
        
        $p1fname =  mysqli_real_escape_string($conn, $P1Fname);
        $p1mname =  mysqli_real_escape_string($conn, $P1Mname);
        $p1lname =  mysqli_real_escape_string($conn, $P1Lname);
        $p2fname =  mysqli_real_escape_string($conn, $P2Fname);
        $p2mname =  mysqli_real_escape_string($conn, $P2Mname);
        $p2lname =  mysqli_real_escape_string($conn, $P2Lname);
        $p3fname =  mysqli_real_escape_string($conn, $P3Fname);
        $p3mname =  mysqli_real_escape_string($conn, $P3Mname);
        $p3lname =  mysqli_real_escape_string($conn, $P3Lname);
       
      
        $adID=  mysqli_real_escape_string($conn, $adviser_id);
        $pan1_id=  mysqli_real_escape_string($conn, $panel1_id);
        $pan2_id=  mysqli_real_escape_string($conn, $panel2_id);

        $stat =  mysqli_real_escape_string($conn, $status);
        // $abs =  mysqli_real_escape_string($conn, $abstract); 

        $pan1 =  mysqli_real_escape_string($conn, $pan1);
        $pan2 =  mysqli_real_escape_string($conn, $pan2);

        //UPDATE soft_copy    


        if(!empty($file)  && ($file != NULL)){
            $file_name = basename($file["name"]);
            $tar_dir = "../../uploads/chapter 1/";
            // $target_file = $tar_dir.$file_name; 
            $uploadNow = 1;
            
            // if(file_exists($target_file)){
            //     header("Location:  ../admin/research.php?file already exist"); 
            //     exit();
            //   $uploadNow = 0;
        
            // } else {
            //     $uploadNow = 1;
            // }
        
            if($uploadNow == 1){


                    
                $fileExt =  explode('.', $file_name);
                $fileActualExt = strtolower(end($fileExt));

                if( $fileActualExt == 'pdf'){
                
                    $file_name_new = uniqid('',true).".".$fileActualExt;
                    $target_file = $tar_dir. $file_name_new; 
                    
                        if(move_uploaded_file($file["tmp_name"],$target_file)){
                        
                            $queryValidate = "SELECT research.copy_id FROM research WHERE research.research_id=$id";
                            $sqlValidate = mysqli_query($conn, $queryValidate);
                            $rowValidate = mysqli_fetch_assoc($sqlValidate);
                            $copyID = $rowValidate["copy_id"];
                    
                                
                            $queryValidate = "UPDATE soft_copy SET file_name = '$file_name', chapter1_path = '$target_file' WHERE soft_copy.copy_id =  $copyID";
                            if(!mysqli_query($conn, $queryValidate)){
                                return 0;
                            }

                        } else {
                            header("Location:  ../admin/research.php?error uploading file"); 
                            return 0;
                            exit();
                        }
                } else {

                    header("Location:  ../admin/research.php?error uploading files"); 
                    return 0;
                    exit();
                }
            }
        }

        if($abstract != NULL){

           
             
            $queryValidate = "SELECT research.copy_id FROM research WHERE research.research_id=$id";
            $sqlValidate = mysqli_query($conn, $queryValidate);
            $rowValidate = mysqli_fetch_assoc($sqlValidate);
            $copyID = $rowValidate["copy_id"];
    

            $file_name = basename($abstract["name"]);
            $tar_dir = "../../uploads/abstract/";
            
            $fileExt =  explode('.', $file_name);
            $fileActualExt = strtolower(end($fileExt));


            $file_name_new = uniqid('',true).".".$fileActualExt;
            $target_file = $tar_dir. $file_name_new; 

            if(move_uploaded_file($abstract["tmp_name"],$target_file)){
           
            
                $queryValidate = "UPDATE soft_copy SET abstract = '$target_file'  WHERE soft_copy.copy_id =  $copyID";
                mysqli_query($conn, $queryValidate);
            }
            else{

                header("Location:  ../admin/research.php?error uploading abstract file abstract"); 
                return 0;
                exit();
            }
            

        }

        // if($abstract == null){

        //     $queryValidate = "SELECT research.copy_id FROM research WHERE research.research_id=$id";
        //     $sqlValidate = mysqli_query($conn, $queryValidate);
        //     $rowValidate = mysqli_fetch_assoc($sqlValidate);
        //     $copyID = $rowValidate["copy_id"];

        //     $queryValidate = "UPDATE soft_copy SET abstract = ''  WHERE soft_copy.copy_id =  $copyID";
        //     mysqli_query($conn, $queryValidate);

        // }


       

        // UPDATE reseach table
            $queryValidate = "UPDATE research SET adviser_id = $adID, research_title = '$title', category = '$categ',status = '$stat',date_completed = '$date' WHERE research_id = $id;";
            mysqli_query($conn, $queryValidate);
               
            
        // UPDATE PANEL TABLE

          
            
            $queryValidate = "UPDATE research_panel SET faculty_id = $pan1_id  WHERE faculty_id = $pan1 AND research_id = $id;";
            mysqli_query($conn, $queryValidate);

             
            $queryValidate = "UPDATE research_panel SET faculty_id = $pan2_id  WHERE faculty_id = $pan2 AND research_id = $id;";
            mysqli_query($conn, $queryValidate);
           
            

           

         // UPDATE FIRST PROPONENT

           
            
            $queryValidate = "UPDATE person SET fname = '$p1fname', mname = '$p1mname', lname = '$p1lname' WHERE person_id = $p1id;";
            mysqli_query($conn, $queryValidate);
                
            
        
       

        // UPDATE SECOND AND third PROPONENT
            if (!empty($p2id)){
               
                if (!empty($p2fname) && !empty($p2mname) && !empty($p2lname)){
                    $queryValidate = "UPDATE person SET fname = '$p2fname', mname = '$p2mname', lname = '$p2lname' WHERE person_id =  $p2id;";
                    mysqli_query($conn, $queryValidate);
                }
                else{
                    $queryValidate = "DELETE FROM student WHERE person_id =  $p2id;";
                    mysqli_query($conn, $queryValidate);

                    $queryValidate = "DELETE FROM person WHERE person_id =  $p2id;";
                    mysqli_query($conn, $queryValidate);

                }
            }
            if(empty($p2id)) {


                if (!empty($p2fname) && !empty($p2mname) && !empty($p2lname)){
                    $queryValidate = "INSERT INTO person(fname,mname,lname)  values( '$p2fname',  '$p2mname', '$p2lname' );";
                    mysqli_query($conn, $queryValidate);

                    
                    $queryValidate = "SELECT person_id FROM person  WHERE fname = '$p2fname' AND  (mname =  '$p2mname' AND lname = '$p2lname' );";
                    $sqlValidate = mysqli_query($conn, $queryValidate);
                    $rowValidate =  mysqli_fetch_array($sqlValidate);
                    $person_id = $rowValidate['person_id'];


                    $queryValidate = "INSERT INTO student(person_id,research_id)  values( $person_id, $id);";
                    mysqli_query($conn, $queryValidate);
                }

            }
           if(!empty($p3id)){
                if (!empty($p3fname) && !empty($p3mname) && !empty($p3lname)){
                    $queryValidate = "UPDATE person SET fname = '$p3fname', mname = '$p3mname', lname = '$p3lname' WHERE person_id =  $p3id;";
                    mysqli_query($conn, $queryValidate);
                }else{
                    $queryValidate = "DELETE FROM student WHERE person_id =  $p3id;";
                    mysqli_query($conn, $queryValidate);

                    $queryValidate = "DELETE FROM person WHERE person_id =  $p3id;";
                    mysqli_query($conn, $queryValidate);
                }   
            }
            if(empty($p3id)){
                if (!empty($p3fname) && !empty($p3mname) && !empty($p3lname)){
                    $queryValidate = "INSERT INTO person(fname,mname,lname)  values( '$p3fname',  '$p3mname', '$p3lname' );";
                    mysqli_query($conn, $queryValidate);
                
                    $queryValidate = "SELECT person_id FROM person  WHERE fname = '$p3fname' AND  (mname =  '$p3mname' AND lname = '$p3lname' );";
                    $sqlValidate = mysqli_query($conn, $queryValidate);
                    $rowValidate =  mysqli_fetch_array($sqlValidate);
                    $person_id = $rowValidate['person_id'];


                    $queryValidate = "INSERT INTO student(person_id,research_id)  values( $person_id, $id);";
                    mysqli_query($conn, $queryValidate);
                }

            }

                
            
        return 1;

    }

   
    protected function getDetails($copy_id){
        //abstract, title, category, proponents, adviser 
        $arr = array();
        $conn = $this->connect();

        $research_id;
        $adviser_id;

        //get abstract
        $queryValidate = "SELECT abstract FROM soft_copy WHERE copy_id = $copy_id";
        $sqlValidate = mysqli_query($conn, $queryValidate);
        $rowValidate = mysqli_fetch_assoc($sqlValidate);
        $arr[] = $rowValidate['abstract'];
       

        //get title and category
        $queryValidate = "SELECT research_id,status,date_completed, research_title, adviser_id, category FROM research WHERE copy_id = $copy_id";
        $sqlValidate = mysqli_query($conn, $queryValidate);
        $rowValidate = mysqli_fetch_assoc($sqlValidate);
        
        $research_id = $rowValidate['research_id'];
        $arr[] = $rowValidate['status'];
        $arr[] = $rowValidate['date_completed'];
        $arr[] = $rowValidate['research_title'];
        $adviser_id = $rowValidate['adviser_id'];
        $arr[] = $rowValidate['category'];


        //get proponents
        $queryValidate = "SELECT person.fname, person.mname, person.lname FROM person,student WHERE person.person_id = student.person_id AND student.research_id = $research_id";
        $sqlValidate = mysqli_query($conn, $queryValidate);

        while ($rowValidate = mysqli_fetch_assoc($sqlValidate)){
            $arr[] = $rowValidate['fname'];
            $arr[] = $rowValidate['mname'];
            $arr[] = $rowValidate['lname'];
        }

        //get adviser
        $queryValidate = "SELECT person.fname, person.mname, person.lname FROM person,faculty WHERE person.person_id = faculty.person_id AND faculty.faculty_id = $adviser_id";
        $sqlValidate = mysqli_query($conn, $queryValidate);
        $rowValidate = mysqli_fetch_assoc($sqlValidate);

            $arr[] = $rowValidate['fname'];
            $arr[] = $rowValidate['mname'];
            $arr[] = $rowValidate['lname'];

        //get panel
        $queryValidate = "SELECT  person.fname, person.mname, person.lname FROM research,faculty,person,research_panel WHERE (research_panel.faculty_id = faculty.faculty_id AND research_panel.research_id = research.research_id)  AND ( faculty.person_id = person.person_id AND  research.research_id = $research_id )";
        $sqlValidate = mysqli_query($conn, $queryValidate);
        while ($rowValidate = mysqli_fetch_assoc($sqlValidate)){
            $arr[] = $rowValidate['fname'];
            $arr[] = $rowValidate['mname'];
            $arr[] = $rowValidate['lname'];
        }

        

        return $arr;

    }

    protected function getTitle($copy_id){

        $conn = $this->connect();


        $queryValidate = "SELECT research_title FROM research WHERE copy_id = $copy_id";
        $sqlValidate = mysqli_query($conn, $queryValidate);
        $rowValidate = mysqli_fetch_assoc($sqlValidate);

        return $rowValidate["research_title"];


    }
}