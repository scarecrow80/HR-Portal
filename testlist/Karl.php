<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>Karl</title>


</head>
<body>
<br>test</br>
//connect to database to get the core info of the selected new employer
<?php
$db = mysqli_connect("localhost", "root", "", "personer");
if(!$db){
    die("Feil i databasetilkobling:".$db->connect_error);
}
$query = "select * from dine_nyansatte where Fornavn = 'Karl'";
$result = $db->query($query);
if(!$result){
    echo "viewing failed";
}
else{
    while ($row = $result->fetch_object()){
        echo "<li>".$row->Fornavn. " ".$row->Etternavn." in ".$row->Avdeling." working as ".$row->Ansatttype."</li>";
    }
}
?>
//link to the full checklist for that person
<a href="">Checklist for Karl</a>
</body>
</html>
