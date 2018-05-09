<?php
$db =  mysqli_connect('student.cs.hioa.no', 's236619', '', 's236619');
if(!$db){
    die("Feil i databasetilkobling:".$db->connect_error);
}

if(!isset($_POST['formList'])){
    echo '<script type="text/javascript">alert("Tom Form");</script>';

    header('location: ../Usersites/HR/hr_owntasks.php');
} else {
    $alist = $_POST['formList'];


        $count  = count($alist);

        echo ("Du valgte $count bokser<br/>");
        for($i=0; $i < $count; $i++) {
            //echo($alist[$i]."<br/>");
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
                if ($checked == 2) {
                    $query = "UPDATE Newemployee_has_Checklist SET checked = 0 WHERE Newemployee_idNewemployee = '$emp' AND Checklist_idChecklist ='$checkid'";
                    $result = mysqli_query($db, $query);
                }

            }

        }header('location: ../Usersites/HR/hr_owntasks.php');
}
