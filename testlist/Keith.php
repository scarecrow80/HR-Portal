<?php include('dbconnection.php');
if (!isLoggedIN()){
    $_SESSION['msg'] = "you must be logged in to enter";
    header( 'location: ../testlist/homepage.php');
}
if (isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['user']);
    header("location../testlist/homepage.php");
}
?>
<html>
<head>
    <title>Karl</title>


</head>
<body>
<?php
//connect to database to get the core info of the selected new employer

$db = mysqli_connect("localhost", "root", "", "personer");
if(!$db){
    die("Feil i databasetilkobling:".$db->connect_error);
}
$query = "select * from dine_nyansatte where Fornavn = 'Keith'";
$result = $db->query($query);
if(!$result){
    echo "viewing failed";
}
else{
    while ($row = $result->fetch_object()){
        echo "<li>".$row->Fornavn. " ".$row->Etternavn." in ".$row->Avdeling." working as ".$row->Ansatttype."</li>";
    }
}

//link to the full checklist for that person
?>
<a href="">Checklist for Keith</a><br>
<a href="Lists.php">Tilbake til listen</a><br>
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
