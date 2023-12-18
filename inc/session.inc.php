<?php

session_start();

function pathTO() {

    echo  "<script>window.location.href = '/DSTS/pages/$destination.php'</script>";
}

if ($_SESSION['status'] == 'invalid' || empty($_SESSION['status'])) {

    $_SESSION['status'] = 'invalid';

    unset($_SESSION['username']);

    pathTo('login');

}