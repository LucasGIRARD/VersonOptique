<?php

$link = mysqli_connect('127.0.0.1', 'root', '');

function connect() {
    global $link;
    if (!$link) {
        die('Connexion impossible : ' . mysqli_error());
    } else {
        mysqli_select_db($link,"versonoptique") or die(mysqli_error());
    }
}

function disconnect() {
    global $link;
    mysqli_close($link);
}

function select($requete) {
    global $link;
    $resultatSQL = mysqli_query($link,$requete) or die(mysqli_error());

// Récupération des lignes de résultat dans un tableau
    $tab = array();
    while ($ligne = mysqli_fetch_array($resultatSQL)) {
        $tab[] = $ligne;
    }

    mysqli_free_result($resultatSQL);



    return $tab;
}

function insert($requete) {
    global $link;
    if (mysqli_query($link,$requete) or die(mysqli_error())) {
        return true;
    } else {
        return false;
    }
}

function place_bdd($type) {

    $tableauNbrPlaceBdd = select("SELECT COUNT(*) AS nbre_place FROM place_bdd WHERE type='$type'");


    if (isset($tableauNbrPlaceBdd) && $tableauNbrPlaceBdd[0]['nbre_place'] >= "1") {

        $tableauSqlId = select("SELECT MIN(*)FROM place_bdd WHERE type='$type'");

        $id = $tableauSqlId['MIN(numero)'];

        mysqli_query($link,$link,"DELETE FROM place_bdd WHERE numero='$id' && type='$type'") or die(mysqli_error());
    } else {

        $tableauSqlId = select("SELECT MAX(id_$type) FROM $type");

        $id = $tableauSqlId[0]["MAX(id_$type)"];
        $id = $id + 1;
    }


    return $id;
}

function champSelectCreation($type, $idNbr) {

    $tableauNom = select("SELECT id_$type, nom_$type FROM $type");
    $champ = "<select id='$type$idNbr' name='$type$idNbr'>";

    foreach ($tableauNom as $ligneTableauNom) {
        $champ .= "<option value=" . $ligneTableauNom["id_$type"] . ">" . $ligneTableauNom["nom_$type"] . "</option>";
    }

    $champ .=" </select>";

    return $champ;
}

function champSelectModification($type, $id) {

    $tableauNom = select("SELECT id_$type, nom_$type FROM $type");
    $champ = "<select name='$type'>";

    foreach ($tableauNom as $ligneTableauNom) {
        if ($ligneTableauNom["id_$type"] == $id) {
            $champ .= "<option value=" . $ligneTableauNom["id_$type"] . " selected=selected>" . $ligneTableauNom["nom_$type"] . "</option>";
        } else {
            $champ .= "<option value=" . $ligneTableauNom["id_$type"] . ">" . $ligneTableauNom["nom_$type"] . "</option>";
        }
    }

    $champ .=" </select>";

    return $champ;
}

function ajoutFGMT($type, $nbrAjout) {
    for ($i = 1; $i <= $nbrAjout; $i++) {
        $nom = $_POST["nom$i"];
        $id = place_bdd($type);
        $return = true;
        if (insert("INSERT INTO $type VALUES('" . $id . "', '" . $nom . "')")) {
            if ($return != false) {
                $return = true;
            }
        } else {
            $return = false;
        }
    }
    return $return;
}

function modifFGMT($type, $id, $value) {
    $requete = "UPDATE " . $type . " SET " . $type . ".nom_" . $type . "='" . $value . "' WHERE id_" . $type . "='" . $id . "'";

    if (insert($requete)) {
        return true;
    } else {
        return false;
    }
}

function selectSelect($type) {

    $tableauNom = select("SELECT id_$type, nom_$type FROM $type");
    $champ = "<p>$type :</p><select name='$type'>";

    if (isset($_POST[$type])) {
        $champ .= "<option value=''></option>";
        foreach ($tableauNom as $ligneTableauNom) {
            if ($_POST[$type] == $ligneTableauNom["id_$type"]) {
                $champ .= "<option value=" . $ligneTableauNom["id_$type"] . " selected=selected>" . $ligneTableauNom["nom_$type"] . "</option>";
            } else {
                $champ .= "<option value=" . $ligneTableauNom["id_$type"] . ">" . $ligneTableauNom["nom_$type"] . "</option>";
            }
        }
    } else {
        $champ .= "<option value='' selected=selected></option>";
        foreach ($tableauNom as $ligneTableauNom) {
            $champ .= "<option value=" . $ligneTableauNom["id_$type"] . ">" . $ligneTableauNom["nom_$type"] . "</option>";
        }
    }

    $champ .=" </select>";

    return $champ;
}

function checkboxSelect($type) {

    $tableauNom = select("SELECT id_$type, nom_$type FROM $type");
    $champ = "<p>$type :</p><div style='max-height:85px;overflow: auto;'>";

    foreach ($tableauNom as $ligneTableauNom) {
        if (isset($_POST[$type][$ligneTableauNom["id_$type"]])) {
            $champ .= "<input type='checkbox' name='" . $type . "[" . $ligneTableauNom["id_$type"] . "]' id='" . $ligneTableauNom["nom_$type"] . "' checked='checked' /> <label for=" . $ligneTableauNom["nom_$type"] . ">" . $ligneTableauNom["nom_$type"] . "</label><br />";
        } else {
            $champ .= "<input type='checkbox' name='" . $type . "[" . $ligneTableauNom["id_$type"] . "]' id='" . $ligneTableauNom["nom_$type"] . "' /> <label for=" . $ligneTableauNom["nom_$type"] . ">" . $ligneTableauNom["nom_$type"] . "</label><br />";
        }
    }
    $champ .="</div>";

    return $champ;
}

function lunette() {
    $requete = "";
    $y = 0;
    if (isset($_POST['marque'])) {
        $i = 0;
        foreach ($_POST['marque'] as $id => $value) {
            if ($i > 0) {
                $requete .= " OR lunette.id_marque ='" . $id . "'";
                $i++;
            } else {
                $requete .= " WHERE lunette.id_marque ='" . $id . "'";
                $i++;
                $y = 1;
            }
        }
    }
    if (isset($_POST['genre']) && strlen($_POST['genre']) > 0) {
        if ($y == 1) {
            $requete .= " AND lunette.id_genre ='" . $_POST['genre'] . "'";
        } else {
            $requete .= " WHERE lunette.id_genre ='" . $_POST['genre'] . "'";
            $y = 1;
        }
    }
    if (isset($_POST['type']) && strlen($_POST['type']) > 0) {
        if ($y == 1) {
            $requete .= " AND lunette.id_type ='" . $_POST['type'] . "'";
        } else {
            $requete .= " WHERE lunette.id_type ='" . $_POST['type'] . "'";
        }
    }
    $requete .= " ORDER BY lunette.id_marque, lunette.id_lunette";


    $requeteNbr = "SELECT COUNT(*) AS nb_lunette FROM lunette" . $requete;

    $nombreLunettePPage = 30;
    $totalLunette = select($requeteNbr);
    $totalLunette = $totalLunette[0]['nb_lunette'];
    $nombreDePages = ceil($totalLunette / $nombreLunettePPage);





    if (isset($_GET['sp'])) {
        // On récupère le numéro de la page indiqué dans l'adresse (livreor.php?page=4)
        $sp = intval($_GET['sp']);
    } else { // La variable n'existe pas, c'est la première fois qu'on charge la page {
        $sp = 1; // On se met sur la page 1 (par défaut)
    }
// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
    $premierMessageAafficher = ($sp - 1) * $nombreLunettePPage;
    $requete .= " LIMIT $premierMessageAafficher, $nombreLunettePPage";
    $requeteSelect = "SELECT id_lunette, timestamp, lunette.id_marque, nom_marque, id_genre, lunette.id_type, nom_type FROM lunette JOIN marque ON marque.id_marque = lunette.id_marque JOIN type ON type.id_type = lunette.id_type" . $requete;
    $tableauNom = select($requeteSelect);
    $exIdMarque = "";
    $tableauLunette = '';

    $i = 1;
    foreach ($tableauNom as $ligneTableauNom) {
        if ($exIdMarque != "" && $exIdMarque != $ligneTableauNom['id_marque']) {
            $tableauLunette .= "</tr></table><table class='listeLunetteMarque'><tr><td>" . $ligneTableauNom['nom_marque'] . "</td></tr></table><table><tr>";
            $i = 1;
        } elseif ($exIdMarque != $ligneTableauNom['id_marque']) {
            $tableauLunette .= "<table class='listeLunetteMarque'><tr><td>" . $ligneTableauNom['nom_marque'] . "</td></tr></table><table><tr>";
        }
        if ($_POST['action'] == "modifier") {
            $tableauLunette .= "<td> <img src='../images/lunettes/mini/" . $ligneTableauNom['nom_marque'] . "-" . $ligneTableauNom['nom_type'] . "-" . $ligneTableauNom['id_lunette'] . ".jpg' alt=''> <br /> <center><form method='post' action='index.php'><input type='hidden' value='lunette' name='element' /><input type='hidden' value='" . $ligneTableauNom['id_lunette'] . "' name='id' /><input type='hidden' value='modifForm' name='action' /><input type='hidden' value='lunette' name='element' /><input type='submit' value='Modifier' /></form></center> </td>";
        } else {
            $tableauLunette .= "<td> <img src='../images/lunettes/mini/" . $ligneTableauNom['nom_marque'] . "-" . $ligneTableauNom['nom_type'] . "-" . $ligneTableauNom['id_lunette'] . ".jpg' alt=''> <br /> <center><form method='post' action='index.php'><input type='hidden' value='" . $ligneTableauNom['id_lunette'] . "' name='id' /><input type='hidden' value='supprBdd' name='action' /><input type='hidden' value='lunette' name='element' /><input type='submit' value='Supprimer' /></form></center> </td>";
        }
        $exIdMarque = $ligneTableauNom['id_marque'];
        if ($i == '7') {
            $tableauLunette .= "</tr><tr>";
            $i = 1;
        }
        $i++;
    }
    if ($totalLunette > 0) {
        $tableauLunette .= "</tr></table>";
    }



    if ($totalLunette > $nombreLunettePPage) {

        $tableauLunette .= '<br /><br /><center>Page : ';
        for ($i = 1; $i <= $nombreDePages; $i++) {
            $tableauLunette .= '<a href="index.php?page=lunettes&amp;sp=' . $i . '">' . $i . '</a> ';
        }
        $tableauLunette .= '</center>';
    }

    return $tableauLunette;
}

function returnCorrectFunction($ext) {
    $function = "";
    switch ($ext) {
        case "png":
            $function = "imagecreatefrompng";
            break;
        case "jpeg":
            $function = "imagecreatefromjpeg";
            break;
        case "jpg":
            $function = "imagecreatefromjpeg";
            break;
        case "gif":
            $function = "imagecreatefromgif";
            break;
        case "bmp":
            $function = "imagecreatefrombmp2";
            break;
    }
    return $function;
}

function imagecreatefrombmp2($filename) {
    //Ouverture du fichier en mode binaire
    if (!$f1 = fopen($filename, "rb"))
        return FALSE;

    //1 : Chargement des ent?tes FICHIER
    $FILE = unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread($f1, 14));
    if ($FILE['file_type'] != 19778)
        return FALSE;

    //2 : Chargement des ent?tes BMP
    $BMP = unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel' .
                    '/Vcompression/Vsize_bitmap/Vhoriz_resolution' .
                    '/Vvert_resolution/Vcolors_used/Vcolors_important', fread($f1, 40));
    $BMP['colors'] = pow(2, $BMP['bits_per_pixel']);
    if ($BMP['size_bitmap'] == 0)
        $BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];
    $BMP['bytes_per_pixel'] = $BMP['bits_per_pixel'] / 8;
    $BMP['bytes_per_pixel2'] = ceil($BMP['bytes_per_pixel']);
    $BMP['decal'] = ($BMP['width'] * $BMP['bytes_per_pixel'] / 4);
    $BMP['decal'] -= floor($BMP['width'] * $BMP['bytes_per_pixel'] / 4);
    $BMP['decal'] = 4 - (4 * $BMP['decal']);
    if ($BMP['decal'] == 4)
        $BMP['decal'] = 0;

    //3 : Chargement des couleurs de la palette
    $PALETTE = array();
    if ($BMP['colors'] < 16777216) {
        $PALETTE = unpack('V' . $BMP['colors'], fread($f1, $BMP['colors'] * 4));
    }

    //4 : Cr?ation de l'image
    $IMG = fread($f1, $BMP['size_bitmap']);
    $VIDE = chr(0);

    $res = imagecreatetruecolor($BMP['width'], $BMP['height']);
    $P = 0;
    $Y = $BMP['height'] - 1;
    while ($Y >= 0) {
        $X = 0;
        while ($X < $BMP['width']) {
            if ($BMP['bits_per_pixel'] == 24)
                $COLOR = unpack("V", substr($IMG, $P, 3) . $VIDE);
            elseif ($BMP['bits_per_pixel'] == 16) {
                $COLOR = unpack("n", substr($IMG, $P, 2));
                $COLOR[1] = $PALETTE[$COLOR[1] + 1];
            } elseif ($BMP['bits_per_pixel'] == 8) {
                $COLOR = unpack("n", $VIDE . substr($IMG, $P, 1));
                $COLOR[1] = $PALETTE[$COLOR[1] + 1];
            } elseif ($BMP['bits_per_pixel'] == 4) {
                $COLOR = unpack("n", $VIDE . substr($IMG, floor($P), 1));
                if (($P * 2) % 2 == 0)
                    $COLOR[1] = ($COLOR[1] >> 4); else
                    $COLOR[1] = ($COLOR[1] & 0x0F);
                $COLOR[1] = $PALETTE[$COLOR[1] + 1];
            }
            elseif ($BMP['bits_per_pixel'] == 1) {
                $COLOR = unpack("n", $VIDE . substr($IMG, floor($P), 1));
                if (($P * 8) % 8 == 0)
                    $COLOR[1] = $COLOR[1] >> 7;
                elseif (($P * 8) % 8 == 1)
                    $COLOR[1] = ($COLOR[1] & 0x40) >> 6;
                elseif (($P * 8) % 8 == 2)
                    $COLOR[1] = ($COLOR[1] & 0x20) >> 5;
                elseif (($P * 8) % 8 == 3)
                    $COLOR[1] = ($COLOR[1] & 0x10) >> 4;
                elseif (($P * 8) % 8 == 4)
                    $COLOR[1] = ($COLOR[1] & 0x8) >> 3;
                elseif (($P * 8) % 8 == 5)
                    $COLOR[1] = ($COLOR[1] & 0x4) >> 2;
                elseif (($P * 8) % 8 == 6)
                    $COLOR[1] = ($COLOR[1] & 0x2) >> 1;
                elseif (($P * 8) % 8 == 7)
                    $COLOR[1] = ($COLOR[1] & 0x1);
                $COLOR[1] = $PALETTE[$COLOR[1] + 1];
            }
            else
                return FALSE;
            imagesetpixel($res, $X, $Y, $COLOR[1]);
            $X++;
            $P += $BMP['bytes_per_pixel'];
        }
        $Y--;
        $P+=$BMP['decal'];
    }

    //Fermeture du fichier
    fclose($f1);

    return $res;
}

?>     