<?php 

 require_once '../mvc/views/researchesview.class.php';
 $researchobj = new ResearchesView();
 $researchtable = $researchobj->showResearch();



 if (isset($_POST["research_id"])){
  
 

  $reID = $_POST["research_id"];
 
  $researchDetails = $researchobj -> showResearchDetails($reID);
  $researchProponents = $researchobj -> showProponents($reID);
  $researchAdviser = $researchobj -> showAdviser($reID);
  $researchPanel = $researchobj -> showPanel($reID);
  if (!empty($researchDetails) && !empty($researchProponents) && !empty($researchAdviser) && !empty($researchPanel)){
      
      $rowValidate = mysqli_fetch_assoc($researchDetails);
      $research_title = $rowValidate["research_title"];
      $category = $rowValidate["category"];
      $status = $rowValidate["status"];
      $dateCompleted = $rowValidate["date_completed"];
      $abstract = $rowValidate["abstract"];
      $proponent = [];
      $i = 0;
      
      while( $rowValidate = mysqli_fetch_assoc($researchProponents)){
      
        $proponent[] = $rowValidate["fname"]." ".$rowValidate["mname"].". ".$rowValidate["lname"];
        $i++;
      }

      $rowValidate = mysqli_fetch_assoc($researchAdviser);
      $adviser = $rowValidate["fname"]." ".$rowValidate["mname"].". ".$rowValidate["lname"];

      while( $rowValidate = mysqli_fetch_assoc($researchPanel)){
      
        $panel[] = $rowValidate["fname"]." ".$rowValidate["mname"].". ".$rowValidate["lname"];
      
      }

    
    
      $response =  "<div class='table-responsive text-dark'>";
      $response .= "<table class='table table-bordered text-dark'>";
      $response .= "<tr>";
      $response .= "<th class='text-dark'>Title</th>";
      $response .= "<td> ".$research_title."</td>";
      $response .= "</tr>";
      $response .= "<tr>";
      $response.= "<th class='text-dark'>Category</th>";
      $response.= "<td>".$category."</td>";
      $response.="</tr>";

     
     
     
     
    
      $response.="<tr>";
      $response.="<th class='text-dark'>Proponents</th>";
      if ($i == 3){

        $response.="<td> $proponent[0] ,  $proponent[1],  $proponent[2]  </td>";
       }
      if ($i == 2){

        $response.="<td> $proponent[0] ,  $proponent[1]  </td>";
      }
      if ($i == 1){

        $response.="<td> $proponent[0]  </td>";
      }
      $response.="</tr>";
     
     
     
      $response.="<tr>";
      $response.="<th class='text-dark'>Adviser</th>";
      $response.=" <td> ".$adviser."</td>";
      $response.="</tr>";
      $response.="<tr>";
      $response.="<th class='text-dark'>Panels</th>";
      $response.= "<td>$panel[0] , $panel[1] </td>";
      $response.="</tr>";

      $response.="</tr>";
      $response.="<tr>";
      $response.="<th class='text-dark'>Status</th>";
      $response.= "<td style='vertical-align: middle'>  $status Research</td>";
      $response.="</tr>";

      
      if($status == "Completed"){
        $response.="</tr>";
        $response.="<tr>";
        $response.="<th class='text-dark'>Date Completed</th>";
        $response.= "<td style='vertical-align: middle'>  $dateCompleted </td>";
        $response.="</tr>";
      }

      if($status == "Completed"){  
    
        if($abstract == "Research Ongoing No Abstract to Show" || empty($abstract)){

            
          $response.="<tr id='trAbstract'>";
          $response.="<th class='text-dark'>Abstract</th>";
          $response.= "<td class='font-italic'>No Abstract File Found</td>";
          $response.="</tr>";

        }
        else{

              
          $response.="<tr id='trAbstract' data-id=$abstract>";
          $response.="<th class='text-dark'>Abstract</th>";
          $response.= "<td><u><a type='button' class='btnAbstract' data-toggle='modal' data-target='#modalAbstract' >Abstract.pdf</a></u></td>";
          $response.="</tr>";

        }
      }

      $response.="</table>";
      $response .=  "<div>";
      echo $response;
      
      exit;

  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href= "../assets/css/all.css" >
    <link rel="stylesheet" href="../assets/DataTables/css/dataTables.bootstrap4.min.css"/>

    <script src="../js/jquery-3.5.1.js"></script>
    <script type= "text/javascript" src="../js/myScript.js" ></script>
    <script src="../assets/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../assets/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../assets/DataTables/js/dataTables.bootstrap4.min.js"></script>


    <style>
    .tableresearch td{
      border-top: none;
      padding-bottom: 0;

    } 
    ._wrapper2{
      margin-top: 60px;
    }
    @media screen and (max-width:600px){  
    ._wrapper2{
        margin-top: 80px;
       
    }
    ._customnav h6{

      font-size: 15px;
    }
    }
   
    </style>

    
    

  </head>
  <body class="text-light">
  <div >
  <nav class="navbar navbar-expand-md bg-dark navbar-dark _customnav" >
    <img class="mb-1" src="../img/CIT LOGO WHITE BACKGROUND.png" alt="citlogo.png">
    <h6 class="mt-1 navbar-brand" href="#">MSU - College of Information Technology</h6>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    
    <ul class="navbar-nav  ml-auto" >
      <li class="nav-item ">
        <a class="nav-link text-light" href="../index.php">Home</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-light" href="#">Researches</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-light" href="aboutpage.php">About</a>
      </li>    
      <li class="nav-item ">
        <a class="nav-link text-light" href="login2.php">Login</a>
      </li>    
    </ul>
  </div>  
 </nav>
 </div>

    <div class="content">
    <div class="_wrapper2 p-3 shadow">
          
    <h1 class="_title font-weight-bolder">Researches</h1>
          <div class="table-responsive" >
            <table id="data" class="table  text-light tableresearch" >
              <thead>
                <tr>
                  <th> </th>
                  <!-- <th>Category</th> -->
                  
                  
                  
                </tr>
              </thead>

              <tbody>
                <?php 
                 
                  while($rowValidate = mysqli_fetch_assoc($researchtable)){
                ?>
                <tr data-id=<?php echo $rowValidate["research_id"]?>>
                    <td ><u> <a type="button"  class="text-light  btnResearch"><?php echo $rowValidate["research_title"]  ?></u></a> </td>
                   
                </tr> 
              <?php } ?>
              </tbody>
            </table>
          </div>
    </div>


<!-- MODAL RESEARCH INFO -->
<div class="modal fade" id="modalResearchInfo1"  tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="text-light modal-title">Research Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-light" aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body  mx-3 bodyInfo1">

            </div>
           
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
      </div>
    </div>

  <!-- Modal Abstract -->
  <div class="modal fade" id="modalAbstract">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Abstract</h4>
          <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body p-0 bodyAbstract">
          <embed  id = "abstractID" src="" type="application/pdf" style="height: 450px; width: 100%" ></embed>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
        
      </div>
    </div>
  </div>
 


  </body>
    <script>
  
  $(document).ready(function() {
    $('#modalAbstract').on('show.bs.modal',function (){

             
              var abstract = $('#trAbstract').data('id');
              abstract = abstract.replace('../', '');

              $('#abstractID').attr("src",abstract);
    });
});  


    
    // $(document).ready(function() {
    //             $('.btnAbstract').on('click',function(){
                    
    //                 // var abstract = 'uploads/60c9987733f181.66895949.pdf';
                    
    //                 // document.getElementById('abstractID').src = abstract;
    //                 $('#modalAbstract').modal('show');
    //                 alert("meiow");
    //             });
    //     });      
// function table( jQuery){
//         $('#dataResearch').DataTable( {
          
//           ordering: false
//         });
//     };
// $( document ).ready( table );

    </script>    
</html>