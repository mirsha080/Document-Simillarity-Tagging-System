<?php 

require_once '../mvc/views/loginview.class.php';
$result;
 if (!isset($_SESSION)){
            
      session_start();
    
 }
 

            if (empty($_SESSION['status'])){
               $_SESSION['status'] =  'invalid';
            }
            
            if ($_SESSION['status'] == 'valid'){
               echo "<script>window.location.href='admin/accounts.php'</script>";
            }
            
            if (isset($_POST['login'])){

               $user = trim($_POST['username']);
               $pass =  trim($_POST['password']);
               
            
                  $obj = new LoginView();  
                  
                  $result = $obj->log_in($user,$pass);
                  
                  if ($result > 0 ){
                    
                           $_SESSION['status'] = 'valid';
                           echo  "<script>window.location.href = 'admin/index.php'</script>";
                  } 
                  else {

                     $_SESSION['status'] = 'invalid';
                     
                    
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
   <script src="../js/sweetalert.min.js"></script>

    <style>
            ._wrapper2{


                min-height: 20px;
                width: 35vw;
                margin-top: 90px;

            }

            h1{
              font-size: 20px;
             
              font-weight: bolder;
            }

           #enter{
           
              color: #f8f9fa8c;
            }
            
            #lock{
              width: 50px;
              margin-bottom: 60px;
              float: right;
              color: #f8f9fa8c;
              
            }

            /* #error{
              float: right;
            } */

            ._wrapper2{
              margin-top: 160px;
            }  
@media screen and (max-width:600px){  
    ._wrapper2{
     width: 90vw;
      margin-top: 130px;
    }
    #lock{
      margin-left: 10px;
    }
    ._customnav h6{

        font-size: 15px;
    }
  }  

    
    </style>

    
    

  </head>
  <body class="text-light">
  
  <nav class="navbar navbar-expand-md bg-dark navbar-dark _customnav">
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
        <a class="nav-link text-light" href="researches.php">Researches</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-light" href="aboutpage.php">About</a>
      </li>    
      <li class="nav-item ">
        <a class="nav-link text-light" href="#">Login</a>
      </li>    
    </ul>
  </div>  
 </nav>

    <div class="content">
    <div class="_wrapper2 p-3 shadow " >
         
    <form action="/DSTS/pages/login.php" method="post">
                    <div  id="lock">
                     <i  class="fas fa-lock fa-3x" aria-hidden="true"></i>
                     </div>
                     <h1  id="__loginFont"> LOGIN </h1>
                     <h6 id="enter">Enter your username and password to log on:</h6>
                   
                     <div class="form-group">
                
                        <!-- <label>User Name</label> -->
                        <?php
                      if(isset($_SESSION["error"])){
                              $error = $_SESSION["error"];
                              echo "<span id='error' style='color: #ffffff75; font-size: 14px;'>$error</span>";
                          
                        }?>
                        <input required type="text" class="form-control" name="username" placeholder="User Name">
                     </div>
                     <div class="form-group">
                        <!-- <label>Password</label> -->
                        <input required type="password" class="form-control" name="password" placeholder="Password">
                     </div>
                     <button type="submit" class="btn btn-black" id="__loginButton" name="login" value="LOGIN" style="font-size: 20px; width: 100%;">Login</button>
                     <!-- <button  type="button" id="btnRegister" class="btn btn-black">Register</button> -->
                     <div class="form-group mt-2">
                
                      <div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
                      <label for="remember-me">Remember me</label>
                     

                      
                     
                    </div>
                    
                  </form>

         
    </div>


  </body>
</html>
<?php
    unset($_SESSION["error"]);

?> 


