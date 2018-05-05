
<?php
//All connection to DB here
//register here
session_start();
$username ="";
$errors = array();
$db = mysqli_connect('student.cs.hioa.no', 's236619', '', 's236619');
//$db = mysqli_connect( 'localhost', 'root',  '', 'db_hr_portal');

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

if (isset($_POST['createCheckList'])) {
    $firstname = e($_POST['firstname']);
    $lastname = e($_POST['lastname']);
    $workposition = e($_POST['workposition']);
    $international = e($_POST['international']);
    $startdate = e($_POST['startdate']);
    //$id = $_SESSION['user'];
    // $queryias ="SELECT Firstname from Users WHERE idUsers = '$id';
    //$resalt=  $DB->$query("$queryas");
    // if  and if not sentences
    //    while ($row = mysqli_fetch_assoc($resalt))
    // $ans = $row['Firstname'];
    //insert nede ansvarlig value $ans
    if (empty($firstname)) {
        array_push($errors, "You need a firstname");
    }
    if (empty($lastname)) {
        array_push($errors, "write your lastname");
    }
    if (empty($workposition)) {
        array_push($errors, "write the workposition");
    }

    if (count($errors) == 0) {


        $query = "INSERT INTO Newemployee (firstname, lastname, workposition , international, startdate) 
  			  VALUES('$firstname', '$lastname', '$workposition', '$international', '$startdate')";
        $result = $db->query($query);
        $result2 = "SELECT * FROM Checklist";


        if (!$result) {
            echo "Wrong in the script";
        } elseif ($db->affected_rows == 0) {
            echo "The script worked, but the user wasn't added";
        } elseif ($db->affected_rows > 0) {
            $i = 0;
            if ($workposition == "Ansatt" && $international == "Nei") {

                $idNewemployee = $db->insert_id;
                $query = "SELECT idChecklist FROM Checklist WHERE nationality = 'Norsk' AND leader = 'Nei' ";
                $res = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($res);

                while ($row = mysqli_fetch_assoc($res)) {
                    $checkId = $row['idChecklist'];
                    $query2 = "INSERT INTO Newemployee_has_Checklist (Newemployee_idNewemployee, Checklist_idChecklist, checked) VALUES ($idNewemployee, $checkId, 0)";

                    $res2 = mysqli_query($db, $query2);

                    if (!$res2) {

                        echo '<script type="text/javascript">alert("Wrong in the script");</script>';

                    } elseif ($db->affected_rows == 0) {
                        echo '<script type="text/javascript">alert("The list wasnt added, but the script worked");</script>';

                    } else {
                        if ($i == ($num_rows - 1)) {
                            echo '<script type="text/javascript">alert("This worked as a normal ansatt");</script>';
                        }
                        $i++;
                    }
                }
            }
            elseif ($workposition == "Ansatt" && $international == "Ja") {

                $idNewemployee = $db->insert_id;
                $query = "SELECT idChecklist FROM Checklist WHERE leader = 'Nei' ";
                $res = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($res);

                while ($row = mysqli_fetch_assoc($res)) {
                    $checkId = $row['idChecklist'];
                    $query2 = "INSERT INTO Newemployee_has_Checklist (Newemployee_idNewemployee, Checklist_idChecklist, checked) VALUES ($idNewemployee, $checkId, 0)";

                    $res2 = mysqli_query($db, $query2);

                    if (!$res2) {
                        echo $query2;
                        echo '<script type="text/javascript">alert("Another wrong in the script");</script>';
                    } elseif ($db->affected_rows == 0) {
                        echo '<script type="text/javascript">alert("List wasnt added, but the script worked");</script>';
                    } else {
                        if ( $i == ( $num_rows - 1 ) ) {
                            echo '<script type="text/javascript">alert("An international worker was addded");</script>';
                        }

                    }
               $i++; }
            } elseif ($workposition == "Leder" && $international == "Nei") {

                $idNewemployee = $db->insert_id;
                $query = "SELECT idChecklist FROM Checklist WHERE nationality = 'Norsk'";
                $res = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($res);

                while ($row = mysqli_fetch_assoc($res)) {
                    $checkId = $row['idChecklist'];
                    $query2 = "INSERT INTO Newemployee_has_Checklist (Newemployee_idNewemployee, Checklist_idChecklist, checked) VALUES ($idNewemployee, $checkId, 0)";

                    $res2 = mysqli_query($db, $query2);

                    if (!$res2) {
                        echo $query2;
                        echo '<script type="text/javascript">alert("Script wrong");</script>';
                    } elseif ($db->affected_rows == 0) {
                        echo '<script type="text/javascript">alert("The list wasnt added, but the script worked");</script>';
                    } else {
                        if ( $i == ( $num_rows - 1 ) ) {
                            echo '<script type="text/javascript">alert("A norwegian leader was added");</script>';
                        }
                    }
               $i++; }
            } elseif ($workposition == "Leder" && $international == "Ja") {

                $idNewemployee = $db->insert_id;
                $query = "SELECT idChecklist FROM Checklist ";
                $res = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($res);


                while ($row = mysqli_fetch_assoc($res)) {
                    $checkId = $row['idChecklist'];
                    $query2 = "INSERT INTO Newemployee_has_Checklist (Newemployee_idNewemployee, Checklist_idChecklist, checked) VALUES ($idNewemployee, $checkId, 0)";

                    $res2 = mysqli_query($db, $query2);

                    if (!$res2) {
                        echo $query2;
                        echo '<script type="text/javascript">alert("Something wrong");</script>';
                    } elseif ($db->affected_rows == 0) {
                        echo '<script type="text/javascript">alert("List wasnt added, but the script worked");</script>';
                    } else {
                        if ($i == ($num_rows - 1)) {
                            echo '<script type="text/javascript">alert("International leader added");</script>';
                        }
                    }

            $i++;    }
            }
        }
    }
}
//login
    if (isset($_POST["login"])) {
        login();
    }

//login function
    function login()
    {
        global $db, $username, $errors;
        //get values
        $username = e($_POST['username']);
        $password = e($_POST['password']);

        // make sure form is filled properly
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
        //attempt login if no errors found. Password needs to be encrypted again
        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM Users WHERE username='$username' AND password='$password' LIMIT 1";
            $result = $db->query($query);

            if ($db->affected_rows == 1) {

                $logged_in_user = mysqli_fetch_assoc(($result));
                if ($logged_in_user['usertype'] == 'admin') {
                    $_SESSION['user'] = $logged_in_user;
                    $_SESSION['success'] = "Logged in";
                    header('location: ../HR-Portal/admin.php');
                } else if ($logged_in_user['usertype'] == 'leader') {
                    $_SESSION['user'] = $logged_in_user;
                    $_SESSION['success'] = "Logged in getting you to list";
                    header('location: ../Hr-Portal/leader.php');
                } else if ($logged_in_user['usertype'] == 'mentor') {
                    $_SESSION['user'] = $logged_in_user['username'];
                    $_SESSION['success'] = "Logged in getting you to list";
                    header('location: ../HR-Portal/mentor.php');
                } else {
                    $_SESSION['user'] = $logged_in_user;
                    $_SESSION['success'] = "Logged in getting you to list";
                    header('location: ../HR-Portal/hrDepartment.php');
                }

            } else {
                array_push($errors, "Wrong credentials");
                header('location: ../HR-Portal/index.php');
            }


        }

    }

    if (isset($_POST["del"])) {
        deletechecklist();
    }
//delete user
    function deletechecklist()
    {/*
        global $db, $username, $errors;
        //get values
        $firstname = e($_POST['firstname']);

        if (empty($firstname)) {
            array_push($errors, "You need a firstname");
        }
        // make sure form is filled properly


        $name_check = "SELECT firstname FROM Newemployee WHERE firstname= '$firstname'";
        $result = $db->query($name_check);
        $in = mysqli_fetch_assoc($result);
        if (!$in) {
            echo '<script type="text/javascript">alert("Not a name");</script>';
            array_push($errors, "Not a user");
        } else {
            if (count($errors) == 0) {
                $idquery = "SELECT idNewemployee FROM Newemployee WHERE firstname = '$firstname'";
                $resultid = $db->query($idquery);
                if (!$resultid) {
                    echo '<script type="text/javascript">alert("Not correct Id");</script>';
                } else {
                    while ($row = mysqli_fetch_assoc($resultid)) {
                        $id5 = $row['idNewemployee'];
                        $query = "DELETE FROM Newemployee_has_Checklist WHERE Newemployee_idNewemployee = '$id5' ";


                        echo $query; echo "<br> <br />";

                        if ($db->query($query) === TRUE ) {
                            $dquery = "DELETE FROM Newemployee WHERE idNewemployee = '$id5'";
                            if ($db->query($dquery) === TRUE) {
                                echo '<script type="text/javascript">alert("Delete successfull");</script>';
                            } else {
                                echo '<script type="text/javascript">alert("Dquery is faulty");</script>';
                            }

                        }
                        else {
                                echo '<script type="text/javascript">alert("Delete failed");</script>';
                        }

                    }

                    }
                }
            }*/

    }

//making sure you only enter if logged in
    function isLoggedIN()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

//making sure only admin enter admin
    function admin()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }

//leader check on login
    function leader()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'admin') {
            return true;
        } elseif (isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'leader') {
            return true;
        } else {
            return false;
        }
    }

//fadder cant login to some place
    function fadder()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'fadder') {
            return true;
        } else {
            return false;
        }
    }

//HR and admin can get to hr
    function HR()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'admin') {
            return true;
        } elseif (isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'HR') {
            return true;
        } else {
            return false;
        }
    }

//logout function on logout.php
    function logO()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }
        return true;
    }

//if use the edit form go to editpass function
    if (isset($_POST["edit"])) {
        editpass();
    }


//if use typeedit form got to edittype function
    if (isset($_POST["type_edit"])) {
        edittype();
    }
    if (isset($_GET['search'])) {
        searchuser();
    }

    if (isset($_POST['Updatemen'])) {
        updatementor();
    }
    if (isset($_POST['Edilis'])) {
        Edlist();
    } elseif (isset($_POST['Nypunkt'])) {
        pointlist();
    } elseif (isset($_POST['Deletent'])) {
        Dellist();
    }
    if (isset($_POST['Assign'])) {
        addmentor();
    }

//edit a usertype
    function edittype()
    {
        global $db, $username, $errors;
        $username = e($_POST['username']);
        $user_type = e($_POST['user_type']);
        $user_check = "SELECT username FROM Users WHERE username= '$username'";
        $result = $db->query($user_check);
        $user = mysqli_fetch_assoc($result);
        if (!$user) {
            echo '<script type="text/javascript">alert("Not a user");</script>';
            array_push($errors, "Not a user");
        } else {

            if (count($errors) == 0) {
                $query = "UPDATE Users SET usertype = '$user_type' WHERE username='$username'";
                $result = $db->query($query);
                $chck = mysqli_fetch_assoc($result);
                if (!$chck) {
                    echo '<script type="text/javascript">alert("Script is wrong");</script>';
                } else {
                    echo '<script type="text/javascript">alert("Usertype edit worked");</script>';
                }
            }

        }

    }
    function ment()
    {
        global $db;
        $query = mysqli_query($db, "SELECT firstname FROM Users where usertype= 'mentor'") or die(mysqli_error());
        echo "<select name=\"mentor\" class=\"field comment-alerts\">";

        while ($row = $query->fetch_assoc()) {

            unset($name);
            $name = $row['firstname'];

            echo "<option value ='" . $name . "'>" . $name . "</option>";

        }
    }
function emp()
{
    global  $db;
    $query = mysqli_query($db, "SELECT firstname FROM Newemployee") or die(mysqli_error());
    echo "<select name=\"empname\" class=\"field comment-alerts\">";

    while ($row = $query->fetch_assoc()){

        unset($name);
        $name = $row['firstname'];

        echo  "<option value ='".$name."'>".$name."</option>";

    }
    echo  "</select>";


}
//Update mentor
    function updatementor()
    {
        global $db, $errors;
        $employee = e($_POST['empname']);
        $mentor = e($_POST['mentor']);
        $user_check = "SELECT firstname FROM Users WHERE firstname = '$mentor' ";
        $result = $db->query($user_check);
        $user = mysqli_fetch_assoc($result);
        if (!$user) {
            echo '<script type="text/javascript">alert("Not a user");</script>';
            echo $user_check;
            array_push($errors, "Not a user");
        } else {
            $id = "SELECT idNewemployee FROM Newemployee WHERE firstname = '$employee'";
            $id2 = "SELECT idUsers FROM Users WHERE firstname = '$mentor' ";
            $resultid = $db->query($id);

            if (!$resultid) {
                echo '<script type="text/javascript">alert("Wrong id");</script>';
            } else {
                while ($row = mysqli_fetch_assoc($resultid)) {
                    $resultid2 = $db->query($id2);
                    $id4 = $row['idNewemployee'];

                    if (!$resultid2) {
                        echo '<script type="text/javascript">alert("User and id dont match");</script>';
                    } else {
                        while ($row = mysqli_fetch_assoc($resultid2)) {
                            $id3 = $row['idUsers'];
                            $querya = "SELECT Users_idUsers FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$id4'";
                            $resulta = $db->query($querya);
                            if (!$resulta) {
                                echo "something";
                            } else {
                                while ($row2 = mysqli_fetch_assoc($resulta)) {
                                    $haha = $row2['Users_idUsers'];
                                    if ($haha == $id3) {
                                        echo '<script type="text/javascript">alert("same mentor error");</script>';
                                    }
                                    else {
                                        $query = "UPDATE Users_has_Newemployee SET Users_idUsers= '$id3' WHERE Newemployee_idNewemployee='$id4'";
                                        $result = $db->query($query);

                                        if ($result === TRUE) {

                                            echo '<script type="text/javascript">alert("Mentor edit worked");</script>';

                                        } else {
                                            echo '<script type="text/javascript">alert("Something wrong happend");</script>';

                                        }
                                    }

                                }

                            }
                        }

                    }
                }
            }

        }
    }

//adds a mentor to the newemployye
    function addmentor()
    {
        global $db, $username, $errors;
        $employee = e($_POST['empname']);
        $mentor = e($_POST['mentor']);
        $user_check = "SELECT firstname FROM Newemployee WHERE firstname = '$employee'";
        $result = $db->query($user_check);
        $user = mysqli_fetch_assoc($result);
        if (!$user) {
            echo '<script type="text/javascript">alert("Not a user");</script>';
            echo $user_check;
            array_push($errors, "Not a user");
        } else {
            $id = "SELECT idNewemployee FROM Newemployee WHERE firstname = '$employee'";
            $id2 = "SELECT idUsers FROM Users WHERE firstname = '$mentor'";
            $resultid = $db->query($id);

            if (!$resultid) {
                echo '<script type="text/javascript">alert("Wrong id");</script>';

            } else {
                while ($row = mysqli_fetch_assoc($resultid)) {
                    $resultid2 = $db->query($id2);
                    $id4 = $row['idNewemployee'];
                    $test = "Select Newemployee_idNewemployee FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$id4' ";
                    $testresult = $db->query($test);
                    if (!$resultid2) {
                        echo '<script type="text/javascript">alert("User and id dont match");</script>';
                    } else {

                        if ($db->affected_rows == 1) {
                            echo '<script type="text/javascript">alert("Employee has already a mentor edit mentor instead");</script>';
                        } else {

                            while ($row = mysqli_fetch_assoc($resultid2)) {
                                $id3 = $row['idUsers'];

                                $query = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$id3', '$id4') ";
                                $res = mysqli_query($db, $query);
                                if (!$res) {

                                } elseif ($db->affected_rows == 0) {
                                    echo '<script type="text/javascript">alert("Something failed");</script>';
                                } else {
                                    echo '<script type="text/javascript">alert("Mentor assigned");</script>';
                                }
                            }
                        }

                    }

                }
            }
        }
    }

    function oversikt()
    {
        global $db;
        $querya = "SELECT international FROM Newemployee";
        $finale = $db->query($querya);
        if (!$finale) {
            echo $querya;
            echo '<script type="text/javascript">alert("Error");</script>';
        } elseif ($finale->num_rows > 0) {
            while ($row = $finale->fetch_object()) {
                $query = "SELECT * FROM Checklist ";
                $result = $db->query($query);
                if ($row->international == "Ja") {
                    while (($row = $result->fetch_object())) {

                        echo "<li>" . $row->idChecklist . " " . $row->checkpointsEN . " responsible is " . $row->responsible . " is " . $row->nationality . " is a leader " . $row->leader . "</li>";
                    }
                } else if ($row->international == "Nei") {
                    while ($row = $result->fetch_object()) {

                        echo "<li>" . $row->idChecklist . " " . $row->checkpointsNO . " responsible is " . $row->responsible . " From " . $row->nationality . " is a leader " . $row->leader . "</li>";

                    }
                } else {

                    echo '<script type="text/javascript">alert("Checklist cant be viewed");</script>';
                }
            }

        }

    }

    function oversikt_mentor()
    {
        global $db, $errors;
        $username = $_SESSION['user'];

        $first = "SELECT idUsers FROM Users WHERE username= '$username'";
        $res = $db->query($first);
        if (!$res) {
            echo "view failed";
        } else if ($res->num_rows > 0) {
            while ($row = $res->fetch_object()) {

                $query = "SELECT Newemployee_idNewemployee FROM Users_has_Newemployee WHERE Users_idUsers = '$row->idUsers'";
                $result = $db->query($query);

                if (!$result) {
                    echo $query;
                    echo '<script type="text/javascript">alert("Viewing failed");</script>';
                } else if ($result->num_rows > 0) {
                    while ($row = $result->fetch_object()) {
                        $second = "SELECT Checklist_idChecklist, Newemployee_idNewemployee FROM Newemployee_has_Checklist WHERE Newemployee_idNewemployee = '$row->Newemployee_idNewemployee'";
                        $resa = $db->query($second);

                        if (!$resa) {
                            echo $second;
                            echo '<script type="text/javascript">alert("Failed");</script>';
                        } else if ($resa->num_rows > 0) {
                            while ($row = $resa->fetch_object()) {
                                $querya = "SELECT international FROM Newemployee WHERE idNewemployee = '$row->Newemployee_idNewemployee'";
                                $queryfin = "SELECT * FROM Checklist WHERE idChecklist = '$row->Checklist_idChecklist'";
                                $final = $db->query($queryfin);
                                $finale = $db->query($querya);
                                if (!$finale) {
                                    echo $querya;
                                    echo '<script type="text/javascript">alert("Error");</script>';
                                } elseif ($finale->num_rows > 0) {
                                    while ($row = $finale->fetch_object()) {
                                        if ($row->international == "Ja") {
                                            if (!$final) {
                                                echo $queryfin;
                                                echo '<script type="text/javascript">alert("game over");</script>';
                                            } elseif ($final->num_rows > 0) {

                                                while ($row = $final->fetch_object()) {

                                                    echo "<li>" . $row->idChecklist . " " . $row->checkpointsEN . " responsible is " . $row->responsible . " is " . $row->nationality . " is a leader " . $row->leader . "</li>";
                                                }
                                            } else {
                                                echo '<script type="text/javascript">alert("Troubled checklist");</script>';
                                            }
                                        } else {
                                            if (!$final) {
                                                echo $queryfin;
                                                echo '<script type="text/javascript">alert("Failure");</script>';
                                            } elseif ($final->num_rows > 0) {

                                                while ($row = $final->fetch_object()) {

                                                    echo "<li>" . $row->idChecklist . " " . $row->checkpointsNO . " responsible is " . $row->responsible . " From " . $row->nationality . " is a leader " . $row->leader . "</li>";

                                                }
                                            } else {
                                                echo '<script type="text/javascript">alert("Troubled list");</script>';
                                            }
                                        }
                                    }
                                }

                            }
                        } else {
                            echo '<script type="text/javascript">alert("Newemployee dont have a checklist");</script>';


                        }
                    }
                } else {
                    echo '<script type="text/javascript">alert("Isnt mentoring anyone at the moment");</script>';

                }
            }
        } else {
            echo '<script type="text/javascript">alert("Troubled registartion");</script>';
        }

    }

    function pointlist()
    {
        global $db, $errors;
        $innd = e($_POST['innd']);
        $innde = e($_POST['innde']);
        $ans = e($_POST['ans']);
        $nasj = e($_POST['nasj']);
        $Led = e($_POST['Led']);
        if (empty($innd)) {
            echo '<script type="text/javascript">alert("Empty write something");</script>';
            array_push($errors, "You need to write something");
        }
        $ind_check = "SELECT checkpointsNO FROM Checklist WHERE checkpointsNO= '$innd'";
        $result = $db->query($ind_check);
        $user = mysqli_fetch_assoc($result);
        if ($user) {
            echo '<script type="text/javascript">alert("Already a checkpoint");</script>';
            array_push($errors, "Checkpoint is already here");
        } else {
            if (count($errors) == 0) {
                $query = "INSERT INTO Checklist (checkpointsNO, checkpointsEN, responsible, nationality, leader)
                                VALUES ('$innd', '$innde', '$ans', '$nasj', '$Led' ) ";
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

//edit the password of a user
    function editpass()
    {
        global $db, $username, $errors;

        $username = e($_POST['username']);
        $original_password = e($_POST['original_password']);
        $new_password = e($_POST['new_password']);
        $original_password = md5($original_password);
        $user_check = "SELECT username FROM Users WHERE username= '$username'";
        $result = $db->query($user_check);
        $user = mysqli_fetch_assoc($result);
        if (!$user) {
            echo '<script type="text/javascript">alert("Not a user");</script>';
            array_push($errors, "Not a user");
        } else {
            $pass_check = "SELECT password from Users WHERE password= '$original_password'";
            $result = $db->query($pass_check);
            $pass = mysqli_fetch_assoc($result);
            if (!$pass) {
                echo '<script type="text/javascript">alert("Not a valid password");</script>';
                array_push($errors, "not a valid password");
            } else {

                //edit password adnd cryptate the password in md5 cryption
                if (count($errors) == 0) {
                    $password = md5($new_password);
                    $query = "UPDATE Users SET password = '$password' WHERE username='$username'";
                    $result = $db->query($query);
                    if (!$result) {
                        echo '<script type="text/javascript">alert("Didnt work");</script>';
                    } else {
                        echo '<script type="text/javascript">alert("Password edit worked");</script>';
                    }
                }
            }

        }


    }

//search for a user
    function searchuser()
    {
        global $db,
               $lastname;
        $lastname = e($_GET['lastname']);


        $query = "SELECT * FROM Newemployee WHERE lastname= '$lastname'";
        $result = $db->query($query);
        if (!$result) {
            echo '<script type="text/javascript">alert("View failed");</script>';
        } else {
            while ($row = $result->fetch_object()) {
                echo "<li>" . "ID number " . $row->firstname . "  " . $row->lastname . " gonna get the title of " . $row->workposition . "has an international background " . $row->international . " start working on " . $row->startdate . " " . $row->checked . "</li>";
            }
        }

    }

//get userid
    function getUserByID($id)
    {
        global $db;
        $query = "SELECT * FROM Users WHERE id=" . $id;
        $result = $db->query($query);
        $user = mysqli_fetch_assoc($result);
        return $user;
    }

// escape string
    function e($val)
    {
        global $db;
        return mysqli_real_escape_string($db, trim($val));
    }

    function display_error()
    {
        global $errors;

        if (count($errors) > 0) {
            echo '<div class="error">';
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
            echo '</div>';
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


