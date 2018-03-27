<?php
include ("../DBconnections/dbconnection.php");
if (!isLoggedIN()){
    $_SESSION['msg'] = "you must be logged in to enter";
    header( 'location: ../testlist/homepage.php');
}
?>

<!DOCTYPE html>
<head xmlns="http://www.w3.org/1999/html">

</head>
<body>
<form action="" method="get">
<label for>Username</label>
    <input type="text" name="username"value="<?php echo $username; ?>"</input><br>

    <input type="submit" class="btn" name="search" id="search">search for a User</input>
</form>
</body>