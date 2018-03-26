
<?php include('dbconnection.php') ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Registration system PHP and MySQL</title>
</head>
<script type="text/javascript">

</script>
<body>
<div class="header">
    <h2>Register</h2>
</div>
<?php
/**
 * Created by PhpStorm.
 * User: Generel Seem
 * Date: 21.03.2018
 * Time: 13:16
 */?>
<form method="post" action="register.php">

    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
    </div>
    <select name="user_type"
    <label>User type</label>
    <option value=""></option>
    <option value="fadder">Fadder</option>
    <option value="admin">Admin</option>
    <option value="HR">HR</option>
    <option value="leder">Leder</option>
    </select>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password_first">
    </div>
    <div class="input-group">
        <label>Confirm password</label>
        <input type="password" name="confirm_password">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="register">Register</button>
    </div>

</form>
</body>
</html>
