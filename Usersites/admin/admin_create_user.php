<?php
include "admin_session.php";
?>
<!DOCTYPE html>


<html itemscope itemtype="http://schema.org/Article" xmlns="http://www.w3.org/1999/xhtml" xml:lang="nb" lang="nb">
<head>

    <meta property="og:image" content="../../img/HiOA-logo-stor-versjon.png"/>


    <title>OsloMet - Admin Lag en Bruker</title>

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

        <a href="../admin_eng/admin_create_user_eng.php">English</a>
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

                                <div id="create" class="page tilsatt" >
                                    <h2>Opprett bruker</h2>

                                    <form action="" method="post">
                                        <table>
                                            <tr class="input-group">
                                                <td>Fornavn: </td>
                                                <td><input type="text" name="firstname" value="" class="field comment-alerts" id="input-box" required/> </td>
                                            </tr>
                                            <tr class="input-group">
                                                <td>Etternavn: </td>
                                                <td><input type="text" name="lastname"  class="field comment-alerts" id="input-box" required/> </td>
                                            </tr>
                                            <tr class="input-group">
                                                <td>Brukernavn: </td>
                                                <td><input type="text" name="username"  class="field comment-alerts" id="input-box" required/> </td>
                                            </tr>
                                            <tr class="input-group">
                                                <td>Brukertype: </td>
                                                <td><select name="usertype" class="field comment-alerts" id="choose2" required>
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
                                                <td><input type="password" name="password" class="field comment-alerts" id="input-box" required /> </td>
                                            </tr>
                                            <tr class="input-group">
                                                <td>Gjenta passord: </td>
                                                <td><input type="password" name="repeatPassword" class="field comment-alerts" id="input-box" required /> </td>
                                            </tr>

                                        </table>
                                        <button class="btn btn-cancel" type="button">Avbryt</button>
                                        <button type="submit" class="btn btn-primary" name="register">Register</button>
                                    </form>
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
