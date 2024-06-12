<?php
if (isset($_POST['action'])) {

    $action = $_POST['action'];
    $element = $_POST['element'];


    if ($action == "ajouter") {
        $nbrAjout = $_POST['nbrAjoutv'];
        $include = "formulaire.php";
        $action = "ajoutBdd";
    } elseif ($action == "modifForm") {
        $include = "modification.php";
        $id = $_POST['id'];
        $action = "modifBdd";
    } elseif ($action == "ajoutBdd" || $action == "modifBdd" || $action == "supprBdd" || $action == "resize") {
		if ($element == 'lunette') {
			session_start();
		}
        $include = "bdd2.php";
    } else {
        if ($element == "page") {
            $page = $_POST['page'];
            $action = "modifBdd";
            $include = "page.php";
        } else {
            $include = "listing.php";
        }
    }
} else {
    $include = "accueil.php";
}
include("fonctions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
        <link rel="stylesheet" media="screen" type="text/css" title="Base" href="../Base.css" />
        <link href="../images/favicon.ico" rel="SHORTCUT ICON" type="image/x-icon"/>
        <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="ckfinder/ckfinder.js"></script>


    </head>
    <body>
        <table>
            <tr>
                <td id="leftColumn"></td>
                <td id="CenterColumn">


                    <div id="header">
                        <h1>Administration</h1>
                    </div>



                    <div id="body">
                        <center>
                            <?php
                            connect();
                            include("includes/" . $include );
                            disconnect();
                            ?>
                        </center>
                    </div>
                </td>
                <td id="RightColumn"></td>
            </tr>
        </table>
    </body>
</html>