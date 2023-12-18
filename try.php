<?php 
  require_once ( 'assets/PdfToText/PdfToText.phpclass' );
  require_once ('mvc/dbh.class.php');
  require_once ('mvc/porterstemming.class.php');
  require_once ('mvc/PreProcess.class.php');
  require_once ('mvc/Rabin-Karp.class.php');

  $obj = new Dbh();
  $conn = $obj->connect();
  // $a = array();
  // $b = array();
  // array_push($a,array("salad","vegetables"));
  // array_push($a,array("niyog","carabao"));
  // array_push($b,array("salad","vegetables"));
  // array_push($b,array("banana","apple"));
  // //echo $a[0][0];
  
  // print_r(array_intersect($a,$b));


  // $a=array("a"=>"red","b"=>"green","c"=>"blue");
  // $b=array("a"=>"red","b"=>"green","d"=>"blue","e"=>"blue");
  // $a = array("a","b");
  // $b = array("a","b");
  // $c =array();
  // $i = 0;
  // $c[$a[$i]] = "asdfas";
  // $match = array_intersect($b,$a);
  // $sameHash = 0;
  // echo $c["a"];
  // foreach($match as $x => $x_value ){
  //   foreach($b as $y => $y_value ){
  //     if($x_value == $y_value){
  //       if($x == $y){
  //         $sameHash++;
  //       }
  //     }
  //   }
  // }
  // echo $sameHash;
   
  
    // $pdf  = new PdfToText("uploads/60891d6c4bd911.36788562.pdf");
    // $data = $pdf->Text;
    


    // TESTING 

    // $data = "hello world significance of the study hehe hehe ehehe";
    // $obj = new PreProcess();
    // $data = $obj->Process($data);
    // echo $ec = implode($data);
    //echo $data;
    
  
    

    // $obj = new RabinKarp();
    // for ($i = 0; $i < count($data); $i++){

      
    //   $data[$i] = $obj->getHash($data[$i],10007);
    // }
    //echo implode(" ",$data);


   //second pdf
    
  //  $pdf  = new PdfToText("uploads/chapter 2.pdf");
  //  $string = $pdf->Text;

  //  $obj = new PreProcess();
  //  $string = $obj->process($string);
   

  //  $obj = new RabinKarp();
  //  for ($i = 0; $i < count($string); $i++){

     
  //    $string[$i] = $obj->getHash($string[$i],10007);
  //  }

  
  // result 
  // $doc1 = count($data);
  // $doc2 = count($string);
  // $sameHash = 0;
 
  //   for ($i = 0; $i < count($string); $i++){

  //     if(in_array($string[$i],$data)){
  //       $sameHash++;
  //     }
  //   }
    
  //   $P = ((2 * $sameHash) / ($doc1 + $doc2));
  //   $P = number_format($P * 100);
  //   echo $P."%";
 
 
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href= "assets/css/all.css" >
    <link rel="stylesheet" href="assets/DataTables/css/dataTables.bootstrap4.min.css"/>
    <link href="assets/cropper.min.css" rel="stylesheet" type="text/css"/>

    <script src="js/jquery-3.5.1.js"></script>
    <script type= "text/javascript" src="js/myScript.js" ></script>
    <script src="assets/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/jquery.form.min.js"></script>
    <script src="assets/cropper.min.js" type="text/javascript"></script>

    



    
</head>

<body>




<!-- MODAL EDIT -->
<div class="modal fade" id="modalEdit" aria-hidden="true" >
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
        <link href="assets/bootstrap-select.css" rel="stylesheet" type="text/css"/>
        <script src="assets/bootstrap-select.js" type="text/javascript"></script>

        <!-- <div class="col-lg-5"> -->
        <label>Standard</label>
        <select class="selectpicker form-control" data-live-search="true">

        <option value="">Hello WOrldd</option>
        <option value="">Hello There</option>
        <option value="">Hello Hoho</option>
        </select>
      <!-- </div> -->








<!-- <div class="row bg-primary">
    <div class="col tet-center p-4 bg-primary">
        <input  class="form-control-lg" type="date" id="txtDate" value="<?php echo date("Y-m-d") ?>">
    </div>
</div> -->

<script>
    $(document).ready(function(){


        $.ajax({

            type: "post",
            data: {selected_date: $("#txtDate").val()},
            
        });

    });


    
// <script>
// function createOptions(number) {
//   var options = [], _options;

//   for (var i = 0; i < number; i++) {
//     var option = '<option value="' + i + '">Option ' + i + '</option>';
//     options.push(option);
//   }

//   _options = options.join('');
  
//   $('#number')[0].innerHTML = _options;
//   $('#number-multiple')[0].innerHTML = _options;

//   $('#number2')[0].innerHTML = _options;
//   $('#number2-multiple')[0].innerHTML = _options;
// }

// var mySelect = $('#first-disabled2');

// createOptions(4000);

// $('#special').on('click', function () {
//   mySelect.find('option:selected').prop('disabled', true);
//   mySelect.selectpicker('refresh');
// });

// $('#special2').on('click', function () {
//   mySelect.find('option:disabled').prop('disabled', false);
//   mySelect.selectpicker('refresh');
// });

// $('#basic2').selectpicker({
//   liveSearch: true,
//   maxOptions: 1
// });
// </script>
</script>

</body>

</html>

