<?php
//Funksjon som viser alle ansatte med sjekkliste
function overviewAll()
{
    global $db;

    if (!$db) {
        die("Feil i databasetilkobling:" . $db->connect_error);
    }
    //$userId = $_SESSION;
    $qry = "SELECT DISTINCT Newemployee.firstname, Newemployee.lastname, Newemployee.idNewemployee FROM Newemployee INNER JOIN Users_has_Newemployee ON Newemployee.idNewemployee = Users_has_Newemployee.Newemployee_idNewemployee ORDER BY Newemployee.lastname, Newemployee.firstname";
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

//Funksjon som viser alle ansatte med sjekkliste i engelsk versjon
function overviewAllENG()
{
    global $db;

    if (!$db) {
        die("Feil i databasetilkobling:" . $db->connect_error);
    }
    //$userId = $_SESSION;
    $qry = "SELECT DISTINCT Newemployee.firstname, Newemployee.lastname, Newemployee.idNewemployee FROM Newemployee INNER JOIN Users_has_Newemployee ON Newemployee.idNewemployee = Users_has_Newemployee.Newemployee_idNewemployee ORDER BY Newemployee.lastname, Newemployee.firstname";
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

//Funksjon som oppretter ny ansatt med sjekkliste
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

//Funksjon som oppretter ny ansatt med sjekkliste i engelsk versjon
function createChecklistEN()
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
            echo '<script type="text/javascript">alert("Wrong"); </script>';
        } elseif ($db->affected_rows == 0) {
            echo '<script type="text/javascript">alert("Worked, but didnt execute properly"); </script>';
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

                        echo '<script type="text/javascript">alert("The script failed");</script>';

                    } elseif ($db->affected_rows == 0) {
                        echo '<script type="text/javascript">alert("The script worked, but couldnt perform its task");</script>';

                    } else {
                        if ($i == ($num_rows - 1)) {
                            mysqli_commit($db);
                            echo '<script type="text/javascript">alert("Checklist created for a regular employee");</script>';
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
                        echo '<script type="text/javascript">alert("The script failed");</script>';
                    } elseif ($db->affected_rows == 0) {
                        echo '<script type="text/javascript">alert("The script worked, but couldnt perform its task ");</script>';
                    } else {
                        if ( $i == ( $num_rows - 1 ) ) {
                            mysqli_commit($db);
                            echo '<script type="text/javascript">alert("Checklist created for a international employee");</script>';
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
                        echo '<script type="text/javascript">alert("The script is wrong");</script>';
                    } elseif ($db->affected_rows == 0) {
                        echo '<script type="text/javascript">alert("The script worked, but couldnt perform its task);</script>';
                    } else {
                        if ( $i == ( $num_rows - 1 ) ) {
                            mysqli_commit($db);
                            echo '<script type="text/javascript">alert("Checklist created for a new leader");</script>';
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
                        echo '<script type="text/javascript">alert("Failed script");</script>';
                    }
                    elseif ($db->affected_rows == 0) {
                        echo '<script type="text/javascript">alert("The script was executed, but couldnt do its task");</script>';
                    }
                    else {
                        if ($i == ($num_rows - 1)) {
                            mysqli_commit($db);
                            echo '<script type="text/javascript">alert("Checklist created for a new international leader");</script>';
                        }

                    }

                    $i++;    }
            }
        }
    }
}

//Funksjon som lar deg velge i en liste over alle brukertyper 'mentor'
function selectMentor()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'mentor' ORDER BY Users.lastname, Users.firstname") or die(mysqli_error());
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

function MentorDel()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'mentor' ORDER BY Users.lastname, Users.firstname") or die(mysqli_error());
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

//Funksjon som lar deg velge i en liste over alle brukertyper 'leader'
function selectLeader()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'leader' ORDER BY Users.lastname, Users.firstname") or die(mysqli_error());
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

//Funksjon som lar deg velge i en liste over alle brukertyper 'HR'
function selectHr()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'HR' ORDER BY Users.lastname, Users.firstname") or die(mysqli_error());
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

//Funksjon som lar deg velge i en liste over alle ansatte
function employeeSelect()
{
    global  $db;
    $query = mysqli_query($db, "SELECT idNewemployee, firstname, lastname FROM Newemployee ORDER BY Newemployee.lastname, Newemployee.firstname") or die(mysqli_error());
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

//Funksjon som lar deg velge i en liste over alle brukertyper 'mentor'
function mentorSelect()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'mentor' ORDER BY Users.lastname, Users.firstname") or die(mysqli_error());
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

//Funksjon som lar deg velge i en liste over alle brukertyper 'leader'
function leaderSelect()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'leader' ORDER BY Users.lastname, Users.firstname") or die(mysqli_error());
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

//Funksjon som lar deg velge i en liste over alle brukertyper 'HR'
function hrSelect()
{
    global $db;
    $query = mysqli_query($db, "SELECT idUsers, firstname, lastname FROM Users where usertype= 'HR' ORDER BY Users.lastname, Users.firstname") or die(mysqli_error());
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

//Funksjon som knytter en fadder til en ansatt
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

function deleteMentor(){
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
                    while ($row2 = mysqli_fetch_assoc($resultId2)) {
                        $idUsers = $row2['idUsers'];

                        $query = "DELETE FROM Users_has_Newemployee WHERE Users_idUsers = '" . $idUsers . "'  AND Newemployee_idNewemployee = '" . $idNewemployee ."'";
                        $result = mysqli_query($db, $query);
                       
                        if (!$result) {

                                echo '<script type="text/javascript">alert("Cant delete");</script>';
                            }

                        }
                    if (mysqli_affected_rows($db) > 0) {
                        echo '<script type="text/javascript">alert("Mentor assiginging deleted");</script>';
                        mysqli_commit($db);
                    }
                }
            }
        }
    }
}
//Funksjon som knytter en leder til en ansatt
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

//Funksjon som ikke er i bruk, oppdaterer fra en fadder til en annen
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

//Funksjon som ikke er i bruk, oppdaterer fra en leder til en annen
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

//Funksjon som knytter en hr-ansatt til en ansatt
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

//Funksjon som ikke er i bruk, oppdaterer fra en hr-ansatt til en annen
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

//Funksjon som søker etter om en ansatt er knyttet til noen eller ikke
function searchEmployeeConnected()
{
    if(isset($_POST["searchConnected"]) && $_POST['searchConnectedUser'] == 'leader') {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForEmployee = e($_POST["searchForConnected"]);
        $sql = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%' ORDER BY Newemployee.lastname, Newemployee.firstname";
        $result = $db->query($sql);

        if ($result) {


            echo "<tr><th>Valg</th>";
            echo "<th>Fornavn</th>";
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
                        echo "<td></td>";
                        echo "<td>" . $f_name . "</td>";
                        echo "<td>" . $l_name . "</td>";
                        echo "<td>" . $workposition . "</td>";
                        echo "<td>" . $international . "</td>";
                        echo "<td>" . $startdate . "</td>";
                        echo "<td>" . "Ingen Leder" . "</td>";
                        echo "</tr>";

                    } else {

                        $sqb = "SELECT idUsers, firstname , lastname FROM Users WHERE usertype = 'leader' AND idUsers IN (SELECT Users_idUsers FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$id')";
                        $result3 = $db->query($sqb);
                        if ($result3) {
                            while ($row2 = mysqli_fetch_assoc($result3)) {

                                $id = e($row['idNewemployee']);
                                $f_name = e($row["firstname"]);
                                $l_name = e($row["lastname"]);
                                $workposition = e($row["workposition"]);
                                $international = e($row["international"]);
                                $startdate = e($row["startdate"]);
                                $newUserId = e($row2["idUsers"]);
                                $name = e($row2['firstname'] . " ". $row2['lastname']);

                                echo "<tr>";
                                echo "<td id='searchForDeleteUser'><input type='radio' class='radio-button-delete-user' name='DeleteConnectionValue' value='$newUserId'/></td>";
                                echo "<td id='searchForDeleteUser'><input type='hidden' name='DeleteValue' value='" . $id . "' />" . $f_name . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $l_name . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $workposition . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $international . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $startdate . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $name . "</td>";
                                echo "</tr>";
                            }

                        }


                    }
                }
            }echo "</table><button type='submit' class='btn btn-primary' name='DeleteConnection' >Slett tilknytning</button></div></form>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }

    if(isset($_POST["searchConnected"]) && $_POST['searchConnectedUser'] == 'mentor') {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForEmployee = e($_POST["searchForConnected"]);
        $sql = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%' ORDER BY Newemployee.lastname, Newemployee.firstname";
        $result = $db->query($sql);

        if ($result) {


            echo "<tr><th>Valg</th>";
            echo "<th>Fornavn</th>";
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
                        echo "<td></td>";
                        echo "<td>" . $f_name . "</td>";
                        echo "<td>" . $l_name . "</td>";
                        echo "<td>" . $workposition . "</td>";
                        echo "<td>" . $international . "</td>";
                        echo "<td>" . $startdate . "</td>";
                        echo "<td>" . "Ingen Fadder" . "</td>";
                        echo "</tr>";

                    } else {

                        $sqb = "SELECT idUsers, firstname , lastname FROM Users WHERE usertype = 'mentor' AND idUsers IN (SELECT Users_idUsers FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$id')";
                        $result3 = $db->query($sqb);
                        if ($result3) {
                            while ($row2 = mysqli_fetch_assoc($result3)) {
                                $id = e($row['idNewemployee']);
                                $f_name = e($row["firstname"]);
                                $l_name = e($row["lastname"]);
                                $workposition = e($row["workposition"]);
                                $international = e($row["international"]);
                                $newUserId = $row2["idUsers"];
                                $name = e($row2['firstname'] . " ". $row2['lastname']);

                                echo "<tr>";
                                echo "<td id='searchForDeleteUser'><input type='radio' class='radio-button-delete-user' name='DeleteConnectionValue' value='$newUserId'/></td>";
                                echo "<td id='searchForDeleteUser'><input type='hidden' name='DeleteValue' value='" . $id . "' />" . $f_name . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $l_name . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $workposition . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $international . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $startdate . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $name . "</td>";
                                echo "</tr>";
                            }
                        }


                    }
                }
            }echo "</table><button type='submit' class='btn btn-primary' name='DeleteConnection' >Slett tilknytning</button></div></form>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }

    if(isset($_POST["searchConnected"]) && $_POST['searchConnectedUser'] == 'HR') {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForEmployee = e($_POST["searchForConnected"]);
        $sql = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%' ORDER BY Newemployee.lastname, Newemployee.firstname";
        $result = $db->query($sql);

        if ($result) {


            echo "<tr><th>Valg</th>";
            echo "<th>Fornavn</th>";
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
                        echo "<td></td>";
                        echo "<td>" . $f_name . "</td>";
                        echo "<td>" . $l_name . "</td>";
                        echo "<td>" . $workposition . "</td>";
                        echo "<td>" . $international . "</td>";
                        echo "<td>" . $startdate . "</td>";
                        echo "<td>" . "Ingen HR-ansatt" . "</td>";
                        echo "</tr>";

                    } else {

                        $sqb = "SELECT idUsers, firstname , lastname FROM Users WHERE usertype = 'HR' AND idUsers IN (SELECT Users_idUsers FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$id')";
                        $result3 = $db->query($sqb);
                        if ($result3) {
                            while ($row2 = mysqli_fetch_assoc($result3)) {
                                $id = e($row['idNewemployee']);
                                $f_name = e($row["firstname"]);
                                $l_name = e($row["lastname"]);
                                $workposition = e($row["workposition"]);
                                $international = e($row["international"]);
                                $newUserId = $row2["idUsers"];
                                $name = e($row2['firstname'] . " ". $row2['lastname']);
                                echo "<tr>";
                                echo "<td id='searchForDeleteUser'><input type='radio' class='radio-button-delete-user' name='DeleteConnectionValue' value='$newUserId'/></td>";
                                echo "<td id='searchForDeleteUser'><input type='hidden' name='DeleteValue' value='" . $id . "' />" . $f_name . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $l_name . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $workposition . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $international . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $startdate . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $name . "</td>";
                                echo "</tr>";
                            }
                        }


                    }
                }
            }echo "</table><button type='submit' class='btn btn-primary' name='DeleteConnection' >Slett tilknytning</button></div></form>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }
}

function deleteConnection()
{
    if (isset($_POST["DeleteConnection"])) {

        global $db, $errors;
        mysqli_autocommit($db, false);
        $idUsers2 = e($_POST["DeleteConnectionValue"]);
        $idEmployee = e($_POST['DeleteValue']);


        $sql2 = "DELETE FROM Users_has_Newemployee WHERE Users_idUsers = '" . $idUsers2 . "' AND Newemployee_idNewemployee = '" . $idEmployee . "'";

        $result3 = mysqli_query($db, $sql2);

        if (!$result3) {

            if (mysqli_affected_rows($db) > 0) {
                echo '<script type="text/javascript">alert("Users_has_Newemployee er slettet");</script>';
            } else {
                echo '<script type="text/javascript">alert("Finner ikke Users_has_Newemployee");</script>';
            }
        }
        mysqli_commit($db);
    }
}

//Funksjon som søker etter om en ansatt er knyttet til noen eller ikke
function searchEmployeeConnectedEng()
{
    if(isset($_POST["searchConnected"]) && $_POST['searchConnectedUS'] == 'leader') {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForEmployee = e($_POST["searchForConnect"]);
        $sql = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%' ORDER BY Newemployee.lastname, Newemployee.firstname";
        $result = $db->query($sql);

        if ($result) {


            echo "<tr><th>Choose</th>";
            echo "<th>Firstname</th>";
            echo "<th>Surname</th>";
            echo "<th>Workposition</th>";
            echo "<th>International</th>";
            echo "<th>Startdate</th>";
            echo "<th>Leader</th></tr>";

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
                        echo "<td></td>";
                        echo "<td>" . $f_name . "</td>";
                        echo "<td>" . $l_name . "</td>";
                        echo "<td>" . $workposition . "</td>";
                        echo "<td>" . $international . "</td>";
                        echo "<td>" . $startdate . "</td>";
                        echo "<td>" . "No  Leader responsible" . "</td>";
                        echo "</tr>";

                    } else {

                        $sqb = "SELECT idUsers, firstname , lastname FROM Users WHERE usertype = 'leader' AND idUsers IN (SELECT Users_idUsers FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$id')";
                        $result3 = $db->query($sqb);
                        if ($result3) {
                            while ($row2 = mysqli_fetch_assoc($result3)) {
                                $id = e($row['idNewemployee']);
                                $f_name = e($row["firstname"]);
                                $l_name = e($row["lastname"]);
                                $workposition = e($row["workposition"]);
                                $international = e($row["international"]);
                                $startdate = e($row["startdate"]);
                                $newUserId = e($row2["idUsers"]);
                                $name = e($row2['firstname'] . " ". $row2['lastname']);
                                echo "<tr>";
                                echo "<td id='searchForDeleteUser'><input type='radio' class='radio-button-delete-user' name='DeleteConnectionValue' value='$newUserId'/></td>";
                                echo "<td id='searchForDeleteUser'><input type='hidden' name='DeleteValue' value='" . $id . "' />" . $f_name . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $l_name . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $workposition . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $international . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $startdate . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $name . "</td>";
                                echo "</tr>";
                            }
                        }


                    }
                }
            }echo "</table><button type='submit' class='btn btn-primary' name='DeleteConnection' >Delete connection</button></div></form>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }

    if(isset($_POST["searchConnected"]) && $_POST['searchConnectedUS'] == 'mentor') {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForEmployee = e($_POST["searchForConnect"]);
        $sql = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%' ORDER BY Newemployee.lastname, Newemployee.firstname";
        $result = $db->query($sql);

        if ($result) {


            echo "<tr><th>Choose</th>";
            echo "<th>Firstname</th>";
            echo "<th>Surename</th>";
            echo "<th>Workposition</th>";
            echo "<th>International</th>";
            echo "<th>Startdate</th>";
            echo "<th>Mentor</th></tr>";

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
                        echo "<td></td>";
                        echo "<td>" . $f_name . "</td>";
                        echo "<td>" . $l_name . "</td>";
                        echo "<td>" . $workposition . "</td>";
                        echo "<td>" . $international . "</td>";
                        echo "<td>" . $startdate . "</td>";
                        echo "<td>" . "No  Mentor responsible" . "</td>";
                        echo "</tr>";

                    } else {

                        $sqb = "SELECT idUsers, firstname , lastname FROM Users WHERE usertype = 'mentor' AND idUsers IN (SELECT Users_idUsers FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$id')";
                        $result3 = $db->query($sqb);
                        if ($result3) {
                            while ($row2 = mysqli_fetch_assoc($result3)) {
                                $id = e($row['idNewemployee']);
                                $f_name = e($row["firstname"]);
                                $l_name = e($row["lastname"]);
                                $workposition = e($row["workposition"]);
                                $international = e($row["international"]);
                                $newUserId = e($row2["idUsers"]);
                                $name = e($row2['firstname'] . " ". $row2['lastname']);
                                echo "<tr>";
                                echo "<td id='searchForDeleteUser'><input type='radio' class='radio-button-delete-user' name='DeleteConnectionValue' value='$newUserId'/></td>";
                                echo "<td id='searchForDeleteUser'><input type='hidden' name='DeleteValue' value='" . $id . "' />" . $f_name . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $l_name . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $workposition . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $international . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $startdate . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $name . "</td>";
                                echo "</tr>";
                            }
                        }


                    }
                }
            }echo "</table><button type='submit' class='btn btn-primary' name='DeleteConnection' >Delete connection</button></div></form>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }

    if(isset($_POST["searchConnected"]) && $_POST['searchConnectedUS'] == 'HR') {
        echo "<form action='' method='post'><table>";

        global $db, $errors;
        $searchForEmployee = e($_POST["searchForConnect"]);
        $sql = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%' ORDER BY Newemployee.lastname, Newemployee.firstname";
        $result = $db->query($sql);

        if ($result) {


            echo "<tr><th>Choose</th>";
            echo "<th>Firstname</th>";
            echo "<th>Surename</th>";
            echo "<th>Workposition</th>";
            echo "<th>International</th>";
            echo "<th>Startdate</th>";
            echo "<th>HR-employee</th></tr>";

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
                        echo "<td></td>";
                        echo "<td>" . $f_name . "</td>";
                        echo "<td>" . $l_name . "</td>";
                        echo "<td>" . $workposition . "</td>";
                        echo "<td>" . $international . "</td>";
                        echo "<td>" . $startdate . "</td>";
                        echo "<td>" . "No HR-Employee Responsible" . "</td>";
                        echo "</tr>";

                    } else {

                        $sqb = "SELECT idUsers, firstname , lastname FROM Users WHERE usertype = 'HR' AND idUsers IN (SELECT Users_idUsers FROM Users_has_Newemployee WHERE Newemployee_idNewemployee = '$id')";
                        $result3 = $db->query($sqb);
                        if ($result3) {
                            while ($row2 = mysqli_fetch_assoc($result3)) {
                                $id = e($row['idNewemployee']);
                                $f_name = e($row["firstname"]);
                                $l_name = e($row["lastname"]);
                                $workposition = e($row["workposition"]);
                                $international = e($row["international"]);
                                $newUserId = e($row2["idUsers"]);
                                $name = e($row2['firstname'] . " ". $row2['lastname']);
                                echo "<tr>";
                                echo "<td id='searchForDeleteUser'><input type='radio' class='radio-button-delete-user' name='DeleteConnectionValue' value='$newUserId'/></td>";
                                echo "<td id='searchForDeleteUser'><input type='hidden' name='DeleteValue' value='" . $id . "' />" . $f_name . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $l_name . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $workposition . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $international . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $startdate . "</td>";
                                echo "<td id='searchForDeleteUser'>" . $name . "</td>";
                                echo "</tr>";
                            }
                        }


                    }
                }
            }echo "</table><button type='submit' class='btn btn-primary' name='DeleteConnection' >Delete connection</button></div></form>";

        } else {
            echo '<script type="text/javascript">alert("Connection error or checklist lacking");</script>';
        }
    }

}

//Funksjon som søker etter en ansatt i engelsk versjon
function searchEmployeeEng()
{
    if (isset($_POST['searcFi'])) {

        global $db;

        if (!$db) {
            die("Feil i databasetilkobling:" . $db->connect_error);
        }

        $searchForEmployee = e($_POST["searchFro"]);
        $qry = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%' ORDER BY Newemployee.lastname, Newemployee.firstname";
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

                $qry3 = "SELECT checkpointsEN, idChecklist from Checklist WHERE idChecklist ='$check_id'";
                $res3 = mysqli_query($db, $qry3);
                $res4 = mysqli_fetch_assoc($res3);

                $article .= '
                                             <tr>
                                             <td>';
                $article .= " " . $res4['checkpointsEN'] . " ";
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

//Funksjon som søker etter en ansatt
function searchEmployee()
{
    if (isset($_POST['searcF'])) {

        global $db;

        if (!$db) {
            die("Feil i databasetilkobling:" . $db->connect_error);
        }

        $searchForEmployee = e($_POST["searchFr"]);
        $qry = "SELECT * FROM Newemployee WHERE Newemployee.firstname LIKE '" . $searchForEmployee . "%'  OR Newemployee.lastname LIKE '" . $searchForEmployee . "%' ORDER BY Newemployee.lastname, Newemployee.firstname";
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

//Sjekker om registrer sjekkliste blir trykket og starter funksjonen createChecklist()
if (isset($_POST['createCheckList'])) {
    createChecklist();
}

//Sjekker om registrer sjekkliste blir trykket og starter funksjonen createChecklist() i engelsk versjon
if (isset($_POST['createCheckListEn'])) {
    createChecklistEN();
}

//Sjekker om knappen tildel fadder blir trykket inn og starter funksjonen addMentor()
if (isset($_POST['assignMentor'])) {
    addMentor();
}

if (isset($_POST['deleteassignedMentor'])){
    deleteMentor();
}

//Sjekker om knappen tildel leder blir trykket inn og starter funksjonen addLeader()
if (isset($_POST['assignLeader'])) {
    addLeader();
}

//Sjekker om knappen tildel HR-ansatt blir trykket inn og starter funksjonen addHr()
if (isset($_POST['assignHr'])) {
    addHr();
}

//Ikke i bruk, tenkt og sjekke om kanppen endre fadder er trykket inn å starte funksjonen updateMentor()
if (isset($_POST['updateMentor'])) {
    updateMentor();
}

//Ikke i bruk, tenkt og sjekke om kanppen endre leder er trykket inn å starte funksjonen updateLeader()
if (isset($_POST['updateLeader'])) {
    updateLeader();
}

//Ikke i bruk, tenkt og sjekke om kanppen endre HR-ansatt er trykket inn å starte funksjonen updateHr()
if (isset($_POST['updateHr'])) {
    updateHr();
}