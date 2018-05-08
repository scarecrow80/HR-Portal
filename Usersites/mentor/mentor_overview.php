<?php
include('../../DBconnections/dbconnection.php');
include('../../DBconnections/mentorController.php');
if (!isLoggedIN()){
    $_SESSION['msg'] = "you must be logged in to enter";
    header( 'location: ../../index.php');
}

?>
<!DOCTYPE html>


<html itemscope itemtype="http://schema.org/Article" xmlns="http://www.w3.org/1999/xhtml" xml:lang="nb" lang="nb">
<head>

    <meta property="og:image" content="../../img/HiOA-logo-stor-versjon.png"/>


    <title>OsloMet - Fadder</title>

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

        <div id="mobile-menu">
            <ul>
                <li class="main-menu">
                    <a class="list" id="" href="../../DBconnections/logout.php" role="menuitem" title="Logg ut"> <span class="nav-item-label"> Logg ut </span> </a>
                </li>
            </ul>
        </div>
    </div>


    <div id="top">
        <div class="contentWrapper">
            <a id="logo" href="http://www.hioa.no/"><img width="236" height="auto" alt="Logo - HiOA - Tilbake til forsida HiOA" src="../../img/hioa-logo-web_697×120_no.png" /></a>
            <nav>
                <div id="navcontainer" class="fullsizeBlock">

                    <ul id="topMenu">
                        <li><a href="http://www.hioa.no/eng">EnglishTODO</a></li>
                        <li class=" " id="fyzs_" role="presentation">
                            <a class="list" onclick="window.location='../../DBconnections/logout.php'" id="" role="menuitem" title="Logg ut"> <span class="nav-item-label" style="cursor: pointer"> Logg ut</span> </a>
                        </li>
                    </ul>

                    <ul id="Nav">

                    </ul>

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
                                        <?php overviewMentor() ?>

                                    </section>

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
            <script type="text/javascript" src="js/all.js" charset="utf-8"></script>


</body>
</html>
