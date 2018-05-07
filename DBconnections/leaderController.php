<?php

function overviewLeader(){

    global $db;

    if(!$db){
        die("Feil i databasetilkobling:".$db->connect_error);
    }
//$userId = $_SESSION;
    $qry =  "SELECT Newemployee.firstname, Newemployee.lastname, Newemployee.idNewemployee FROM Newemployee INNER JOIN Users_has_Newemployee ON Newemployee.idNewemployee = Users_has_Newemployee.Newemployee_idNewemployee WHERE Users_has_Newemployee.Users_idUsers = 19";
    $res = mysqli_query($db, $qry);
    if(!$res){
        echo '<script type="text/javascript">alert("Failed query");</script>';
    }


    while($row = mysqli_fetch_assoc($res)){
        $id_new = $row['idNewemployee'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];


        $article = ' <article class="h-card vcard person-card article-contact" role="article"><h3 title="Oversikt over sjekklister"  class="toggler-header article-contact-heading"> ';
        $article.=$f_name." ".$l_name." ";
        $article.= '</h3><div class="toggler-content"><form action="" method="post"><table><tr><th>Oppgave</th><th>Sjekkboks</th></tr>';
        $qry2 = "SELECT Newemployee_idNewemployee, Checklist_idChecklist, checked FROM Newemployee_has_Checklist INNER JOIN Checklist ON idChecklist WHERE Checklist_idChecklist = idChecklist AND responsible = 'Leder' AND Newemployee_idNewemployee='$id_new'";
        $res2 = mysqli_query($db, $qry2);

        if(!$res2){
            echo '<script type="text/javascript">alert("Tom res");</script>';
            die();
        }
        while($row2 = mysqli_fetch_assoc($res2)){
            $check_id = $row2['Checklist_idChecklist'];
            $checked = $row2['checked'];
            $emp_id = $row2['Newemployee_idNewemployee'];

            $qry3 = "SELECT checkpointsNO, idChecklist from Checklist WHERE idChecklist ='$check_id' AND responsible='Leder'";
            $res3 =  mysqli_query($db, $qry3);
            $res4 = mysqli_fetch_assoc($res3);

            $article.='
                                             <tr>
                                             <td>';
            $article.=" ".$res4['checkpointsNO']." ";
            $id_check=$res4['idChecklist'];
            $article.='</td>';
            $article.='<td height="30px" >';
            if($checked == 0){
                $article.='<input type="checkbox" class="checkbox" name="';
                $article.=$emp_id;
                $article.='" value="';
                $article.=$checked;
                $article.='" id="';
                $article.=$check_id;
                $article.='" onclick="test(this.name, this.id, this.value)"/>';

            } else{
                $article.='<input type="checkbox" class="checkbox" name="empty" checked onclick="postData(this.name, this.value, this.id)" value="';

                $article.=$checked;

                $article.='">';

            }

            $article.='</td>
                                            </tr>';

        }
        //$article.='<button type="submit">Submit</button>';
        $article.= '</table></form></div></article>';
        echo $article;

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

function emp()
{
    global  $db;
    $query = mysqli_query($db, "SELECT idNewemployee, firstname, lastname FROM Newemployee") or die(mysqli_error());
    echo "<select name=\"empname\" class=\"field comment-alerts\">";

    while ($row = $query->fetch_assoc()){

        unset($f_name, $l_name);
        $employee_id = $row['idNewemployee'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];

        echo  '<option value="'.$employee_id.'">'.$f_name.' '.$l_name.'</option>';

    }
    echo  "</select>";
}

function ment()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'mentor'") or die(mysqli_error());
    echo "<select name=\"mentorSelect\" class=\"field comment-alerts\">";

    while ($row = $query->fetch_assoc()) {

        unset($f_name, $l_name);
        $user_id = $row['idUsers'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];

        echo '<option value="'.$user_id.'">'.$f_name.' '.$l_name.'</option>';

    }
}

//Update mentor
function updatementor()
{
    global $db, $errors;
    $employee = e($_POST['empname']);
    $mentor = e($_POST['mentorSelect']);
    $user_check = "SELECT firstname, lastname FROM Users WHERE idUsers = $mentor ";
    $result = $db->query($user_check);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo '<script type="text/javascript">alert("Not a user");</script>';
        echo $user_check;
        array_push($errors, "Not a user");
    } else {
        $id = "SELECT idNewemployee FROM Newemployee WHERE idNewemployee = '$employee'";
        $id2 = "SELECT idUsers FROM Users WHERE idUsers = '$mentor' ";
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
    $mentor = e($_POST['mentorSelect']);
    $user_check = "SELECT idNewemployee, firstname, lastname FROM Newemployee WHERE idNewemployee = '$employee'";
    $result = $db->query($user_check);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        echo '<script type="text/javascript">alert("Not a user");</script>';
        echo $user_check;
        array_push($errors, "Not a user");
    } else {
        $id = "SELECT idNewemployee FROM Newemployee WHERE idNewemployee = '$employee'";
        $id2 = "SELECT idUsers FROM Users WHERE idUsers = '$mentor'";
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

if (isset($_POST['Assign'])) {
    addmentor();
}

if (isset($_POST['Updatemen'])) {
    updatementor();
}