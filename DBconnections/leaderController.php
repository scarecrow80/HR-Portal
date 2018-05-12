<?php

function overviewLeader(){

    global $db;

    if(!$db){
        die("Feil i databasetilkobling:".$db->connect_error);
    }
    $userId = $_SESSION['user']['idUsers'];
    $qry =  "SELECT Newemployee.firstname, Newemployee.lastname, Newemployee.idNewemployee FROM Newemployee INNER JOIN Users_has_Newemployee ON Newemployee.idNewemployee = Users_has_Newemployee.Newemployee_idNewemployee WHERE Users_has_Newemployee.Users_idUsers = $userId";
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
        $article.= '</h3><div class="toggler-content"><form action="../../DBconnections/update.php" method="post"><table><tr id="tableArt"><th id="tableArt">Mine oppgaver</th><th id="tableArt"></th></tr>';
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

            $article.='<tr id="tableArt"><td id="tableArt">';
            $article.=" ".$res4['checkpointsNO']." ";

            $article.='</td>';
            $article.='<td height="30px"  id="tableArt">';
            if($checked == 0){
                $article.='<input type="checkbox" class="checkbox" name="formList[]"';
                $article.='" value="';
                $article.=$checked." ".$emp_id." " .$check_id;
                $article.='" id="';
                $article.=$check_id;
                $article.='" />';

            } else{
                $article .= '<input type="checkbox" class="checkbox" name="empty" checked   onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"';
                $article.='" name="formList[]">';
             }
             $article.='</td></tr>';

        }
        $article.= '</table><br/><button type="submit" class="btn btn-primary">Update</button></form></div></article>';
        echo $article;

    }
}
function overviewLeaderEng(){

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
        $article.= '</h3><div class="toggler-content"><form action="../../DBconnections/update_english.php" method="post"><table><tr id="tableArt"><th id="tableArt">Mine oppgaver</th><th id="tableArt"></th></tr>';
        $qry2 = "SELECT Newemployee_idNewemployee, Checklist_idChecklist, checked FROM Newemployee_has_Checklist INNER JOIN Checklist ON idChecklist WHERE Checklist_idChecklist = idChecklist AND responsible = 'HR' AND Newemployee_idNewemployee='$id_new'";
        $res2 = mysqli_query($db, $qry2);

        if(!$res2){
            echo '<script type="text/javascript">alert("Empty result");</script>';
            die();
        }
        while($row2 = mysqli_fetch_assoc($res2)){
            $check_id = $row2['Checklist_idChecklist'];
            $checked = $row2['checked'];
            $emp_id = $row2['Newemployee_idNewemployee'];

            $qry3 = "SELECT checkpointsEN, idChecklist from Checklist WHERE idChecklist ='$check_id' AND responsible='HR'";
            $res3 =  mysqli_query($db, $qry3);
            $res4 = mysqli_fetch_assoc($res3);

            $article.=' <tr id="tableArt"><td id="tableArt">';
            $article.=" ".$res4['checkpointsEN']." ";

            $article.='</td>';
            $article.='<td height="30px"  id="tableArt">';
            if($checked == 0){
                $article.='<input type="checkbox" class="checkbox" name="formList[]"';
                $article.='" value="';
                $article.=$checked." ".$emp_id." " .$check_id;
                $article.='" id="';
                $article.=$check_id;
                $article.='" />';

            } else{
                $article .= '<input type="checkbox" class="checkbox" name="empty" checked   onclick="return false;" onkeydown="e = e || window.event; if(e.keyCode !== 9) return false;"';
                $article.='" name="formList[]">';

            }
            $article.='</td></tr>';

        }
        $article.= '</table><br/><button type="submit" class="btn btn-primary">Update</button></form></div></article>';
        echo $article;

    }
}
