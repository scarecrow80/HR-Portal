<?php
include('../DBconnections/dbconnection.php');
if (!admin()){
    $_SESSION['msg'] = "You have to log in as admin";
    session_destroy();
    unset($_SESSION['user']);
    header('location: ../testlist/homepage.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <style>
        .header {
            background: #003366;
        }
        button[name=register_btn] {
            background: #003366;
        }
    </style>
</head>
<body>
<div class="header">
    <h2>Admin - Home Page</h2>
</div>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <a href="register.php">Register people</a><br>
    <a href="HR.php">HR</a><br>
    <a href="Lists.php">normal page</a><br>
    <!-- logged in user information -->
    <br>
    <a href="Edituser.php">Edit a user</a><br>
    <a href="delete.php">Delete a user</a><br>
    <?php  if (isset($_SESSION['user'])) : ?>
        <strong><?php echo $_SESSION['user']['username']; ?></strong>

        <small>
            <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
            <br>
            <a href="logout.php" id="logout" style="color: red;">logout</a>

        </small>

    <?php endif ?>

</div>
</body>
</html>
