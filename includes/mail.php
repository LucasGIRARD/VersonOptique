<?php
$headers = 'From: ' . $nom . ' ' . $prenom . ' <' . $email . '>' . "\n";
$headers .='Reply-To: ' . $email . '' . "\n";
$headers .='Content-Type: text/html; charset="ISO-8859-15"' . "\n";
$headers .='Content-Transfer-Encoding: 8bit';

$sujet = "[SITE INTERNET] : " . $objet;

$mail = "<html><head><title>" . $sujet . "</title></head><body><b>Nom</b> : " . $nom . "<br /><b>Prénom</b> : " . $prenom . "<br /><b>Adresse E-mail</b> : " . $email . "<br /><b>Adresse</b> : " . $adresse . "<br /><b>CP</b> : " . $cp . "<br /><b>Ville</b> : " . $ville . "<br /><b>Pays</b> : " . $pays . "<br /><b>Téléphone</b> : " . $telephone . "<br /><b>Fax</b> : " . $fax . "<br /><b>Message</b> : <br /><br />" . $message . "<br /><br />";


if (mail('contact@versonoptique.net', $sujet, $mail, $headers)) {
    echo '<div id="messageMail">Le mail a été envoyé.<br /><br />';
} else {
    echo '<div id="messageMail">Le mail n\'a pu être envoyé.<br /><br />';
}
echo "Redirection en cours.<meta http-equiv='refresh' content='5; URL=index.php'></div>";
?>
