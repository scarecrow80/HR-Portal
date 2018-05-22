<?php
include('../../DBconnections/dbconnection.php');
include('../../DBconnections/adminController.php');
include('../../DBconnections/commonController.php');
if (!admin()){
    $_SESSION['msg'] = "You have to log in as admin";
    session_destroy();
    unset($_SESSION['user']);
    header('location: ../../index.php');
}
