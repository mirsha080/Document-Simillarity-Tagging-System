<?php 
  require_once ( 'assets/PdfToText/PdfToText.phpclass' ) ;
  require_once ('mvc/dbh.class.php');
  require_once ('mvc/porterstemming.class.php');
  require_once ('mvc/PreProcess.class.php');
  require_once ('mvc/Rabin-Karp.class.php');

  $obj = new Dbh();
  $conn = $obj->connect();
  
  $queryValidate = "SELECT chapter1_path from soft_copy WHERE copy_id = 94";
  $sqlValidate = mysqli_query($conn, $queryValidate);
  $string;
  //while ($result = mysqli_fetch_assoc($sqlValidate)){
    //$path = $result['chapter1_path'];
  
    //$pdf  = new PdfToText($path);
  
    // $string = "object";
    // $data = $pdf->Text;
    // if(strpos($data,$string) !== false){
    //   echo "found";
    // }else {
    //   echo "failed";
    // }
    //$string = $pdf->Text;
    // echo nl2br($string);
    // echo strlen($string);
    //echo "<---------------------------------------------------------------------------------------------------------------------------------------------->";
  //}

    // TESTING 
    $string = "plagiarism is an act or instance of using or closely imitating the language and thoughts of another author without authorization";
    $obj2 = new PreProcess();
    $string = $obj2->Process($string);
    

    $obj3 = new RabinKarp();
    for ($i = 0; $i < count($string); $i++){

      
      $string[$i] = $obj3->getHash($string[$i],10007);
    }



   $string2 = "plagiarism is an act of copying the ideas or words of another person without giving credit to that person";
   $obj3 = new PreProcess();
   $string2 = $obj3->process($string2);
   

   $obj3 = new RabinKarp();
   for ($i = 0; $i < count($string2); $i++){

     
     $string2[$i] = $obj3->getHash($string2[$i],10007);
   }

  
  // result 
  $doc1 = count($string);
  $doc2 = count($string2);
  $sameHash = 0;
 
    for ($i = 0; $i < count($string); $i++){

      if(in_array($string[$i],$string2)){
        $sameHash++;
      }
    }
    
    $P = ((2 * $sameHash) / ($doc1 + $doc2));
    $P = number_format($P * 100, 2);
    echo $P."%";
  



 
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href= "assets/css/all.css" >
    <link rel="stylesheet" href="assets/DataTables/css/dataTables.bootstrap4.min.css"/>


    <script src="js/jquery-3.5.1.js"></script>
    <script type= "text/javascript" src="js/myScript.js" ></script>
    <script src="assets/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/jquery.form.min.js"></script>

</head>
<body>


        
      
</body>

</html>

