<?php 
  require_once "../inc/session.php";
  require_once '../../mvc/views/accountsview.class.php';
  require_once '../../mvc/controller/accountscont.class.php';
  require_once '../../mvc/controller/signupcont.class.php';
  require_once '../../mvc/controller/accountsettingcont.class.php';
  require_once '../../mvc/views/accountsettingview.class.php';

  
  //$sqlValidate;
  $accnts = new AccountsView();
  $coorAccnts = $accnts->showCoorAccounts();
  $adminAccnts = $accnts->showAdminAccounts();

  $profileObj = new AccountSettingView();
  $profile = $profileObj->showProfile();
  $profileImage = $profile["profile_picture"];
  if($profileImage == null || empty($profileImage)){
    $profileImage = "../../img/user8.png";
  }


  if(isset($_POST['image']))
{
	$data = $_POST['image'];

  $obj = new AccountSettingCont();
  $image_name = $obj->updateProfile($data);
  echo $image_name;
  exit;
}



  //$queryResult;
  $activate;
  $deactivate;
  if (isset($_POST['submitform'])){
    
    
    
    $firstName = $_POST['firstname'];
    $middleName = $_POST['middlename'];
    $lastName = $_POST['lastname'];
    $userName = $_POST['username'];
    $accountType = $_POST['accountType'];
    $password =  $_POST['password'];


       $obj = new SignupCont();  
       $queryResult = $obj->createUser($firstName, $middleName, $lastName, $userName,$accountType,$password);
       $coorAccnts = $accnts->showCoorAccounts();
       $adminAccnts = $accnts->showAdminAccounts();

 }

  
   
    if(isset($_POST['btnActivate'])){
      $account_id = $_POST['account_id_ac'];
   
      $obj = new AccountsCont();  
      $activate = $obj->updateAccnt($account_id,"ACTIVE");
      $coorAccnts = $accnts->showCoorAccounts();
      $adminAccnts = $accnts->showAdminAccounts();
     }
 
  
    
   if(isset($_POST['btnDeactive'])){
      $account_id = $_POST['account_id_de'];
      
      $obj = new AccountsCont();
      $deactivate = $obj->updateAccnt($account_id,"INACTIVE");
      $coorAccnts = $accnts->showCoorAccounts();
      $adminAccnts = $accnts->showAdminAccounts();
     
   
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
  
    <script src="../../js/jquery-3.5.1.js"></script>
    <script type= "text/javascript" src="../../js/myScript.js" ></script>
    <script src=../../assets/popper.min.js></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../assets/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/DataTables/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../js/sweetalert.min.js"></script>
    <script src="../../assets/cropper.min.js" type="text/javascript"></script>
       
    
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
      
      <!-- <h3 class="logout_btn">DOCUMENT SIMILARITY TAGGING SYSTEM</h3>  -->
      <a href="../../pages/inc/logout.php" class="logout_btn"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>
           
    </div> 
    <!--header area end-->
   
   
    <!--mobile navigation bar start-->
    <div class="mobile_nav">
      <div class="nav_bar" onclick="readyFn()">
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
      <a href="index.php"><i class="__link active"><img  class="mb-1" src="../../img/filesearch.png" style="height: 22px;" alt=""></i><span>Compare Document</span></a>
      <a class="_accounts" href="accounts.php"><i class="__link fa fa-users"></i><span>User Accounts</span></a>
      <a href="research.php"><i class="__link fa fa-book"></i><span>Capstone/Thesis</span></a>
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
    <div class="content">
      <div class="container _accntcontainer">


        <button id ="btn-createAccnt" data-toggle="modal" data-target="#create_accnt" class="btn btn-primary mt-3 mb-3"><i class = "fa fa-user-plus"></i><span> Create Account</span></button>
        <br/>
        <div class="table-responsive text-light">
       
          <table id="data" class="table table-striped table-bordered text-light">
            <thead>
              <tr>
                <!-- <th hidden> </th> -->
                <th>Name</th>
                <th>User Type</th>
                <th>Status</th>
                <th>Action</th> 
              </tr>
            </thead>
            
            <tbody>
            <!-- FOR COORDINATOR ACCNTS VIEW -->
            <?php
                $btnActivate = '<td><button  type="button"  class="btn btn-info btnModActivate">Activate Account</button></td>';
                $btnDeactivate = '<td><button  type="button"  class="btn btn-danger btnModDeactivate"> Deactivate Account</button></td>';
                
                if (!empty($coorAccnts)){
                while($result = mysqli_fetch_assoc($coorAccnts)){ 
                  
                
            ?>
            <tr data-id=<?php echo $result['account_id']?>>
           
                <!-- <td hidden></td>  -->
                <td> <?php echo $result['fname']." ".$result['mname'][0].". ".$result['lname'];?></td>
                <td><?php echo $result['account_type'] ?></td>
                <td><?php echo $status= $result['status'];?></td>
                
                
                <?php if ($status === "ACTIVE"){ echo $btnDeactivate;}else{ echo $btnActivate;}  ?>
               
              </tr>
            <?php  }}?>
            
            <!-- FOR ADMIN ACCNTS VIEW -->
            <?php
                $btnActivate = '<td><button  type="button"  class="btn btn-info btnModActivate">Activate Account</button></td>';
                $btnDeactivate = '<td><button  type="button"  class="btn btn-danger btnModDeactivate"> Deactivate Account</button></td>';
                
                if (!empty($adminAccnts)){
                while($result = mysqli_fetch_assoc($adminAccnts)){ 
                  
                
            ?>
            <tr data-id=<?php echo $result['account_id']?>>
           
                <!-- <td hidden></td>  -->
                <td> <?php echo $result['fname']." ".$result['mname'][0].". ".$result['lname'];?></td>
                <td><?php echo $result['account_type'] ?></td>
                <td><?php echo $status= $result['status'];?></td>
                
                
                <?php if ($status === "ACTIVE"){ echo $btnDeactivate;}else{ echo $btnActivate;}  ?>
               
              </tr>
            <?php  }}?>
            </tbody>
          </table>
         
        </div>
      
      <!-- Modal Activate -->
   
      <div class="modal fade" id="modalActivate" aria-hidden="true" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header " style="background: white;">
              <h5 class="modal-title" >Activate Account</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                <form  action="/DSTS/pages/admin/accounts.php" method="POST">
                  <div class="modal-body">
               
                    <input type="hidden" id="account_id_ac" name="account_id_ac">
                    <h5>Activate this account?</h5>
                  </div>
                  <div class="modal-footer " style="background: white;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit"  id = "btnActivate" name = "btnActivate"  value="btnActive" class="btn btn-info">Activate</button>
                
                  </div>
                </form>  
          </div>
        </div>
      </div>

      <!-- Modal Deactivate  -->

      
      <div class="modal fade" id="modalDeactivate" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header "  style="background: white;">
              <h5 class="modal-title">Deactivate Account</h5>
              <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/DSTS/pages/admin/accounts.php"  method="POST">
                <div class="modal-body">
                    <input type="hidden" name="account_id_de"  id="account_id_de" >
              
                    <h5>Are you sure want to deactivate this account?</h5>
                </div>
              
                <div class="modal-footer " style="background: white;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type= "submit"  id = "btnDeactive" name="btnDeactive" value ="btnDeactive" class="btn btn-info">Deactivate</button>
                </div>
            </form>
          </div>
        </div>
      </div>



      <!-- Modal Create Account -->
   
      <div class="modal fade" id="create_accnt"  aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content ">
            <div class="modal-header">
              <h5 class="modal-title text-light">Create Account</h5>
              <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body mx-3">
              <form action="/DSTS/pages/admin/accounts.php" method="POST" id="user-form">

                 
                 <div class="form-row">
                <div class="form-group col-md-4"> 	 
                    <label for="firstname"><span class="req">* </span> First name: </label>
                    <input class="form-control" type="text" name="firstname" id = "txt"  required /> 
                    <div id="errFirst"></div>    
                </div>

                <div class="form-group col-md-4"> 	 
                    <label for="middlename"><span class="req">* </span> Middle name: </label>
                    <input class="form-control" type="text" name="middlename" id = "txt" required /> 
                    <div id="errFirst"></div>    
                </div>

                <div class="form-group col-md-4"> 	 
                    <label for="lastname"><span class="req">* </span> Last name: </label>
                    <input class="form-control" type="text" name="lastname" id = "txt"required /> 
                    <div id="errFirst"></div>    
                </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="username "><span class="req">* </span> Username: </label> 
                      <input class="form-control" type="text" name="username" id = "txt"  required />  
                          <div id="errLast"></div>
                  </div>
                  <div class="form-group col-md-6"> 	 
                      <label for="accntType"><span class="req">* </span> Account Type: </label>
                      <select name="accountType" class="form-control" id="accntType"required="">
                                            <option value="Research Coordinator">Research Coordinator</option>
                                            <option value="Administrator">Administrator</option>
                                         
                                          </select>
                      <div id="errFirst"></div>    
                  </div>
                </div>


                <div class="form-group">
                <label for="password"><span class="req">* </span> Password: </label>
                    <input required name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16"  id="pass1" /> </p>

                <label for="password"><span class="req">* </span> Retype Password: </label>
                    <input required type="password" class="form-control inputpass" minlength="4" maxlength="16"  id="pass2" onkeyup="checkPass(); return false;" />
                        <span id="confirmMessage" class="confirmMessage"></span>
                </div>
            </form>
            </div>
            <div class="modal-footer">
              <button type="submit" name="submitform" class="btn btn-primary" value="submit" style="  width: 100px;" form="user-form" onClick=showAlert(); >Submit</button>
            </div>
            
   
          </div>
        </div>
      </div>



      </div>
    


    
      <?php 
        if($_SESSION['account_type'] == 'Research Coordinator') {
          echo   '<script type="text/javascript">', 'disableAccnts();','</script>';  
        }

        if (!empty($queryResult) && $queryResult == 1){
       
          echo'<script type="text/javascript">';
          echo 'swal("Success!","Account Created!","success");';
          echo '</script>';
         }

         if (!empty($queryResult) && $queryResult == 0){
       
          echo'<script type="text/javascript">';
          echo 'swal("Error!","Something Went Wrong!","error");';
          echo '</script>';
         }
         
        if (!empty($activate) && $activate == 1){
       
          echo'<script type="text/javascript">';
          echo 'swal("Success!","Account Activated!","success");';
          echo '</script>';
         }

         if (!empty($activate) && $activate == 0){
       
          echo'<script type="text/javascript">';
          echo 'swal("Error!","Fail to activate account!","error");';
          echo '</script>';
         }
         
        if (!empty($deactivate) && $deactivate == 1){
       
          echo'<script type="text/javascript">';
          echo 'swal("Success!","Account Deactivated!","success");';
          echo '</script>';
         }

        
         
        if (!empty($deactivate) && $deactivate === 0){
       
          echo'<script type="text/javascript">';
          echo 'swal("Error!","Fail to deactivate account!","error");';
          echo '</script>';
         }
        
      ?>


      <script>
      
      if(window.history.replaceState) {
         window.history.replaceState(null, null, window.location.href); 
        }
      </script>
  </body>
</html>