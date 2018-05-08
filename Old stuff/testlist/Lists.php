<?php include('../DBconnections/dbconnection.php');
if (!isLoggedIN()){
    $_SESSION['msg'] = "you must be logged in to enter";
    header( 'location: ../testlist/homepage.php');
}
if (fadder()){
    $_SESSION['msg'] = "No access";
    session_destroy();
    unset($_SESSION['user']);
    header('location: ../testlist/homepage.php');

}
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>You are logged in</title>
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

<div class="dropdown">
    <button onclick="dropfunc()" class="dropbtn">Persons</button>
    <div id="recruits" class="dropdown-content">
        <a href="http://localhost:63342/HR-Portal/testlist/Karl.php">Karls list</a>
        <a href="http://localhost:63342/HR-Portal/testlist/Lena.php">Lenas list</a>
        <a href="http://localhost:63342/HR-Portal/testlist/Keith.php">Keiths list</a>
    </div>
</div><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
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
    <!-- logged in user information -->

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
<script>
    function dropfunc() {
        document.getElementById("recruits").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {

            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>