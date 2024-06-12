

<?php
if ($element == "lunette") {
$tableauBDD = select("SELECT * FROM lunette JOIN marque ON marque.id_marque = lunette.id_marque JOIN TYPE ON type.id_type = lunette.id_type WHERE id_lunette='$id'");
    $selectMarque = champSelectModification('marque',$tableauBDD[0]["id_marque"]);
    $selectGenre = champSelectModification('genre',$tableauBDD[0]["id_genre"]);
    $selectType = champSelectModification('type',$tableauBDD[0]["id_type"]);

    $timestamp = $tableauBDD[0]["timestamp"];
    date_default_timezone_set("Europe/Paris");
    $jour = date('d', $timestamp);
    $mois = date('m', $timestamp);
    $annee = date('Y', $timestamp);
    $heure = date('H', $timestamp);
    $minute = date('i', $timestamp);

    $image = "../images/lunettes/mini/" . $tableauBDD[0]['nom_marque'] . "-" . $tableauBDD[0]['nom_type'] . "-" . $tableauBDD[0]['id_lunette'] . ".jpg";
}
else {
    $tableauBDD = select("SELECT * FROM ".$element." WHERE id_".$element."='$id'");
    $nom = $tableauBDD[0]["nom_".$element.""];
}
?>


<form action="index.php" enctype="multipart/form-data" method="POST" >
    <?php
    $i = 1;
    if ($element == "lunette") {
        echo "<table><tr><td> <p>Lunette</p><br />
<label for='jour'>date :</label> <input type='text' id='jour' name='jour' size='1' maxlength='2' value='$jour' /> / <input type='text' name='mois' size='1' maxlength='2' value='$mois' /> / <input type='text' name='annee' size='2' maxlength='4' value='$annee' /> <br /><br />
<label for='marque'>marque :</label>
$selectMarque
<br /><br />
<label for='genre'>genre :</label>
$selectGenre
<br /><br />
<label for='type'>type :</label>
$selectType
<br /><br />
 <p>aperçu photo : </p><img alt='' src='$image' />
<br /><br />
<label for='photo'>photo :</label> <input type='file' id='photo' name='photo' /> <br /><br /></td></tr></table>";
    } else {
        echo "<table><tr><td> <p>$element</p> <br /> <label for='nom'>Nom :</label> <input type='text' id='nom' name='nom' value='$nom' /> </td></tr></table>";
    }
    ?>
    <input type='hidden' name='id' value="<?php echo $id; ?>" />
    <input type='hidden' name='action' value="<?php echo $action; ?>" />
    <input type='hidden' name='element' value="<?php echo $element; ?>" />
    <br />
    <input type="submit" value="valider" />
</form>



