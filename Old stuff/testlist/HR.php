<?php
include('../DBconnections/dbconnection.php');
if (!HR()){
     $_SESSION['msg'] = "wrong logintype";
    session_destroy();
    unset($_SESSION['user']);
    header('location: ../testlist/homepage.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <h1>Welcome HR department</h1>
</head>
<body>
<a href="Lists.php">normal page</a><br>
<?php  if (isset($_SESSION['user'])) : ?>
    <strong><?php echo $_SESSION['user']['username']; ?></strong>

    <small>
        <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
        <br>
        <a href="logout.php" id="logout" style="color: red;">logout</a>

    </small>

<?php endif ?>
</body>
</html>
