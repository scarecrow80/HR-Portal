
<?php
//All connection to DB here
//register here
session_start();
$username ="";
$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'personer');
//check if inputs are correct!
if (isset($_POST['register'])){
    $username = e($_POST['username']);
    $name = e($_POST['name']);
    $user_type = e($_POST['user_type']);
    $password_first = e($_POST['password_first']);
    $confirm_password = e($_POST['confirm_password']);
    if (empty($username)) {array_push($errors, "You need a username");}
    if (empty($name)) {array_push($errors, "write your name");}
    if (empty($user_type)) {array_push($errors, "You have to have a role");}
    if ($password_first != $confirm_password){
        array_push($errors, "the password needs to match");
    }
    //check if your user isnt already made
    $user_check = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = $db->query($user_check);
    $user = mysqli_fetch_assoc($result);
    if($user){
        if($user['username'] === $username){
            array_push($errors, "That username allready exits");
            echo "exiting username";
        }
    }


    //add user and cryptate the password in md5 cryption
    if (count($errors) ==0){
        $password = md5($password_first);
        $query = "INSERT INTO users (username, name, user_type, password) 
  			  VALUES('$username', '$name', '$user_type', '$password')";
        $result = $db->query($query);
        if(!$result){
            echo "Wrong in the script";
        }
        //elseif(mysqli_affected_rows($db) == 0){
        elseif($db->affected_rows == 0){
            echo "The script worked, but the user wasn't added";
        }
        else{
            echo "user added";
        }
    }
}
//login
if (isset($_POST["login"])){
    login();
}

//login function
function login() {
    global  $db, $username, $errors;
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
    if (count($errors) == 0){
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
        $result = $db->query($query);

        if($db->affected_rows == 1) {

            $logged_in_user = mysqli_fetch_assoc(($result));
            if ($logged_in_user['user_type'] == 'admin') {
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "Logged in";
                header('location: ../testlist/admin.php');
            } else if ($logged_in_user['user_type'] == 'leder') {
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "Logged in getting you to list";
                header('location: ../testlist/lists.php');
            } else if  ($logged_in_user['user_type'] == 'fadder'){
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "Logged in getting you to list";
                header('location: ../testlist/Karl.php');
            } else{
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "Logged in getting you to list";
                header('location: ../testlist/HR.php');
            }

        }else {
            array_push($errors, "Wrong credentials");
        }


    }

}
if (isset($_POST["Usern"])){
    deleteuser();
}
//delete user
function deleteuser()
{
    global $db, $username, $errors;
    //get values
    $username = e($_POST['username']);


    // make sure form is filled properly
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    $user_check = "SELECT username FROM users WHERE username='$username'";
    $result = $db->query($user_check);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        array_push($errors, "Not a user");
    } else {
        if (count($errors) == 0) {

            $query = "DELETE FROM users WHERE username='$username'";
            $result = $db->query($query);

            if (!$result) {
                echo "couldnt delete user";




            } else {
                echo "user deleted";
            }


        }

    }
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
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin'){
        return true;
    }else{
        return false;
    }
}
//fadder cant login to some place
function fadder(){
      if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'fadder'){
        return true;
    }else{
        return false;
    }
}
//HR and admin can get to hr
function HR(){
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin'){
        return true;
    }elseif (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'HR')
    {
     return true;
    } else{
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
if (isset($_POST["edit"])){
    editpass();
}
//if use typeedit form got to edittype function
if(isset($_POST["type_edit"])){
    edittype();
}
if (isset($_GET['search'])){
    searchuser();
}
//edit a usertype
function edittype()
{
    global $db, $username, $errors;
    $username = e($_POST['username']);
    $user_type = e($_POST['user_type']);
    $user_check = "SELECT username FROM users WHERE username= '$username'";
    $result = $db->query($user_check);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        echo "not a user";
        array_push($errors, "Not a user");
    } else {

            if (count($errors) == 0){
                $query = "UPDATE users SET user_type = '$user_type' WHERE username='$username'";
                $result = $db->query($query);
                if(!$result){
                    echo "wrong in the script";
                }else{
                    echo "user type edited successful";
                }
            }

    }

    }


//edit the password of a user
function editpass()
{
    global $db, $username, $errors;

        $username = e($_POST['username']);
        $original_password =  e($_POST['original_password']);
        $new_password =  e($_POST['new_password']);
        $original_password = md5($original_password);
    $user_check = "SELECT username FROM users WHERE username= '$username'";
    $result = $db->query($user_check);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        array_push($errors, "Not a user");
    } else {
        $pass_check = "SELECT password from users WHERE password= '$original_password'";
        $result = $db->query($pass_check);
        $pass = mysqli_fetch_assoc($result);
        if (!$pass) {
        array_push($errors, "not a valid password");
        }else {

            //edit password adnd cryptate the password in md5 cryption
            if (count($errors) == 0) {
                $password = md5($new_password);
                $query = "UPDATE users SET password = '$password' WHERE username='$username'";
                $result = $db->query($query);
                if (!$result) {
                    echo "Wrong in the script";
                } else {
                    echo "password edit succesful";
                }
            }
        }

    }


}
//search for a user
function searchuser()
{
    global $db, $username, $errors;
    $username = e($_GET['username']);
    $user_check = "SELECT username FROM users WHERE username= '$username'";
    $result = $db->query($user_check);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        array_push($errors, "Not a user");
    } else {
        if (count($errors) == 0) {
            $query = "SELECT *, NULL AS password FROM users WHERE username= '$username'";
            $result = $db->query($query);
            if (!$result) {
                echo "viewing failed";
            } else {
                while ($row = $result->fetch_object()) {
                    echo "<li>"."ID number ". $row->ID . " user " . $row->username . " is named " . $row->name . " has the role " . $row->user_type . ". " . $row->password . "</li>";
                }
            }
        }
    }
}
//get userid
    function getUserByID($id)
    {
        global $db;
        $query = "SELECT * FROM users WHERE id=" . $id;
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


