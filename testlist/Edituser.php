<?php include('../DBconnections/dbconnection.php');
if (!admin()) {
    $_SESSION['msg'] = "You have to log in as admin";
    session_destroy();
    unset($_SESSION['user']);
    header('location: ../testlist/homepage.php');
}

?>
<!DOCTYPE html>
<head>

</head>
<body>
<form action="" method="post">

        <label for>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>"><br>
    <div class="input-group">
        <label>Old Password</label>
        <input type="password" name="original_password">
    </div>
    <div class="input-group">
        <label>New password</label>
        <input type="password" name="new_password">
        <div class="input-group">
            <button type="submit" class="btn" name="edit" id="edit">change password</button>
        </div>
    </div>
<form action="" method="post"><br><br>

    <label for>Username</label>
    <input type="text" name="username" value="<?php echo $username; ?>"><br>
    <select name="user_type"
    <label>User type</label>
    <option value=""></option>
    <option value="fadder">Fadder</option>
    <option value="admin">Admin</option>
    <option value="HR">HR</option>
    <option value="leder">Leder</option>
    </select>
    <button type="submit" class="btn" name="type_edit" id="type_edit">change user type</button>
</form>

</form>

</body>
</html>
