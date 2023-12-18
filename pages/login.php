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
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link rel="stylesheet" href="../css/style.css">

   <script src="../js/jquery-3.5.1.js"></script>
   <script src="../assets/popper.min.js"></script>
   <script src="../js/bootstrap.min.js"></script>
   <script src="../js/sweetalert.min.js"></script>
       
   <style>
      body {
         font-family: "Lato", sans-serif;
         background-image: url("../img/back.png");
         background-size: cover;
         background-repeat: no-repeat;
      }    

      #home{

         text-align: center;
         font-size: 15px;
        
    
         
      }
   
   </style>
   
    
</head>
<body >

   
   <div class="container-fluid sidenav">
               <div class="login-main-text">
                  <div class="mr-4" style="float: left;">

                  <img src="../img/CIT LOGO WHITE BACKGROUND.png" alt="" class=" image-fluid rounded-circle img-thumbnail" id="logoLogin" width="110em" > 
                  </div> 
                  <div id="heading">
                  <h3 class="">MSU  - CIT  </h3>  
                  <h3>Document Similarity </h3>
                  <h3>Tagging System</h3>
                  <p class="font-italic" >Login from here to access</p>
                  
                  </div>
               </div>
                           
   </div>
          

   <div class="main">
            <div class="col-md-6 col-sm-12">
               <div class="login-form">
            

                    
                                



                  <form action="/DSTS/pages/login.php" method="post">
                     <h1 class= "text-center mb-4" id="__loginFont"> Login </h1>
                     <div class="form-group">
                        <label>User Name</label>
                        <input required type="text" class="form-control" name="username" placeholder="User Name">
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input required type="password" class="form-control" name="password" placeholder="Password">
                     </div>
                     <button type="submit" class="btn btn-black mb-2 " id="__loginButton" name="login" value="LOGIN" style="font-size: 20px; width: 100%;">Login</button>
                     <!-- <button  type="button" id="btnRegister" class="btn btn-black">Register</button> -->
                     <div id="home">
                         <a href="/DSTS" style="    color: #2f5fac;" ><u><i>Go to Home Page</i></u></a>
                     </div>
            
                    
                     <?php
                        if(isset($_SESSION["error"])){
                              // $error = $_SESSION["error"];
                              // echo "<span style='color: red; font-size: 14px; display: inline; '>$error</span>";
                              echo'<script type="text/javascript">';
                              echo 'swal("Error!","Invalid Username/Password!","error");';
                              echo '</script>';
                        }
                        
                               
                        // if (!empty($result) && $result === 0){
                           
                        //    echo'<script type="text/javascript">';
                        //    echo 'swal("Error!","Invalid Username/Password!","error");';
                        //    echo '</script>';
                        // }
                     ?>  
                  </form>
                 



               </div>
            </div>
            
   </div>
</body>
</html>

<?php
    unset($_SESSION["error"]);

?> 