<?php

function valider_firstname($firstname)
{
    if(!preg_match("/^[a-zA-ZøæåØÆÅ.\- ]{2,20}$/", $firstname))
    {
        echo '<script type="text/javascript">alert("Firstname can only have letters");</script>';
        echo "Firstname is wrong, use only letters. <br/>";
        return false;
    }
    return $firstname;
}

function valider_lastname($lastname)
{
    if(!preg_match("/^[a-zA-ZøæåØÆÅ.\- ]{2,20}$/", $lastname))
    {
        echo '<script type="text/javascript">alert("Lastname error contatning other than letters");</script>';
        echo "Lastname is wrong, use only letters. <br/>";
        return false;
    }
    return $lastname;
}

function valider_username($username)
{
    if(!preg_match("/^[a-zA-ZøæåØÆÅ0-9.\- ]{2,20}$/", $username))
    {
        echo '<script type="text/javascript">alert("USername ");</script>';
        echo "Username is not allowed. <br/>";
        return false;
    }
    return $username;
}

function valider_password($password)
{
    if(!preg_match("/^[a-zA-ZøæåØÆÅ0-9\-_]{2,20}$/", $password))
    {
        echo "Password not valid, please use a valid pattern. <br/>";
        return false;
    }
    return $password;
}

if (isset($_POST['createNewPoint'])) {
    pointlist();
}

//check if inputs are correct!
if (isset($_POST['register'])){
    $firstname = valider_firstname($_POST["firstname"]);
    $lastname = valider_lastname($_POST["lastname"]);
    $username = valider_username($_POST["username"]);
    $usertype= e($_POST['usertype']);
    $password = e($_POST["password"]);
    $repeatPassword = e($_POST['repeatPassword']);

    $query = "SELECT * FROM Users WHERE username = '$username' ";
    $usernameExist = mysqli_query($db, $query);

    if (empty($firstname)) {array_push($errors, "You need a firstname");}
    if (empty($lastname)) {array_push($errors, "write your lastname");}
    if (empty($username)) {array_push($errors, "write the username");}

    //Check that password and repeat is alike
    if ($password != $repeatPassword){
        echo "Password not valid";
    }
    //Check if username in use already
    else if (mysqli_num_rows($usernameExist) > 0){
        echo "Username already in use";
    }
    //add user and crypt the password in md5 encryption
    else{
        if (count($errors) == 0) {

            $password = md5($_POST['password']);
            $query = "INSERT INTO Users (firstname, lastname, username , usertype, password) 
                  VALUES('$firstname', '$lastname', '$username', '$usertype', '$password')";
            $result = $db->query($query);
            if (!$result) {
                echo '<script type="text/javascript">alert("Wrong in the script");</script>';

            } //elseif(mysqli_affected_rows($db) == 0){
            elseif ($db->affected_rows == 0) {
                echo '<script type="text/javascript">alert("User wasnt added, but the script worked");</script>';

            } else {
                echo '<script type="text/javascript">alert("User added");</script>';
            }
        }
    }
}

function pointlist()
{
    global $db, $errors;
    $newPointNo = e($_POST['newPointNo']);
    $newPointEn = e($_POST['newPointEn']);
    $userType = e($_POST['userType']);
    $nationality = e($_POST['nationality']);
    $leader = e($_POST['leader']);
    if (empty($newPointNo)) {
        echo '<script type="text/javascript">alert("Empty write something");</script>';
        array_push($errors, "You need to write something");
    }
    $ind_check = "SELECT checkpointsNO FROM Checklist WHERE checkpointsNO= '$newPointNo'";
    $result = $db->query($ind_check);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        echo '<script type="text/javascript">alert("Already a checkpoint");</script>';
        array_push($errors, "Checkpoint is already here");
    } else {
        if (count($errors) == 0) {
            $query = "INSERT INTO Checklist (checkpointsNO, checkpointsEN, responsible, nationality, leader)
                                VALUES ('$newPointNo', '$newPointEn', '$userType', '$nationality', '$leader' ) ";
            $res = mysqli_query($db, $query);
            if (!$res) {

            } elseif ($db->affected_rows == 0) {
                echo '<script type="text/javascript">alert("Something failed");</script>';
            } else {
                echo '<script type="text/javascript">alert("Point added");</script>';
            }
        }
    }
}

function selectPoint()
{
    global $db, $errors;
    $sql ="SELECT * FROM Checklist";
    $result = $db->query($sql);

    if (mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_assoc($result)){
            echo '<option value="'.$row["idChecklist"].'">'.$row["checkpointsNO"].' Ansvarlig:'.$row["responsible"].', Nasjonalitet:'.$row["nationality"].', Lederstilling:'.$row["leader"].'';
        }
    }
    else{
        echo "No connection to database or server";
    }
}

function changePoint()
{
    if(isset($_POST["selectPoint"]))
    {
        global $db, $errors;
        $checkpointId = e($_POST["checkpoint"]);
        $sql = "SELECT * FROM Checklist WHERE Checklist.idChecklist ='".$checkpointId."'";
        $result = $db->query($sql);

        $result2 = mysqli_fetch_assoc($result);
        $checkpointId = e($result2["idChecklist"]);
        $checkpointNO = e($result2["checkpointsNO"]);
        $checkpointEN = e($result2["checkpointsEN"]);
        $responsible = e($result2["responsible"]);
        $nationality = e($result2["nationality"]);
        $leader = e($result2["leader"]);

        echo "<form action='' method='post' ><table>";
        echo "<tr class='input-group'><td><label type='text' name='checkPointId' value='$checkpointId' readonly >".$checkpointId."</td></tr>";
        echo "<tr class='input-group'><td><textarea type='text' name='orgPointNO' id='$checkpointId' readonly >".$checkpointNO."</textarea></td><br></tr>";
        echo "<tr class='input-group'><td> <textarea type='text' name='newPointNO' id='$checkpointId' placeholder='Skriv inn nytt punkt på norsk her'></textarea></td></tr>";
        echo "<tr class='input-group'><td><textarea type='text' name='orgPointEN' id='$checkpointId' readonly >".$checkpointEN."</textarea></td><br></tr>";
        echo "<tr class ='input-group'><td><textarea type='text' name='newPointEN' id='$checkpointId' placeholder='Skriv inn nytt punkt på engelsk her'></textarea></td></tr>";
        echo "</table>";
        echo "<button type='submit' class='btn btn-primary' name='changingPoint'>Forandre</button>";
        echo "</form>";
    }

    if(isset($_POST["changingPoint"]))
    {
        global $db, $errors;
        $checkpointId2 = e($_POST["checkPointId"]);
        $newPointNO = e($_POST["newPointNO"]);
        $newPointEN = e($_POST["newPointEN"]);
        $orgPointNO = e($_POST["orgPointNO"]);
        $orgPointEN = e($_POST["orgPointEN"]);

        $sql = "UPDATE Checklist SET checkpointsNO = '$newPointNO', checkpointsEN = '$newPointEN' WHERE idChecklist = '$checkpointId2'";

        if ($newPointNO == $orgPointNO && $newPointEN == $orgPointEN){

            echo '<script type="text/javascript">alert("The new and original points are identical.");</script>';
        }

        elseif($newPointNO != $orgPointNO || $newPointEN != $orgPointEN){
            if(mysqli_query($db, $sql)){

                if(mysqli_affected_rows($db) > 0){

                    echo '<script type="text/javascript">alert("The checkpoint is altered");</script>';
                }
                else{

                    echo '<script type="text/javascript">alert("Something wrong happened");</script>';
                }
            }
            else{
                echo '<script type="text/javascript">alert("Something wrong happened  2");</script>';
            }

        }
        else{
            echo '<script type="text/javascript">alert("Something wrong happened  3");</script>';
        }
    }
}

function selectDeletePoint()
{
    echo "<tr><th>Valg</th>";
    echo "<th>Sjekkpunkt på norsk</th>";
    echo "<th>Sjekkpunkt på engelsk</th>";
    echo "<th>Ansvarlig</th>";
    echo "<th>Nasjonalitet</th>";
    echo "<th>Leder</th></tr>";

    global $db, $errors;
    $sql = "Select * FROM Checklist";
    $result = mysqli_query($db, $sql);

    if ($result) {

        while($row = mysqli_fetch_assoc($result)){
            $check_id = $row["idChecklist"];

            echo "<tr>";
            echo "<td><input type='radio' name='DeletePoint' value='$check_id'/></td>";
            echo "<td>".$row["checkpointsNO"]."</td>";
            echo "<td>".$row["checkpointsEN"]."</td>";
            echo "<td>".$row["responsible"]."</td>";
            echo "<td>".$row["nationality"]."</td>";
            echo "<td>".$row["leader"]."</td>";
            echo "</tr>";

        }echo "</table>";
    }
    else{
        echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
    }
}

function deletePoint()
{
    if(isset($_POST["Delete"])) {

        global $db, $errors;
        $checkpointId = e($_POST["DeletePoint"]);
        $sql = "DELETE FROM Checklist WHERE idChecklist = '".$checkpointId."'";
        $sql2 = "DELETE FROM Newemployee_has_Checklist WHERE Checklist_idChecklist = '".$checkpointId."'";

        $result2 = mysqli_query($db,$sql);
        $result3 = mysqli_query($db,$sql2);

        if(!$result2) {

            if(mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Delete worked");</script>';
            }
            else {
                echo '<script type="text/javascript">alert("Punktet eksiterer ikke");</script>';
            }
        }
        if(!$result3) {

            if(mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Skjekkpunktet er slettet");</script>';
            }
            else {
                echo '<script type="text/javascript">alert("Finner ikke slettepunktet");</script>';
            }
        }
    }

}

function searchForEmployee()
{
    if(isset($_POST["searchFor"]))
    {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForEmployee = e($_POST["searchForEmployee"]);
        $sql = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '".$searchForEmployee."%'  OR Newemployee.lastname LIKE '".$searchForEmployee."%'";
        $result = $db->query($sql);

        if ($result) {

            echo "<tr><th>Valg</th>";
            echo "<th>Fornavn</th>";
            echo "<th>Etternavn</th>";
            echo "<th>Arbeidstilling</th>";
            echo "<th>Internasjonal</th>";
            echo "<th>Startdato</th></tr>";

            while($row = mysqli_fetch_assoc($result)){

                $newEmployeeId = $row["idNewemployee"];

                echo "<tr>";
                echo "<td><input type='radio' name='DeleteEmployeeValue' value='$newEmployeeId'/></td>";
                echo "<td>".$row["firstname"]."</td>";
                echo "<td>".$row["lastname"]."</td>";
                echo "<td>".$row["workposition"]."</td>";
                echo "<td>".$row["international"]."</td>";
                echo "<td>".$row["startdate"]."</td>";
                echo "</tr>";

            }echo "</table><button type='submit' class='btn btn-primary' name='DeleteEmployee' >Slett ansatt</button></form>";

        }
        else{
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }
}

function deleteEmployee()
{
    if(isset($_POST["DeleteEmployee"])) {

        global $db, $errors;
        $idNewemployee2 = e($_POST["DeleteEmployeeValue"]);

        $sql = "DELETE FROM Newemployee WHERE idNewemployee = '".$idNewemployee2."'";
        $sql2 = "DELETE FROM Newemployee_has_Checklist WHERE Newemployee_idNewemployee = '".$idNewemployee2."'";
        $sql3 = "DELETE FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '".$idNewemployee2."'";

        $result3 = mysqli_query($db,$sql2);
        $result4 = mysqli_query($db,$sql3);
        $result2 = mysqli_query($db,$sql);

        if(!$result2) {

            if(mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Newemployee er slettet");</script>';
            }
            else {
                echo '<script type="text/javascript">alert("Finner ikke Newemployee");</script>';
            }
        }
        if(!$result3) {

            if(mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Newemployee_has_Checklist er slettet");</script>';
            }
            else {
                echo '<script type="text/javascript">alert("Finner ikke Newemployee_has_Checklist");</script>';
            }
        }
        if(!$result4) {

            if(mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Users_has_Newemployee er slettet");</script>';
            }
            else {
                echo '<script type="text/javascript">alert("Finner ikke Users_has_Newemployee");</script>';
            }
        }
    }
}

function searchForUser()
{
    if(isset($_POST["searchForUser"]))
    {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForUser = e($_POST["userSearch"]);
        $sql = "SELECT * FROM Users WHERE Users.firstname LIKE '".$searchForUser."%'  OR Users.lastname LIKE '".$searchForUser."%'";
        $result = $db->query($sql);

        echo $sql;

        if ($result) {

            echo "<tr><th>Valg</th>";
            echo "<th>Fornavn</th>";
            echo "<th>Etternavn</th>";
            echo "<th>Brukernavn</th>";
            echo "<th>Brukertype</th></tr>";

            while($row = mysqli_fetch_assoc($result)){

                $newUserId = $row["idUsers"];

                echo "<tr>";
                echo "<td><input type='radio' name='DeleteUserValue' value='$newUserId'/></td>";
                echo "<td>".$row["firstname"]."</td>";
                echo "<td>".$row["lastname"]."</td>";
                echo "<td>".$row["username"]."</td>";
                echo "<td>".$row["usertype"]."</td>";
                echo "</tr>";

            }echo "</table><button type='submit' class='btn btn-primary' name='DeleteUser' >Slett bruker</button></form>";

        }
        else{
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }
}

function deleteUser()
{
    if(isset($_POST["DeleteUser"])) {

        global $db, $errors;
        $idUsers2 = e($_POST["DeleteUserValue"]);

        $sql = "DELETE FROM Users WHERE idUsers = '".$idUsers2."'";
        $sql2 = "DELETE FROM Users_has_Newemployee WHERE Users_idUsers = '".$idUsers2."'";

        echo $sql."<br>".$sql2;

        $result3 = mysqli_query($db,$sql2);
        $result2 = mysqli_query($db,$sql);

        if(!$result2) {

            if(mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("User er slettet");</script>';
            }
            else {
                echo '<script type="text/javascript">alert("Finner ikke User");</script>';
            }
        }
        if(!$result3) {

            if(mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Users_has_Newemployee er slettet");</script>';
            }
            else {
                echo '<script type="text/javascript">alert("Finner ikke Users_has_Newemployee");</script>';
            }
        }
    }
}