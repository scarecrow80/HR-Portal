<?php

// Ikke i bruk enda
function overviewHr(){

    global $db;

    if(!$db){
        die("Feil i databasetilkobling:".$db->connect_error);
    }
    $userId = $_SESSION['user']['idUsers'];
    $qry =  "SELECT Newemployee.firstname, Newemployee.lastname, Newemployee.idNewemployee FROM Newemployee INNER JOIN Users_has_Newemployee ON Newemployee.idNewemployee = Users_has_Newemployee.Newemployee_idNewemployee WHERE Users_has_Newemployee.Users_idUsers = $userId";
    $res = mysqli_query($db, $qry);
    if(!$res){
        echo '<script type="text/javascript">alert("Query failed");</script>';
    }


    while($row = mysqli_fetch_assoc($res)){
        $id_new = $row['idNewemployee'];
        $f_name = $row['firstname'];
        $l_name = $row['lastname'];


        $article = ' <article class="h-card vcard person-card article-contact" role="article"><h3 title="Oversikt over sjekklister"  class="toggler-header article-contact-heading"> ';
        $article.=$f_name." ".$l_name." ";
        $article.= '</h3><div class="toggler-content"><form action="../../DBconnections/update.php" method="post"><table><tr><th>Oppgave</th><th>Sjekkboks</th></tr>';
        $qry2 = "SELECT Newemployee_idNewemployee, Checklist_idChecklist, checked FROM Newemployee_has_Checklist INNER JOIN Checklist ON idChecklist WHERE Checklist_idChecklist = idChecklist AND responsible = 'HR' AND Newemployee_idNewemployee='$id_new'";
        $res2 = mysqli_query($db, $qry2);

        if(!$res2){
            echo '<script type="text/javascript">alert("Tomt resultat");</script>';
            die();
        }
        while($row2 = mysqli_fetch_assoc($res2)){
            $check_id = $row2['Checklist_idChecklist'];
            $checked = $row2['checked'];
            $emp_id = $row2['Newemployee_idNewemployee'];

            $qry3 = "SELECT checkpointsNO, idChecklist from Checklist WHERE idChecklist ='$check_id' AND responsible='HR'";
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
                $article.='<input type="checkbox" class="checkbox" name="formList[]"';
               // $article.=$emp_id;
                $article.='" value="';
                $article.=$checked." ".$emp_id." " .$check_id;
                $article.='" id="';
                $article.=$check_id;
                $article.='" />';

            } else{
                $article.='<input type="checkbox" class="checkbox" checked value="2"';

                //$article.=$checked;

                $article.='" name="formList[]">';

            }

            $article.='</td>
                                            </tr>';

        }

        $article.= '</table><br/><button type="submit" class="btn btn-primary">Oppdater</button></form></div></article>';
        echo $article;

    }
}
//Serach for one or more employees
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


            $article = ' <article class="h-card vcard person-card article-contact" role="article"><h3 title="Oversikt over sjekklister"  class="toggler-header article-contact-heading"> ';
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

// Ikke i bruk enda
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