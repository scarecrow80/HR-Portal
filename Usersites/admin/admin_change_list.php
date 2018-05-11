<?php
include "admin_session.php";
?>
<!DOCTYPE html>


<html itemscope itemtype="http://schema.org/Article" xmlns="http://www.w3.org/1999/xhtml" xml:lang="nb" lang="nb">
<head>

    <meta property="og:image" content="../../img/HiOA-logo-stor-versjon.png"/>


    <title>OsloMet - Admin</title>

    <?php
    include_once "../../Elements/Metaheads.php";
    ?>


</head>

<!-- Complete page area: START -->
<body class="article width-large">

<!-- Change between "sidemenu"/"nosidemenu" and "extrainfo"/"noextrainfo" to switch display of side columns on or off  --><ul id="hidnav" role="navigation">
    <li><a href="#section">skip to content</a></li>
    <li><a href="#navcontainer">Main navigation (skip)</a></li>
    <li><a href="#footer">Bottom menu (skip)</a></li>
</ul>
<div class="container" data-role="page">
    <img id="printLogo" alt="Print logo HiOA" src="../../img/Hioa-Logo-s_h-orig.png" />
    <div id="hioa-toolbar">
        <div id="mobile-menu-trigger">
            <img src="../../img/hioa-meny-knapp_off.png" alt="meny" />
        </div>

        <a href="/eng/">English</a>
        <?php
        include_once "nav_admin_mobile.php";
        ?>

    </div>


    <div id="top">
        <div class="contentWrapper">
            <a id="logo" href="http://www.hioa.no/"><img width="236" height="auto" alt="Logo - HiOA - Tilbake til forsida HiOA" src="../../img/hioa-logo-web_697×120_no.png" /></a>
            <nav>
                <?php include "nav_admin.php";?>
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

                                <div id="change" class="page tilsatt">

                                    <div class="mrflexibox block_result_list tjenestebox left width_full"
                                         thetitle="Opprette nytt sjekkliste punkt">

                                        <h2>
                                            Opprette nytt sjekkliste punkt
                                        </h2>

                                        <div class="mr_fleksi_content">


                                            <form action="" method="post">
                                                <table>
                                                    <tr class="input-group">
                                                        <td>Innhold</td>
                                                        <td><textarea input="text" id="" name="newPointNo" placeholder="Skriv punkt her" rows="5"></textarea></td>
                                                    </tr>
                                                    <tr class="input-group">
                                                        <td>Innhold Engelsk</td>
                                                        <td><textarea input="text" id="" name="newPointEn" placeholder="Skriv punkt her på engelsk" rows="5"></textarea></td>
                                                    </tr>
                                                    <tr class="input-group">
                                                        <td>Brukertype: </td>
                                                        <td><select name="userType" class="field comment-alerts" id="choose2" required>
                                                                <option value=""></option>
                                                                <option value="leader">Leder</option>
                                                                <option value="HR">HR</option>
                                                                <option value="mentor">Fadder</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr class="input-group">
                                                        <td>Nasjonalitet: </td>
                                                        <td><select name="nationality" class="field comment-alerts" id="choose2" required />
                                                            <option value=""></option>
                                                            <option value="Norsk">Norsk</option>
                                                            <option value="Internasjonal">Internasjonal</option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr class="input-group">
                                                        <td>Leder: </td>
                                                        <td><select name="leader" class="field comment-alerts" id="choose2" required />
                                                            <option value=""></option>
                                                            <option value="Ja">Ja</option>
                                                            <option value="Nei">Nei</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <button type="submit" class="btn btn-primary" name="createNewPoint" id="Nypunkt">Nytt Punkt</button>
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
                                                <select name="checkpoint" id="choose2">
                                                    <?php selectPoint() ?>
                                                </select>
                                                <input type="submit" class="btn btn-primary" name="selectPoint" value="Velg sjekkpunkt" />
                                            </form>
                                            <?php changePoint() ?>
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
                                                    <?php selectDeletePoint() ?>

                                                    <!--<tr class="input-group">

                                                        <td>Innhold</td>
                                                        <td> <textarea type="text" name="Innd" id="Innd" value=""></textarea></td>
                                                    </tr>-->
                                                    <button type="submit" class="btn btn-primary" name="Delete" id="Delete" >Slett Punkt</button>
                                                    <?php deletePoint() ?>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <!-- END: section -->



                                <!-- Main area content: END -->
                            </div>
                        </div>
                    </div><!--end:frameWrapper-->
                </div>        <!-- Extra area: START -->
            </div></div></div></div>
<!-- Extra area: END -->
<!--  </div>
  </div> -->
<!-- Columns area: END -->
<!-- Footer area: START -->
<!-- Footer area: START -->

<div class="clearfloat"></div>
<?php
include_once "../../Elements/Footer.php";
?>


</body>
</html>
