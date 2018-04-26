<?php
include('../HR-Portal/DBconnections/dbconnection.php');
if (!admin()){
    $_SESSION['msg'] = "You have to log in as admin";
    session_destroy();
    unset($_SESSION['user']);
    header('location: ../HR-Portal/index.php');
}
?>
<!DOCTYPE html>


<html itemscope itemtype="http://schema.org/Article" xmlns="http://www.w3.org/1999/xhtml" xml:lang="nb" lang="nb">
<head>

    <meta property="og:image" content="img/HiOA-logo-stor-versjon.png"/>


    <title>OsloMet - Administrator</title>

    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Content-language" content="no-bokmaal" />

    <meta name="MSSmartTagsPreventParsing" content="TRUE" />
    <meta name="title" content="" />
    <meta itemprop="name" content="">
    <meta name="author" content="" />
    <meta name="description" content="" />
    <meta itemprop="description" content="" />

    <link rel="shortcut icon" href="img/favicon.ico" />

    <!-- <meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
    <meta name="viewport" content="width=device-width" /> -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- <link rel="apple-touch-icon" href="/extension/ezwebin/design/ezwebin/images/touch-icon-iphone.jpg">
    <link rel="apple-touch-icon" sizes="72x72" href="/extension/ezwebin/design/ezwebin/images/touch-icon-ipad.jpg">
    <link rel="apple-touch-icon" sizes="114x114" href="/extension/ezwebin/design/ezwebin/images/touch-icon-iphone4.jpg"> -->


    <!--[if lte IE 8]>
    <link rel="stylesheet" href="css/ie8.css" type="text/css" media="screen" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="css/all.css" />
    <link rel="stylesheet" type="text/css" href="css/aui.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-yamm.css" />
    <link rel="stylesheet" type="text/css" href="css/custom.css" />
    <link rel="stylesheet" type="text/css" href="css/dev-custom.css" />


    <!-- IE conditional comments; for bug fixes for different IE versions -->
    <!--[if IE 5]>     <style type="text/css"> @import url(css/browsers/ie5.css);    </style> <![endif]-->
    <!--[if lte IE 7]> <style type="text/css"> @import url(css/browsers/ie7lte.css); </style> <![endif]-->

    <link rel="stylesheet" type="text/css" media="print"  href="css/print.css" />

    <link rel="stylesheet" type="text/css"  href="css/upgrade_rearrange_fixes.css" />


</head>

<!-- Complete page area: START -->
<body class="article width-large">

<!-- Change between "sidemenu"/"nosidemenu" and "extrainfo"/"noextrainfo" to switch display of side columns on or off  --><ul id="hidnav" role="navigation">
    <li><a href="#section">skip to content</a></li>
    <li><a href="#navcontainer">Main navigation (skip)</a></li>
    <li><a href="#footer">Bottom menu (skip)</a></li>
</ul>
<div class="container" data-role="page">
    <img id="printLogo" alt="Print logo HiOA" src="img/Hioa-Logo-s_h-orig.png" />
    <div id="hioa-toolbar">
        <div id="mobile-menu-trigger">
            <img src="img/hioa-meny-knapp_off.png" alt="meny" />
        </div>

        <a href="/eng/">English</a>

        <div id="mobile-menu">
            <ul>
                <li class="main-menu">
                    <a class="list" onclick="openPage('overview')" role="menuitem" title="Oversikt"> <span class="nav-item-label"> Oversikt </span> </a>
                </li>
                <li class="main-menu">
                    <a class="list" id="" onclick="openPage('change')" role="menuitem" title="Endre på sjekkliste"> <span class="nav-item-label"> Endre på sjekkliste </span> </a>
                </li>
                <li class="main-menu">
                    <a class="list" id="" onclick="openPage('delete')" role="menuitem" title="Slett gamle sjekklister"> <span class="nav-item-label"> Slett gamle sjekklister </span> </a>
                </li>
                <li class="main-menu">
                    <a class="list" id="" onclick="openPage('create')" role="menuitem" title="Opprett bruker"> <span class="nav-item-label"> Opprett bruker </span> </a>
                </li>
            </ul>
        </div>
    </div>


    <div id="top">
        <div class="contentWrapper">
            <a id="logo" href="http://www.hioa.no/"><img width="236" height="auto" alt="Logo - HiOA - Tilbake til forsida HiOA" src="img/hioa-logo-web_697×120_no.png" /></a>
            <nav>
                <div id="navcontainer" class="fullsizeBlock">

                    <ul id="topMenu">
                        <li><a href="http://www.hioa.no/eng">EnglishTODO</a></li>
                    </ul>

                    <ul id="Nav">
                        <li class="active active " id="tzju_" role="presentation">
                            <a class="list" onclick="openPage('overview')" role="menuitem" title="Oversikt"> <span class="nav-item-label"> Oversikt </span> </a>
                        </li>
                        <li class=" " id="ahej_" role="presentation">
                            <a class="list" onclick="openPage('change')" id="" role="menuitem" title="Endre på sjekkliste"> <span class="nav-item-label"> Endre på sjekkliste </span> </a>
                        </li>
                        <li class=" " id="fyzs_" role="presentation">
                            <a class="list" onclick="openPage('delete')" id="" role="menuitem" title="Slett gamle sjekklister"> <span class="nav-item-label"> Slett gamle sjekklister </span> </a>
                        </li>
                        <li class=" " id="oivt_" role="presentation">
                            <a class="list" onclick="openPage('create')" id="" role="menuitem" title="Opprett bruker"> <span class="nav-item-label"> Opprett bruker </span> </a>
                        </li>
                    </ul>
                    <script>

                        function openPage(pageName){
                            var i;
                            var x = document.getElementsByClassName("page");
                            for (i = 0; i < x.length; i++){
                                x[i].style.display = "none";
                            }
                            document.getElementById(pageName).style.display = "block";
                        }
                    </script>
                </div> <!-- END: navcontainer -->
            </nav>
        </div> <!-- contentWrapper -->
    </div><!-- top -->
    <!-- <div class="clearfloat"></div> -->
    <!-- <div id="page" class="nosidemenu noextrainfo section_id_1 subtree_level_0_node_id_2 subtree_level_1_node_id_23577"> -->
    <!-- Header area: START -->
    <!-- Header area: END -->

    <!-- Toolbar area: START -->
    <!-- Toolbar area: END -->

    <div id="maincontent">
        <div id="topShadow"></div>
        <div class="frameWrapper">
            <div class="bodyframe_right side"></div>
            <div class="bodyframe_left side"></div>
            <div class="contentWrapper">
                <div id="breadCrumb">
                    <!-- Path content: START -->

                    <!-- Path content: END -->
                </div>

                <div id="section">		          <!-- Main area content: START -->

                    <div class="section">
                        <a id="nonav3" class="hiddenTxt" name="nonav3"></a>



                        <!-- <div class="innholdskolonne"> -->
                        <div id="firstGrid">		<!-- <div class="venstrekolonne"> -->
                            <!-- </div> --> <!-- END: venstrekolonne -->		<!-- <div class="hoyrekolonne"> -->
                            <!-- </div> --> <!-- END: hoyrekolonne -->
                            <div style="flot:left;clear:both;">

                                <script src="http://cdn.alloyui.com/2.5.0/aui/aui-min.js"></script>
                                <div id="overview" class="page tilsatt">

                                    <script>
                                        YUI().use("aui-toggler", function(a) {
                                            new a.TogglerDelegate({
                                                animated: true,
                                                closeAllOnExpand: true,
                                                container: ".article-toggle",
                                                content: ".toggler-content",
                                                expanded: false,
                                                header: ".toggler-header",
                                                transition: {
                                                    duration: 0.2,
                                                    easing: "cubic-bezier(0, 0.1, 0, 1)"
                                                }
                                            })
                                        });
                                    </script>
                                    <section class="section section-events article-toggle" role="region">
                                        <?php
                                        $db = mysqli_connect("student.cs.hioa.no", "s236619", "", "s236619");
                                        //$db = mysqli_connect("localhost", "root", "", "db_hr_portal");
                                        //include '../HR-Portal/DBconnections/dbconnection.php';
                                        if(!$db){
                                            die("Feil i databasetilkobling:".$db->connect_error);
                                        }
                                        //$userId = $_SESSION;
                                        $qry =  "SELECT Newemployee.firstname, Newemployee.lastname, Newemployee.idNewemployee FROM Newemployee INNER JOIN Users_has_Newemployee ON Newemployee.idNewemployee = Users_has_Newemployee.Newemployee_idNewemployee";
                                        $res = mysqli_query($db, $qry);
                                        if(!$res){
                                            echo "query failed";
                                        }


                                        while($row = mysqli_fetch_assoc($res)){
                                            $id_new = $row['idNewemployee'];
                                            $f_name = $row['firstname'];
                                            $l_name = $row['lastname'];


                                            $article = ' <article class="h-card vcard person-card article-contact" role="article"><h3 title="Oversikt over sjekklister"  class="toggler-header article-contact-heading"> ';
                                            $article.=$f_name." ".$l_name." ";
                                            $article.= '</h3><div class="toggler-content"><form action="" method="post"><table><tr><th>Oppgave</th><th>Sjekkboks</th></tr>';
                                            $qry2 = "SELECT Newemployee_idNewemployee, Checklist_idChecklist, checked FROM Newemployee_has_Checklist INNER JOIN Checklist ON idChecklist WHERE Checklist_idChecklist = idChecklist AND Newemployee_idNewemployee='$id_new'";
                                            $res2 = mysqli_query($db, $qry2);

                                            if(!$res2){
                                                echo "RES2 er tom";
                                                die();
                                            }
                                            while($row2 = mysqli_fetch_assoc($res2)){
                                                $check_id = $row2['Checklist_idChecklist'];
                                                $checked = $row2['checked'];
                                                $emp_id = $row2['Newemployee_idNewemployee'];

                                                $qry3 = "SELECT checkpointsNO, idChecklist from Checklist WHERE idChecklist ='$check_id'";
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
                                        ?>
                                        <p id="test"></p>
                                        <script>
                                            var inputElem = document.getElementsByTagName("checkbox");


                                        </script>
                                    </section>

                                </div>


                                <div id="change" class="page tilsatt" style="display:none">

                                <div class="mrflexibox block_result_list tjenestebox left width_full"
                                     thetitle="Opprette nytt sjekkliste punkt">

                                    <h2>
                                        Opprette nytt sjekkliste punkt
                                    </h2>

                                    <div class="mr_fleksi_content">

                                        <p>Opprett et nytt sjekkliste punkt.</p>
                                        <form action="" method="post">
                                            <table>
                                                <tr class="input-group">
                                                    <td>Innhold</td>
                                                    <td><textarea input="text" id="" name="innd" placeholder="Skriv punkt her" rows="5"></textarea></td>
                                                </tr>
                                                <tr class="input-group">
                                                    <td>Innhold Engelsk</td>
                                                    <td><textarea input="text" id="" name="innde" placeholder="Skriv punkt her på engelsk" rows="5"></textarea></td>
                                                </tr>
                                                <tr class="input-group">
                                                    <td>Brukertype: </td>
                                                    <td><select name="ans" class="field comment-alerts" required>
                                                            <option value=""></option>
                                                            <option value="admin">Administrator</option>
                                                            <option value="leader">Leder</option>
                                                            <option value="HR">HR</option>
                                                            <option value="mentor">Fadder</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="input-group">
                                                    <td>Nasjonalitet: </td>
                                                    <td><select name="nasj" class="field comment-alerts" required />
                                                        <option value=""></option>
                                                        <option value="Norsk">Norsk</option>
                                                        <option value="Internasjonal">Internasjonal</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr class="input-group">
                                                    <td>Leder: </td>
                                                    <td><select name="Led" class="field comment-alerts" required />
                                                        <option value=""></option>
                                                        <option value="Ja">Ja</option>
                                                        <option value="Nei">Nei</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                            <button type="submit" class="btn btn-primary" name="Nypunkt" id="Nypunkt">Nytt Punkt</button>
                                        </form>


                                    </div>
                                </div>

                                <div class="mrflexibox block_result_list tjenestebox left width_full"
                                     thetitle="Endre sjekkliste punkt">

                                    <h2>
                                        Endre sjekkliste punkt
                                    </h2>

                                    <div class="mr_fleksi_content">

                                        <p>Endre et sjekkliste punkt.</p>
                                        <form action="" method="post">
                                            <table>
                                                <tr class="input-group">

                                                    <td><textarea type="text" name="orgpunkt" ></textarea></td><br>
                                                </tr>

                                                <tr class="input-group">

                                                    <td> <textarea type="text" name="Nypunkt" id="Nypunkt" value="" placeholder="Skriv inn nytt punkt på norsk her"></textarea></td>
                                                </tr>

                                                <tr class ="input-group">

                                                    <td><textarea type="text" name="Engpunkt" id="Engpunkt" placeholder="Skriv inn nytt punkt på engelsk her"></textarea></td>
                                                </tr>
                                            </table>
                                            <button type="submit" class="btn btn-primary" name="Edilis" id="Edilis">Endre Punkt</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="mrflexibox block_result_list tjenestebox left width_full"
                                     thetitle="Slett et sjekklist punkt">

                                    <h2>
                                        Slett et sjekklist punkt
                                    </h2>

                                    <div class="mr_fleksi_content">

                                        <p>Slett et sjekklist punkt</p>
                                        <form action="" method="post">
                                            <table>
                                                <!--<tr class="input-group">
                                                    <td>Nummer</td>
                                                    <td> <input type="number" name="numb"/></td><br>
                                                </tr>-->
                                                <tr>
                                                    <th>Sjekkpunkt på norsk</th>
                                                    <th>Sjekkpunkt på engelsk</th>
                                                    <th>Ansvarlig</th>
                                                    <th>Nasjonalitet</th>
                                                    <th>Leder</th>
                                                    <th>Valg</th>
                                                </tr>
                                                <?php
                                                $sql = "Select * FROM Checklist";
                                                $result = mysqli_query($db, $sql);

                                                if ($result) {

                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $check_id = $row["idChecklist"];

                                                        echo "<tr>";
                                                        echo "<td>".$row["checkpointsNO"]."</td>";
                                                        echo "<td>".$row["checkpointsEN"]."</td>";
                                                        echo "<td>".$row["responsible"]."</td>";
                                                        echo "<td>".$row["nationality"]."</td>";
                                                        echo "<td>".$row["leader"]."</td>";
                                                        echo "<td><input type='radio' name='DeletePoint' value='$check_id'/></td>";
                                                        echo "</tr>";

                                                    }echo "</table>";
                                                }
                                                else{
                                                    echo "No connection to database or no checkpoints to select";
                                                }

                                                ?>

                                                <!--<tr class="input-group">

                                                    <td>Innhold</td>
                                                    <td> <textarea type="text" name="Innd" id="Innd" value=""></textarea></td>
                                                </tr>-->
                                                <button type="submit" class="btn btn-primary" name="Delete" id="Delete" >Slett Punkt</button>
                                                <?php

                                                if(isset($_POST["Delete"])) {

                                                    $checkpointId = $_POST["DeletePoint"];
                                                    $sql = "DELETE FROM Checklist WHERE idChecklist = '".$checkpointId."'";
                                                    $sql2 = "DELETE FROM Newemployee_has_Checklist WHERE Checklist_idChecklist = '".$checkpointId."'";

                                                    $result2 = mysqli_query($db,$sql);
                                                    $result3 = mysqli_query($db,$sql2);

                                                    if(!$result2) {

                                                        if(mysqli_affected_rows($db) > 0) {
                                                            echo " *Sjekkpunkt er slettet * ";
                                                        }
                                                        else {
                                                            echo " * Kunne ikke finne punkt for sletting *";
                                                        }
                                                    }
                                                    if(!$result3) {

                                                        if(mysqli_affected_rows($db) > 0) {
                                                            echo " *Sjekkpunkt er slettet fra Newemployee_has_Checklist* ";
                                                        }
                                                        else {
                                                            echo " * Kunne ikke finne punkt for sletting *";
                                                        }
                                                    }
                                                }
                                                ?>
                                        </form>
                                    </div>
                                </div>








                             </div>

                             <div id="delete" class="page tilsatt" style="display:none">
                                             <p>TODOTODOTODOTODOTODO delete user</p>
                                 <form action="" method="post">
                                     <table>
                                     <tr class="input-group">
                                         <td>Fornavn: </td>
                                         <td><input type="text" name="firstname" value="" class="field comment-alerts" required/> </td>
                                     </tr><br>
                                     </table>
                                     <button type="submit" class="btn btn-primary" name="del" id="del">Delete Checklist</button>

                                 </form>
                             </div>

                             <div id="create" class="page tilsatt" style="display:none">
                                             <p>TODOTODOTODOTODOTODO create user</p>

                                 <form action="" method="post">
                                     <table>
                                         <tr class="input-group">
                                             <td>Fornavn: </td>
                                             <td><input type="text" name="firstname" value="" class="field comment-alerts" required/> </td>
                                         </tr>
                                         <tr class="input-group">
                                             <td>Etternavn: </td>
                                             <td><input type="text" name="lastname"  class="field comment-alerts" required/> </td>
                                         </tr>
                                         <tr class="input-group">
                                             <td>Brukernavn: </td>
                                             <td><input type="text" name="username"  class="field comment-alerts" required/> </td>
                                         </tr>
                                         <tr class="input-group">
                                             <td>Brukertype: </td>
                                             <td><select name="usertype" class="field comment-alerts" required>
                                                     <option value=""></option>
                                                     <option value="admin">Administrator</option>
                                                     <option value="leader">Leder</option>
                                                     <option value="HR">HR</option>
                                                     <option value="mentor">Fadder</option>
                                                 </select>
                                             </td>
                                         </tr>
                                         <tr class="input-group">
                                             <td>Passord: </td>
                                             <td><input type="password" name="password" class="field comment-alerts" required /> </td>
                                         </tr>
                                         <tr class="input-group">
                                             <td>Gjenta passord: </td>
                                             <td><input type="password" name="repeatPassword" class="field comment-alerts" required /> </td>
                                         </tr>

                                     </table>
                                     <button class="btn btn-cancel" type="button">Avbryt</button>
                                     <button type="submit" class="btn btn-primary" name="register">Register</button>
                                 </form>
                             </div>
                                 <div class="tilsatt">
                                     <button class="btn btn-cancel" type="button" onclick="window.location='../HR-Portal/logout.php'">Logout</button>
                                 </div>

                         </div><!-- </div> --> <!-- END: innholdskolonne -->
                    </div> <!-- END: section -->



                    <!-- Main area content: END -->
                </div>
            </div>
        </div><!--end:frameWrapper-->
    </div>        <!-- Extra area: START -->

    <!-- Extra area: END -->
    <!--  </div>
      </div> -->
    <!-- Columns area: END -->
    <!-- Footer area: START -->
    <!-- Footer area: START -->

    <div class="clearfloat"></div>
    <div id="footer">
        <div class="inner">
            <div class="contentWrapper">
                <div id="footerMenuContainer">
                    <div class="footerMenu">
                        <h4 class="footerMenuHeader">HiOA</h4>

                        <ul>
                            <li><a href="http://www.hioa.no/Om-HiOA">Om høgskolen</a></li>
                            <li><a href="http://www.hioa.no/Om-HiOA/Organisasjonskart">Organisasjon</a></li>
                            <li><a href="http://www.hioa.no/Om-HiOA/Strategier">Strategi</a></li>
                            <li><a href="http://www.hioa.no/Om-HiOA/Ledige-stillinger">Ledige stillinger</a></li>
                            <li><a href="http://www.hioa.no/Kontakt-oss/Mediekontakt">Mediekontakt</a></li>
                            <li><a href="http://www.hioa.no/Om-HiOA/Kart-og-veibeskrivelse">Kart og veibeskrivelse</a></li>
                            <li><a href="http://www.hioa.no/Om-HiOA/Informasjonskapsler-paa-Hioa.no">Om informasjonskapsler</a></li>

                        </ul>
                    </div>
                    <div class="footerMenu">
                        <h4 class="footerMenuHeader">Kontaktinformasjon</h4>
                        <p>
                            Høgskolen i Oslo og Akershus<br/>
                            Postboks 4 St. Olavs plass<br />                         0130 Oslo <br />
                            Tlf.: 67 23 50 00 <br />
                            E-post: <a href="mailto:post@hioa.no">post@hioa.no</a>
                        </p>
                    </div>
                    <div class="footerMenu">

                        <h4 class="footerMenuHeader">
                            Møt oss her
                        </h4>
                        <ul>
                            <li><a class="imagelink facebook" href="http://www.facebook.com/hioa">Facebook</a></li>
                            <li><a class="imagelink twitter" href="https://twitter.com/#!/HiOA_info">Twitter</a></li>
                            <li><a class="imagelink linkedin" href="http://no.linkedin.com/company/h-gskolen-i-oslo-og-akershus">LinkedIn</a></li>
                            <li><a class="imagelink flickr" href="http://www.flickr.com/photos/hioa/">Flickr</a></li>
                            <li><a class="imagelink instagram" href="http://www.instagram.com/hioa">Instagram</a></li>
                            <li><a class="imagelink googleplus" rel="publisher" href="https://plus.google.com/106065048460808498234">Google+</a></li>
                        </ul>
                    </div>
                    <div class="footerMenu">
                        <h4 class="footerMenuHeader last">Aktuelt</h4>
                        <ul>
                            <li><a href="http://www.hioa.no/Aktuelt">Aktuelle saker fra HiOA</a>  </li>
                            <li><a href="http://vitenogpraksis.no/?origin=externfooter">Viten + praksis - HiOAs forskningsmagasin</a></li>
                            <li><a href="http://www.khrono.no">Khrono - HiOAs uavhengige nettavis</a>  </li>
                            <li><a href="http://blogg.hioa.no/">blogg.hioa.no</a></li>
                        </ul>
                    </div>
                    <div class="footerMenu last">
                        <ul>
                            <li>
                                <a class="imagelink fortilsatte" href="https://www.hioa.no/For-tilsatte">For tilsatte</a>
                            </li>
                            <li>
                                <a href="https://prod.cms.hioa.no/admin" target="_blank" title="Login">eZ Publish</a>
                            </li>
                        </ul>
                    </div>
                </div> <!-- footer menu container -->
                <div class="clearfloat"></div>
            </div>
        </div> <!-- contentwrapper -->
    </div> <!-- inner -->
</div> <!-- footer -->
<!-- Footer area: END -->
<!-- Footer area: END -->
<!-- </div> -->
<!-- Complete page area: END -->
<!-- Footer script area: START --><!-- Footer script area: END -->
<script type="text/javascript" src="js/all.js" charset="utf-8"></script>


</body>
</html>
