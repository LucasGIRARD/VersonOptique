<?php
$SQL_contenu = mysqli_query($link,"SELECT contenu_page FROM page WHERE langue='".$langue."' AND nom_page='".$page."' ") or die(mysql_error());
$tableau_contenu = mysqli_fetch_array($SQL_contenu);
echo $tableau_contenu[0];
?>