<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <style>

        body{
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            /* background: -webkit-linear-gradient(left, #0072ff, #8811c5); */
            background-image: url("../img/back.png");
            background-size: cover;
            background-repeat: no-repeat;
            
        }


       
    </style>
</head>
<body>
<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"><p>Register</p></div>
                        <div class="card-body">
                            <form name="my-form" onsubmit="return validform()" action="success.php" method="">
                                    
                                        <div class="form-group"> 	 
                                            <label  for="title"><span class="req" >*</span>University ID no.: </label>
                                          
                                            <input  class= "form-control" type="text" name="title" id = "txt" onkeyup = "Validate(this)" required />
                                            <div id="errFirst"></div>  
                                        </div>
                                        
                                        <div class="form-row">
                                        <div class="form-group col-md-4"> 	 
                                            <label for="firstname"><span class="req">* </span> First name: </label>
                                            <input class="form-control" type="text" name="firstname" id = "txt" onkeyup = "Validate(this)" required /> 
                                            <div id="errFirst"></div>    
                                        </div>

                                        <div class="form-group col-md-4"> 	 
                                            <label for="middlename"><span class="req">* </span> Middle name: </label>
                                            <input class="form-control" type="text" name="middlename" id = "txt" onkeyup = "Validate(this)" required /> 
                                            <div id="errFirst"></div>    
                                        </div>

                                        <div class="form-group col-md-4"> 	 
                                            <label for="lastname"><span class="req">* </span> Last name: </label>
                                            <input class="form-control" type="text" name="lastname" id = "txt" onkeyup = "Validate(this)" required /> 
                                            <div id="errFirst"></div>    
                                        </div>
                                        </div>

                                        <div class="form-row">    
                                        <div class="form-group col-6"> 	 
                                            <label for="gender"><span class="req">* </span> Gender: </label>
                                            <select name="accountType" class="form-control" id="gender"  required="">
                                                                    <option value="1">Male</option>
                                                                    <option value="2">Female</option>

                                            </select>
                                            <div id="errFirst"></div>    
                                            </div>
                                        <div class="form-group col-6"> 	 
                                            <label for="course"><span class="req">* </span> Course: </label>
                                            <select name="accountType" class="form-control" id="course"required="">
                                                                    <option value="1">Computer Science (Foundation)</option>
                                                                    <option value="2">Computer Science (Software Eng.)</option>
                                                                    <option value="3">Information Technology (Database)</option>
                                                                    <option value="4">Information Technology (Networking)</option>
                                                                    <option value="5">Information System</option>
                                                                    
                                                                </select>
                                            <div id="errFirst"></div>    
                                        </div>
                                        </div>

                                        <div class="form-row">
                                        <div class="form-group col-md-6">
                                        <label for="username "><span class="req">* </span> Username: </label> 
                                            <input class="form-control" type="text" name="username" id = "txt" onkeyup = "Validate(this)" required />  
                                                <div id="errLast"></div>
                                        </div>
                                        <div class="form-group col-md-6"> 	 
                                            <label for="accntType"><span class="req">* </span> Account Type: </label>
                                            <select name="accountType" class="form-control" id="accntType"required="">
                                                                    <option value="1">Student</option>
                                                                    <option value="2">Faculty</option>
                                                                   
                                                                
                                                                    
                                                                </select>
                                            <div id="errFirst"></div>    
                                        </div>
                                        </div>
                                    
                                        <div class="form-group">
                                        <label for="password"><span class="req">* </span> Password: </label>
                                            <input required name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16"  id="pass1" /> </p>

                                        <label for="password"><span class="req">* </span> Password Confirm: </label>
                                            <input required name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16" placeholder="Enter again to validate"  id="pass2" onkeyup="checkPass(); return false;" />
                                            <span id="confirmMessage" class="confirmMessage"></span>
                                        </div>

                                    
                                        <button type="submit" class="btnSubmit btn">
                                        Submit
                                        </button>
                                        <button type="button" id="btnLogin" class="btnSubmit btn">
                                        Login
                                        </button>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

<script>

document.getElementById("btnLogin").onclick = function gotoIndex() {
        location.href =  "login.php";
};
</script>
    
</body>
</html>