<?php
include('../../DBconnections/dbconnection.php');
include('../../DBconnections/hrController.php');
include('../../DBconnections/commonController.php');
if (!HR()){
    $_SESSION['msg'] = "You have to log in as one from hr the department ";
    session_destroy();
    unset($_SESSION['user']);
    header('location: ../../index.php');
}
