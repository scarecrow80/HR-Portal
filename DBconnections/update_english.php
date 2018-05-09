<?php
include "dbconnection.php";

$usertype = $_SESSION['user']['usertype'];

if(!isset($_POST['formList'])){
    if($usertype == "leader"){
        echo "<script type=\"text/javascript\">alert('You have to pick a checkbox to checkout');</script>";
        header('location: ../Usersites/leader/leader_owntasks.php');
    } elseif ($usertype == "HR"){
        echo "<script type=\"text/javascript\">alert('You have to pick a checkbox to checkout');</script>";
        header('location: ../Usersites/HR/hr_owntasks.php');

    }elseif($usertype == "mentor"){
        echo "<script type=\"text/javascript\">alert('You have to pick a checkbox to checkout');</script>";
        header('location: ../Usersites/mentor/mentor_overvieweng.php');
    } else {
        echo "<script>alert('A critical error was detected. Returning to login site')</script>";
        header('location: ../DBconnections/logout.php');
    }
} else {
    if($usertype == "leader"){
        update();
        header('location: ../Usersites/leader/leader_owntasks.php');
    } elseif ($usertype == "HR"){
        update();
        header('location: ../Usersites/HR/hr_owntasks.php');

    }elseif($usertype == "mentor" ){
        update();
        header('location: ../Usersites/mentor/mentor_overvieweng.php');
    } else {
        echo "<script>alert('A critical error was detected. Returning to login site')</script>";
        header('location: ../DBconnections/logout.php');
    }

}

function update(){
  global $db;


    $alist = $_POST['formList'];
    $count  = count($alist);

    for($i=0; $i < $count; $i++) {
        $exp = explode(" ", $alist[$i]);
        $checked = $exp[0];
        $emp = $exp[1];
        $checkid = $exp[2];

        settype($emp, "string");
        settype($checkid, "string");
        settype($checked, "string");

        echo "Checked = " . $checked . "<br/>";
        echo "Employee id = " . $emp . "<br/>";
        echo "Checked id = " . $checkid . "<br/><br/>";
        if ($checked == 0) {
            $query = "UPDATE Newemployee_has_Checklist SET checked = 1 WHERE Newemployee_idNewemployee = '$emp' AND Checklist_idChecklist ='$checkid'";
            $result = mysqli_query($db, $query);

            if (!$result) {
                Echo "<script type=\"text/javascript\">alert('It is empty!');</script>";
            } else {
                //echo "<script type=\"text/javascript\">alert('Den gikk igjennom!');</script>";
            }
        } else {
            if ($checked == 1) {
                $query = "UPDATE Newemployee_has_Checklist SET checked = 0 WHERE Newemployee_idNewemployee = '$emp' AND Checklist_idChecklist ='$checkid'";
                $result = mysqli_query($db, $query);
            }
        }
    }
}