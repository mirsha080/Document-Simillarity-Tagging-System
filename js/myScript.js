// JQUERY

function readyFn( jQuery ) {
        $('.nav_btn').click(function(){
              $('.mobile_nav_items').toggleClass('active');
        });    
};
$( document ).ready( readyFn );


function table( jQuery){
        $('#data').DataTable( {
          
          ordering: false    
        });
    };
$( document ).ready( table );



function enableForm(){
    
    $( "#accountform :input").prop("disabled", false);

   
    var x = document.getElementById("savebtn")
    x.style.display="block";
   
    var y = document.getElementById("updateaccntbtn");
    y.style.display="none";

    var z = document.getElementById("p");
    z.style.display="block";

   document.getElementById("p1").style.display="block";
   
}

$(document).ready(function() {                 
    $('.btnModDeactivate').on('click',function(){
      
      $('#modalDeactivate').modal('show');
      var accid = $(this).closest('tr').data('id');
      $('#account_id_de').val(accid);
      
    //    $tr = $(this).closest('tr');
      
    //    var data = $tr.children("td").map(function(){
    //      return $(this).text();
    //    }).get();
    //     console.log(data);
    //   $('#account_id_de').val(data[0]);
    
     });
});


  $(document).ready(function() {                 
    $('.btnModActivate').on('click',function(){
      
      $('#modalActivate').modal('show');
      var accid = $(this).closest('tr').data('id');
      $('#account_id_ac').val(accid); 
     
      
      //   $tr = $(this).closest('tr');
      
      //  var data = $tr.children("td").map(function(){
      //    return $(this).text();
      //  }).get();
      //   console.log(data);
      // $('#account_id_ac').val(data[0]);
    });
  });

 
  $(document).ready(function() {
    $('#data tbody').on('click','.btnResearchInfo',function(){
        
        var research_id = $(this).closest('tr').data('id'); 
       
        
        $.ajax({
          dataType: "html",
          type: "POST",
          data: {research_id: research_id},
          success: function(data) {
            
            $('.bodyInfo').html(data);
           $('#modalResearchInfo').modal('show');
          
          },
          error: function(xhr, status, error) {
            alert('error');
            console.error(xhr);
          }
        });
      
    });
  
  });



      
  

  $(document).ready(function() {                 
    $('#data tbody').on('click','.btnUpdateResearch',function(){
    
      var update_id = $(this).closest('tr').data('id');
      $('#hiddenUpdate_id').val(update_id);
           
  
      $.ajax({
        dataType:'json',
        type: "POST",
        data: {update_id: update_id},
      
        success: function(data) {
         //alert(data.length);
           ///JSON.stringify(data);

         
           $('#title').val(data[1]);
           if( data[2] === "Capstone Project") {
             $('input:radio[name="radioCategory"]').filter('[value="Capstone Project"]').prop('checked', true);
           }
           if( data[2] === "Thesis"){
            $('input:radio[name="radioCategory"]').filter('[value="Thesis"]').prop('checked', true);
           }
           if( data[4] === "Ongoing") {
             
            $(".abstractUpdate").hide();
            $(".datePicker").hide();
            $('input:radio[name="radioStatus"]').filter('[value="Ongoing"]').prop('checked', true);
          }
          if( data[4] === "Completed"){
           $(".abstractUpdate").show();
           $(".datePicker").show();
           $('input:radio[name="radioStatus"]').filter('[value="Completed"]').prop('checked', true);
           
        
          }
          //  $('#abstractUpdate').val(data[3]);

           if(data.length == 20){
         
           $('#pro1').val(data[6]);
           $('#P1Mname').val(data[7]);
           $('#P1Lname').val(data[8]);
           $('#P2Fname').val(data[10]);
           $('#P2Mname').val(data[11]);
           $('#P2Lname').val(data[12]);
           $('#P3Fname').val(data[14]);
           $('#P3Mname').val(data[15]);
           $('#P3Lname').val(data[16]);
           
           $('#adviserUpdate option[value='+data[17]+']').prop('selected','selected');
           $('#panel1Update option[value='+data[18]+']').prop('selected','selected');
           $('#panel2Update option[value='+data[19]+']').prop('selected','selected');
           
           $('#hiddenUpdate_p1id').val(data[5]);
           $('#hiddenUpdate_p2id').val(data[9]);
           $('#hiddenUpdate_p3id').val(data[13]);
           $('#hiddenUpdate_pan1').val(data[18]);
           $('#hiddenUpdate_pan2').val(data[19]);
          }

          if (data.length == 16){

            $('#pro1').val(data[6]);
            $('#P1Mname').val(data[7]);
            $('#P1Lname').val(data[8]);
            $('#P2Fname').val(data[10]);
            $('#P2Mname').val(data[11]);
            $('#P2Lname').val(data[12]);  
            $('#P3Fname').val("");
            $('#P3Mname').val("");
            $('#P3Lname').val("");
           
           
            
            $('#adviserUpdate option[value='+data[13]+']').prop('selected','selected');
            $('#panel1Update option[value='+data[14]+']').prop('selected','selected');
            $('#panel2Update option[value='+data[15]+']').prop('selected','selected');
            
            $('#hiddenUpdate_p1id').val(data[5]);
            $('#hiddenUpdate_p2id').val(data[9]);
            $('#hiddenUpdate_pan1').val(data[14]);
            $('#hiddenUpdate_pan2').val(data[15]);

          }

          if (data.length == 12){

            $('#pro1').val(data[6]);
            $('#P1Mname').val(data[7]);
            $('#P1Lname').val(data[8]);
            $('#P2Fname').val("");
            $('#P2Mname').val("");
            $('#P2Lname').val("");  
            $('#P3Fname').val("");
            $('#P3Mname').val("");
            $('#P3Lname').val("");
           
           
           
            
            $('#adviserUpdate option[value='+data[9]+']').prop('selected','selected');
            $('#panel1Update option[value='+data[10]+']').prop('selected','selected');
            $('#panel2Update option[value='+data[11]+']').prop('selected','selected');
            
            $('#hiddenUpdate_p1id').val(data[5]);
            $('#hiddenUpdate_pan1').val(data[10]);
            $('#hiddenUpdate_pan2').val(data[11]);

          }
         
           
         $('#modalResearchUpdate').modal('show');
        },
        error: function(xhr, status, error) {
         
         alert(xhr.responseText);
          
        }
      });
      
     });
  });

  $(document).ready(function() {
    $('#data tbody').on('click','.btnResearch',function(){
        
        var research_id = $(this).closest('tr').data('id');
       
        
        $.ajax({
         
          type: "POST",
          data: {research_id: research_id},
          success: function(data) {
           // alert(data);
            $('.bodyInfo1').html(data);
            $('#modalResearchInfo1').modal('show');
          },
          error: function(xhr, status, error) {
            alert('error');
            console.error(xhr);
          }
        });
      
    });
  });


  $(document).ready(function() {
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  });




 
 
 
// function table( jQuery){
//     $('#data').DataTable( {
//       columnDefs: [
//       { orderable: false, targets: [1,2,3] },
//       { searchable: false, targets: 3 }
//       ]
      
//     });
// };
// $( document ).ready( table );


 
    


// < --- VANILLA JS --- >

// function showAlert(){
//     var  inputFeilds = document.querySelectorAll("input");

//     var validInputs = Array.from(inputFeilds).filter( input => input.value !== "");


//     if(validInputs.length >  1){
//     // swal("Success!","Accout Created!","success");
//     }
//     else {
//      // swal("Error!","Please Fill Up All Fields!","error");
//     }
//   }

function disableAccnts(){
    
    var y = document.getElementsByClassName("_accounts");
    var i;
    for (i = 0; i < y.length; i++){
        y[i].style.display="none";
    }
    var z = document.getElementsByClassName("btnEditFaculty");
    for (i = 0; i < z.length; i++){
      z[i].style.display="none";
  }

    // document.getElementById('user').innerHTML = "Research Coordinator";
    // document.getElementById('user').style.fontSize = "18px";

}

function checkPass()
{
    var message = document.getElementById('confirmMessage');
   
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    
    if(pass1.value == pass2.value){
       
        message.style.color = goodColor;
        message.innerHTML = "Password Match"
    }else{
       
        
        message.style.color = badColor;
        message.innerHTML = "Password Do Not Match!"
    }
};



$(document).ready(function() {
  var sel = $('#adviser');
  var selected = sel.val(); // cache selected value, before reordering
  var opts_list = sel.find('option');
  opts_list.sort(function(a, b) { return $(a).text() > $(b).text() ? 1 : -1; });
  sel.html('').append(opts_list);
  sel.val(selected); // set cached selected value


  var sel = $('#panel1');
  var selected = sel.val(); // cache selected value, before reordering
  var opts_list = sel.find('option');
  opts_list.sort(function(a, b) { return $(a).text() > $(b).text() ? 1 : -1; });
  sel.html('').append(opts_list);
  sel.val(selected); // set cached selected value


  var sel = $('#panel2');
  var selected = sel.val(); // cache selected value, before reordering
  var opts_list = sel.find('option');
  opts_list.sort(function(a, b) { return $(a).text() > $(b).text() ? 1 : -1; });
  sel.html('').append(opts_list);
  sel.val(selected); // set cached selected value
});


$(document).ready(function() {
  var sel = $('#adviserUpdate');
  var selected = sel.val(); // cache selected value, before reordering
  var opts_list = sel.find('option');
  opts_list.sort(function(a, b) { return $(a).text() > $(b).text() ? 1 : -1; });
  sel.html('').append(opts_list);
  sel.val(selected); // set cached selected value


  var sel = $('#panel1Update');
  var selected = sel.val(); // cache selected value, before reordering
  var opts_list = sel.find('option');
  opts_list.sort(function(a, b) { return $(a).text() > $(b).text() ? 1 : -1; });
  sel.html('').append(opts_list);
  sel.val(selected); // set cached selected value


  var sel = $('#panel2Update');
  var selected = sel.val(); // cache selected value, before reordering
  var opts_list = sel.find('option');
  opts_list.sort(function(a, b) { return $(a).text() > $(b).text() ? 1 : -1; });
  sel.html('').append(opts_list);
  sel.val(selected); // set cached selected value
});

$(document).ready(function(){
          

  var $modal = $('#modal');

  var image = document.getElementById('sample_image');

  var cropper;

  $('#upload_image').change(function(event){
    var files = event.target.files;

    var done = function(url){
      image.src = url;
      $modal.modal('show');
    };

    if(files && files.length > 0)
    {
      reader = new FileReader();
      reader.onload = function(event)
      {
        done(reader.result);
      };
      reader.readAsDataURL(files[0]);
    }
  });

  $modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
      aspectRatio: 1,
      viewMode: 3,
      preview:'.preview'
    });
  }).on('hidden.bs.modal', function(){
    cropper.destroy();
        cropper = null;
  });

  $('#crop').click(function(){
    canvas = cropper.getCroppedCanvas({
      width:400,
      height:400
    });

    canvas.toBlob(function(blob){
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onloadend = function(){
        var base64data = reader.result;
        $.ajax({
          
          method:'POST',
          data:{image:base64data},
          success:function(data)
          {
            $modal.modal('hide');
            $('.profile_image').attr('src', data);
          }
        });
      };
        });
        
  });
  
});



// MODAL EDIT SCRIPTS

  
$(document).ready(function() {

  $('#modalAbstract').on('show.bs.modal',function (){

           var abstract = $('#trAbstract').data('id');
           $('#abstractID').attr("src",abstract);
   });

});  


$(document).ready(function(){

 $('.removeFaculty').on('click',function (){

      var name = $(this).parent().siblings(":first").text();
      name = 'Remove '+name+' from the List?'
      $('#txtRemove').text(name);
       
      $('#modalRemove').modal('show');
      
      var faculty_id = $(this).closest('tr').data('id');
      
        $('#btnRemove').on('click',function (){
      
          $.ajax({

            type: "POST",
            data: {faculty_id:  faculty_id},
            success: function(data) {
             location.reload(true);
             // $('button[href="#pills-addResearch"]').click();
             
             // $('#modalRemove').modal('hide');
              //$('#list').DataTable().ajax.reload();
             //$('#modalEdit').modal('show');

            },
            error: function(xhr, status, error) {
             
              console.error(xhr);
            }
        });

       });

  });

});



$(document).ready(function(){

 $('#submitFaculty').on('click',function (e){


   let fname =  $('#facultyFname').val();
   let mname = $('#facultyMname').val();
   let lname =  $('#facultyLname').val();
   $.ajax({



     type: "POST",
     data: {facultyFname:  fname,
           facultyMname:  mname,
           facultyLname:  lname
     },
     success: function(data) {
         // $('#pills-tab').tabs({ active: 1});
         //e.preventdefault();
         //$('button[href="#pills-addResearch"]').click();
         // header("Location:  ../admin/research.php?error uploading file"); 
         // $('#modalAddFaculty').modal('hide');
         // $('#modalEdit').modal('show');
            // location.reload(true);
            // $('button[href="#pills-addResearch"]').click();
            // $('#modalAddFaculty').modal('hide');
            
            // $('#modalEdit').modal('hide');
             //$('#modalAddFaculty').modal('hide');
             //$('#list').DataTable().ajax.reload();
         location.reload(true);
     },
     error: function(xhr, status, error) {
       alert('error');
       console.error(xhr);
     }
   });

 });   

});


$(document).ready(function(){

 $(".updateFaculty").on("click",function(){
 
   let faculty_id = $(this).closest('tr').data('id');
  
   $.ajax({
     dataType: 'json',
     type: "POST",
     data: {facultyUp_id:  faculty_id},
     success: function(data) {
       if(data != null){
       $('#faculty_update').val(faculty_id);
       $('#facultyUpFname').val(data["fname"]);
       $('#facultyUpMname').val(data["mname"]);
       $('#facultyUpLname').val(data["lname"]);

       $('#modalUpdateFaculty').modal('show');
       //print(data);
      }
       //location.reload(true);
     },
     error: function(xhr, status, error) {
     
       console.error(xhr);
     }
     });


 });

 $(document).ready(function(){
   $('.submitUpFaculty').on('click',function(){
     
     let facultyUp_id = $('#faculty_update').val();
     let fname =  $('#facultyUpFname').val();
     let mname = $('#facultyUpMname').val();
     let lname = $('#facultyUpLname').val();
     

     $.ajax({

         type: "POST",
         data: {
               facultyUpID: facultyUp_id,
               facultyUpFname: fname,
               facultyUpMname:  mname,
               facultyUpLname:  lname
         },
         success: function(data) {
            
             location.reload(true);
         },
         error: function(xhr, status, error) {
          // alert('error');
           console.error(xhr);
         }
     });

   });   

 });


});



  


$(document).ready(function() {    
            
 $('#list').DataTable( {
   pageLength : 5,
   // lengthMenu: [[5, 10, 20, -1], [5,10,20]],
   lengthChange: false,
   ordering: false    
 });

 $("#radioCompleted").on("click",function(){
   $(".abstractUpdate").show();
   $(".datePicker").show();
 });

 $("#radiOngoing").on("click",function(){
   $(".abstractUpdate").hide();
   $(".datePicker").hide();
 });



 $("#radioCompleted2").on("click",function(){
   $(".abstract").show();
   $(".datePicker2").show();
 });

 $("#radiOngoing2").on("click",function(){
   $(".abstract").hide();
   $(".datePicker2").hide();
 });
});


