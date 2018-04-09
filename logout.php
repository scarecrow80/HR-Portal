<?php
include('../HR-Portal/DBconnections/dbconnection.php');
if (logO()){
    $_SESSION['msg'] = "Logged out";
    session_destroy();
    unset($_SESSION['user']);
    header( 'location: ../HR-Portal/index.php');

}