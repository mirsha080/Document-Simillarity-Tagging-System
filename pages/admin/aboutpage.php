<?php
  require_once "../inc/session.php";
  require_once '../../mvc/controller/accountsettingcont.class.php';
  require_once '../../mvc/views/accountsettingview.class.php';


  
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



?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="../../assets/css/all.css" rel="stylesheet"> 
    <link href="../../assets/fileinput/fileinput.css" media="all" rel="stylesheet" >
    <link href="../../assets/css/fontawesome.min.css" media="all" rel="stylesheet" >
    <link href="../../assets/cropper.min.css" rel="stylesheet" type="text/css"/>
   
    <script src="../../js/jquery-3.5.1.js" charset="utf-8"></script>
    <script type= "text/javascript" src="../../js/myScript.js" ></script>
    <script src="../../assets/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../assets/cropper.min.js" type="text/javascript"></script>

  </head>
  <body>
  <input type="checkbox" id="check">
    <!--header area start-->
    <div class="my_header">
      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>
      
      <img src="../../img/CIT LOGO WHITE BACKGROUND.png" alt="">
        <h3> MSU - <span>CIT</span></h3>
         
      
      <div class="right_area">
        <a href="../../pages/inc/logout.php" class="logout_btn"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>
      </div>
      
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



  <!-- conten start -->
    <div class="content">

            <div class="inner-container ">
                  <h1>About</h1>
                  <p class="textAbout">
                      This system is a web based capstone project developed for Mindanao State University - College of Information Techonology (MSU - CIT)
                      to prevent possible dupplication of Capstone/Thesis Project. Through the system MSU CIT constituents will be able
                      to view the capstone/thesis projects in MSU - CIT and they will be able to scan their research proposal for possible dupplication. 
                      This project is developed as part of the  requirement for the degree Bachelor of Science in Information Technology.
                  
                  </p>
                  <div class="skills">
                      <!-- <span>Web Design</span>
                      <span>Photoshop & Illustrator</span>
                      <span>Coding</span> -->
                      <span>Mohammad Shamir M. Radia</span>
                      <span>Farhan G. Abdulmalic</span>
                      <span>Mohammad Naif S. Talib</span>
                  </div>
            </div>
 
    </div>


    <?php 
        if($_SESSION['account_type'] == 'Research Coordinator') {
          echo   '<script type="text/javascript">', 'disableAccnts();','</script>';  
        }
    
    ?>

  </body>
</html>