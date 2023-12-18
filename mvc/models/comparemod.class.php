<?php
    require_once ('mvc/dbh.class.php');
    require_once ('mvc/porterstemming.class.php');
    require_once ('mvc/PreProcess.class.php');
    require_once ('mvc/Rabin-Karp.class.php');

    class CompareMod extends Dbh{

        public function comparepdf($string){

            $conn = $this->connect();
            //array storage for results
            $result2 = array();

            // Hash for the input PDF
            //Pre-Processing
            $obj = new PreProcess();
            $string = $obj->Process($string);
            
            //Hashing
            $pdf1 = array();
            $obj = new RabinKarp();
            for ($i = 0; $i < count($string); $i++){

                $pdf1[$string[$i]] = $obj->getHash($string[$i],10007);
            }
            $doc1 = count($pdf1);

           
            // HASH FOR THE PDF capstones in the database
            $queryValidate = "SELECT copy_id, chapter1_path from soft_copy where abstract != 'Research Ongoing No Abstract to Show';";
            $sqlValidate = mysqli_query($conn, $queryValidate);
            
            while ($result = mysqli_fetch_assoc($sqlValidate)){

                $copy_id = $result['copy_id'];
                $path = $result['chapter1_path'];
                $path = str_replace("../../","",$path);
                $pdf  = new PdfToText($path);
                $data = $pdf->Text;
               
                
                //Pre-Processing
                $obj = new PreProcess();
                $data = $obj->Process($data);
                
                
                // //Hashing
                $pdf2 = array();
                $obj = new RabinKarp();
                for ($i = 0; $i < count($data); $i++){

                    $pdf2[$data[$i]] = $obj->getHash($data[$i],10007);
                }
                $doc2 = count($pdf2);



                // result 
                
              
                $sameHash = 0;
                $P = 0;
                
                    $match = array_intersect($pdf1,$pdf2);


                    foreach($match as $x => $x_value ){
                      foreach($pdf2 as $y => $y_value ){
                        if($x_value == $y_value){
                          if($x == $y){
                            $sameHash++;
                          }
                        }
                      }
                    }

                    // $sameHash = count($match);
                    
                    $P = ((2 * $sameHash) / ($doc1 + $doc2));
                    $P = number_format($P * 100);

                    if($P >= 11){
                       $result2[$copy_id] = $P;
                    }   
            
            }


            return $result2;
            
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

?>