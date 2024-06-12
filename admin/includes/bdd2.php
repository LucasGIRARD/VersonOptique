<?php
ini_set('memory_limit', "512M");
ini_set('upload_max_filesize', "4M");
if ($action == "ajoutBdd") {
    $nbrAjout = $_POST['nbrAjout'];
    switch ($element) {
        case 'lunette':
            
            for ($i = 1; $i <= $nbrAjout; $i++) {

                $file = $_FILES["photo" . $i];

                if ($file['error'] == 0) {

                    $tmp_file = $file['tmp_name'];


                    if (!is_uploaded_file($tmp_file)) {
                        $message = "une erreur lors de l'upload du fichier " . $fileName . " s'est produit.";
                    } else {

                        $allowedExtensions = array("jpg", "jpeg", "gif", "png", "bmp");
                        $split = explode(".", strtolower($file['name']));
                        $extension = end($split);

                        if (!preg_match('/image/i', $file['type']) && !in_array($extension, $allowedExtensions)) {
                            $message = "n'est pas reconnu comme une image!";
                        } else {
                            $idMarque = $_POST["marque" . $i];
                            $marque = select("SELECT nom_marque FROM marque WHERE id_marque=" . $idMarque);
                            $idType = $_POST["type" . $i];
                            $type = select("SELECT nom_type FROM type WHERE id_type=$idType");
                            $idLunette = place_bdd($element);

                            $fileName = $marque[0]['nom_marque'] . "-" . $type[0]['nom_type'] . "-" . $idLunette . "." . $extension;
                            $uploaddir = "../images/lunettes/original";  // dossier ou sera déplacé la photo
                            $path = $uploaddir . "/" . $fileName;

                            if (!move_uploaded_file($tmp_file, $path)) {
                                $message = "Impossible de copier la photo dans $uploaddir";
                            } else {
                                $message = "Le fichier " . $fileName . "  a bien été uploadé";

                                $jour = $_POST["jour" . $i];
                                $mois = $_POST["mois" . $i];
                                $annee = $_POST["annee" . $i];
                                $idGenre = $_POST["genre" . $i];
                                date_default_timezone_set('Europe/Paris');
                                $date = mktime("0", "0", "0", $mois, $jour, $annee);

                                $photo[0][$i] = $idLunette;
                                $photo[1][$i] = $fileName;

                                if (insert("INSERT INTO lunette VALUES('" . $idLunette . "', '" . $date . "', '" . $idMarque . "', '" . $idGenre . "', '" . $idType . "', '0')")) {
                                    $message .= "<br />insertion dans la base de donnée réussie.<br /><br />";
                                } else {
                                    $message .= "<bt />échec de l'insertion dans la base de donnée.<br /><br />";
                                }
                            }
                        }
                    }
                } else {
                    $messageErreurPHP = array("",
                        "Le fichier téléchargé excède la taille authorisé par le serveur. <!--(php.ini => upload_max_filesize) -->",
                        "Le fichier téléchargé excède la taille authorisé par le formulaire. <!--(HTML => MAX_FILE_SIZE) -->",
                        "Le fichier n'a été que partiellement téléchargé. <!-- (max_execution_time) -->",
                        "Aucun fichier n'a été téléchargé.",
                        "",
                        "Le fichier n'a pas été téléchargé. <!--(serveur => dossier temporaire) -->",
                        "Le fichier n'a pas été téléchargé. <!--(serveur => droit d'écriture) -->",
                        "Le fichier n'a pas été téléchargé. <!--(serveur => extension PHP -->");
                    $message = $messageErreurPHP[$file['error']];
                }
            }
            
            $_SESSION['photoTemp'] = $photo;
            $i = 1;

            break;
        case 'type':
        case 'genre':
        case 'marque':
            if (ajoutFGMT($element, $nbrAjout)) {
                $message = $element . " correctement ajouté";
            } else {
                $message = $element . " non correctement ajouté";
            }

            break;
    }
} elseif ($action == "modifBdd") {
    switch ($element) {
        case 'lunette':

            for ($i = 1; $i <= $nbrAjout; $i++) {



                $idMarque = $_POST["marque" . $i];
                $marque = select("SELECT nom_marque FROM marque WHERE id_marque=" . $idMarque);
                $marque = $marque[0]['nom_marque'];

                $idType = $_POST["type" . $i];
                $type = select("SELECT nom_type FROM type WHERE id_type=$idType");
                $type = $type[0]['nom_type'];

                $idLunette = $id;

                $jour = $_POST["jour" . $i];
                $mois = $_POST["mois" . $i];
                $annee = $_POST["annee" . $i];
                date_default_timezone_set('Europe/Paris');
                $date = mktime("0", "0", "0", $mois, $jour, $annee);

                $idGenre = $_POST["genre" . $i];

                $file = $_FILES["photo" . $i];

                if ($file['error'] == 0) {

                    $exLunette = select("SELECT lunette.id_marque, marque.nom_marque, lunette.id_type, type.nom_type FROM lunette JOIN marque ON marque.id_marque = lunette.id_marque JOIN type ON type.id_type = lunette.id_type WHERE id_lunette = " . $id);
                    $exLunetteName = $exLunette["nom_marque"] . "-" . $exLunette["nom_type"] . "-" . $id . ".jpg";

                    unlink("../images/lunettes/original/" . $exLunetteName);
                    unlink("../images/lunettes/mini/" . $exLunetteName);
                    unlink("../images/lunettes/normal/" . $exLunetteName);


                    $tmp_file = $file['tmp_name'];

                    if (!is_uploaded_file($tmp_file)) {
                        $message = "une erreur lors de l'upload du fichier " . $fileName . " s'est produit.";
                    } else {

                        $allowedExtensions = array("jpg", "jpeg", "gif", "png", "bmp");
                        $split = explode(".", strtolower($file['name']));
                        $extension = end($split);

                        if (!preg_match('/image/i', $file['type']) && !in_array($extension, $allowedExtensions)) {
                            $message = "n'est pas reconnu comme une image!";
                        } else {

                            $fileName = $marque . "-" . $type . "-" . $idLunette . "." . $extension;
                            $uploaddir = "../images/lunettes/original";  // dossier ou sera déplacé la photo
                            $path = $uploaddir . "/" . $fileName;

                            if (!move_uploaded_file($tmp_file, $path)) {
                                $message = "Impossible de copier la photo dans $uploaddir";
                            } else {
                                $message = "Le fichier " . $fileName . "  a bien été uploadé";

                                $photo[0][$i] = $idLunette;
                                $photo[1][$i] = $fileName;
                            }
                        }
                    }
                } elseif ($file['error'] == 4) {
                    $exLunette = select("SELECT lunette.id_marque, marque.nom_marque, lunette.id_type, type.nom_type FROM lunette JOIN marque ON marque.id_marque = lunette.id_marque JOIN type ON type.id_type = lunette.id_type WHERE id_lunette = " . $id);
                    $exLunetteName = $exLunette["nom_marque"] . "-" . $exLunette["nom_type"] . "-" . $id . ".jpg";

                    $LunetteName = $marque . "-" . $type . "-" . $id . ".jpg";

                    rename("../images/lunettes/original/" . $exLunetteName, "../images/lunettes/original/" . $LunetteName);
                    rename("../images/lunettes/mini/" . $exLunetteName, "../images/lunettes/mini/" . $LunetteName);
                    rename("../images/lunettes/normal/" . $exLunetteName, "../images/lunettes/normal/" . $LunetteName);
                } else {
                    $messageErreurPHP = array("",
                        "Le fichier téléchargé excède la taille authorisé par le serveur. <!--(php.ini => upload_max_filesize) -->",
                        "Le fichier téléchargé excède la taille authorisé par le formulaire. <!--(HTML => MAX_FILE_SIZE) -->",
                        "Le fichier n'a été que partiellement téléchargé. <!-- (max_execution_time) -->",
                        "Aucun fichier n'a été téléchargé.",
                        "",
                        "Le fichier n'a pas été téléchargé. <!--(serveur => dossier temporaire) -->",
                        "Le fichier n'a pas été téléchargé. <!--(serveur => droit d'écriture) -->",
                        "Le fichier n'a pas été téléchargé. <!--(serveur => extension PHP -->");
                    $message = $messageErreurPHP[$file['error']];
                }

                if (insert("UPDATE lunette SET timestamp='" . $timestamp . "', id_marque='" . $idMarque . "', id_genre='" . $idGenre . "', id_type='" . $idType . "' WHERE id_lunette='" . $id . "'")) {
                    $message .= "<br />Mise à jour de la base de donnée réussie.<br /><br />";
                } else {
                    $message .= "<bt />échec de la mise à jour de la base de donnée.<br /><br />";
                }
            }
            $_SESSION['photoTemp'] = $photo;
            $i = 1;

            break;

        case 'type':
        case 'genre':
        case 'marque':
            if (modifFGMT($element, $_POST['id'], $_POST['nom'])) {
                $message = $element . " correctement modifié";
            } else {
                $message = "la modification de l'élément \"" . $element . "\" à subit un problème!";
            }
            break;
        case 'page':

            $nom = $_POST['page'];
            $contenu_pageFR = $_POST['editor1'];
            $contenu_pageEN = $_POST['editor2'];
            if (insert("UPDATE page SET contenu_page='" . $contenu_pageFR . "' WHERE nom_page='" . $nom . "' AND langue='fr'")) {
                $message = "Mise à jour de la page en français réussie.<br /><br />";
            } else {
                $message = "échec de la mise à jour de la page en français.<br /><br />";
            }
            if (insert("UPDATE page SET contenu_page='" . $contenu_pageEN . "' WHERE nom_page='" . $nom . "' AND langue='en'")) {
                $message .= "Mise à jour de la page en anglais réussie.";
            } else {
                $message .= "échec de la mise à jour de la page en anglais.";
            }

            break;
    }
} elseif ($action == "supprBdd") {
    $id = $_POST['id'];
    if ($element == "lunette") {
        $exLunette = select("SELECT lunette.id_marque, marque.nom_marque, lunette.id_type, type.nom_type FROM lunette JOIN marque ON marque.id_marque = lunette.id_marque JOIN type ON type.id_type = lunette.id_type WHERE id_lunette = " . $id);
        $exLunetteName = $exLunette["nom_marque"] . "-" . $exLunette["nom_type"] . "-" . $id . ".jpg";

        unlink("../images/lunettes/original/" . $exLunetteName);
        unlink("../images/lunettes/mini/" . $exLunetteName);
        unlink("../images/lunettes/normal/" . $exLunetteName);
    }
    if (insert("DELETE FROM $element WHERE id_$element = $id")) {
        $message = $element . " correctement supprimé";
    }
}
if ($action == "resize") {
    $i = $_POST['compteur'];
    session_start();
    $photo = $_SESSION['photoTemp'];
    $tempImage = "../images/lunettes/original/" . $photo[1][$i];
    $imageD = "../images/lunettes/normal/" . $photo[1][$i];
    $imageDThumb = "../images/lunettes/mini/" . $photo[1][$i];
    $angle = $_POST['angle'];
    $difH = 0;
    $difW = 0;


    $split = explode('.', $tempImage);
    $ext = end($split);

    $function = returnCorrectFunction($ext);
    $image = $function($tempImage);


    list($imageBaseWidth, $imageBaseHeight) = getimagesize($tempImage);

    $ratioW = $imageBaseWidth / 100;
    $ratioH = $imageBaseHeight / 100;
    if ($ratioH > $ratioW) {
        $ratio = $ratioH;
    } else {
        $ratio = $ratioW;
    }
    $blackTop = $_POST['blackTop'] * $ratio;
    $blackBottom = $_POST['blackBottom'] * $ratio;
    $blackLeft = $_POST['blackLeft'] * $ratio;
    $blackRight = $_POST['blackRight'] * $ratio;

    $tempModifWidth = $_POST["imageNewWidth"];
    $tempModifHeight = $_POST["imageNewHeight"];
    $modifWidth = $tempModifWidth * $ratio;
    $modifHeight = $tempModifHeight * $ratio;

    if ($modifHeight > $modifWidth) {
        $newHeight = $modifHeight;
        $newWidth = $modifHeight;
    } elseif ($modifHeight == 0 && $modifWidth == 0) {
        $newHeight = $imageBaseHeight;
        $newWidth = $imageBaseWidth;
    } else {
        $newHeight = $modifWidth;
        $newWidth = $modifWidth;
    }

    if ($angle != 0 && $angle != 360) {
        $x1 = imagesx($image);
        $y1 = imagesy($image);
        $white = imageColorAllocate($image, 255, 255, 255);
        $image = imagerotate($image, $angle, $white);
        $x2 = imagesx($image);
        $y2 = imagesy($image);
        if ($modifHeight < $x2) {
            $difH = ($x2 - $x1) / 2;
        } else {
            $imageBaseHeight = $x2;
        }
        if ($modifWidth < $y2) {
            $difW = ($y2 - $y1) / 2;
        } else {

            $imageBaseWidth = $y2;
        }
    }

    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    imageantialias($newImage, true);

    $bg = imagecolorallocate($newImage, 255, 255, 255);
    imagefill($newImage, 0, 0, $bg);


    if ($blackTop > 0) {
        $src_x = $blackTop + $difH;
    } else {
        $src_x = 0 + $difH;
    }

    if ($blackLeft > 0) {
        $src_y = $blackLeft + $difW;
    } else {
        $src_y = 0 + $difW;
    }
    if ($blackTop > 0 || $blackBottom > 0) {
        $src_h = $modifHeight;
    } else {
        $src_h = $imageBaseWidth;
    }
    if ($blackLeft > 0 || $blackRight > 0) {
        $src_w = $modifWidth;
    } else {
        $src_w = $imageBaseWidth;
    }



    $dst_x = ($newHeight / 2) - ($src_h / 2);
    $dst_y = ($newWidth / 2) - ($src_w / 2);
    $dst_h = $src_h;
    $dst_w = $src_w;



    imagecopyresampled($newImage, $image, $dst_y, $dst_x, $src_y, $src_x, $dst_w, $dst_h, $src_w, $src_h);

    $xr = 0;
    $yr = 0;
    $src_hr = $newHeight;
    $src_wr = $newWidth;
    $dst_hwr1 = 500;
    $dst_hwr2 = 100;

    $dst_imager1 = imagecreatetruecolor($dst_hwr1, $dst_hwr1);
    $dst_imager2 = imagecreatetruecolor($dst_hwr2, $dst_hwr2);
    imageantialias($dst_imager1, true);
    imageantialias($dst_imager2, true);
    imagecopyresized($dst_imager1, $newImage, $xr, $yr, $xr, $yr, $dst_hwr1, $dst_hwr1, $src_wr, $src_hr);
    imagecopyresized($dst_imager2, $newImage, $xr, $yr, $xr, $yr, $dst_hwr2, $dst_hwr2, $src_wr, $src_hr);


    imagejpeg($dst_imager1, $imageD, 100);
    imagejpeg($dst_imager2, $imageDThumb, 100);

    imagedestroy($image);


    insert("UPDATE lunette SET lunette.active=1 WHERE lunette.id_lunette=" . $photo[0][$i]);
    $i++;
}

if (!isset($i) || !isset($photo[1][$i])) {
    echo '<meta http-equiv="refresh" content="1; URL=index.php">';
} else {
    include("image.php");
}
?>
<p id="messageAdministration"><?php echo $message; ?></p>