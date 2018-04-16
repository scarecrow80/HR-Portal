<?php include('../HR-Portal/DBconnections/dbconnection.php') ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>Login</title>
</head>

<body>
<center>

    <form method="post" action="">
        <?php echo display_error(); ?>
        <div class="tilsatt">
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div class="tilsatt">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="tilsatt">
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </div>
    </form>
</center>
</body>

