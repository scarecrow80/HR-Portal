<?php
include('dbconnection.php');

//Sjekker opp mot logout funksjonen i dbconnection.php. Om den får true fra den logger den ut brukeren, fjerner denne session og sender dem til innlogging siden.
if (logOut()){
    $_SESSION['msg'] = "Logged out";
    session_destroy();
    unset($_SESSION['user']);
    header( 'location: ../../HR-Portal/index.php');

}