<?php
include('DBconnections/dbconnection.php');
?>
<!DOCTYPE html>


<html itemscope itemtype="http://schema.org/Article" xmlns="http://www.w3.org/1999/xhtml" xml:lang="nb" lang="nb">
<head>

    <meta property="og:image" content="img/HiOA-logo-stor-versjon.png"/>


    <title>OsloMet - Logg inn</title>

    <meta property="og:image" content="img/HiOA-logo-stor-versjon.png"/>
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

        <a href="index.php">Norsk</a>

        <div id="mobile-menu">
            <ul>

            </ul>
        </div>
    </div>


    <div id="top">
        <div class="contentWrapper">
            <a id="logo" href="http://www.hioa.no/"><img width="236" height="auto" alt="Logo - HiOA - Tilbake til forsida HiOA" src="img/hioa-logo-web_697×120_no.png" /></a>
            <nav>
                <div id="navcontainer" class="fullsizeBlock">

                    <ul id="topMenu">

                        <li><a href="index.php">Norsk</a></li>

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

                                <div id="change" class="page tilsatt">

                                <div class="mrflexibox block_result_list tjenestebox left width_full" thetitle="Logg inn">
                                    <h2> Login </h2>

                                    <div class="mr_fleksi_content">

                                        <div id="admin-toggle">
                                            <p class="login-admin-toggle toggler-header-collapsed" id="trigger-admin-toggle"></p>
                                            <div class="toggler-content-wrapper">
                                                <div id="admin-login-content" class="toggler-content toggler-content-expanded" style="margin-top: 0px;">
                                                    <form action="" class="form admin-login-form " id="_58_fm" method="post" name="_58_fm" autocomplete="on">
                                                        <?php echo display_error(); ?>
                                                        <input name="_58_formDate" type="hidden" value="1448557611063">
                                                        <input class="field" id="_58_saveLastPath" name="_58_saveLastPath" type="hidden" value="false">
                                                        <input class="field" id="_58_redirect" name="_58_redirect" type="hidden" value="/c/portal/localizedmypage">
                                                        <input class="field" id="_58_doActionAfterLogin" name="_58_doActionAfterLogin" type="hidden" value="false">

                                                        <fieldset class="fieldset ">
                                                            <div class="">

                                                                <div class="control-group">
                                                                    <input class="field clearable" id="_58_login" name="username" type="text" value="" placeholder="Username"> </div>

                                                                <div class="control-group">
                                                                    <input class="field" id="_58_password" name="password" type="password" value="" placeholder="Password"> </div> <span id="_58_passwordCapsLockSpan" style="display: none; color:red; margin-bottom: 10px;">Caps-lock er på.</span> </div>
                                                        </fieldset>

                                                        <div class="loginButtonHolder">
                                                            <button type="submit"  class="loginButton" name="login" >Login</button> </div>
                                                        <div class="clearfix"></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
