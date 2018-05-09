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

