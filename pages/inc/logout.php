<?php 
  session_start();
  
    $_SESSION['status'] =  'invalid';
    unset($_SESSION['account_type']);
    unset($_SESSION['error']);
    unset($_SESSION['account_id']);
    session_destroy();
   
    
    echo  "<script>window.location.href = '/DSTS/pages/login2.php'</script>";
   
?>