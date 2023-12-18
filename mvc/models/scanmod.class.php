<?php

    require_once '../../mvc/dbh.class.php';
    require_once ('../../mvc/porterstemming.class.php');
    require_once ('../../mvc/PreProcess.class.php');
    require_once ('../../mvc/Rabin-Karp.class.php');

    class ScanMod extends Dbh{

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
                //$pdf  = new PdfToText("../../uploads/60c1b011a6a429.78059075.pdf");
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
                    //  $sameHash = count($match);

                    $P = ((2 * $sameHash) / ($doc1 + $doc2));
                    $P = number_format($P * 100);

                   if($P >= 11){
                       $result2[$copy_id] = $P;
                       
                   }   
            
           }

           
            return $result2;

            
            
        }
        

}



?>