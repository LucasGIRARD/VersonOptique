<?php
$casePLigne = 4;
$calculLigne = $nbrAjout % $casePLigne;
if ($nbrAjout <= $casePLigne || $calculLigne == 0) {
    $ligneT1 = $nbrAjout;
    $nombreT = 1;
} else {
    $ligneT2 = $nbrAjout;
    $ligneT1 = $nbrAjout - $calculLigne;
    $nombreT = 2;
}

if ($element == "lunette") {
    for ($i = 1; $i <= $nbrAjout; $i++) {
        ${'selectMarque' . $i} = champSelectCreation('marque', $i);
        ${'selectGenre' . $i} = champSelectCreation('genre', $i);
        ${'selectType' . $i} = champSelectCreation('type', $i);
    }
    date_default_timezone_set("Europe/Paris");
    $jour = date("d");
    $mois = date("m");
    $annee = date("Y");
}
?>


<form action="index.php" enctype="multipart/form-data" method="POST" >
<?php
$i = 1 ;
if ($element == "lunette") {
    for ($y = 1; $y <= $nombreT; $y++) {
        echo "<table><tr>";
        for ($i = $i; $i <= ${'ligneT' . $y}; $i++) {
            echo "<td> <p>$element $i</p> <br />
<label for='jour$i'>date :</label> <input type='text' id='jour$i' name='jour$i' size='1' maxlength='2' value='$jour' /> / <input type='text' name='mois$i' size='1' maxlength='2' value='$mois' /> / <input type='text' name='annee$i' size='2' maxlength='4' value='$annee' /> <br /><br />
<label for='marque$i'>marque :</label>
${'selectMarque' . $i}
<br /><br />
<label for='genre$i'>genre :</label>
${'selectGenre' . $i}
<br /><br />
<label for='type$i'>type :</label>
${'selectType' . $i}
<br /><br />
<label for='photo$i'>photo :</label> <input type='file' id='photo$i' name='photo$i' /> <br /><br /></td>";
            if ($i % $casePLigne == 0) {
                echo "</tr><tr>";
            }
        }
        echo "</tr></table>";
    }
} else {

    for ($y = 1; $y <= $nombreT; $y++) {
        echo "<table><tr>";
        for ($i = $i; $i <= ${'ligneT' . $y}; $i++) {
            echo "<td> <p>$element $i</p> <br /> <label for='nom$i'>Nom :</label> <input type='text' id='nom$i' name='nom$i' value='' /> </td>";
            if ($i % $casePLigne == 0) {
                echo "</tr><tr>";
            }
        }
        echo "</tr></table>";
    }
}
?>
    <input type='hidden' name='nbrAjout' value="<?php echo $nbrAjout; ?>" />
    <input type='hidden' name='action' value="<?php echo $action; ?>" />
    <input type='hidden' name='element' value="<?php echo $element; ?>" />
    <br />
    <input type="submit" value="valider" />
</form>



