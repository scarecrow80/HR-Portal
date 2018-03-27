<?php
include ('../DBconnections/dbconnection.php');
if (!admin()) {
    $_SESSION['msg'] = "You have to log in as admin";
    session_destroy();
    unset($_SESSION['user']);
    header('location: ../testlist/homepage.php');
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
</head>
<body>
<form action="" method="post">

    <label for>Username</label>
    <input type="text" name="username" value="<?php echo $username; ?>"><br>

    <input type="submit" class="btn" name="Usern" id="Usern">Delete User</input>

</form>
</body>
