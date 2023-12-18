<?php
  require_once "../inc/session.php"; 
  require_once '../../mvc/controller/researchcont.class.php';
  require_once '../../mvc/views/facultyview.class.php';
  require_once '../../mvc/views/researchview.class.php';
  require_once '../../mvc/controller/accountsettingcont.class.php';
  require_once '../../mvc/views/accountsettingview.class.php';
  require_once '../../mvc/controller/facultycont.class.php';

 
  $result;
  $profileObj = new AccountSettingView();
  $profile = $profileObj->showProfile();
  $profileImage = $profile["profile_picture"];
  if($profileImage == null){
    $profileImage = "../../img/user8.png";
  }

 
  $researchobj = new ResearchView();
  $researchtable = $researchobj->showResearch();
 
  $researchDetails;
  $researchDetails2;
  $researchProponents;
  $researchAdviser;
  $researchPanel;
  $research_id;
  $result;
  $resultAdd; 

  $obj = new FacultyView();
  $sqlValidate = $obj->showFaculty();
  //$list = $sqlValidate
  $list = array();
  while($facultyList = mysqli_fetch_assoc($sqlValidate)){ 
    
    $list[] = $facultyList;
  }

  if ($_SERVER['REQUEST_METHOD']=='POST' && !empty(isset($_POST["facultyUp_id"]))) {

    $id = $_POST["facultyUp_id"];
    
    $result = $obj->getFaculty($id);

    echo json_encode($result);;
    exit;



  }
  
  if ($_SERVER['REQUEST_METHOD']=='POST' && !empty(isset($_POST["facultyFname"])) && !empty(isset($_POST["facultyMname"])) && !empty(isset($_POST["facultyLname"]))){

    $fname = $_POST["facultyFname"];
    $mname = $_POST["facultyMname"];
    $lname = $_POST["facultyLname"];


    $faculty = new FacultyCont();
    $result = $faculty->createFaculty($fname,$mname,$lname);

    echo $result;
    exit;
  }

  if ($_SERVER['REQUEST_METHOD']=='POST' && !empty(isset($_POST["facultyUpFname"])) && !empty(isset($_POST["facultyUpMname"])) && !empty(isset($_POST["facultyUpLname"]))){
    
    $faculty_id = $_POST["facultyUpID"];
    $fname = $_POST["facultyUpFname"];
    $mname = $_POST["facultyUpMname"];
    $lname = $_POST["facultyUpLname"];


    $faculty = new FacultyCont();
    $faculty->updateFaculty($faculty_id,$fname,$mname,$lname);

   
    exit;
  }

  if ($_SERVER['REQUEST_METHOD']=='POST' && !empty(isset($_POST['faculty_id'])) ){

    $faculty_id = $_POST['faculty_id'];

    $faculty = new FacultyCont();
    $result = $faculty->removeFaculty($faculty_id);

    

    

    exit;
    

  }


if (isset($_POST["btnAddResearch"])){
 
 
  $obj = new ResearchCont();
  $abstract = null;
 
  $researchTitle = $_POST["addtitle"];
  $category = $_POST["radioCategory"];
  $date = "";
  $P1Fname = $_POST["P1Fname"];
  $P1Mname = $_POST["P1Mname"];
  $P1Lname = $_POST["P1Lname"];
  $P2Fname  = "";
  $P2Mname = ""; 
  $P2Lname = "";

  $P3Fname  = "";
  $P3Mname = ""; 
  $P3Lname = "";
  if(!empty($_POST["P2Fname"]))
  {
    $P2Fname = $_POST["P2Fname"];
    $P2Mname = $_POST["P2Mname"];
    $P2Mname = $P2Mname[0];
    $P2Lname = $_POST["P2Lname"];
    if (!empty($_POST["P3Fname"])){

      $P3Fname = $_POST["P3Fname"];
      $P3Mname = $_POST["P3Mname"];
      
      $P3Mname = $P3Mname[0];
      $P3Lname = $_POST["P3Lname"];
    }
  }
 
  $adviserID = $_POST["adviser"];
  $panel1 = $_POST["panel1"];
  $panel2 = $_POST["panel2"];

  $file = $_FILES["file"];
  $status = $_POST["radioStatus"];

  if($status == "Completed"){
    if(isset($_POST["date"])){
      $date = $_POST["date"];
    }
  }

  if ($_FILES["abstractFile"]["size"] > 0)
  {
    $abstract = $_FILES["abstractFile"];
  }

  $P1Mname = $P1Mname[0];

  $resultAdd  = $obj->addResearch( $researchTitle,$category,$P1Fname,$P1Mname,$P1Lname,$P2Fname,$P2Mname,$P2Lname,$P3Fname,$P3Mname,$P3Lname,$adviserID,$panel1,$panel2,$file,$status,$abstract,$date);
  $researchtable = $researchobj->showResearch();

}

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
      
        $proponent[$i] = $rowValidate["fname"]." ".$rowValidate["mname"].". ".$rowValidate["lname"];
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


      // if($status == "Ongoing"){
      //   $response.="</tr>";
      //   $response.="<tr>";
      //   $response.="<th class='text-dark'>Status</th>";
      //   $response.= "<td> Ongoing Research </td>";
      //   $response.="</tr>";
      // }
     
      // if($status == "Ongoing"){
     
        
      //     $response.="<tr id='trAbstract'>";
      //     $response.="<th class='text-dark'>Abstract</th>";
      //     $response.= "<td class='font-italic'>Ongoing Research No Abstract to Show</td>";
      //     $response.="</tr>";

    

            
      //     // $response.="<tr id='trAbstract' data-id=$abstract>";
      //     // $response.="<th class='text-dark'>Abstract</th>";
      //     // $response.= "<td><u><a type='button' class='btnAbstract' data-toggle='modal' data-target='#modalAbstract' >$research_title.pdf</a></u></td>";
      //     // $response.="</tr>";

      
      // }

     
      $response.="<tr>";
      $response.="<th class='text-dark'>Proponents</th>";
      
   
     
    

      if ($i === 3){

        $response.="<td> $proponent[0] ,  $proponent[1],  $proponent[2]  </td>";
       }
      if ($i === 2){

        $response.="<td> $proponent[0] ,  $proponent[1]  </td>";
      }
      if ($i === 1){

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

if (isset($_POST["update_id"])){
  
 

  $reID = $_POST["update_id"];
 
  
  $rowValidates[] = array();
 
  $researchDetails = $researchobj -> showResearchDetails($reID);
  if (!empty($researchDetails)){
     
      $rowValidate = mysqli_fetch_array($researchDetails);
      $rowValidates[] = $rowValidate["research_title"];
      $rowValidates[] = $rowValidate["category"];
      $rowValidates[] = $rowValidate["abstract"];
      $rowValidates[] = $rowValidate["status"];
     

     
  }  

  $researchProponents = $researchobj -> showProponents($reID);
  if (!empty($researchProponents)){
      
      while( $rowValidate = mysqli_fetch_array($researchProponents)){
        $rowValidates[] = $rowValidate["person_id"];
        $rowValidates[] = $rowValidate["fname"];
        $rowValidates[] = $rowValidate["mname"];
        $rowValidates[] = $rowValidate["lname"];
       
      }
    
     
  }
  
  $researchAdviser = $researchobj -> showAdviser($reID);
  if (!empty($researchAdviser)){
      $rowValidate = mysqli_fetch_array($researchAdviser);
      $rowValidates[] = $rowValidate["faculty_id"];
    
     
  }
 

  $researchPanel = $researchobj -> showPanel($reID);
  if (!empty($researchPanel)){
      while( $rowValidate = mysqli_fetch_assoc($researchPanel)){
      
        $rowValidates[]  = $rowValidate["faculty_id"];
      
      }
      
  }  
  echo json_encode($rowValidates);
  //echo print_r($rowValidates);
  exit;
 
}

if(!empty(isset($_POST["updateButton"]))){

  
  $id = $_POST["hiddenUpdate_id"];
  $p1id = $_POST["hiddenUpdate_p1id"];
  $p2id = $_POST["hiddenUpdate_p2id"];  
  $p3id = $_POST["hiddenUpdate_p3id"];
  $pan1 = $_POST['hiddenUpdate_pan1'];
  $pan2 = $_POST['hiddenUpdate_pan2'];
  $date = "";

  $file = null;
  $abstract = null;
  $researchTitle = $_POST["updateTitle"];
  $category = $_POST["radioCategory"];
  $P1Fname = $_POST["P1Fname"];
  $P1Mname = $_POST["P1Mname"];
  $P1Mname = $P1Mname[0];
 
  $P1Lname = $_POST["P1Lname"];
  $P2Fname = "";
  $P2Mname = "";
  $P2Lname = "";

  $P3Fname = "";
  $P3Mname = "";
  $P3Lname = "";

 

  if(!empty($_POST["P2Fname"]))
  {
    $P2Fname = $_POST["P2Fname"];
    $P2Mname = $_POST["P2Mname"];
    $P2Mname = $P2Mname[0];
 
    $P2Lname = $_POST["P2Lname"];
    if (!empty($_POST["P3Fname"])){

      $P3Fname = $_POST["P3Fname"];
      $P3Mname = $_POST["P3Mname"];
      $P3Mname = $P3Mname[0];
      $P3Lname = $_POST["P3Lname"];
    }
  }

  
 
  $adviserID = $_POST["adviser"];
  $panel1 = $_POST["panel1"];
  $panel2 = $_POST["panel2"];

  

  if ($_FILES["fileUpdate"]["size"] > 0)
  {
    $file = $_FILES["fileUpdate"];
  }

  if ($_FILES["abstractUpdate"]["size"] > 0 )
  {
    $abstract = $_FILES["abstractUpdate"];
  }
  

  $status = $_POST["radioStatus"];

  if($status == "Completed"){
    if(isset($_POST["date"])){
      $date = $_POST["date"];
    }
  }

   $obj = new ResearchCont();
   $result = $obj->UpdateResearch($pan1, $pan2, $p1id,$p2id,$p3id, $id,$researchTitle,$category,$P1Fname,$P1Mname,$P1Lname,$P2Fname,$P2Mname,$P2Lname,$P3Fname,$P3Mname,$P3Lname,$adviserID,$panel1,$panel2,$file,$status,$abstract,$date);
   $researchtable = $researchobj->showResearch();

  
}

if(isset($_POST['image']))
{
	$data = $_POST['image'];

  $obj = new AccountSettingCont();
  $image_name = $obj->updateProfile($data);
  echo $image_name;
  exit;
}


?>  

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../assets/css/all.css" >
    <link rel="stylesheet" href="../../assets/DataTables/css/dataTables.bootstrap4.min.css"/>
    <link href="../../assets/cropper.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/bootstrap-select.css" rel="stylesheet" type="text/css"/>


   
    <script src="../../js/jquery-3.5.1.js"></script>
    <script type= "text/javascript" src="../../js/myScript.js" ></script>
    <script src=../../assets/popper.min.js></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../assets/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/DataTables/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../js/sweetalert.min.js"></script>
    <script src="../../assets/cropper.min.js" type="text/javascript"></script>
    <script src="../../assets/bootstrap-select.js" type="text/javascript"></script>
    
    
    

  </head>
  <body>


   








    <!--header area start-->
    <input type="checkbox" id="check">
    <div class="my_header">


      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>

      <img src="../../img/CIT LOGO WHITE BACKGROUND.png" alt="">
      <h3> MSU - <span>CIT</span></h3>

      <a href="../../pages/inc/logout.php" class="logout_btn"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>

    </div>
    <!--header area end-->


    <!--mobile navigation bar start-->
    <div class="mobile_nav">
      <div class="nav_bar navbar-custom" onclick="readyFn()">
        <i class="fa fa-bars nav_btn"></i>
      </div>
      <div class="mobile_nav_items">
        <a href="index.php"><i class="__link active d-inline"><img class=" mb-2" src="../../img/filesearch.png" style="height: 20px;" alt=""></i><span>Compare Document</span></a>
        <a class="_accounts" href="accounts.php"><i class="__link fa fa-users"></i><span>User Accounts</span></a>
        <a href="research.php"><i class="__link fa fa-book"></i><span>Capstone/Thesis</span></a>
        <a href="accountsetting.php"><i class="__link fas fa-user"></i><span>My Account</span></a>
        <a href="aboutpage.php"><i class="__link fas fa-info-circle"></i><span>About</span></a>
        
      </div>
    </div>
    <!--mobile navigation bar end-->


    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
        <div class="image_area">
          <form method="post">
            <label for="upload_image">  
              <img src="<?php echo $profileImage ?>" class="profile_image" alt="">
             
                <div class="overlay">
                    <div class="text">Change Profile</div>
                  </div>
                  <input type="file" name="image" class="image" id="upload_image" style="display:none" />
            </label>
           
          </form>
        </div>
        <!-- <h4 id="user">Admin</h4> -->
        <h4 id="user"><?php echo $profile["fname"] ?></h4>
        
      </div>
      <a href="index.php"><i class="__link active d-inline"><img  class="mb-1" src="../../img/filesearch.png" style="height: 22px;" alt=""></i><span>Compare Document</span></a>
      <a class="_accounts" href="accounts.php"><i class="__link fa fa-users"></i><span>User Accounts</span></a>
      <a href="research.php"><i class="fa fa-book"></i><span>Capstone/Thesis</span></a>
      <a href="accountsetting.php"><i class="__link fas fa-user"></i><span>My Account</span></a>
      <a href="aboutpage.php"><i class="__link fas fa-info-circle"></i><span>About</span></a>
      
    </div>
    <!--sidebar end-->



    <!-- MODAL PICTURE -->
   <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-centered modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title text-light">Crop Image</h5>
			        		<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">×</span>
			        		</button>
			      		</div>
			      		<div class="modal-body">
			        		<div class="img-container container">
			            		<div class="row">
			                		<div class="col-md-8">
			                    		<img src="" id="sample_image" />
			                		</div>
			                		<div class="col-md-4">
			                    		<div class="preview m-auto"></div>
			                		</div>
			            		</div>
			        		</div>
			      		</div>
			      		<div class="modal-footer">
			      			<button type="button" id="crop" class="btn btn-primary">Crop</button>
			        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			      		</div>
			    	</div>
			  	</div>
			</div>		




<!-- Content Start -->
    <div class="content ">
      <div class="container _accntcontainer">

            
        
        
       <!-- MY TAB --> 
        <ul class="nav nav-pills mb-3 mt-3 navbar-custom"  id="pills-tab" role="tablist">
          <li class="nav-item mr-1"  >
            <button type="button" class="btn btn-primary active" id="pills-researches-tab" data-toggle="pill" href="#pills-researches" role="tab" aria-controls="pills-researches" aria-selected="true"><i class="fa fa-book"></i> Researches</button>
          </li>
          <li class="nav-item">
            <button type="button" class="btn btn-primary " id="pills-addResearch-tab" data-toggle="pill" href="#pills-addResearch" role="tab" aria-controls="pills-addResearch" aria-selected="false"><i class="fas fa-plus"></i><span> Add Research</span></button>
          </li>
        </ul>
    
      <!-- Research Table Tab -->
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-researches" role="tabpanel" aria-labelledby="pills-researches-tab">
        
        
          <!-- <form action="/DSTS/pages/admin/research.php" method="POST" id="reform" name="reform">
            <input hidden id="research_id" name="research_id">
            </form> -->
         <div class="table-responsive text-light">
         
            <table id="data" class="table table-bordered text-light">
              <thead> 
                <tr>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Action</th> 
                
                </tr>
              </thead>
             
              <tbody>
            
                <?php 
                  while($rowValidate = mysqli_fetch_array($researchtable)){
                ?>
                
                <tr data-id= <?php echo $rowValidate["research_id"]?>>
             
                    
                   
                    <td><?php echo $rowValidate["research_title"]  ?></td>
                    <td><?php echo $rowValidate["category"]; ?></td>
                    <td><?php echo $rowValidate["status"]; ?></td>
                    <td >
                      <div class="btn-group">
                        <button type="button"  name="btnResearchInfo" id="btnResearchInfo" value="btnsubmit" class="btn btn-info btnResearchInfo" style="border-color: #fff">Details</button>
                        <button type = "button" name="btnUpdateResearch" id="btnUpdateResearch"  class="btn btn-primary btnUpdateResearch">Update</button>
                        </div>
                    </td>
                </tr>
              
                  <?php } ?>
                  
              </tbody>
             
            </table>
            
           
          </div>
         
    </div>
      
    
        <!-- Add Research Tab  -->
      <div class="tab-pane fade" id="pills-addResearch" role="tabpanel" aria-labelledby="pills-addResearch-tab">
    
          <form  enctype="multipart/form-data" id="addresearch" class ="jumbotron" action="/DSTS/pages/admin/research.php" method="post"  role="form">
            
            <div class="form-group row">
                <label class="col-1 col-form-label" for="title" ><span class="req" ></span>Title </label>
                <div class="col-11">
                <input  class= "form-control" type="text" name="addtitle" id = "txt" onkeyup = "Validate(this)" required /></div>
                <div id="errFirst"></div>
            </div>

            <div class="form-group row">
              <label class="col-3 col-form-label" for=""> <span class="req"> </span> Category </label>
          
              <div class="form-check-inline col-3">
              <label class="form-check-label" for="radioThesis">
                  <input type="radio" class="form-check-input" id="radiobtn" name="radioCategory" value="Thesis" checked>Thesis
                </label>
              </div>
             
              <div class="form-check-inline col">
               
                <label class="form-check-label" for="radioCapstone">
                  <input type="radio" class="form-check-input" id="radiobtn" name="radioCategory" value="Capstone Project">Capstone Project
                </label>
              </div>
            </div>


            <label><span class="req"></span> Proponent/s <small>(Fill according to the number of proponents)</small></label>
            <label class="d-block"> Proponent 1</label>
            <div class="form-row">
                
                <div class="form-group col-md-4">
                    <input class="form-control " placeholder="First Name" type="text" name="P1Fname" id = "P1Fname" onkeyup = "Validate(this)" required />
                    <div id="errFirst"></div>
                </div>

                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="Middle Initial" type="text" name="P1Mname" id = "txt" onkeyup = "Validate(this)" required />
                    <div id="errFirst"></div>
                </div>

                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="Last Name" type="text" name="P1Lname" id = "txt" onkeyup = "Validate(this)" required />
                    <div id="errFirst"></div>
                </div>
            </div>
            <label class="d-block"> Proponent 2</label>
            <div class="form-row">
                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="First Name" type="text" name="P2Fname" id = "txt" onkeyup = "Validate(this)"  />
                    <div id="errFirst"></div>
                </div>

                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="Middle Initial" type="text" name="P2Mname" id = "txt" onkeyup = "Validate(this)"  />
                    <div id="errFirst"></div>
                </div>

                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="Last Name" type="text" name="P2Lname" id = "txt" onkeyup = "Validate(this)"  />
                    <div id="errFirst"></div>
                </div>
            </div>
            <label class="d-block"> Proponent 3</label>
            <div class="form-row">
                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="First Name" type="text" name="P3Fname" id = "txt" onkeyup = "Validate(this)"  />
                    <div id="errFirst"></div>
                </div>

                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="Middle Initial" type="text" name="P3Mname" id = "txt" onkeyup = "Validate(this)"  />
                    <div id="errFirst"></div>
                </div>

                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="Last Name" type="text" name="P3Lname" id = "txt" onkeyup = "Validate(this)" />
                    <div id="errFirst"></div>
                </div>
            </div>

           

            <div class="form-group"> 
            <label for="adviser"><span class="req"> </span> Adviser </label>
            <a type= "button" class="btnEditFaculty" data-toggle="modal" data-target="#modalEdit" class="font-italic">  <u class="font-italic text-primary"><small>Edit List?</small> </u></a>
          
              <select   class="form-control" id="number" name="adviser" id="adviser" title="Select an adviser" >
              <option value="" disabled selected><p  style="font-style: italic" >select an adviser</p></option>
              <?php foreach($list as $lists){ 
                $name =  $lists["fname"]." ".$lists["mname"].". ".$lists["lname"];  
              ?>
               
              <option value=<?php echo $lists["faculty_id"] ?> > <?php echo $name ?>  </option>
              <?php  }?>
             
              </select>
            </div>
            <div class="form-group">
          
            <label for="panel"><span class="req"> </span> Panel 1 </label>
              <select style="font-style: italic"  class="form-control" name="panel1" id="panel1"  title="Select First Panel"> 
            <!-- <select name="" id="" class="form-control selectpicker" data-live-search="true"> -->
              <option value="" disabled selected> <p  style="font-style: italic" > select the first panel </p></option>
              
              <?php foreach($list as $lists){ ?>
                <option value=<?php echo $lists["faculty_id"] ?> > <?php echo $lists["fname"]." ".$lists["mname"].". ".$lists["lname"] ?>  </option>
              <?php  }?>
              
              </select>
            </div>

            <div class="form-group">
            
              <label for="panel2"><span class="req"> </span> Panel 2 </label>
              <select style="font-style: italic" class="form-control" name="panel2" id="panel2"  title="Select Second Panel">
                <option value="" disabled selected><p  style="font-style: italic" >select the second panel</p></option>
                
                <?php foreach($list as $lists){ ?>
                  <option value=<?php echo $lists["faculty_id"] ?> > <?php echo $lists["fname"]." ".$lists["mname"].". ".$lists["lname"] ?>  </option>
                <?php  }?>
              </select>
            </div>
           
          

            <div class="form-group">
              <label for=""> Chapter 1 File</label>
                <div class="custom-file"> 
                
                  <input  type="file" name="file" class="custom-file-input" id="file" accept=".pdf" required>
                    <label class="custom-file-label" for="customFile">Choose File
                    <!-- <div class="text-center uploading" style="display: none;">
                      <span class="spinner-border spinner-border-sm" role="status"></span><small>  Uploading...</small>
                    </div> -->
                  </label>
                  </div>
              </div>


             

             <div class="form-group row">
                <label class="col-3 col-form-label" for=""> <span class="req"> </span> Status &nbsp </label>
                <div class="form-check-inline col-3">
                  <label class="form-check-label" for="radioOngoing">
                    <input type="radio" class="form-check-input" id="radiOngoing2" name="radioStatus" value="Ongoing" checked >Ongoing
                  </label>
                </div>
                <div class="form-check-inline col">
                  <label class="form-check-label" for="radioCompleted">
                    <input type="radio" class="form-check-input" id="radioCompleted2" name="radioStatus" value="Completed">Completed
                  </label>
                </div>
              
            </div>

            <div class="row">

            <div class="form-group abstract col-md-6" style="display: none">
              <label class="col-form-label"> Abstract File</label>
                <div class="custom-file"> 
                  <input type="file" class="custom-file-input" name="abstractFile" id="abstractFile" accept=".pdf" >
                  <label class="custom-file-label" for="customFile">Choose File</label>
                </div>
              </div>
            
              <div class="form-group datePicker2 col-md-6" style="display: none">
                
                <label class="col-form-label "> Date Completed</label>
              
                <div >
                <input  class="form-control " name="date" type="date" id="txtDate" value="<?php echo date("Y-m-d") ?>"> 
                </div>
              </div>
            
          
            </div>
         

            <!-- <div class="form-group">
             <label for="exampleFormControlTextarea1"><span class="req"> </span>Abstract </label>
             <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="abstract"></textarea>
            </div> -->
           
            <button form= "addresearch" type="submit" value="submit" id="btnAddResearch" name="btnAddResearch" class="btn btn-primary" style="width: 150px;"> Submit</button>
            
           </form>   

      
    </div>

           

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true" role="dialog">
              <div class="modal-dialog modal-lg modal-dialog-centered" >
                <div class="modal-content"  style="min-height: 90vh; min-width: 50vw;" >
                  <div class="modal-header">
                    <h4 class="modal-title text-light">Faculty List</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  
            
                  <div class="modal-body">
                
                    <div class="table-responsive text-dark">
                        
                      <table id="list" class="table table-bordered text-light">
                        <thead>
                          <tr class="text-dark">
                            <th>Name</th> 
                            <th>Action</th>
                          </tr>
                        </thead>

                        <tbody>
                        
                        <?php sort($list); foreach($list as $lists){ ?>
                       
                      
                          <tr class="text-dark" data-id= <?php echo $lists["faculty_id"] ?> >
                              <td id="facultyName">  <?php echo $lists["fname"]." ".$lists["mname"].". ".$lists["lname"] ?> </td>
                              <td><button class="btn btn-danger removeFaculty" >REMOVE</button>
                              <button class="btn btn-info updateFaculty" >UPDATE</button></td>
                             
                          </tr>
                         
                        <?php  }?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                
                  <div class="modal-footer" >
                  
                    <button type="button" data-toggle="modal" data-target="#modalAddFaculty" class="btn btn-primary" id="add" style="float: left"><span> ADD FACULTY </span></button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                
                  </div>
                  
                </div>
            </div>
           </div>
  
          </div>

        </div> 
      </div>
     <!-- MODAL REMOVE FACULTY -->
     <!-- <div class="modal fade" id="modalRemoveFaculty"  >
        <div class="modal-dialog modal-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="text-light modal-title">Remove From List</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-light" aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">

            </div>
           
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
      </div>
    </div> -->


          <!-- MODAL ADD FACULTY -->
          <div class="modal fade" id="modalAddFaculty"  >
        <div class="modal-dialog modal-centered" style="min-width: 50vw">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="text-light modal-title">Create Faculty</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-light" aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body ">
                        
                  <form role="form">
                    <div class="form-group">
                      <label >First Name</label>
                      <input  type="text" class="form-control" placeholder="First Name" id="facultyFname" name = "facultyFname" value="" required>
                    </div>
                    <div class="form-group">
                      <label ">Middle Initial</label>
                      <input type="text" class="form-control" placeholder="Middle Initial"  id="facultyMname" name = "facultyMname" value="" required>
                    </div>
                    <div class="form-group">
                      <label >Last Name</label>
                      <input type="text" class="form-control" placeholder="Last Name" id="facultyLname"  name = "facultyLname" value="" required>
                    </div>
                    <input  type="button" name="submitFaculty" value="CREATE" id="submitFaculty" class="btn btn-primary">
                </form>
             
               

            </div>
           
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
      </div>
    </div>




     <!-- MODAL UPDATE FACULTY -->
     <div class="modal fade" id="modalUpdateFaculty"  >
        <div class="modal-dialog modal-centered" style="min-width: 50vw">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="text-light modal-title">UPDATE FACULTY INFO</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-light" aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body ">
       
                  <form role="form">
                    <div class="form-group">
                      <label >First Name</label>
                      <input  type="text" class="form-control"  id="facultyUpFname"  >
                    </div>
                    <div class="form-group">
                      <label ">Middle Initial</label>
                      <input type="text" class="form-control"   id="facultyUpMname"  >
                    </div>
                    <div class="form-group">
                      <label >Last Name</label>
                      <input type="text" class="form-control"  id="facultyUpLname"   >
                      <input  id="faculty_update" hidden> 
                    </div>
                    <input  type="button" value="UPDATE"  class="btn btn-primary submitUpFaculty">
              </form>
             
               

            </div>
           
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
      </div>
    </div>




    
             <!-- MODAL RESEARCH INFO -->
             <div class="modal fade" id="modalResearchInfo"  >
        <div class="modal-dialog modal-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="text-light modal-title">Research Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-light" aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body  mx-3 bodyInfo">

            </div>
           
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
      </div>
    </div>


                
      <!-- MODAL REMOVE  -->
    <div class="modal fade" id="modalRemove" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header "  style="background: white;">
              <h5 class="modal-title">Remove</h5>
              <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="account_id_de"  id="account_id_de" >
              
                    <h5 id="txtRemove">Are you sure you want to remove this from the list?</h5>
                </div>
              
                <div class="modal-footer " style="background: white;">
                   
                    <input type= "button"  id = "btnRemove"  value ="Yes" class="btn btn-info"></input>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
          </div>
        </div>
      </div>




   <!-- MODAL ABSTRACT -->
          
  <div class="modal fade" id="modalAbstract" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-light">Abstract</h4>
          <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body p-0 bodyAbstract">
          <embed id="abstractID"  src="" type="application/pdf" style="height: 450px; width: 100%" ></embed>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
        
      </div>
    </div>
  </div>




    
    
 

     <!-- MODAL UPDATE RESEARCH -->
     <div class="modal fade " id="modalResearchUpdate" >
        <div class="modal-dialog modal-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="text-light modal-title">Update Research</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-light" aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body  mx-3">

            <form   enctype="multipart/form-data" action="/DSTS/pages/admin/research.php" id="updateResearchForm" method="post"  role="form">
            <input type="hidden" id="hiddenUpdate_id" name="hiddenUpdate_id">
            <input type="hidden" id="hiddenUpdate_p1id" name="hiddenUpdate_p1id">
            <input type="hidden" id="hiddenUpdate_p2id" name="hiddenUpdate_p2id">
            <input type="hidden" id="hiddenUpdate_p3id" name="hiddenUpdate_p3id">
            <input type="hidden" id="hiddenUpdate_pan1" name="hiddenUpdate_pan1">
            <input type="hidden" id="hiddenUpdate_pan2" name="hiddenUpdate_pan2">

            <div class="form-group row">
                <label class="col-1 col-form-label" for="title"><span class="req" ></span>Title </label>
                <div class="col-11">
                <input  class= "form-control" type="text" name="updateTitle" id = "title"   /></div>
                <div id="errFirst"></div>
            </div>
            
            <div class="form-group row">
              <label class="col-3 col-form-label" for=""> <span class="req"> </span> Category </label>
          
              <div class="form-check-inline col-3">
              <label class="form-check-label" for="radioThesis">
                  <input type="radio" class="form-check-input radioCategory" id="radioThesis" name="radioCategory" value="Thesis">Thesis
                </label>
              </div>
             
              <div class="form-check-inline col">
               
                <label class="form-check-label" for="radioCapstone">
                  <input type="radio" class="form-check-input radioCategory" id="radioCapstone" name="radioCategory" value="Capstone Project">Capstone Project
                </label>
              </div>
            </div>


            <label><span class="req"></span> Proponent/s <small>(Fill according to the number of proponents)</small></label>
            <label class="d-block"> Proponent 1</label>
            <div class="form-row">
   
                <div class="form-group col-md-4">
                    <input class="form-control" placeholder="First Name" type="text" name="P1Fname" id = "pro1"    required/>
                    <div id="errFirst"></div>
                </div>

                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="Middle Initial" type="text" name="P1Mname" id = "P1Mname" onkeyup = "Validate(this)" required/>
                    <div id="errFirst"></div>
                </div>

                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="Last Name" type="text" name="P1Lname" id = "P1Lname" onkeyup = "Validate(this)" required />
                    <div id="errFirst"></div>
                </div>
            </div>
            <label class="d-block"> Proponent 2</label>
            <div class="form-row">
                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="First Name" type="text" name="P2Fname" id = "P2Fname" onkeyup = "Validate(this)" />
                    <div id="errFirst"></div>
                </div>

                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="Middle Initial" type="text" name="P2Mname" id = "P2Mname" onkeyup = "Validate(this)" />
                    <div id="errFirst"></div>
                </div>

                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="Last Name" type="text" name="P2Lname" id = "P2Lname" onkeyup = "Validate(this)" />
                    <div id="errFirst"></div>
                </div>
            </div>
            <label class="d-block"> Proponent 3</label>
            <div class="form-row">
                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="First Name" type="text" name="P3Fname" id = "P3Fname" onkeyup = "Validate(this)" />
                    <div id="errFirst"></div>
                </div>

                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="Middle Initial" type="text" name="P3Mname" id = "P3Mname" onkeyup = "Validate(this)"  />
                    <div id="errFirst"></div>
                </div>

                <div class="form-group col-md-4">

                    <input class="form-control" placeholder="Last Name" type="text" name="P3Lname" id = "P3Lname" onkeyup = "Validate(this)"  />
                    <div id="errFirst"></div>
                </div>
            </div>

          
            <div class="form-group">
            
            <label for="adviser"><span class="req"> </span> Adviser </label>
            <a type= "button" class="btnEditFaculty" data-toggle="modal" data-target="#modalEdit" class="font-italic">  <u class="font-italic text-primary"><small>Edit List?</small> </u></a>
              <select style="font-style: italic"  class="form-control" name="adviser" id="adviserUpdate">
              <option value="" disabled selected>select an adviser</option>
              
              <?php foreach($list as $lists){ ?>
              <option value=<?php echo $lists["faculty_id"] ?> > <?php echo $lists["fname"]." ".$lists["mname"].". ".$lists["lname"] ?>  </option>
              <?php  }?>
             
              </select>
            </div>

            <div class="form-group">
            <!-- <label for="panel"><span class="req"> </span> Panel 1 <small><a type="button" style="font-style: italic" data-toggle="modal" data-target="#modalEdit">Edit list?</a></small></label> -->
            <label for="panel"><span class="req"> </span> Panel 1 </label>
              <select style="font-style: italic"  class="form-control" name="panel1" id="panel1Update">
              <option value="" disabled selected> <p  style="font-style: italic" > select the first panel </option>
              
              <?php foreach($list as $lists){ ?>
                <option value=<?php echo $lists["faculty_id"] ?> > <?php echo $lists["fname"]." ".$lists["mname"].". ".$lists["lname"] ?>  </option>
              <?php  }?>
              
              </select>
            </div>

            <div class="form-group">
              <!-- <label for="panel2"><span class="req"> </span> Panel 2  <small><a type="button" data-toggle="modal" data-target="#modalEdit" style="font-style: italic" >Edit list?</a></small> </label> -->
              <label for="panel2"><span class="req"> </span> Panel 2 </label>
              <select style="font-style: italic" class="form-control" name="panel2" id="panel2Update">
                <option value="" disabled selected>select the second panel</option>
                
                <?php foreach($list as $lists){ ?>
                  <option value=<?php echo $lists["faculty_id"] ?> > <?php echo $lists["fname"]." ".$lists["mname"].". ".$lists["lname"] ?>  </option>
                <?php  }?>
              </select>
            </div>
           
          


           
            
            <div class="form-group">
              <label for="">Chapter 1 File</label>
                <div class="custom-file"> 
                  <input type="file" class="custom-file-input" name="fileUpdate" id="file" accept=".pdf">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>


             
            

             <div class="form-group row">
                <label class="col-3 col-form-label" for=""> <span class="req"> </span> Status &nbsp </label>
                <div class="form-check-inline col-3">
                  <label class="form-check-label" for="radioOngoing">
                    <input type="radio" class="form-check-input radioStatus" id="radiOngoing" name="radioStatus" value="Ongoing" checked>Ongoing
                  </label>
                </div>
                <div class="form-check-inline col">
                  <label class="form-check-label" for="radioCompleted">
                    <input type="radio" class="form-check-input" id="radioCompleted" name="radioStatus" value="Completed">Completed
                  </label>
                </div>
              
            </div>

            <div class="row">

              <div class="form-group abstractUpdate col-md-6" style="display: none">
                <label class="col-form-label">Abstract File</label>
                  <div class="custom-file"> 
                    <input type="file" class="custom-file-input" name="abstractUpdate" id="abstractUpdate" accept=".pdf">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
              
              <div class="form-group datePicker col-md-6" style="display: none">
                <label class="col-form-label" for=""> Date Completed</label>
                <input  class="form-control"  name="date" type="date" id="txtDate" value="<?php echo date("Y-m-d") ?>"> 
              </div>
            </div>

            <!-- <div class="form-group">
             <label for="exampleFormControlTextarea1"><span class="req"> </span>Abstract </label>
             <textarea class="form-control" id="abstractUpdate" rows="3" name="abstractUpdate"></textarea>
            </div> -->
           
           
            
           </form>        
           
          
          </div>
          <div class="modal-footer container-fluid">
            <button id="updateButton" form="updateResearchForm" type="submit" name="updateButton" class="btn btn-info updateButton">Update</button>
            <button type="button"  class="btn btn-secondary" data-dismiss="modal" >Close</button>
          <div>
      </div>
    </div>


   
  
  


   
<?php 
      if($_SESSION['account_type'] == 'Research Coordinator') {
        echo   '<script type="text/javascript">', 'disableAccnts();','</script>';  
      }

      // if (!empty($result) && $result == 1){
        
      //   echo'<script type="text/javascript">';
      //   echo 'swal("Success!","Research Updated!","success");';
      //   echo '</script>';
      
      //  }
      
      //  if (!empty($result) && $result == 0){
       
      //   echo'<script type="text/javascript">';
      //   echo 'swal("Error!","Update Failed!","error");';
      //   echo '</script>';
      //  }
      unset($_SESSION["ADD"]);
?>
 



<script>

          
      $(document).ready(function(){

          $('#modalEdit').on('shown.bs.modal', function() {
          //$('.btnEditFaculty').on('click', function() {
            $('#modalResearchUpdate').modal('hide');
          
          });
      });
     
        if(window.history.replaceState) {
         window.history.replaceState(null, null, window.location.href); 
        }

       

   </script>


</body>
</html>
