<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>Du er logget inn</title>
    <style>
        .dropbtn {
            background-color: #3498DB;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: #2980B9;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {background-color: #ddd}

        .show {display:block;}
    </style>
</head>

<body>
<?php
/*$db = mysqli_connect("localhost", "root", "", "personer");
    if(!$db) {
        die("feil i koblingen:".$db->connect_error);
        }
    $query = "select Fornavn from dine_nyansatte";
    $result = $db->query($query);
    if(!$result){
        echo "viweing failed";
    }
    else{
        while  ($row = $result->fetch_object()){
            echo "<li>".$row->Fornavn."</li>";

        }
    }*/
?>
<div class="dropdown">
    <button onclick="dropFunc()" class="dropbtn">Personer</button>
    <div id ="dropLink" class="dropdown-content">
        <a href="http://localhost:63342/testlist/Karl.php">Karls list</a>
        <a href="http://localhost:63342/testlist/Lena.php">Lenas list</a>
        <a href="http://localhost:63342/testlist/Keiths.php">Keiths list</a>
    </div>
</div>
<script>
    function dropFunc() {
        document.getElementById("dropLink").classList.toggle("show");
    }
      /*  window.onclick = function (event){
            if (!event.target.matches('.dropbtn')){
                var down = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < down.length; i++){
                var opendrop = down[i];
                if (opendrop.classList.contains('show')){
                    down.classList.remove('show');
                }
            }

            }
        }*/

</script>

</body>
