<?php
include("fonctions.php");
$include = "";
if (isset($_GET['langue'])) {
    $langue = $_GET['langue'];
    $langueLien = '&amp;langue=' . $langue;
} else {
    $langueLien = "";
    $langue = 'fr';
}

if ($langue == 'fr') {
    $menu1 = "menu1";
    $menu2 = "menu2";
    $menu3 = "menu3";
    $menu4 = "menu4";
    $menu5 = "menu5";
} else {
    $menu1 = "menu1EN";
    $menu2 = "menu2EN";
    $menu3 = "menu3EN";
    $menu4 = "menu4EN";
    $menu5 = "menu5";
}


if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case "accueil":
            $include = "bdd.php";
            if ($langue == 'fr') {
                $menu1 = "menu1selected";
            } else {
                $menu1 = "menu1ENselected";
                $pageEN = "Home";
            }
            break;
        case "verre-lentille":
            $include = "bdd.php";
            if ($langue == 'fr') {
                $menu2 = "menu2selected";
            } else {
                $menu2 = "menu2ENselected";
                $pageEN = "Lens - Contact Lens";
            }

            break;
        case "lunettes":
            $include = "lunettes.php";
            if ($langue == 'fr') {
                $menu3 = "menu3selected";
            } else {
                $menu3 = "menu3ENselected";
                $pageEN = "Glasses";
            }
            break;
        case "localisation":
            $include = "bdd.php";
            if ($langue == 'fr') {
                $menu4 = "menu4selected";
            } else {
                $menu4 = "menu4ENselected";
                $pageEN = "Location";
            }
            break;
        case "contact":
            $include = "contact.php";
            $menu5 = "menu5selected";
            $pageEN = "Contact";
            break;
        case "mentions":
            $include = "bdd.php";
            $pageEN = "Legals";
            break;
        default:
            $include = "bdd.php";
            $page = "Erreur";
            $pageEN = "Erreur";
            break;
    }
} else {
    $include = "bdd.php";
    $pageEN = "Home";
    if ($langue == 'fr') {
        $menu1 = "menu1selected";
    } else {
        $menu1 = "menu1ENselected";
    }
    $page = "accueil";
}
if ($langue == 'fr') {
    $titre = ucfirst($page);
} else {
    $titre = $pageEN;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-15' />
        <title>Ver'son Optique -  <?php echo $titre; ?></title>
        <meta name="description" content="Opticien indépendant installé à verson depuis 2008." />
        <meta name="keywords" content="luntte,lentille,optique,opticien,independant,verson,larsonneur,michael,ver\'son,ver,son,essilor,chloe,boss,hugo,emporio,armani,dior,oxibis,chez,colette,vanni,william,morris,london,dilem,rip,curl,julbo,rebel,mawi,jim,varilux" />
        <meta name="robots" content="index" />
        <meta name="REVISIT-AFTER" content="30 days" />
        <meta http-equiv="Content-Language" content="fr,en,us" />
        <meta name="google-site-verification" content="mldovNS_h2WmxHuk3eeeH42Hsfru_6VU9ttQPROkRnM" />
        <link rel='stylesheet' media='screen' type='text/css' title='Base' href='Base.css' />
        <link href='images/favicon.ico' rel='SHORTCUT ICON' type='image/x-icon' />
        <link rel='stylesheet' type='text/css' href='shadowbox/shadowbox.css' />
        <script type='text/javascript' src='shadowbox/shadowbox.js'></script>
        <script type='text/javascript'>
            Shadowbox.init();
        </script>

    </head>
    <body>
        <?php
        connect();
        include('includes/barreInfoLangue.php');
        ?>
        <table>
            <tr>
                <td id='leftColumn'></td>
                <td id='CenterColumn'>


                    <div id='header'>
                        <img alt='' src='images/header.jpg' />
                    </div>


                    <table id='menu'>
                        <tr>


                            <td><a href='<?php echo "index.php?page=accueil" . $langueLien ?>'><span style="position:absolute;z-index:-10;">acceuil - home</span><span id='<?php echo "$menu1" ?>'></span></a></td>
                            <td><a href='<?php echo "index.php?page=verre-lentille" . $langueLien ?>'><span style="position:absolute;z-index:-10;">verre-lentille - lens-contact lens</span><span id='<?php echo "$menu2" ?>'></span></a></td>
                            <td><a href='<?php echo "index.php?page=lunettes" . $langueLien ?>'><span style="position:absolute;z-index:-10;">lunettes - glasses</span><span id='<?php echo "$menu3" ?>'></span></a></td>
                            <td><a href='<?php echo "index.php?page=localisation" . $langueLien ?>'><span style="position:absolute;z-index:-10;">localisation - location</span><span id='<?php echo "$menu4" ?>'></span></a></td>
                            <td><a href='<?php echo "index.php?page=contact" . $langueLien ?>'><span style="position:absolute;z-index:-10;">contact</span><span id='<?php echo "$menu5" ?>'></span></a></td>
                        </tr>
                    </table>

                    <div id='body'>
                        <?php
                        include('includes/' . $include );
                        disconnect();
                        ?>
                    </div>
                    <div id='footer'>
                        <?php
                        if ($langue == "fr") {
                            echo "<p> Copyright © 2010, VER'SON OPTIQUE. Tous droits réservés.<br />
                            <a href='index.php?page=mentions$langueLien'>Mentions Légales</a><br />
                            Résolution conseillée : 1024x768 minimum. </p>";
                        } else {
                            echo "<p> Copyright © 2010, VER'SON OPTIQUE. All rights reserved.<br />
                            <a href='index.php?page=mentions$langueLien'>Legals</a><br />
                            Recommended resolution : 1024x768 minimum. </p>";
                        }
                        ?>
                    </div>
                </td>
                <td id='RightColumn'></td>
            </tr>
        </table>
    </body>
</html>
