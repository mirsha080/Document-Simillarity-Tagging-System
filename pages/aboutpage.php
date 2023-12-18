<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href= "../assets/css/all.css" >

    <script src="../js/jquery-3.5.1.js"></script>
    <script type= "text/javascript" src="../js/myScript.js" ></script>
    <script src="../assets/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <style>

        .inner-container{
          margin-top: 60px;
        }
     
      @media screen and (max-width:600px){  
        .inner-container{
            padding:50px;
            
        }
        .textAbout{
          font-size: 12px;
        }

        ._aboutcontainer{
          margin-top: 50px;
        }

        .skills{
          font-size: 11px;
        }
        ._customnav h6{

          font-size: 15px;
        }

      }



    
  
 
    </style>
    
</head>
<body>
<div class="_nav">
<nav class="navbar navbar-expand-md bg-dark  navbar-dark _customnav">
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
        <a class="nav-link text-light" href="login2.php">Login</a>
      </li>    
    </ul>
  </div>  
</nav>

   <div class="_aboutcontainer" > 
    <!-- <div class="_customcontainer">   -->
    <!-- <div class="content"> -->
    <!-- <div class="_wrapper2 p-3 shadow "> -->
        <div class="inner-container " >
                  <h1>About</h1>
                  <p class="textAbout">
                      This system is a web based capstone project developed for Mindanao State University - College of Information Techonology (MSU - CIT)
                      to prevent possible dupplication of Capstone/Thesis Project. Through the system MSU -CIT constituents will be able
                      to view the capstone/thesis projects in MSU - CIT and they will be able to scan their research proposal for possible dupplication. 
                      This project is developed as part of the  requirement for the degree Bachelor of Science in Information Technology.
                  
                  </p>
                  <div class="skills">
                      <span>Mohammad Shamir M. Radia</span>
                      <span>Farhan G. Abdulmalic</span>
                      <span>Mohammad Naif S. Talib</span>
                  </div> 
          <!-- </div> -->
    </div>
    <!-- </div>  -->
</div>

<!-- 
 <div class="content" style="background-color: #f1f1f100;">
    //<div class="_wrapper2 p-3 shadow ">
    <div class="inner-container ">
                  <h1 class ="text">About</h1>
                  <p class="text">
                      This system is a web based capstone project developed for Mindanao State University - College of Information Techonology (MSU - CIT)
                      to prevent possible dupplication of Capstone/Thesis Project. Through the system MSU -CIT constituents will be able
                      to view the capstone/thesis projects in MSU - CIT and they will be able to scan their research proposal for possible dupplication. 
                      This project is developed by Mohammad Shamir M. Radia, Mohammad Naif S. Talib, and Farhan G. Abdulmalic as part of the  requirement for the degree Bachelor of Science in Information Technology .
                  
                  </p>
                  <div class="skills text">
                      <span>Web Design</span>
                      <span>Photoshop & Illustrator</span>
                      <span>Coding</span>
                  </div> 
          </div>
    </div>


     </div> 
</div> -->
</body>
</html>


