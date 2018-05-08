
<?php
//All connection to DB here
//register here
session_start();
$username ="";
$errors = array();
$db = mysqli_connect('student.cs.hioa.no', 's236619', '', 's236619');
//$db = mysqli_connect( 'localhost', 'root',  '', 'db_hr_portal');


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
                    header('location: ../HR-Portal/Usersites/admin/admin_overview.php');
                } else if ($logged_in_user['usertype'] == 'leader') {
                    $_SESSION['user'] = $logged_in_user;
                    $_SESSION['success'] = "Logged in";
                    header('location: ../HR-Portal/Usersites/leader/leader_overview.php');
                } else if ($logged_in_user['usertype'] == 'mentor') {
                    $_SESSION['user'] = $logged_in_user;
                    $_SESSION['success'] = "Logged in getting you to list";
                    header('location: ../HR-Portal/Usersites/mentor/mentor_overview.php');
                } else {
                    $_SESSION['user'] = $logged_in_user;
                    $_SESSION['success'] = "Logged in getting you to list";
                    header('location: ../HR-Portal/Usersites/HR/hr_overview.php');
                }

            } else {
                array_push($errors, "Wrong credentials");
                header('location: ../../HR-Portal/index.php');
            }


        }

    }
/*
    if (isset($_POST["del"])) {
        deletechecklist();
    }
//delete user
    function deletechecklist()
    {
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
            }

    }*/

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
        if (isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'mentor') {
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
    function logOut()
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


















