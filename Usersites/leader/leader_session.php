<?php
include('../../DBconnections/dbconnection.php');
include('../../DBconnections/leaderController.php');
include('../../DBconnections/commonController.php');

if (!leader()){
    $_SESSION['msg'] = "You have to log in as leader";
    session_destroy();
    unset($_SESSION['user']);
    header('location: ../../index.php');
}
