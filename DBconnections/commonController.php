<?php
function overviewAll()
{
    global $db;

    if (!$db) {
        die("Feil i databasetilkobling:" . $db->connect_error);
    }
    //$userId = $_SESSION;
    $qry = "SELECT DISTINCT Newemployee.firstname, Newemployee.lastname, Newemployee.idNewemployee FROM Newemployee INNER JOIN Users_has_Newemployee ON Newemployee.idNewemployee = Users_has_Newemployee.Newemployee_idNewemployee";
    $res = mysqli_query($db, $qry);
    if (!$res) {
        echo '<script type="text/javascript">alert("Query failed");</script>';
    }


    while ($row = mysqli_fetch_assoc($res)) {
        $id_new = $row['idNewemployee'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];


        $article = ' <article class="h-card vcard person-card article-contact" role="article"><h3 title="Oversikt over sjekklister"  class="toggler-header article-contact-heading"> ';
        $article .= $f_name . " " . $l_name . " ";
        $article .= '</h3><div class="toggler-content"><form action="" method="post"><table><tr id="tableArt"><th id="tableArt">Oppgaver</th><th id="tableArt"></th></tr>';
        $qry2 = "SELECT Newemployee_idNewemployee, Checklist_idChecklist, checked FROM Newemployee_has_Checklist INNER JOIN Checklist ON idChecklist WHERE Checklist_idChecklist = idChecklist AND Newemployee_idNewemployee='$id_new'";
        $res2 = mysqli_query($db, $qry2);

        if (!$res2) {
            echo '<script type="text/javascript">alert("Tom resultat");</script>';
            die();
        }
        while ($row2 = mysqli_fetch_assoc($res2)) {
            $check_id = $row2['Checklist_idChecklist'];
            $checked = $row2['checked'];
            $emp_id = $row2['Newemployee_idNewemployee'];

            $qry3 = "SELECT checkpointsNO, idChecklist from Checklist WHERE idChecklist ='$check_id'";
            $res3 = mysqli_query($db, $qry3);
            $res4 = mysqli_fetch_assoc($res3);

            $article .= '
                                             <tr id="tableArt">
                                             <td id="tableArt">';
            $article .= " " . $res4['checkpointsNO'] . " ";
            $id_check = $res4['idChecklist'];
            $article .= '</td>';
            $article .= '<td height="30px"  id="tableArt">';
            if ($checked == 0) {
                $article .= '<input type="checkbox" class="checkbox" name="';
                $article .= $emp_id;
                $article .= '" value="';
                $article .= $checked;
                $article .= '" id="';
                $article .= $check_id;
                $article .= '" onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"/>';

            } else {
                $article .= '<input type="checkbox" class="checkbox" name="empty" checked   onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"';

                $article .= $checked;

                $article .= '">';

            }

            $article .= '</td>
                                            </tr>';

        }
        //$article.='<button type="submit">Submit</button>';
        $article .= '</table></form></div></article>';
        echo $article;

    }
}

function overviewAllENG()
{
    global $db;

    if (!$db) {
        die("Feil i databasetilkobling:" . $db->connect_error);
    }
    //$userId = $_SESSION;
    $qry = "SELECT DISTINCT Newemployee.firstname, Newemployee.lastname, Newemployee.idNewemployee FROM Newemployee INNER JOIN Users_has_Newemployee ON Newemployee.idNewemployee = Users_has_Newemployee.Newemployee_idNewemployee";
    $res = mysqli_query($db, $qry);
    if (!$res) {
        echo '<script type="text/javascript">alert("Query failed");</script>';
    }


    while ($row = mysqli_fetch_assoc($res)) {
        $id_new = $row['idNewemployee'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];


        $article = ' <article class="h-card vcard person-card article-contact" role="article"><h3 title="Overview over checklists"  class="toggler-header article-contact-heading"> ';
        $article .= $f_name . " " . $l_name . " ";
        $article .= '</h3><div class="toggler-content"><form action="" method="post"><table><tr><th>Tasks</th><th>Checkbox</th></tr>';
        $qry2 = "SELECT Newemployee_idNewemployee, Checklist_idChecklist, checked FROM Newemployee_has_Checklist INNER JOIN Checklist ON idChecklist WHERE Checklist_idChecklist = idChecklist AND Newemployee_idNewemployee='$id_new'";
        $res2 = mysqli_query($db, $qry2);

        if (!$res2) {
            echo '<script type="text/javascript">alert("Empty result");</script>';
            die();
        }
        while ($row2 = mysqli_fetch_assoc($res2)) {
            $check_id = $row2['Checklist_idChecklist'];
            $checked = $row2['checked'];
            $emp_id = $row2['Newemployee_idNewemployee'];

            $qry3 = "SELECT checkpointsEN, idChecklist from Checklist WHERE idChecklist ='$check_id'";
            $res3 = mysqli_query($db, $qry3);
            $res4 = mysqli_fetch_assoc($res3);

            $article .= '
                                             <tr>
                                             <td>';
            $article .= " " . $res4['checkpointsEN'] . " ";

            $article .= '</td>';
            $article .= '<td height="30px" >';
            if ($checked == 0) {
                $article .= '<input type="checkbox" class="checkbox" name="';
                $article .= $emp_id;
                $article .= '" value="';
                $article .= $checked;
                $article .= '" id="';
                $article .= $check_id;
                $article .= '" onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"/>';

            } else {
                $article .= '<input type="checkbox" class="checkbox" name="empty" checked   onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"';

                $article .= $checked;

                $article .= '">';

            }

            $article .= '</td>
                                            </tr>';

        }
        //$article.='<button type="submit">Submit</button>';
        $article .= '</table></form></div></article>';
        echo $article;

    }
}

function createChecklist()
{

    global $db, $errors;
    mysqli_autocommit($db, false);
    $firstname = e($_POST['firstname']);
    $lastname = e($_POST['lastname']);
    $workposition = e($_POST['workposition']);
    $international = e($_POST['international']);
    $startdate = e($_POST['startdate']);
    $responsibleLeader = e($_POST['responsibleLeader']);
    $responsibleHr = e($_POST['responsibleHr']);
    $responsibleMentor = e($_POST['responsibleMentor']);

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
            echo '<script type="text/javascript">alert("Feil"); </script>';
        } elseif ($db->affected_rows == 0) {
            echo '<script type="text/javascript">alert("Fungerte, men kjørte ikke"); </script>';
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
                    $query3 = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$responsibleLeader', '$idNewemployee') ";
                    $query4 = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$responsibleHr', '$idNewemployee') ";
                    $query5 = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$responsibleMentor', '$idNewemployee') ";

                    $res2 = mysqli_query($db, $query2);
                    $res3 = mysqli_query($db, $query3);
                    $res4 = mysqli_query($db, $query4);
                    $res5 = mysqli_query($db, $query5);

                    if (!$res2) {

                        echo '<script type="text/javascript">alert("Scriptet feilet");</script>';

                    } elseif ($db->affected_rows == 0) {
                        echo '<script type="text/javascript">alert("Scriptet fungerte, men kunne ikke gjøre oppgaven");</script>';

                    } else {
                        if ($i == ($num_rows - 1)) {
                            mysqli_commit($db);
                            echo '<script type="text/javascript">alert("Sjekkliste laget for vanlig nyansatt");</script>';
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
                    $query3 = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$responsibleLeader', '$idNewemployee') ";
                    $query4 = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$responsibleHr', '$idNewemployee') ";
                    $query5 = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$responsibleMentor', '$idNewemployee') ";

                    $res2 = mysqli_query($db, $query2);
                    $res3 = mysqli_query($db, $query3);
                    $res4 = mysqli_query($db, $query4);
                    $res5 = mysqli_query($db, $query5);

                    if (!$res2) {
                        echo $query2;
                        echo '<script type="text/javascript">alert("Scriptet fungerte ikke");</script>';
                    } elseif ($db->affected_rows == 0) {
                        echo '<script type="text/javascript">alert("Scriptet ble utført, men kunne ikke gjøre oppgaven ");</script>';
                    } else {
                        if ( $i == ( $num_rows - 1 ) ) {
                            mysqli_commit($db);
                            echo '<script type="text/javascript">alert("Sjekkliste laget for en internasjonal nyansatt");</script>';
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
                    $query3 = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$responsibleLeader', '$idNewemployee') ";
                    $query4 = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$responsibleHr', '$idNewemployee') ";
                    $query5 = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$responsibleMentor', '$idNewemployee') ";

                    $res2 = mysqli_query($db, $query2);
                    $res3 = mysqli_query($db, $query3);
                    $res4 = mysqli_query($db, $query4);
                    $res5 = mysqli_query($db, $query5);

                    if (!$res2) {
                        echo $query2;
                        echo '<script type="text/javascript">alert("Scriptet er feil");</script>';
                    } elseif ($db->affected_rows == 0) {
                        echo '<script type="text/javascript">alert("Sjekklisten fikk ikke til å sette inn leder");</script>';
                    } else {
                        if ( $i == ( $num_rows - 1 ) ) {
                            mysqli_commit($db);
                            echo '<script type="text/javascript">alert("Sjekkliste laget for en ny leder");</script>';
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
                    $query3 = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$responsibleLeader', '$idNewemployee') ";
                    $query4 = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$responsibleHr', '$idNewemployee') ";
                    $query5 = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$responsibleMentor', '$idNewemployee') ";

                    $res2 = mysqli_query($db, $query2);
                    $res3 = mysqli_query($db, $query3);
                    $res4 = mysqli_query($db, $query4);
                    $res5 = mysqli_query($db, $query5);

                    if (!$res2) {
                        echo $query2;
                        echo '<script type="text/javascript">alert("Misslyket Script");</script>';
                    }
                    elseif ($db->affected_rows == 0) {
                        echo '<script type="text/javascript">alert("Scriptet ble kjørt, men fikk ikke lagt til");</script>';
                    }
                    else {
                        if ($i == ($num_rows - 1)) {
                            mysqli_commit($db);
                            echo '<script type="text/javascript">alert("Sjekkliste laget for en internasjonal nyleder");</script>';
                        }

                    }

                    $i++;    }
            }
        }
    }
}

function selectMentor()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'mentor'") or die(mysqli_error());
    echo "<select name=\"responsibleMentor\" class=\"field comment-alerts\" id='choose2'>";
    echo '<option value=""></option>';

    while ($row = $query->fetch_assoc()) {

        unset($f_name, $l_name);
        $user_id = $row['idUsers'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];

        echo '<option value="'.$user_id.'">'.$f_name.' '.$l_name.'</option>';

    }
}

function selectLeader()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'leader'") or die(mysqli_error());
    echo "<select name=\"responsibleLeader\" class=\"field comment-alerts\" id='choose2'>";
    echo '<option value=""></option>';

    while ($row = $query->fetch_assoc()) {

        unset($f_name, $l_name);
        $user_id = $row['idUsers'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];

        echo '<option value="'.$user_id.'">'.$f_name.' '.$l_name.'</option>';

    }
}

function selectHr()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'HR'") or die(mysqli_error());
    echo "<select name=\"responsibleHr\" class=\"field comment-alerts\" id='choose2'>";
    echo '<option value=""></option>';

    while ($row = $query->fetch_assoc()) {

        unset($f_name, $l_name);
        $user_id = $row['idUsers'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];

        echo '<option value="'.$user_id.'">'.$f_name.' '.$l_name.'</option>';

    }
}

function employeeSelect()
{
    global  $db;
    $query = mysqli_query($db, "SELECT idNewemployee, firstname, lastname FROM Newemployee") or die(mysqli_error());
    echo "<select name=\"empname\" class=\"field comment-alerts\" id='choose2'>";
    echo '<option value=""></option>';

    while ($row = $query->fetch_assoc()){

        unset($f_name, $l_name);
        $employee_id = $row['idNewemployee'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];

        echo  '<option value="'.$employee_id.'">'.$f_name.' '.$l_name.'</option>';
    }
    echo  "</select>";
}

function mentorSelect()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'mentor'") or die(mysqli_error());
    echo "<select name=\"mentorSelect\" class=\"field comment-alerts\" id='choose2'>";
    echo '<option value=""></option>';

    while ($row = $query->fetch_assoc()) {

        unset($f_name, $l_name);
        $user_id = $row['idUsers'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];

        echo '<option value="'.$user_id.'">'.$f_name.' '.$l_name.'</option>';

    }
}

function leaderSelect()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'leader'") or die(mysqli_error());
    echo "<select name=\"leaderSelect\" class=\"field comment-alerts\" id='choose2' >";
    echo '<option value=""></option>';

    while ($row = $query->fetch_assoc()) {

        unset($f_name, $l_name);
        $user_id = $row['idUsers'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];

        echo '<option value="'.$user_id.'">'.$f_name.' '.$l_name.'</option>';

    }
}

function hrSelect()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'HR'") or die(mysqli_error());
    echo "<select name=\"hrSelect\" class=\"field comment-alerts\" id='choose2' >";
    echo '<option value=""></option>';

    while ($row = $query->fetch_assoc()) {

        unset($f_name, $l_name);
        $user_id = $row['idUsers'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];

        echo '<option value="'.$user_id.'">'.$f_name.' '.$l_name.'</option>';

    }
}

function addMentor()
{
    global $db, $username, $errors;
    mysqli_autocommit($db, false);
    $employee = e($_POST['empname']);
    $mentor = e($_POST['mentorSelect']);
    $sql = "SELECT idNewemployee, firstname, lastname FROM Newemployee WHERE idNewemployee = '$employee'";
    $result = $db->query($sql);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        echo '<script type="text/javascript">alert("Not a user");</script>';
        echo $sql;
        array_push($errors, "Not a user");
    } else {
        $sql2 = "SELECT idNewemployee FROM Newemployee WHERE idNewemployee = '$employee'";
        $sql3 = "SELECT idUsers FROM Users WHERE idUsers = '$mentor'";
        $resultId = $db->query($sql2);

        if (!$resultId) {
            echo '<script type="text/javascript">alert("Wrong id");</script>';

        } else {
            while ($row = mysqli_fetch_assoc($resultId)) {
                $resultId2 = $db->query($sql3);
                $idNewemployee = $row['idNewemployee'];
                $sql4 = "Select Newemployee_idNewemployee FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$idNewemployee' ";
                $testresult = $db->query($sql4);
                if (!$resultId2) {
                    echo '<script type="text/javascript">alert("User and id dont match");</script>';
                } else {
                    while ($row = mysqli_fetch_assoc($resultId2)) {
                        $idUsers = $row['idUsers'];

                        $query = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$idUsers', '$idNewemployee') ";
                        $res = mysqli_query($db, $query);
                        if (!$res) {

                        } elseif ($db->affected_rows == 0) {
                            echo '<script type="text/javascript">alert("Something failed");</script>';
                        } else {
                            mysqli_commit($db);
                            echo '<script type="text/javascript">alert("Mentor assigned");</script>';
                        }
                    }
                }
            }
        }
    }
}

function addLeader()
{
    global $db, $username, $errors;
    mysqli_autocommit($db, false);
    $employee = e($_POST['empname']);
    $leader = e($_POST['leaderSelect']);
    $sql = "SELECT idNewemployee, firstname, lastname FROM Newemployee WHERE idNewemployee = '$employee'";
    $result = $db->query($sql);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        echo '<script type="text/javascript">alert("Not a user");</script>';
        echo $sql;
        array_push($errors, "Not a user");
    } else {
        $sql2 = "SELECT idNewemployee FROM Newemployee WHERE idNewemployee = '$employee'";
        $sql3 = "SELECT idUsers FROM Users WHERE idUsers = '$leader'";
        $resultId = $db->query($sql2);

        if (!$resultId) {
            echo '<script type="text/javascript">alert("Wrong id");</script>';

        } else {
            while ($row = mysqli_fetch_assoc($resultId)) {
                $resultId2 = $db->query($sql3);
                $idNewemployee = $row['idNewemployee'];
                $sql4 = "Select Newemployee_idNewemployee FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$idNewemployee' ";
                $testresult = $db->query($sql4);
                if (!$resultId2) {
                    echo '<script type="text/javascript">alert("User and id dont match");</script>';
                } else {
                    while ($row = mysqli_fetch_assoc($resultId2)) {
                        $idUsers = $row['idUsers'];

                        $query = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$idUsers', '$idNewemployee') ";
                        $res = mysqli_query($db, $query);
                        if (!$res) {

                        } elseif ($db->affected_rows == 0) {
                            echo '<script type="text/javascript">alert("Something failed");</script>';
                        } else {
                            mysqli_commit($db);
                            echo '<script type="text/javascript">alert("Leader assigned");</script>';
                        }
                    }
                }
            }
        }
    }
}

function updateMentor()
{
    global $db, $errors;
    mysqli_autocommit($db, false);
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

                                        mysqli_commit($db);
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

function updateLeader()
{
    global $db, $errors;
    mysqli_autocommit($db, false);
    $employee = e($_POST['empname']);
    $leader = e($_POST['leaderSelect']);
    $user_check = "SELECT firstname, lastname FROM Users WHERE idUsers = $leader ";
    $result = $db->query($user_check);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo '<script type="text/javascript">alert("Not a user");</script>';
        echo $user_check;
        array_push($errors, "Not a user");
    } else {
        $id = "SELECT idNewemployee FROM Newemployee WHERE idNewemployee = '$employee'";
        $id2 = "SELECT idUsers FROM Users WHERE idUsers = '$leader' ";
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
                                $Userid = $row2['Users_idUsers'];
                                if ($Userid == $id3) {
                                    echo '<script type="text/javascript">alert("same leader error");</script>';
                                }
                                else {
                                    $query = "UPDATE Users_has_Newemployee SET Users_idUsers= '$id3' WHERE Newemployee_idNewemployee='$id4'";
                                    $result = $db->query($query);

                                    if ($result === TRUE) {

                                        mysqli_commit($db);
                                        echo '<script type="text/javascript">alert("Leader edit worked");</script>';

                                    } else {
                                        echo '<script type="text/javascript">alert("Something wrong happened");</script>';

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

function addHr()
{
    global $db, $username, $errors;
    mysqli_autocommit($db, false);
    $employee = e($_POST['empname']);
    $hr = e($_POST['hrSelect']);
    $sql = "SELECT idNewemployee, firstname, lastname FROM Newemployee WHERE idNewemployee = '$employee'";
    $result = $db->query($sql);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        echo '<script type="text/javascript">alert("Not a user");</script>';
        echo $sql;
        array_push($errors, "Not a user");
    } else {
        $sql2 = "SELECT idNewemployee FROM Newemployee WHERE idNewemployee = '$employee'";
        $sql3 = "SELECT idUsers FROM Users WHERE idUsers = '$hr'";
        $resultId = $db->query($sql2);

        if (!$resultId) {
            echo '<script type="text/javascript">alert("Wrong id");</script>';

        } else {
            while ($row = mysqli_fetch_assoc($resultId)) {
                $resultId2 = $db->query($sql3);
                $idNewemployee = $row['idNewemployee'];
                $sql4 = "Select Newemployee_idNewemployee FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$idNewemployee' ";
                $testresult = $db->query($sql4);
                if (!$resultId2) {
                    echo '<script type="text/javascript">alert("User and id dont match");</script>';
                } else {
                    while ($row = mysqli_fetch_assoc($resultId2)) {
                        $idUsers = $row['idUsers'];

                        $query = "INSERT INTO Users_has_Newemployee (Users_idUsers, Newemployee_idNewemployee)
                                VALUES ('$idUsers', '$idNewemployee') ";
                        $res = mysqli_query($db, $query);
                        if (!$res) {

                        } elseif ($db->affected_rows == 0) {
                            echo '<script type="text/javascript">alert("Something failed");</script>';
                        } else {
                            mysqli_commit($db);
                            echo '<script type="text/javascript">alert("HR-employee assigned");</script>';
                        }
                    }
                }
            }
        }
    }
}

function updateHr()
{
    global $db, $errors;
    mysqli_autocommit($db, false);
    $employee = e($_POST['empname']);
    $leader = e($_POST['leaderSelect']);
    $user_check = "SELECT firstname, lastname FROM Users WHERE idUsers = $leader ";
    $result = $db->query($user_check);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo '<script type="text/javascript">alert("Not a user");</script>';
        echo $user_check;
        array_push($errors, "Not a user");
    } else {
        $id = "SELECT idNewemployee FROM Newemployee WHERE idNewemployee = '$employee'";
        $id2 = "SELECT idUsers FROM Users WHERE idUsers = '$leader' ";
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
                                    echo '<script type="text/javascript">alert("same leader error");</script>';
                                }
                                else {
                                    $query = "UPDATE Users_has_Newemployee SET Users_idUsers= '$id3' WHERE Newemployee_idNewemployee='$id4'";
                                    $result = $db->query($query);

                                    if ($result === TRUE) {

                                        mysqli_commit($db);
                                        echo '<script type="text/javascript">alert("Leader edit worked");</script>';

                                    } else {
                                        echo '<script type="text/javascript">alert("Something wrong happened");</script>';

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

function searchEmployeeConnected()
{
    if(isset($_POST["searchConnected"]) && $_POST['searchConnectedUser'] == 'leader') {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForEmployee = e($_POST["searchForConnected"]);
        $sql = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%'";
        $result = $db->query($sql);

        if ($result) {


            echo "<tr><th>Fornavn</th>";
            echo "<th>Etternavn</th>";
            echo "<th>Arbeidstilling</th>";
            echo "<th>Internasjonal</th>";
            echo "<th>Startdato</th>";
            echo "<th>Leder</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                $id = e($row['idNewemployee']);
                $f_name = e($row["firstname"]);
                $l_name = e($row["lastname"]);
                $workposition = e($row["workposition"]);
                $international = e($row["international"]);
                $startdate = e($row["startdate"]);

                $sqa = "SELECT Newemployee_idNewemployee FROM Users_has_Newemployee WHERE  Newemployee_idNewemployee = $id";

                $result2 = $db->query($sqa);
                if($result2) {
                    if ($db->affected_rows == 0) {
                        echo "<tr>";
                        echo "<td>" . $f_name . "</td>";
                        echo "<td>" . $l_name . "</td>";
                        echo "<td>" . $workposition . "</td>";
                        echo "<td>" . $international . "</td>";
                        echo "<td>" . $startdate . "</td>";
                        echo "<td>" . "Ingen Leder" . "</td>";
                        echo "</tr>";

                    } else {

                        $sqb = "SELECT firstname , lastname FROM Users WHERE usertype = 'leader' AND idUsers IN (SELECT Users_idUsers FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$id')";
                        $result3 = $db->query($sqb);
                        if ($result3) {
                            while ($row2 = mysqli_fetch_assoc($result3)) {
                                $f_name = e($row["firstname"]);
                                $l_name = e($row["lastname"]);
                                $workposition = e($row["workposition"]);
                                $international = e($row["international"]);
                                $startdate = e($row["startdate"]);
                                $name = e($row2['firstname'] . " ". $row2['lastname']);
                                echo "<tr>";
                                echo "<td>" . $f_name . "</td>";
                                echo "<td>" . $l_name . "</td>";
                                echo "<td>" . $workposition . "</td>";
                                echo "<td>" . $international . "</td>";
                                echo "<td>" . $startdate . "</td>";
                                echo "<td>" . $name . "</td>";
                                echo "</tr>";
                            }
                        }


                    }
                }
            }echo "</table>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }

    if(isset($_POST["searchConnected"]) && $_POST['searchConnectedUser'] == 'mentor') {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForEmployee = e($_POST["searchForConnected"]);
        $sql = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%'";
        $result = $db->query($sql);

        if ($result) {


            echo "<tr><th>Fornavn</th>";
            echo "<th>Etternavn</th>";
            echo "<th>Arbeidstilling</th>";
            echo "<th>Internasjonal</th>";
            echo "<th>Startdato</th>";
            echo "<th>Fadder</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                $id = e($row['idNewemployee']);
                $f_name = e($row["firstname"]);
                $l_name = e($row["lastname"]);
                $workposition = e($row["workposition"]);
                $international = e($row["international"]);
                $startdate = e($row["startdate"]);

                $sqa = "SELECT Newemployee_idNewemployee FROM Users_has_Newemployee WHERE  Newemployee_idNewemployee = $id";

                $result2 = $db->query($sqa);
                if($result2) {
                    if ($db->affected_rows == 0) {
                        echo "<tr>";
                        echo "<td>" . $f_name . "</td>";
                        echo "<td>" . $l_name . "</td>";
                        echo "<td>" . $workposition . "</td>";
                        echo "<td>" . $international . "</td>";
                        echo "<td>" . $startdate . "</td>";
                        echo "<td>" . "Ingen Fadder" . "</td>";
                        echo "</tr>";

                    } else {

                        $sqb = "SELECT firstname , lastname FROM Users WHERE usertype = 'mentor' AND idUsers IN (SELECT Users_idUsers FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$id')";
                        $result3 = $db->query($sqb);
                        if ($result3) {
                            while ($row2 = mysqli_fetch_assoc($result3)) {
                                $f_name = e($row["firstname"]);
                                $l_name = e($row["lastname"]);
                                $workposition = e($row["workposition"]);
                                $international = e($row["international"]);
                                $name = e($row2['firstname'] . " ". $row2['lastname']);
                                echo "<tr>";
                                echo "<td>" . $f_name . "</td>";
                                echo "<td>" . $l_name . "</td>";
                                echo "<td>" . $workposition . "</td>";
                                echo "<td>" . $international . "</td>";
                                echo "<td>" . $startdate . "</td>";
                                echo "<td>" . $name . "</td>";
                                echo "</tr>";
                            }
                        }


                    }
                }
            }echo "</table>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }

    if(isset($_POST["searchConnected"]) && $_POST['searchConnectedUser'] == 'HR') {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForEmployee = e($_POST["searchForConnected"]);
        $sql = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%'";
        $result = $db->query($sql);

        if ($result) {


            echo "<tr><th>Fornavn</th>";
            echo "<th>Etternavn</th>";
            echo "<th>Arbeidstilling</th>";
            echo "<th>Internasjonal</th>";
            echo "<th>Startdato</th>";
            echo "<th>HR-ansatt</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                $id = e($row['idNewemployee']);
                $f_name = e($row["firstname"]);
                $l_name = e($row["lastname"]);
                $workposition = e($row["workposition"]);
                $international = e($row["international"]);
                $startdate = e($row["startdate"]);

                $sqa = "SELECT Newemployee_idNewemployee FROM Users_has_Newemployee WHERE  Newemployee_idNewemployee = $id";

                $result2 = $db->query($sqa);
                if($result2) {
                    if ($db->affected_rows == 0) {
                        echo "<tr>";
                        echo "<td>" . $f_name . "</td>";
                        echo "<td>" . $l_name . "</td>";
                        echo "<td>" . $workposition . "</td>";
                        echo "<td>" . $international . "</td>";
                        echo "<td>" . $startdate . "</td>";
                        echo "<td>" . "Ingen HR-ansatt" . "</td>";
                        echo "</tr>";

                    } else {

                        $sqb = "SELECT firstname , lastname FROM Users WHERE usertype = 'HR' AND idUsers IN (SELECT Users_idUsers FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$id')";
                        $result3 = $db->query($sqb);
                        if ($result3) {
                            while ($row2 = mysqli_fetch_assoc($result3)) {
                                $f_name = e($row["firstname"]);
                                $l_name = e($row["lastname"]);
                                $workposition = e($row["workposition"]);
                                $international = e($row["international"]);
                                $name = e($row2['firstname'] . " ". $row2['lastname']);
                                echo "<tr>";
                                echo "<td>" . $f_name . "</td>";
                                echo "<td>" . $l_name . "</td>";
                                echo "<td>" . $workposition . "</td>";
                                echo "<td>" . $international . "</td>";
                                echo "<td>" . $startdate . "</td>";
                                echo "<td>" . $name . "</td>";
                                echo "</tr>";
                            }
                        }


                    }
                }
            }echo "</table>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }

}

function searchEmployee()
{
    if (isset($_POST['searcF'])) {

        global $db;

        if (!$db) {
            die("Feil i databasetilkobling:" . $db->connect_error);
        }

        $searchForEmployee = e($_POST["searchFr"]);
        $qry = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%'";
        $res = mysqli_query($db, $qry);
        if (!$res) {
            echo '<script type="text/javascript">alert("Query failed");</script>';
        }


        while ($row = mysqli_fetch_assoc($res)) {
            $id_new = $row['idNewemployee'];
            $f_name = $row['firstname'];
            $l_name = $row['lastname'];


            $article = '<article class="h-card vcard person-card article-contact" role="article" id="colorWhite"><h3 title="Oversikt over sjekklister"  class="toggler-header article-contact-heading"> ';
            $article .= $f_name . " " . $l_name . " ";
            $article .= '</h3><div class="toggler-content"><form action="" method="post"><table><tr><th>Oppgave</th><th>Sjekkboks</th></tr>';
            $qry2 = "SELECT Newemployee_idNewemployee, Checklist_idChecklist, checked FROM Newemployee_has_Checklist INNER JOIN Checklist ON idChecklist WHERE Checklist_idChecklist = idChecklist AND Newemployee_idNewemployee='$id_new'";
            $res2 = mysqli_query($db, $qry2);

            if (!$res2) {
                echo '<script type="text/javascript">alert("Tom resultat");</script>';
                die();
            }
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $check_id = $row2['Checklist_idChecklist'];
                $checked = $row2['checked'];
                $emp_id = $row2['Newemployee_idNewemployee'];

                $qry3 = "SELECT checkpointsNO, idChecklist from Checklist WHERE idChecklist ='$check_id'";
                $res3 = mysqli_query($db, $qry3);
                $res4 = mysqli_fetch_assoc($res3);

                $article .= '
                                             <tr>
                                             <td>';
                $article .= " " . $res4['checkpointsNO'] . " ";
                $id_check = $res4['idChecklist'];
                $article .= '</td>';
                $article .= '<td height="30px" >';
                if ($checked == 0) {
                    $article .= '<input type="checkbox" class="checkbox" name="';
                    $article .= $emp_id;
                    $article .= '" value="';
                    $article .= $checked;
                    $article .= '" id="';
                    $article .= $check_id;
                    $article .= '" onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"/>';

                } else {
                    $article .= '<input type="checkbox" class="checkbox" name="empty" checked   onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"';

                    $article .= $checked;

                    $article .= '">';

                }

                $article .= '</td></tr>';

            }
            //$article.='<button type="submit">Submit</button>';
            $article .= '</table></form></div></article>';
            echo $article;

        }

    }

}

if (isset($_POST['createCheckList'])) {
    createChecklist();
}

if (isset($_POST['assignMentor'])) {
    addMentor();
}

if (isset($_POST['assignLeader'])) {
    addLeader();
}

if (isset($_POST['assignHr'])) {
    addHr();
}

if (isset($_POST['updateMentor'])) {
    updateMentor();
}

if (isset($_POST['updateLeader'])) {
    updateLeader();
}

if (isset($_POST['updateHr'])) {
    updateHr();
}