<?php 

require_once "../inc/session.php";
require_once '../../mvc/views/accountsettingview.class.php';
require_once '../../mvc/controller/accountsettingcont.class.php';
require_once '../../mvc/controller/accountsettingcont.class.php';
require_once '../../mvc/views/accountsettingview.class.php';

$result;
$accnt = new AccountSettingView();
$result= $accnt->showAccountInfo();
$updateResult;



$profileObj = new AccountSettingView();
$profile = $profileObj->showProfile();
$profileImage = $profile["profile_picture"];
if($profileImage == null){
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



if (isset($_POST["savebtn"])){

  $password = null;

  $fname = $_POST["fname"];
  $mname = $_POST["mname"];
  $lname = $_POST["lname"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  $account = new AccountSettingCont();
  $updateResult = $account->updateAccnt( $fname, $mname,  $lname , $username,  $password);

  $result= $accnt->showAccountInfo();
  

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
      
      <!-- <h3 class="logout_btn">DOCUMENT SIMILARITY TAGGING SYSTEM</h3> -->
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
        <!-- <a href="../../index.ph"><i class="__link fas fa-sliders-h"></i><span>Settings</span></a> -->
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
        <h4 id="user"><?php echo $profile["fname"]?></h4>
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
    <div class="content"  > 
    <div class="card mt-2">
            <div class="card-header  text-center">Your Account</div>
                <div class="card-body" >
                    
                    <form   id="accountform" action="/DSTS/pages/admin/accountsetting.php" method="post"  role="form">
                        <?php 
                        
                              if(!empty($result)){
                                while($rowValidate = mysqli_fetch_assoc($result)){  
                              ?>
                        <div class="form-group">
                            <label  for="fname"><span class="req" ></span>First Name </label>
                            
                            <input disabled class= "form-control"  type="text" name="fname" id = "txt" value=<?php echo $rowValidate["fname"]; ?> />
                            <div id="errFirst"></div>
                        </div>
                        <div class="form-group">
                            <label  for="mname"><span class="req" ></span>Middle Initial </label>
                            <input disabled class= "form-control" type="text" name="mname" id = "txt" value=<?php echo $rowValidate["mname"][0]; ?>  />
                            <div id="errFirst"></div>
                        </div>
                        <div class="form-group">
                            <label  for="lname"><span class="req" ></span>Last Name </label>
                            <input disabled class= "form-control" type="text" name="lname"   value=<?php echo $rowValidate["lname"] ?> />
                            <div id="errFirst"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="username "><span class="req"></span>Username </label> 
                            <input disabled class="form-control" type="text" name="username" id = "txt" value=<?php echo $rowValidate["username"]; ?> />  
                            <div id="errLast"></div>
                        </div>
                        <div class="form-group" id="p" style="display:none;">
                            <label for="password"><span class="req"></span>Password </label>
                            <input disabled  name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16"  id="pass1" />
                        </div>
                        <div class="form-group" id="p1" style="display:none;">
                            
                            <label for="password"><span class="req"></span>Confirm Password </label>
                            <input disabled  name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16"  id="pass2" onkeyup="checkPass(); return false;" />
                            <span id="confirmMessage" class="confirmMessage"></span>

                        </div>
                              <?php }}?>
                    </form>
                    <button id="updateaccntbtn" class="btn text-light"  style="background-color: #2f323a; width: 150px;"  onclick="enableForm()" type="button" style="width: 150px">Update</button>
                    <button form="accountform" id="savebtn" name="savebtn" class="btn text-light" style="background-color: #2f323a; display: none;" type="submit" style="width: 150px">Save Changes</button>
                </div>
           
         </div>



      </div>
    

      <?php 
        if($_SESSION['account_type'] == 'Research Coordinator') {
          echo   '<script type="text/javascript">', 'disableAccnts();','</script>';  
        }
      

        if (!empty($updateResult) && $updateResult === 1){
       
          echo'<script type="text/javascript">';
          echo 'swal("Success!","Your Account has been Updated!","success");';
          echo '</script>';
         }

         
        if (!empty($updateResult) && $updateResult === 0){
       
          echo'<script type="text/javascript">';
          echo 'swal("Error!","Failed to Update You Account!","error");';
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