
<?php
//All connection to DB here
//register here
session_start();
$username ="";
$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'personer');
//check if inputs are correct!
if (isset($_POST['register'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $user_type = mysqli_real_escape_string($db, $_POST['user_type']);
    $password_first = mysqli_real_escape_string($db, $_POST['password_first']);
    $confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);
    if (empty($username)) {array_push($errors, "You need a username");}
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
        }
    }
    //add user and cryptate the password in md5 cryption
    if (count($errors) ==0){
        $password = md5($password_first);
        $query = "INSERT INTO users (username, user_type, password) 
  			  VALUES('$username', '$user_type', '$password')";
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
function fadder(){
      if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'fadder'){
        return true;
    }else{
        return false;
    }
}
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
function logO(){
   if (isset($_SESSION['user'])){
       return true;
   }
    return true;
}

//get userid
function getUserByID($id){
    global $db;
    $query = "SELECT * FROM users WHERE id=" . $id;
    $result = $db->query($query);
    $user = mysqli_fetch_assoc($result);
    return $user;
}
// escape string
function e($val){
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

