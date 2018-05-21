
<?php
//All connection to DB here
//register here
session_start();
$username ="";
$errors = array();
$db = mysqli_connect('student.cs.hioa.no', 's236619', '', 's236619');
//$db = mysqli_connect( 'localhost', 'root',  '', 'db_hr_portal');


//Tar inn logg inn data fra index.php og sender det til funksjonen login
    if (isset($_POST["logginn"])) {
        login();
    }
//Tar inn logg inn data indexeng.php og sender det til funksjonen  logineng
if (isset($_POST["login"])) {
    logineng();
}

//Tester login dataen mot databasen. Om det matcher noe blir du logget inn til gitt brukerside. Om ikke forblir du på index
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
//Tester login dataen mot databasen. Om det matcher noe blir du logget inn til gitt brukerside. Om ikke forblir du på index. Fra den engelske siden
function logineng()
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
                header('location: ../HR-Portal/Usersites/admin_eng/admin_overvieweng.php');
            } else if ($logged_in_user['usertype'] == 'leader') {
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "Logged in";
                header('location: ../HR-Portal/Usersites/leader_eng/leader_overvieweng.php');
            } else if ($logged_in_user['usertype'] == 'mentor') {
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "Logged in getting you to list";
                header('location: ../HR-Portal/Usersites/mentor/mentor_overvieweng.php');
            } else {
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "Logged in getting you to list";
                header('location: ../HR-Portal/Usersites/HR_eng/hr_overvieweng.php');
            }

        } else {
            array_push($errors, "Wrong credentials");
            header('location: ../../HR-Portal/indexeng.php');
        }


    }

}


//Tester at du er logget inn på visse sider
    function isLoggedIN()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

//Tester om du er logget inn som admin.
    function admin()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }

//Tester om du er logget inn som leder. Admin har og tilgang til ledersidene så tester det og.
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

//Tester om du er logget inn som fadder.
    function fadder()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'mentor') {
            return true;
        } else {
            return false;
        }
    }

//Tester om du er logget inn som HR eller admin for tilgang til HR sidene.
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

//Tester om du er logget inn for å ha noe data til logout.php
    function logOut()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }
        return true;
    }

//Tar inn data og sender det til funksjon editpass. Note ikke i bruk
    if (isset($_POST["edit"])) {
        editpass();
    }


//Tar inn data og sender det til edittype funksjonen. Note ikke i bruk
    if (isset($_POST["type_edit"])) {
        edittype();
    }


//Endre en brukertype. Ikke i bruk.
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
//

//Endre passord til en bruker. Ikke i  bruk
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


//Får bruker ved å gi bruker iden. Ikke i bruk.
    function getUserByID($id)
    {
        global $db;
        $query = "SELECT * FROM Users WHERE id=" . $id;
        $result = $db->query($query);
        $user = mysqli_fetch_assoc($result);
        return $user;
    }

// escape string som fjerner unnødvendige eller overflødig data.
    function e($val)
    {
        global $db;
        return mysqli_real_escape_string($db, trim($val));
    }
//Viser feil som er gjort i andre funksjoner.
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


















