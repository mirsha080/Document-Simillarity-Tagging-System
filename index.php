<?php  

  require_once ( 'assets/PdfToText/PdfToText.phpclass');
  require_once ( 'mvc/controller/comparecont.class.php');
  require_once ('mvc/views/compareview.class.php');


  if ($_SERVER['REQUEST_METHOD']=='POST' && !empty(isset($_FILES['file'])) ){
  
    $file = $_FILES['file']["tmp_name"];
    $pdf  = new PdfToText($file);
    $string = $pdf->Text;
   
    $obj = new CompareCont();
    $result = $obj->scan($string);
    $response = "";
 

    $obj = new CompareView();
    
    arsort($result);
    foreach($result as $x => $x_value) {
    
    $title = $obj->showTitle($x);

     
                  
     $response .= "<tr data-id = $x >";
     $response .= "<td><a type='button' onclick=openModal($x)   class='text-light  dunno' > $title </a></td>";
     
     $response .= "<td style='font-size: 25px; color: red'>$x_value%</td>";
     $response .= "</tr>";    
     
    }
   
    
     echo $response;
    
    exit;
 }


 if ($_SERVER['REQUEST_METHOD']=='POST' && !empty(isset($_POST['copy_id'])) ){
  
   $obj = new CompareView();
   $copy_id = $_POST['copy_id'];
   $result = $obj->showDetails($copy_id);
   
   echo json_encode($result);
   exit;


 }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href= "assets/css/all.css" >
    


    <script src="js/jquery-3.5.1.js"></script>
    <script type= "text/javascript" src="js/myScript.js" ></script>
    <script src="assets/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.form.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    
  
    <style>

    table, th{

    color: #343a40;
    }

    ._wrapper2{
      margin-top: 80px;
    }
    @media screen and (max-width:600px){  
        ._title{
            font-size: 30px;
          
        }
        #file{
          height: 0vh;
        }
        ._subtitle{
          display: none;
        }
        ._customnav h6{

          font-size: 15px;
        }
        .card{
          height: 200px;
        }
        .dunno{
          font-size: 15px;
        }
        .card{
      min-height: 40vh;
    }
    .files:before{
      display: none;
    }

    }

   
    </style>

   
</head>
<body style="color: #fff;">
  
  <nav class="navbar navbar-expand-md bg-dark navbar-dark _customnav">
    <img class="mb-1" src="img/CIT LOGO WHITE BACKGROUND.png" alt="citlogo.png">
    <h6 class="mt-1 navbar-brand" href="#">MSU - College of Information Technology</h6>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    
    <ul class="navbar-nav  ml-auto" >
      <li class="nav-item ">
        <a class="nav-link text-light" href="index.php">Home</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-light" href="pages/researches.php">Researches</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-light" href="pages/aboutpage.php">About</a>
      </li>    
      <li class="nav-item ">
        <a class="nav-link text-light" href="pages/login2.php">Login</a>
      </li>    
    </ul>
  </div>  
 </nav>

    <div class="content ">
    <div class="container _scancontainer">
          <div class="_wrapper2 p-3 shadow" >
                <h1 class="_title font-weight-bolder">Document Similarity Tagging System</h1>
                    <div class="_subtitle font">
                      <!-- Checks similarity of a document with the research documents stored in the database -->
                    </div>
                        <div class="_uploadbox row">
                              <div class="col-md-7">
                                <div class="_table  mt-2 h-100">
                                  <h3 class="mt-3 font-weight-bolder text-center">UPLOAD FILE</h3>
                                 
                                  <form method="post"   id="myForm" enctype='multipart/form-data'>
                                    
                                   
                                    <div class="container files">
                                      
                                    <!-- <div class="custom-file"> 
                                      <input type="file" class="custom-file-input" name="file" id="file" accept=".pdf">
                                      <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div> -->
                                      <input type="file" name="file" id="file" class="form-control" accept=".pdf"  >
                                    
                              
                               
                                    </div>

                                    <div class="container">
                                        <div  id="files2">
                                        <div >
                                          <div  class="spinner-border text-muted" style="margin-left: 50px"></div>
                                          <div class="ml-4">Uploading...</div>    
                                        </div>
                                        </div>
                                      </div>
                                   
                                    
                                 </form>
                                </div>
                              </div>
                              

                              <div class="col-md">
                                
                                <div class="card mt-2 h-100" id="cardResult">
                                  <div class="card-body">
                                   <div  class="card-title " id="result"> 
                                   <h3 class="text-center font-weight-bolder border-bottom"> <span >RESULT </span> </h3>
                                      <div class="container ">
                                              <h6 class="d-inline font-weight-bolder" >TITLE</h6>
                                              <h6 style="float: right" class="d-inline font-weight-bolder ml-5" >SIMILARITY</h6>
                                      </div>
                                       
                                   
                                   </div>
                                   
                                       <div class="_scanresult border-top ">
                                              
                                       <!-- <div style="width: 380px; !important; position: fixed">
                                              <h6 class="d-inline" >TITLE</h6>
                                              <h6 class="d-inline" style="float: right">SIMILARITY</h6>
                                            </div> -->
                                       
                                          <table class="table table-responsive">
                                           
                                            <tbody id="percentage" >
<!--                                                 
                                            <div style="width: 380px; !important; position: fixed">
                                              <h6 class="d-inline" >TITLE</h6>
                                              <h6 class="d-inline" style="float: right">SIMILARITY</h6>
                                            </div>  -->
                                            
                                                <div class="container spin" style="display: none;">
                                                    <div>
                                                      <div class="text-center">
                                                        <div  class="spinner-border text-light" style="margin-top: 80px" ></div>
                                                        <div class="mt-3 text-light"><h6>Please Wait this may take several minute...</h6></div>  
                                                      </div>
                                                    </div>
                                                  </div>
                                                  
                                               
                                                
                                            </tbody>
                                           

                                          </table>
                                      
                                          </div>
                                  </div>
                                </div>
                              </div>

                          </div>
                              <div class="row">
                                  <div class="col-md-7">
                                      <div class="_btns mt-3">   
                                        
                                        <!-- <button type="button" class="btn btn-black shadow" name="btnScan" id="btnScan">SCAN </button> -->
                                        <button style="border-color: #fff" type="button" class="btn btn-black shadow" name="btnScan" id="btnScan">Compare </button>
                                      </div>
                                  </div>
                              </div>
                   </div>
          </div>
    </div>
   
  



    <script type= "text/javascript" src="../js/myScript.js"></script>
    

        <!-- MODAL RESEARCH INFO -->
        <div class="modal fade " id="modalResearchInfo"  aria-hidden="true">
        <div class="modal-dialog modal-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="text-light modal-title">Research Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-light" aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body  mx-3">
             <div class='table-responsive text-dark'>
                <table class="table table-bordered text-dark">
              
                <tr>
                    <th>Title</th>
                    <td id="title"></td>
                  </tr>
                  <tr>
                    <th>Category</th>
                    <td id="category"></td>
                  </tr>
                 
                  <tr>
                    <th>Proponents</th>
                    <td id="proponents"></td>
                  </tr>
                  <tr>
                    <th>Adviser</th>
                    <td id="adviser"></td>
                  </tr>
                  <tr>
                    <th>Panel</th>
                    <td id="panel"></td>
                  </tr>

                  <tr id="trstatus">
                      <th>status</th>
                      <td id="status"></td>
                    </tr>
                    <tr id="trdate_completed"  style="display: none">
                      <th>Date Completed</th>
                      <td id="date_completed"></td>
                    </tr>
                    <tr id="trabstract" data-id="" style="display: none">
                    <th>Abstract</th>
                      <td id="abstract" style="display: none"><u><a type="button" id="btnAbstract" class='btnAbstract' >Abstract Pdf</a></u></td>
                      <td id="abstract2" class="font-italic" style="display: none">No Abstract File Found</td>
                  </tr>


                </table>
              </div>
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
        <div class="modal-body p-0">
        <embed id="abstractID"  src="" type="application/pdf" style="height: 450px; width: 100%" ></embed>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer" >
        
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
        
      </div>
    </div>
  </div>
   
<script>

    
$(document).ready(function(){
      $('#file').change(function(e){
        
        let file = document.querySelector('#file').files[0];
       // let allowed_mime_types = [ 'image/jpeg', 'image/png' ];
        let allowed_mime_types = [ 'application/pdf'];
        let allowed_size_mb = 2;
      
        if(allowed_mime_types.indexOf(file.type) == -1) {
          swal("Error!","Incorrect File Type only PDF Files allowed!","error");
          $("#myForm").get(0).reset(); 
          return;
        }

        // if(file.size > allowed_size_mb*1024*1024) {
        //   alert('Error : Exceeded size');
        //   return;
        // }


        //var formData =  new FormData($('form')[0]);  
        $.ajax({
          cache: false,
          contentType: false,
          processData: false,
          //data: formData,                         
          type: 'post',
          beforeSend: function() {
              $('.files').hide();
              $('#files2').show();
           },
          success: function(php_script_response){
            $('.files').show(); 
            $('#files2').hide(); 
       
          
          },
        });

      }); 
    });






$(document).ready(function(){
      $('#btnScan').on('click',function(){

        
     
      if ($('#file').get(0).files.length === 0) {
          
          swal("Error!","Please Upload File First!","error");
          return;
        }
        var formData =  new FormData($('form')[0]);  
        
       
        $.ajax({
          dataType: 'html',
          cache: false,
          contentType: false,
          processData: false,
          data: formData,                          
          type: 'post',
          beforeSend: function() {
             $('#percentage').hide();
              $('.spin').show ();
           },
          success: function(php_script_response){
            
             $('.spin').hide();
             $('#percentage').html(php_script_response);
             $('#percentage').show();
           
          },
          error: function(php_script_response){
            console.log(php_script_response);
          }
         
        });

      }); 
    });

     
    function openModal(copy_id) {
     
     var id = copy_id;
     $.ajax({
        dataType: "json",
        type: "POST",
        data: {copy_id: id},
        success: function(data) {
         var le = data.length;

         var abstract = data[0];
          var status = data[1];
          var date_completed = data[2];

          
          document.getElementById('status').innerHTML = status+' Research';
          document.getElementById('date_completed').innerHTML = date_completed;
        
   
          
         // document.getElementById("btnAbstract").innerHTML = data[1]+".pdf";

          if(status == "Completed"){
            if((abstract != "" && abstract != null) && abstract != "Research Ongoing No Abstract to Show"){
              
              $("#trabstract").hide();
             
              $('#trabstract').attr("data-id",abstract);
              $('#abstract2').hide();
              $("#abstract").show();
              $("#trabstract").show();
              $("#trdate_completed").show();
             
            }
            else{
              $("#trabstract").hide();
              
              $("#abstract").hide();
              $('#abstract2').show();
              $("#trabstract").show();
              $("#trdate_completed").show();
             
             

            }
           
          }

          if(status == "Ongoing"){
            $("#trabstract").hide();
            $("#trdate_completed").hide();
          }

          //   $('#abstract2').hide();
          //   $("#abstract").show();
          //   $('#trabstract').attr("data-id",abstract);
          
          // 
        
          if (le == 23) {

              // document.getElementById('abstract').innerHTML = data[0];
              document.getElementById('title').innerHTML = data[3];
              document.getElementById('category').innerHTML = data[4];
              document.getElementById('proponents').innerHTML = data[5]+" "+data[6]+". "+data[7]+","+data[8]+" "+data[9]+". "+data[10]+","+data[11]+" "+data[12]+". "+data[13];
              document.getElementById('adviser').innerHTML = data[14]+" "+data[15]+". "+data[16];
              document.getElementById('panel').innerHTML = data[17]+" "+data[18]+". "+data[19]+", "+data[20]+" "+data[21]+". "+data[22];




              $('#modalResearchInfo').modal('show');
              }
              else if (le == 20){

              // document.getElementById('abstract').innerHTML = data[0];
              document.getElementById('title').innerHTML = data[3];
              document.getElementById('category').innerHTML = data[4];
              document.getElementById('proponents').innerHTML = data[5]+" "+data[6]+". "+data[7]+","+data[8]+" "+data[9]+". "+data[10];
              document.getElementById('adviser').innerHTML = data[11]+" "+data[12]+". "+data[13];
              document.getElementById('panel').innerHTML = data[14]+" "+data[15]+". "+data[16]+", "+data[17]+" "+data[18]+". "+data[19];

              $('#modalResearchInfo').modal('show');
              }

              else {

              //  document.getElementById('abstract').innerHTML = data[0];
              document.getElementById('title').innerHTML = data[3];
              document.getElementById('category').innerHTML = data[4];
              document.getElementById('proponents').innerHTML = data[5]+" "+data[6]+". "+data[7];
              document.getElementById('adviser').innerHTML = data[8]+" "+data[9]+". "+data[10];
              document.getElementById('panel').innerHTML = data[11]+" "+data[12]+". "+data[13]+", "+data[14]+" "+data[15]+". "+data[16];


              $('#modalResearchInfo').modal('show');
}
         
         },
         error: function(xhr, status, error) {
          
           console.error(xhr);
         }
       });
    
   }
   
   $(document).ready(function(){
      $('.btnAbstract').on('click',function(){
            
            
        
            var abstract = $(this).closest('tr').data('id');
            abstract = abstract.replace('../../', '');
            
            $('#abstractID').attr("src",abstract);
             
            $('#modalResearchInfo').modal('hide');
            $('#modalAbstract').modal('show');

            $('#modalAbstract').on('hide.bs.modal',function (e){

              $('#modalResearchInfo').modal('show');
            });
           
             
        });
      
    }); 
  
  
    if(window.history.replaceState) {
         window.history.replaceState(null, null, window.location.href); 
    }
 </script>
        
   

</body>

</html>


