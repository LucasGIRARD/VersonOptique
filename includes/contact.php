<?php
$nom = "";
$prenom = "";
$email = "";
$objet = "";
$message = "";
$adresse = "";
$cp = "";
$ville = "";
$pays = "";
$telephone = "";
$fax = "";

$AvertissementChamp = "";
$AvertissementCount = 0;

if (!empty($_POST['Nom'])) {
    $nom = $_POST['Nom'];
} else {
    $AvertissementChamp .= "Nom";
    $AvertissementCount += 1;
}
if (!empty($_POST['Prenom'])) {
    $prenom = $_POST['Prenom'];
} else {
    if ($AvertissementCount == '1') {
        $AvertissementChamp .= ", ";
    }
    $AvertissementChamp .= "Prénom";
    $AvertissementCount += 1;
}
if (!empty($_POST['EMail'])) {
    $email = $_POST['EMail'];
} else {
    if ($AvertissementCount >= '1') {
        $AvertissementChamp .= ", ";
    }
    $AvertissementChamp .="Adresse e-mail";
    $AvertissementCount += 1;
}
if (!empty($_POST['Objet'])) {
    $objet = $_POST['Objet'];
} else {
    if ($AvertissementCount >= '1') {
        $AvertissementChamp .= ", ";
    }
    $AvertissementChamp .="Objet";
    $AvertissementCount += 1;
}
if (!empty($_POST['Message'])) {
    $message = nl2br($_POST['Message']);
} else {
    if ($AvertissementCount >= '1') {
        $AvertissementChamp .= ", ";
    }
    $AvertissementChamp .="Message";
    $AvertissementCount += 1;
}
if (!empty($_POST['Adresse'])) {
    $adresse = $_POST['Adresse'];
}
if (!empty($_POST['CodePostale'])) {
    $cp = $_POST['CodePostale'];
}
if (!empty($_POST['Ville'])) {
    $ville = $_POST['Ville'];
}
if (!empty($_POST['Pays'])) {
    $pays = $_POST['Pays'];
}
if (!empty($_POST['Telephone'])) {
    $telephone = $_POST['Telephone'];
}
if (isset($_POST['Fax'])) {
    $fax = $_POST['Fax'];
}


if ($AvertissementCount > 1) {
    $Avertissement = "les champs suivants sont mals remplis : " . $AvertissementChamp . "<br /><br />";
} else {
    $Avertissement = "le champ suivant est mal rempli : " . $AvertissementChamp . "<br /><br />";
}

if (!empty($_POST['Nom']) AND !empty($_POST['Prenom']) AND !empty($_POST['EMail']) AND !empty($_POST['Objet']) AND !empty($_POST['Message'])) {
    include('includes/mail.php');
} else {


    if (!isset($_POST['Envoye'])) {
        $Avertissement = "";
    }
    if ($langue == 'fr') {
        $txtTitre = "Formulaire de contact";
        $txtNom = "Nom";
        $txtAdresse = "Adresse";
        $txtPrenom = "Prénom";
        $txtCode = "Code postal";
        $txtMail = "Adresse e-mail";
        $txtVille = "Ville";
        $txtPays = "Pays";
        $txtTel = "Téléphone";        
        $txtObjet = "Objet du message";        
        $txtEnvoyer = "Envoyer";
        $txtOblig = "Champs obligatoires";
    } else {
        $txtTitre = "Contact Form";
        $txtNom = "Last Name";
        $txtAdresse = "Address";
        $txtPrenom = "First Name";
        $txtCode = "Postcode";
        $txtMail = "E-mail";
        $txtVille = "City";
        $txtPays = "Country";
        $txtTel = "Phone";
        $txtObjet = "Message Subject";
        $txtEnvoyer = "Send";
        $txtOblig = "Required fields";
    }
?>
    <h1><?php echo $txtTitre; ?></h1>
    <div id="Formulaire">
        <span id="FormulaireAvertissement"><?php echo $Avertissement; ?></span>
        <form action="index.php?page=contact" method="post">
            <table>
                <tr>
                    <td><label for="Nom"><?php echo $txtNom; ?><sup>*</sup> : </label></td>
                    <td><input type="text" id="Nom" name="Nom" tabindex="1" value="<?php echo $nom; ?>" /></td>

                    <td><label for="Adresse"><?php echo $txtAdresse; ?> : </label></td>
                    <td><input type="text" id="Adresse" name="Adresse" tabindex="4" value="<?php echo $adresse; ?>" /></td>

                </tr>

                <tr>
                    <td><label for="Prénom"><?php echo $txtPrenom; ?><sup>*</sup> : </label></td>
                    <td><input type="text" id="Prénom" name="Prenom" tabindex="2" value="<?php echo $prenom; ?>" /></td>

                    <td><label for="CodePostale"><?php echo $txtCode; ?> : </label></td>
                    <td><input type="text" id="CodePostale" name="CodePostale" tabindex="5" value="<?php echo $cp; ?>" /></td>

                </tr>



                <tr>
                    <td><label for="EMail"><?php echo $txtMail; ?><sup>*</sup> : </label></td>
                    <td><input type="text" id="EMail" name="EMail" tabindex="3" value="<?php echo $email; ?>" /></td>

                    <td><label for="Ville"><?php echo $txtVille; ?> : </label></td>
                    <td><input type="text" id="Ville" name="Ville" tabindex="6" value="<?php echo $ville; ?>" /></td>

                </tr>



                <tr>
                    <td></td>
                    <td></td>

                    <td><label for="Pays"><?php echo $txtPays; ?> : </label></td>
                    <td><input type="text" id="Pays" name="Pays" tabindex="7" value="<?php echo $pays; ?>" /></td>

                </tr>



                <tr>
                    <td></td>
                    <td></td>
                    <td><label for="Telephone"><?php echo $txtTel; ?> : </label></td>
                    <td><input type="text" id="Telephone" name="Telephone" tabindex="8" value="<?php echo $telephone; ?>" /></td>


                </tr>

                <tr>
                    <td></td>
                    <td></td>

                    <td><label for="Fax">Fax : </label></td>
                    <td><input type="text" id="Fax" name="Fax" tabindex="9" value="<?php echo $fax; ?>" /></td>
                </tr>
            </table>
            <div>
            <br />
            <br />
            </div>
            <table>
                <tr>
                    <td><label for="objet"><?php echo $txtObjet; ?><sup>*</sup> : </label></td>
                    <td><input type="text" id="objet" name="Objet" tabindex="10" value="<?php echo $objet; ?>" /></td>
                </tr>

                <tr>
                    <td><label for="message">Message<sup>*</sup> : </label></td>
                    <td><textarea id="message" name="Message" rows="8" cols="50" tabindex="11"><?php echo $message; ?></textarea></td>
                </tr>

                <tr>
                    <td><input type="hidden" name="Envoye" value="true" /></td>
                    <td id="boutton"><br /><input type="submit" tabindex="12" value="<?php echo $txtEnvoyer; ?>" /></td>
                </tr>

            </table>
        </form>
    </div>
    <p><sup>*</sup><?php echo $txtOblig; ?></p>
<?php
}
?>