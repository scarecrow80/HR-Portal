<?php
include('../testlist/dbconnection.php');
if (logO()){
    $_SESSION['msg'] = "Logged out";
    session_destroy();
    unset($_SESSION['user']);
    header( 'location: ../testlist/homepage.php');

}