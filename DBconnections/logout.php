<?php
include('dbconnection.php');
if (logOut()){
    $_SESSION['msg'] = "Logged out";
    session_destroy();
    unset($_SESSION['user']);
    header( 'location: ../../HR-Portal/index.php');

}