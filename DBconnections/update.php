<?php
include "dbconnection.php";

$usertype = $_SESSION['user']['usertype'];

if(!isset($_POST['formList'])){
    if($usertype == "leader"){
        echo "<script type=\"text/javascript\">alert('En må velge en sjekkboks');</script>";
        header('location: ../Usersites/leader/leader_owntasks.php');
    } elseif ($usertype == "HR"){
        echo "<script type=\"text/javascript\">alert('En må velge en sjekkboks');</script>";
        header('location: ../Usersites/HR/hr_owntasks.php');

    }elseif($usertype == "mentor"){
        echo "<script type=\"text/javascript\">alert('En må velge en sjekkboks');</script>";
        header('location: ../Usersites/mentor/mentor_overview.php');
    } else {
        echo "<script type=\"text/javascript\">alert('En kritisk feil!');</script>";
        header('location: ../index.php');
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
        header('location: ../Usersites/mentor/mentor_overview.php');
    } else {
        echo "<script>alert('En kritisk feil skjedde! Du blir sendt tilbake til innlogging')</script>";
        header('location: ../../index.php');
    }

}

function update(){
    $db =  mysqli_connect('student.cs.hioa.no', 's236619', '', 's236619');
    if(!$db){
        die("Feil i databasetilkobling:".$db->connect_error);
    }

    $count  = count($alist);
    $alist = $_POST['formList'];

    for($i=0; $i < $count; $i++) {
            $exp = explode(" ", $alist[$i]);
            $checked = $exp[0];
            $emp = $exp[1];
            $checkid = $exp[2];

            settype($emp, "string");
            settype($checkid, "string");
            settype($checked, "string");

            echo "Checked = " . $checked . "<br/>";
            echo " Employee id = " . $emp . "<br/>";
            echo "Checked id = " . $checkid . "<br/><br/>";
            if ($checked == 0) {
                $query = "UPDATE Newemployee_has_Checklist SET checked = 1 WHERE Newemployee_idNewemployee = '$emp' AND Checklist_idChecklist ='$checkid'";
                $result = mysqli_query($db, $query);

                if (!$result) {
                    echo '<script type="text/javascript">alert("Tomt Resultat");</script>';
                } else {
                    echo '<script type="text/javascript">alert("Den gikk igjennom");</script>';
                }
            } else {
                if ($checked == 1) {
                    $query = "UPDATE Newemployee_has_Checklist SET checked = 0 WHERE Newemployee_idNewemployee = '$emp' AND Checklist_idChecklist ='$checkid'";
                    $result = mysqli_query($db, $query);
                }
            }
        }
}

