
<?php
//All connection to DB here
//register here
session_start();
$username ="";
$errors = array();
//$db = mysqli_connect('student.cs.hioa.no', 's236619', '', 's236619');
$db = mysqli_connect( 'localhost', 'root',  '', 'db_hr_portal');
//check if inputs are correct!

if (isset($_POST['register'])){
    $firstname = e($_POST['firstname']);
    $lastname = e($_POST['lastname']);
    $workposition = e($_POST['workposition']);
    $international= e($_POST['international']);
    $startdate = e($_POST['startdate']);
    //$confirm_password = e($_POST['confirm_password']);
    if (empty($firstname)) {array_push($errors, "You need a firstname");}
    if (empty($lastname)) {array_push($errors, "write your lastname");}
    if (empty($workposition)) {array_push($errors, "write the workposition");}
    //add user and cryptate the password in md5 cryption
    if (count($errors) ==0){
        //$salt = random_bytes(10).$password_first;
        //$password= hash('sha512', $password_first);

        $query = "INSERT INTO Newemployee (firstname, lastname, workposition , international, startdate) 
  			  VALUES('$firstname', '$lastname', '$workposition', '$international', '$startdate')";
        $result = $db->query($query);
        if(!$result){
            echo "Wrong in the script";
        }
        //elseif(mysqli_affected_rows($db) == 0){
        elseif($db->affected_rows == 0){
            echo "The script worked, but the user wasn't added";
        }
        else{
            echo "newemployee was added";
        }
    }
}

if (isset($_POST['createCheckList'])) {
    $firstname = e($_POST['firstname']);
    $lastname = e($_POST['lastname']);
    $workposition = e($_POST['workposition']);
    $international = e($_POST['international']);
    $startdate = e($_POST['startdate']);
    //$confirm_password = e($_POST['confirm_password']);
    if (empty($firstname)) {
        array_push($errors, "You need a firstname");
    }
    if (empty($lastname)) {
        array_push($errors, "write your lastname");
    }
    if (empty($workposition)) {
        array_push($errors, "write the workposition");
    }
    //add user and cryptate the password in md5 cryption
    if (count($errors) == 0) {
        //$salt = random_bytes(10).$password_first;
        //$password= hash('sha512', $password_first);

        $query = "INSERT INTO Newemployee (firstname, lastname, workposition , international, startdate) 
  			  VALUES('$firstname', '$lastname', '$workposition', '$international', '$startdate')";
        $result = $db->query($query);
        $result2 = "SELECT * FROM Checklist";



        if (!$result) {
            echo "Wrong in the script";
        } elseif ($db->affected_rows == 0) {
            echo "The script worked, but the user wasn't added";
        } elseif ($db->affected_rows > 0) {

            if ($workposition == "Ansatt" && $international == "Nei") {

                $idNewemployee = $db->insert_id;
                $query = "SELECT idChecklist FROM Checklist WHERE nationality = 'Norsk' AND leader = 'Nei' ";
                $res = mysqli_query($db, $query);

                while ($row = mysqli_fetch_assoc($res)) {
                    $checkId = $row['idChecklist'];
                    $query2 = "INSERT INTO Newemployee_has_Checklist (Newemployee_idNewemployee, Checklist_idChecklist, checked) VALUES ($idNewemployee, $checkId, 0)";

                    $res2 = mysqli_query($db, $query2);

                    if (!$res2) {
                        echo $query2;
                        echo "Wrong in the script1";
                    } //elseif(mysqli_affected_rows($db) == 0){
                    elseif ($db->affected_rows == 0) {
                        echo "The script worked, but the list wasn't added";
                    } else {
                        echo "This worked: workposition = Ansatt && international = Nei";
                    }
                }
            } elseif ($workposition == "Ansatt" && $international == "Ja") {

                $idNewemployee = $db->insert_id;
                $query = "SELECT idChecklist FROM Checklist WHERE leader = 'Nei' ";
                $res = mysqli_query($db, $query);

                while ($row = mysqli_fetch_assoc($res)) {
                    $checkId = $row['idChecklist'];
                    $query2 = "INSERT INTO Newemployee_has_Checklist (Newemployee_idNewemployee, Checklist_idChecklist, checked) VALUES ($idNewemployee, $checkId, 0)";

                    $res2 = mysqli_query($db, $query2);

                    if (!$res2) {
                        echo $query2;
                        echo "Wrong in the script2";
                    } //elseif(mysqli_affected_rows($db) == 0){
                    elseif ($db->affected_rows == 0) {
                        echo "The script worked, but the list wasn't added";
                    } else {
                        echo "This worked2: workposition = Ansatt && international = Ja";
                    }
                }
            } elseif ($workposition == "Leder" && $international == "Nei") {

                $idNewemployee = $db->insert_id;
                $query = "SELECT idChecklist FROM Checklist WHERE nationality = 'Norsk'";
                $res = mysqli_query($db, $query);

                while ($row = mysqli_fetch_assoc($res)) {
                    $checkId = $row['idChecklist'];
                    $query2 = "INSERT INTO Newemployee_has_Checklist (Newemployee_idNewemployee, Checklist_idChecklist, checked) VALUES ($idNewemployee, $checkId, 0)";

                    $res2 = mysqli_query($db, $query2);

                    if (!$res2) {
                        echo $query2;
                        echo "Wrong in the script3";
                    } //elseif(mysqli_affected_rows($db) == 0){
                    elseif ($db->affected_rows == 0) {
                        echo "The script worked, but the list wasn't added";
                    } else {
                        echo "This worked3: workposition = Leder && international = Nei";
                    }
                }
            } elseif ($workposition == "Leder" && $international == "Ja") {

                $idNewemployee = $db->insert_id;
                $query = "SELECT idChecklist FROM Checklist ";
                $res = mysqli_query($db, $query);

                while ($row = mysqli_fetch_assoc($res)) {
                    $checkId = $row['idChecklist'];
                    $query2 = "INSERT INTO Newemployee_has_Checklist (Newemployee_idNewemployee, Checklist_idChecklist, checked) VALUES ($idNewemployee, $checkId, 0)";

                    $res2 = mysqli_query($db, $query2);

                    if (!$res2) {
                        echo $query2;
                        echo "Wrong in the script4";
                    } //elseif(mysqli_affected_rows($db) == 0){
                    elseif ($db->affected_rows == 0) {
                        echo "The script worked, but the list wasn't added";
                    } else {
                        echo "This worked4: workposition = Leder && international = Ja ";
                    }
                }
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
    {
        global $db, $username, $errors;
        //get values
        $firstname = e($_POST['firstname']);


        // make sure form is filled properly





        $id = "SELECT idNewemployee FROM Newemployee WHERE firstname = '$firstname'";
        $resultid = $db->query($id);
        if (!$resultid) {
            echo "not correct id";
        } else {
            while ($row = mysqli_fetch_assoc($resultid)) {
                $id4 = $row['idNewemployee'];
                        $query = "DELETE FROM Newemployee_has_Checklist WHERE Newemployee_idNewemployee = '$id4'";
                        echo $query;

                        if ($db->query($query) === TRUE) {
                            $dquery = "DELETE FROM Newemployee WHERE idNewemployee = '$id4'";
                            echo $dquery;
                            if ($db->query($dquery) === TRUE) {
                                echo "delete succesfull";
                            } else {
                                echo "couldn't delete employee";
                            }

                        } else {
                            echo "Checklist couldn't be deleted";
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
            echo "not a user";
            array_push($errors, "Not a user");
        } else {

            if (count($errors) == 0) {
                $query = "UPDATE Users SET usertype = '$user_type' WHERE username='$username'";
                $result = $db->query($query);
                $chck = mysqli_fetch_assoc($result);
                if (!$chck) {
                    echo "wrong in the script";
                } else {
                    echo "user type edited successful";
                }
            }

        }

    }

    function addmentor()
    {
        global $db, $username, $errors;
        $firstname = e($_POST['firstname']);
        $Mentorname = e($_POST['Mentorname']);
        $user_check = "SELECT firstname FROM Users WHERE firstname= '$Mentorname'";
        $result = $db->query($user_check);
        $user = mysqli_fetch_assoc($result);
        if (!$user) {
            echo "not a user";
            array_push($errors, "Not a user");
        } else {
            $id = "SELECT idNewemployee FROM Newemployee WHERE firstname = '$firstname'";
            $id2 = "SELECT idUsers FROM Users WHERE firstname = '$Mentorname'";
            $resultid = $db->query($id);

            if (!$resultid) {
                echo "not correct id";

            } else {
                while ($row = mysqli_fetch_assoc($resultid)) {
                    $resultid2 = $db->query($id2);
                    $id4 = $row['idNewemployee'];
                    $test = "Select Newemployee_idNewemployee FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$id4' ";
                    $testresult = $db->query($test);
                    if (!$resultid2) {
                        echo "user dont have that id";
                    } else {

                         if($db->affected_rows == 1  ) {
                            echo "This employee has a mentor already";
                        } else{

                            while ($row = mysqli_fetch_assoc($resultid2)) {
                                $id3 = $row['idUsers'];

                                $query = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$id3', '$id4') ";
                                $res = mysqli_query($db, $query);
                                if (!$res) {

                                } elseif ($db->affected_rows == 0) {
                                    echo "something else went wrong";
                                } else {
                                    echo "mentor assigned";
                                }
                            }
                        }

                    }

                }
            }
        }
    }
    function oversikt(){
        global $db;
        $querya = "SELECT international FROM Newemployee";
        $finale = $db->query($querya);
        if(!$finale){
            echo $querya;
            echo "you loose punk";
        }
        elseif ($finale->num_rows>0){
            while ($row= $finale->fetch_object()){
                $query = "SELECT * FROM Checklist ";
                 $result = $db->query($query);
                if($row->international == "Ja"){
                    while (($row =$result->fetch_object())){

                            echo "<li>" . $row->idChecklist . " " . $row->checkpointsEN . " responsible is " . $row->responsible . " is " . $row->nationality. " is a leader " . $row->leader . "</li>";
                        }
                    }
                    else if ($row->international == "Nei"){
                      while ($row= $result-> fetch_object()) {

                            echo "<li>" . $row->idChecklist . " " . $row->checkpointsNO . " responsible is " . $row->responsible . " From " . $row->nationality. " is a leader " . $row->leader . "</li>";

                        }
                    }
                else{

                        echo "The checklist is troubled";
                    }
                }

        }

    }
   function oversikt_mentor(){
       global $db,  $errors;
$username = $_SESSION['user'];

$first = "SELECT idUsers FROM Users WHERE username= '$username'";
$res = $db->query($first);
if(!$res){
    echo "view failed";
}else if ($res->num_rows>0) {
    while ($row = $res->fetch_object()) {

        $query = "SELECT Newemployee_idNewemployee FROM Users_has_Newemployee WHERE Users_idUsers = '$row->idUsers'";
        $result = $db->query($query);

        if(!$result){
            echo $query;
            echo "viewing failed";
        }
        else if ($result->num_rows>0){
            while ($row = $result->fetch_object()){
                $second = "SELECT Checklist_idChecklist, Newemployee_idNewemployee FROM Newemployee_has_Checklist WHERE Newemployee_idNewemployee = '$row->Newemployee_idNewemployee'";
                $resa = $db->query($second);

                if(!$resa){
                    echo $second;
                    echo  "failed";
                }else if ($resa->num_rows>0){
                    while ($row= $resa->fetch_object()) {
                        $querya = "SELECT international FROM Newemployee WHERE idNewemployee = '$row->Newemployee_idNewemployee'";
                        $queryfin = "SELECT * FROM Checklist WHERE idChecklist = '$row->Checklist_idChecklist'";
                        $final = $db->query($queryfin);
                        $finale = $db->query($querya);
                        if(!$finale){
                            echo $querya;
                            echo "you loose punk";
                        }
                        elseif ($finale->num_rows>0){
                            while ($row= $finale->fetch_object()){
                                if($row->international == "Ja"){
                                    if(!$final){
                                        echo  $queryfin;
                                        echo "game over";
                                    }elseif ($final->num_rows>0){

                                        while ($row= $final-> fetch_object()) {

                                            echo "<li>" . $row->idChecklist . " " . $row->checkpointsEN . " responsible is " . $row->responsible . " is " . $row->nationality. " is a leader " . $row->leader . "</li>";
                                        }
                                    }
                                    else{
                                        echo "The checklist is troubeled";
                                    }
                                }else{
                                    if(!$final){
                                        echo  $queryfin;
                                        echo "game over";
                                    }elseif ($final->num_rows>0){

                                        while ($row= $final-> fetch_object()) {

                                            echo "<li>" . $row->idChecklist . " " . $row->checkpointsNO . " responsible is " . $row->responsible . " From " . $row->nationality. " is a leader " . $row->leader . "</li>";

                                        }
                                    }else{
                                        echo "The checklist is troubeled";
                                    }
                                }
                            }
                        }

                    }
                }else{
                    echo "New employee dosen't have a checklist yet.";



                }
            }
        } else {
            echo  "Not having any newemployees";

        }
    }
}else{
    echo"You aren't registered correctly";
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
            array_push($errors, "Not a user");
        } else {
            $pass_check = "SELECT password from Users WHERE password= '$original_password'";
            $result = $db->query($pass_check);
            $pass = mysqli_fetch_assoc($result);
            if (!$pass) {
                array_push($errors, "not a valid password");
            } else {

                //edit password adnd cryptate the password in md5 cryption
                if (count($errors) == 0) {
                    $password = md5($new_password);
                    $query = "UPDATE Users SET password = '$password' WHERE username='$username'";
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
        global $db,
               $lastname;
        $lastname = e($_GET['lastname']);


        $query = "SELECT * FROM Newemployee WHERE lastname= '$lastname'";
        $result = $db->query($query);
        if (!$result) {
            echo "viewing failed";
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


