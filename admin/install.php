<?php

$link = mysqli_connect('127.0.0.1', 'root', '');
mysqli_set_charset($link, "utf8");
mysqli_query($link,"DROP DATABASE IF EXISTS versonoptique") or die(mysqli_error());
mysqli_query($link,"CREATE DATABASE versonoptique") or die(mysqli_error());

mysqli_select_db($link,"versonoptique") or die(mysqli_error());

mysqli_query($link,"DROP TABLE IF EXISTS lunette") or die(mysqli_error());
mysqli_query($link,"DROP TABLE IF EXISTS type") or die(mysqli_error());
mysqli_query($link,"DROP TABLE IF EXISTS marque") or die(mysqli_error());
mysqli_query($link,"DROP TABLE IF EXISTS genre") or die(mysqli_error());
mysqli_query($link,"DROP TABLE IF EXISTS page") or die(mysqli_error());
mysqli_query($link,"DROP TABLE IF EXISTS place_bdd") or die(mysqli_error());

mysqli_query($link,"CREATE TABLE type (
  id_type tinyint NOT NULL,
  nom_type varchar(20) NOT NULL,
  PRIMARY KEY  (`id_type`)
) ENGINE=InnoDB;") or die(mysqli_error());


mysqli_query($link,"CREATE TABLE marque (
  id_marque tinyint NOT NULL,
  nom_marque varchar(20) NOT NULL,
  PRIMARY KEY  (`id_marque`)
) ENGINE=InnoDB;") or die(mysqli_error());


mysqli_query($link,"CREATE TABLE genre (
  id_genre tinyint NOT NULL,
  nom_genre varchar(20) NOT NULL,
  PRIMARY KEY  (`id_genre`)
) ENGINE=InnoDB;") or die(mysqli_error());


mysqli_query($link,"CREATE TABLE lunette (
  id_lunette tinyint NOT NULL,
  timestamp int NOT NULL,
  id_marque tinyint NOT NULL,
  id_genre tinyint NOT NULL,
  id_type tinyint NOT NULL,
  active boolean  NOT NULL,
  PRIMARY KEY  (`id_lunette`),
  FOREIGN KEY (`id_marque`) REFERENCES `marque` (`id_marque`) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;") or die(mysqli_error());


mysqli_query($link,"CREATE TABLE page (
  id_page tinyint NOT NULL,
  nom_page varchar(20) NOT NULL,
  contenu_page text NOT NULL,
  langue char(2) NOT NULL,
  PRIMARY KEY  (`id_page`)
) ENGINE=InnoDB;") or die(mysqli_error());


mysqli_query($link,"CREATE TABLE place_bdd (
  id tinyint auto_increment NOT NULL,
  type char(7) NOT NULL,
  numero tinyint(2) NOT NULL,
  PRIMARY KEY  (`id`)
)") or die(mysqli_error());

mysqli_query($link,"INSERT INTO page VALUES(
    '0',
    'accueil',
    '<h1>Notre magasin</h1>

<div class=\"image\"><img src=\"images/Magasin-exterieur.jpg\" alt=\"photo extérieur du magasin\" /> </div>
<br />
<p>
Installés dans la rue commerçante de VERSON depuis mai 2008, Ver\' Son Optique est un opticien indépendant, notre engagement est donc de tout mettre en oeuvre afin d\'offrir à nos clients un accueil et un service de qualité. Le besoin du client sera toujours prioritaire.<br />
Nous sommes rattaché à une centrale d\'achat afin de vous proposer les meilleurs: prix, choix, ainsi que la qualité. De plus, notre éthique se situe autour de deux axes qui sont : le conseil et le service de qualité.<br />
<br />
Que ce soit des montures de créateurs, de couturiers ou sportives, nous vous proposons un vaste choix puisque le magasin dispose de plus de 1000 montures renouvelé régulièrement.<br />
Nous disposons entre autres des marques suivantes:
</p>
<br />
<br />
<div class=\"image\"><img src=\"images/logo/couturier/chloe.jpg\" alt=\"logo chloé\" /><img src=\"images/logo/couturier/hugo-boss.jpg\" alt=\"logo hugo boss\" /><img src=\"images/logo/couturier/emporio-armani.jpg\" alt=\"logo emporio armani\" /><img src=\"images/logo/couturier/dior.jpg\" alt=\"logo dior\" /></div>
<br />
<div class=\"image\"><img src=\"images/logo/createur/oxibis.jpg\" alt=\"logo oxibis\" /><img src=\"images/logo/createur/chez-colette.jpg\" alt=\"logo chez colette\" /><img src=\"images/logo/createur/vanni.jpg\" alt=\"logo vanni\" /><img src=\"images/logo/createur/william-morris.jpg\" alt=\"logo william morris\" /><img src=\"images/logo/createur/dilem.jpg\" alt=\"logo dilem\" /></div>
<br />
<div class=\"image\"><img src=\"images/logo/sport/rip-curl.jpg\" alt=\"logo rip curl\" /><img src=\"images/logo/sport/julbo.jpg\" alt=\"logo julbo\" /><img src=\"images/logo/sport/rebel.jpg\" alt=\"logo rebel\" /><img src=\"images/logo/sport/mawi-jim.jpg\" alt=\"logo mawi jim\" /></div>
<br />
<h4>Conditions de paiements :</h4>
<p>
Nous pratiquons le Tiers-Payant avec le plus grand nombre de mutuelles et complémentaires santé, vous n\'aurez pas à vous inquiéter du paiement, Ver\' Son Optique fait tout pour vous faciliter la vie.<br />
Si toutefois le Tiers-Payant n\'était pas praticable, sachez que nous acceptons tous les moyens de paiement classiques (chèques, espèces, cartes bancaires). Nous acceptons également le paiement en plusieurs fois, sans frais supplémentaires (voir conditions en magasin).<br />
</p>
<h4>Garantie satisfaction visuelle :</h4>
<p>
Chez Ver\' Son Optique le service ne s\'arrête pas à la vente. Si malgré un port régulier de vos lunettes, vos verres ne vous donnent pas le confort annoncé, nous vous proposons un nouveau réglage (90 % des cas), ou éventuellement un échange de vos verres (après un contrôle) dans un délai maximum d\'un mois (à compter de la date figurant sur votre carte d\'authenticité Essilor).<br />
</p>
<h4>La 2ème paire pour 1¤ de plus :</h4>
<p>
Lors de l\'achat d\'une paire de lunette (monture + 2 verres), nous vous proposons une seconde paire à moindre frais. Mais moindre frais n\'est pas synonyme de mauvaise qualité ou de choix. Chez Ver\' Son Optique vous aurez le choix parmi des dizaines de montures, vous bénéficierez des verres \" ESSILOR \" comme sur toutes nos montures ainsi que des mêmes garantie et service, ceci ne peut être que gage de qualité.<br />
<br />
Afin d\'être plus proche de la demande de nos clients, nous possédons un tout nouveau centre d\'adaptation, permettant la vérification de la vue.<br />
</p>
<h3>Nos horaires:</h3>
<p>
Du mardi au vendredi: de 9H à 12H30 et de 14H30 à 19H<br />
Le samedi: de 9H à 12H30 et de 14H30 à 18H
</p>',
    'fr')"
) or die(mysqli_error());

mysqli_query($link,"INSERT INTO page VALUES(
    '1',
    'localisation',
    '<h3>Accès en bus :</h3>
-\"Bus Vert\" ligne 9<br />
-\"Bus Vert\" ligne 32<br />
<br />
les horaires sont disponibles pour ces lignes <a href=\"http://www.busverts.fr\">ici</a>.
<h3>Accès en voiture :</h3>
<p>pour cela il suffit de faire un itinéraire via \"Google Map\" en cliquant dans l\'encadré ci-dessus.</p>
<br /><br />
<div id=\"carte\"><iframe width=\"700\" height=\"500\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=ver\'son+optique&amp;sll=49.310799,1.757813&amp;sspn=8.094906,23.269043&amp;ie=UTF8&amp;hq=ver\'son+optique&amp;hnear=&amp;ll=49.155196,-0.452874&amp;spn=0.12114,0.363579&amp;t=h&amp;z=12&amp;iwloc=A&amp;cid=135647432708236301&amp;output=embed\"></iframe><br /><small><a href=\"http://maps.google.fr/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=ver\'son+optique&amp;sll=49.310799,1.757813&amp;sspn=8.094906,23.269043&amp;ie=UTF8&amp;hq=ver\'son+optique&amp;hnear=&amp;ll=49.155196,-0.452874&amp;spn=0.12114,0.363579&amp;t=h&amp;z=12&amp;iwloc=A&amp;cid=135647432708236301\" style=\"color:#0000FF;text-align:left\">Aller sur Google Map</a></small></div>',
    'fr')"
) or die(mysqli_error());

mysqli_query($link,"INSERT INTO page VALUES(
    '2',
    'verre-lentille',
    '<table><tr><td><img src=\"images/logo/Essilor-logo.jpg\" alt=\"logo essilor\" /></td><td><h2>Essilor</h2></td></tr></table>
<br />
<p>
Ver\' Son Optique travaille uniquement avec Essilor, pour vous assurez la plus grande qualité, n\'étant qu\'autre que le n°1 mondial du verre, une référence en terme de savoir-faire et d\'innovation, ESSILOR est pour vous la certitude que vos lunettes seront équipées de ce qui se fait de mieux.<br />
<br />
Parce que tous les verres ne sont pas des Essilor, 1 moyen vous assure de l\'authenticité de vos verres :<br />
<br />
- Le certificat d\'authenticité remis lors de l\'achat de vos verres, il contient les informations indispensables sur votre vue (correction, type de verre...).
<br />
<br />
Essilor est l\'un des groupes français les plus internationaux, présent dans plus de 100 pays, principalement en Europe, en Asie, et sur le continent américain.<br />
Pilier stratégique de l\'entreprise, l\'entité Recherche et Développement d\'Essilor constitue un véritable laboratoire d\'innovation.<br />
Elle assure l\'avance technologique du groupe.<br />
<br />
A l\'échelle mondiale, les équipes R&amp;D se concentrent sur deux axes primordiaux :<br />
- Anticiper les attentes des marchés mondiaux,<br />
- Développer les verres du futur en s\'appuyant sur les meilleures expertises mondiales.<br />
<br />
<br />
</p>
<h4>Quelques chiffres :</h4>
<p>
- N°1 mondial de l\'optique ophtalmique,<br />
- plus de 150 ans d\'expérience,<br />
- 34 320 collaborateurs,<br />
- 3 milliards d\'euros de Chiffre d\'affaires en 2008,<br />
- 245 millions de verres de 450 000 références différentes en 2008,<br />
- 5 centres de R&amp;D,<br />
- 293 laboratoires de prescription,<br />
- 15 usines,<br />
- 12 centres de logistique,<br />
- 500 chercheurs répartis dans 4 centres : Etats-Unis, France, Japon, Singapour,<br />
- 5% du chiffre d\'affaires investi annuellement dans la recherche et le développement,<br />
- Près de 2600 brevets (ou demandes) et désignations en portefeuille au 31.12.2005<br />
- 50% du chiffre d\'affaires réalisé avec des produits lancés depuis moins de 5 ans,<br />
- 30% du chiffre d\'affaires réalisé grâce à des innovations de moins de 3 ans.<br />
<br />
<br />
</p>
<img src=\"images/logo/Essilor-varilux-logo.jpg\" alt=\"logo essilor varilux\" />
<h4>Essilor, l\'inventeur du Varilux</h4>
<p>
Le verre Varilux a été inventé en 1959 par Essel, qui deviendra une partie du groupe Essilor par la suite, Varilux était le premier verre progressif au monde, grâce auquel il était possible de voir facilement et parfaitement, de près comme de loin sans transition et avec la même paire de verres. Depuis, différents verres progressifs ont fait leur apparition sur le marché, tous élaborés sur la base du verre Varilux original. Pourtant, le verre Varilux n\'a jamais été égalé. Aujourd\'hui, Varilux compte plus de 300 millions de porteurs satisfaits dans le monde (un nouveau porteur toutes les 4 secondes) et Essilor continue à améliorer les performances de ses produits. La majorité des études qui avaient été faites pour la correction de la vue, étaient généralement incomplètes. Dans ce domaine également, Essilor a toujours eu une longueur d\'avance, puisque sa seule préoccupation reste les attentes et les besoins des porteurs, c\'est pour cela que la gamme Varilux® a connu 6 génération entre 1959 et 2006<br />
<br />
<br />
</p>
<h4>Ver\' Son Optique s\'engage avec Essilor sur la qualité:</h4>
<p>
Nous délivrons à nos clients une information complète, éthique, claire et pédagogique ;<br />
Nous leurs réservons un accueil personnalisé ;<br />
Toute l\'équipe se tient régulièrement informé sur les dernières innovations technologiques et sur l\'applications de ces dernières ;<br />
Echange avec d\'autres professionnels de la santé ;<br />
<br />
Tout cela nous permet de mieux répondre aux besoins quotidiens de chacun de nos clients<br />
<br />
<br />
</p>
<h4>Les garanties :</h4>
<p>
Les verres Essilor sont garantis contre tout défaut de fabrication pendant 2 ans (après expertise par le laboratoire)<br />
Les verres progressifs Essilor sont garantis d\'adaptation (notamment pour les verres progressifs Varilux) pendant 1 mois maximum (à compter de la date figurant sur le certificat d\'authenticité Essilor).<br />
Ce délai pourra être rallongé si, dans le 1er mois, vous nous avez fait part de votre inconfort et de votre indisponibilité afin que nous puissions vérifier votre équipement (Ouverture d\'un dossier auprès d\'Essilor).<br />
<br />
</p>
<h4>Les recommandations :</h4>
<p>
Il est toujours possible de rayer ou de casser un verre, même si celui-ci est traité. Nous ne prenons donc pas en charge les défauts d\'utilisation :<br />
Eviter la soumission de votre équipement à de fortes chaleurs (par ex: dans le vide-poche d\'une voiture au soleil)<br />
Eviter la soumission de votre équipement à des produits chimiques (par ex: peintures, vernis, solvants,...)<br />
Adopter uniquement les produits d\'entretien recommandés par les opticiens (Siclair, Sinett, Optinett,...)<br />
Si vous avez une question ou besoin de conseils sur l\'entretien de votre équipement,
<a href=\"http://www.essilor.fr/verre-optique/produit-essilor.htm?id=124\">retrouver toute la gamme de verres Essilor</a>.<br />
<br />
</p>
<h4>Services Essilor :</h4>
<table>
  <tr>
    <td>1.Service Conseil</td>
    <td>5.Garantie Vol</td>
  </tr>
  <tr>
    <td>2.Garantie d\'authenticité</td>
    <td>6.Varilux Travel Assistance</td>
  </tr>
  <tr>
    <td>3.Garantie satisfaction</td>
    <td>7.Entretien gratuit</td>
  </tr>
  <tr>
    <td>4.Garantie Casse</td>
    <td></td>
  </tr>
</table>
<br />
<h4>L\'entretien :</h4>
<br />
<br />
<h2>Les lentilles de contact :</h2>
<br />
<p>
Les lentilles de contact présentent de nombreux avantages :

- Elles sont esthétiques, confortables et pratiques
- Elles se portent à tout âge
- Elles offrent une complète restitution de champ de vision
- Elles permettent une grande liberté.

En fonction de votre défaut visuel, le type des lentilles de contact est différent.


Nous travaillons avec toutes les marques de lentilles de contacts, afin d\'obtenir le meilleur confort et la meilleur qualité pour vous.<br />

Il n\'est pas simple de porter des lentilles de contact pour la première fois. C\'est pourquoi nous vous accompagnons dans cette démarche. Nous passons du temps avec vous pour vous apprendre à manipuler et entretenir vos lentilles. Nous restons à votre entière disposition pour vous donner tous les conseils nécessaires, et qu\'ainsi, porter des lentilles devienne un véritable plaisir!<br />
L\'apprentissage pour la manipulation des lentilles de contact est dispensé GRATUITEMENT.<br />
<br />
<br />
</p>
<h4>Lentilles journalières :</h4>
<p>
Les lentilles journalières sont des lentilles souples, extrêmement confortables, qui sont jetées et remplacées chaque jour. Elles sont une option idéale pour ceux qui aimeraient essayer des lentilles pour la première fois, et certainement pour ceux qui envisagent un port en alternance avec les lunettes: pour faire du sport, pour sortir, pendant les vacances... A chaque fois on commence avec une lentille neuve et stérile. C\'est vraiment un mode de port ultra hygiénique! Puisqu\'elles sont jetées après un jour de port, vous avez toujours des lentilles neuves et fraîches à votre disposition.<br />
<br />
</p>
<h4>Lentilles souples :</h4>
<p>
Une large gamme de lentilles est à votre disposition: pour les myopes et les hypermétropes, pour les astigmates, les presbytes et même pour ceux qui aimeraient de temps en temps changer la couleur des yeux. Disponibles en mensuelles ou en traditionnelles (durée de 6 mois à deux ans) Une nouvelle matière, la silicone hydrogel, vient révolutionner l\'offre. Outre un confort accru, elles permettent d\'offrir des solutions intéressantes à ceux qui ne supportent plus leurs lentilles traditionnelles. Leurs principaux avantages sont de laisser passer plus d\'oxygène que les matières connues jusqu\'à aujourd\'hui. Elles sont aussi très flexibles dans leur utilisation et peuvent être portées en permanence, car elles respectent l\'oeil.<br />
<br />
</p>
<h4>Entretien :</h4>',
    'fr')"
) or die(mysqli_error());

mysqli_query($link,"INSERT INTO page VALUES(
    '3',
    'mentions',
    '<h1>Mentions Légales</h1>
<h2>Editeur</h2>

<h4>Ver\'son Optique</h4>
<p>
SARL au capital de 10 0000 ¤<br />
RCS CAEN - 503 137 259 00019<br />
Code APE : 4778A<br />
Siège social : 98 Rue du GENERAL LECLERC - 14790 VERSON - France.<br />
<br />
Conception et maintenance : Ver\'son Optique<br />
Directeur de la publication : Michael LARSONNEUR<br />
</p>
<h2>Hébergeur</h2>

<h4>OVH</h4>
<p>
SAS au capital de 10 000 000 ¤<br />
RCS Roubaix - Tourcoing 424 761 419 00045<br />
Code APE : 6202A<br />
N° TVA : FR 22 424 761 419<br />
Siège social : 2 rue Kellermann - 59100 Roubaix - France.<br />
</p>
<h2>Propriétés intellectuelles</h2>
<p>
L\'ensemble de ce site relève des législations française et internationale sur le droit d\'auteur et la propriété intellectuelle.<br />
L\'ensemble du contenus du site \"www.VerSonOptique.com\" est la propriété exclusive de \"Ver\'son Optique\" ou de la marque concernée.<br />
Toute reproduction et rediffusion de tout ou partie de ces contenus sont soumises à l\'autorisation préalable, écrite et expresse de \"Ver\'son Optique\" ou de la marque concernée.<br />
Tous les droits de reproduction sont réservés, y compris pour les documents iconographiques et photographiques.<br />
</p>
<h2>CNIL</h2>
<p>
Le site \"www.VerSonOptique.com\" ne fait pas l\'objet d\'une déclaration à la CNIL comme convenu dans la déclaration simplifié numéro 48.<br />
Conformément à la loi n°78-17, \" Informatique et Libertés \", du 6 janvier 1978, vous disposez d\'un droit d\'accès, de rectification, de suppression des données vous concernant.<br />
Ce droit peut s\'exercer en ligne en adressant un email au webmaster par le biais du formulaire de contact, ou par courrier à l\'adresse postale du siège social de \"Ver\'son Optique\".<br />
</p>
<h2>Politique de confidentialité</h2>

En aucun cas, les données recueillies sur le site \"www.VersonOptique.com\" ne seront cédées ou vendues à des tiers.<br />
Aucune adresse email ne sera transmise à des tiers y compris à nos partenaires sauf avec l\'accord écrit des intéressés.<br />
Les données collectées par l\'intermédiaire du formulaire de contact ou par le dispositif de statistique sont destinées à l\'usage exclusif du responsable du site.<br />

<h2>Responsabilité</h2>
<p>
Ce site a pour but de présenter tout ou partie des produits vendus par \"Ver\'son optique\".<br />
Il ne saurait en aucun cas être tenu pour responsable des erreurs, des problèmes techniques rencontrés sur le site et sur tous les autres sites vers lesquels nous établissons des liens, ou de toute interprétation des informations publiées sur ces sites, ainsi que les conséquences de leur utilisation.<br />
<br />
Les messages envoyés sur internet peuvent être interceptés. Ne divulguez pas d\'informations personnelles inutiles ou sensibles. Si vous souhaitez nous communiquer de telles informations, utilisez impérativement la voie postale.<br />
</p>',
    'fr')"
) or die(mysqli_error());

mysqli_query($link,"INSERT INTO page VALUES(
    '4',
    'erreur',
    '<b>Impossible de trouver la page.</b><br />
    <br />
    Il est possible que la page recherchée ait été supprimée, que son nom ait changé ou qu\'elle ne soit pas disponible pour le moment.<br />
    <br />
    Une redirection vers notre page d\'accueil est en cours.',
    'fr')"
) or die(mysqli_error());

mysqli_query($link,"INSERT INTO page VALUES(
    '5',
    'info',
    '',
    'fr')"
) or die(mysqli_error());

mysqli_query($link,"INSERT INTO page VALUES(
    '6',
    'accueil',
    '<h1>Our shop</h1>

<div class=\"image\"><img src=\"images/Magasin-exterieur.jpg\" alt=\"photo extérieur du magasin\" /> </div>
<br />
<p>
Installed in the shopping street of VERSON since May 2008, Ver\' Son Optique is an independent optician, our commitment is therefore to do everything possible to provide our customers with a Reception and service quality. The customer need will always take priority.<br />
We are affiliated to a central purchasing to offer you the best: prices, choices together with quality. Additionally, our ethic is around two axes that are : advice and quality service.<br />
<br />
Whether creators frames, designers or sports, we offer a wide choice because the store has over 1000 frames renewed regularly.<br />
We have among others the following brands:<br />
<br />
<br />
<div class=\"image\"><img src=\"images/logo/couturier/chloe.jpg\" alt=\"logo chloé\" /><img src=\"images/logo/couturier/hugo-boss.jpg\" alt=\"logo hugo boss\" /><img src=\"images/logo/couturier/emporio-armani.jpg\" alt=\"logo emporio armani\" /><img src=\"images/logo/couturier/dior.jpg\" alt=\"logo dior\" /></div>
<br />
<div class=\"image\"><img src=\"images/logo/createur/oxibis.jpg\" alt=\"logo oxibis\" /><img src=\"images/logo/createur/chez-colette.jpg\" alt=\"logo chez colette\" /><img src=\"images/logo/createur/vanni.jpg\" alt=\"logo vanni\" /><img src=\"images/logo/createur/william-morris.jpg\" alt=\"logo william morris\" /><img src=\"images/logo/createur/dilem.jpg\" alt=\"logo dilem\" /></div>
<br />
<div class=\"image\"><img src=\"images/logo/sport/rip-curl.jpg\" alt=\"logo rip curl\" /><img src=\"images/logo/sport/julbo.jpg\" alt=\"logo julbo\" /><img src=\"images/logo/sport/rebel.jpg\" alt=\"logo rebel\" /><img src=\"images/logo/sport/mawi-jim.jpg\" alt=\"logo mawi jim\" /></div>
<br />
<h4>Payment Terms :</h4>
We practice the third-party transactions with the largest number of mutual and health complementary, you will not have to worry about payment, Ver\' Son Optique does everything to make your life easier.<br />
However, if the third-party transactions was not feasible, you should know that we accept all  means of classic payment (checks, cash, credit cards). We also accept payment in several times, at no additional charge (see conditions in store).<br />
<br />
<h4>Visual satisfaction guarantee :</h4>
Among Ver\' Son Optique the service does not end with the sale. If despite a regular wearing of your glasses, your lenses do not give you the comfort announced, we offer you a new adjustment (90 % of cases), or eventually an exchange of your lenses (after a check) within a maximum period of one month (from the date on your card of authenticity Essilor).<br />
<br />
<h4>The 2nd pair for 1 ¤ more :</h4>
When buying a pair of glasses (frame + 2 lenses), we offer you a second pair at lower costs. But lower cost is not synonymous with poor quality or choice. Among Ver\' Son Optique you will have the choice from dozens of frames, you will benefit of \" ESSILOR \" lenses as on all our frames and the same warranty and service, This can only be a guarantee of quality.<br />
<br />
To be closer to the demands of our customers, we have a brand new center adaptation, allowing verification of sight.<br />
</p>
<h3>Our schedules :</h3>
From Tuesday to Friday: from 9am to 12:30am and from 2:30pm to 7pm<br />
Saturday: from 9am to 12:30am and from 2:30pm to 6pm',
    'en')"
) or die(mysqli_error());

mysqli_query($link,"INSERT INTO page VALUES(
    '7',
    'localisation',
    '<h3>By bus :</h3>
-\"Bus Vert\" line 9<br />
-\"Bus Vert\" line 32<br />
<br />
Schedules for these lines are available <a target=\"_blank\" href=\"http://translate.google.fr/translate?hl=fr&sl=fr&tl=en&u=http%3A%2F%2Fwww.busverts.fr%2Faffichage.php%3Fid%3D281\">here</a>.
<h3>Access by car :</h3>
<p>you just need to make a route with \"Google Map\" by clicking in the box below.</p>
<br /><br />
<div id=\"carte\"><iframe width=\"700\" height=\"500\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=ver\'son+optique&amp;sll=49.310799,1.757813&amp;sspn=8.094906,23.269043&amp;ie=UTF8&amp;hq=ver\'son+optique&amp;hnear=&amp;ll=49.155196,-0.452874&amp;spn=0.12114,0.363579&amp;t=h&amp;z=12&amp;iwloc=A&amp;cid=135647432708236301&amp;output=embed\"></iframe><br /><small><a href=\"http://maps.google.fr/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=ver\'son+optique&amp;sll=49.310799,1.757813&amp;sspn=8.094906,23.269043&amp;ie=UTF8&amp;hq=ver\'son+optique&amp;hnear=&amp;ll=49.155196,-0.452874&amp;spn=0.12114,0.363579&amp;t=h&amp;z=12&amp;iwloc=A&amp;cid=135647432708236301\" style=\"color:#0000FF;text-align:left\">Go on Google Map</a></small></div>',
    'en')"
) or die(mysqli_error());

mysqli_query($link,"INSERT INTO page VALUES(
    '8',
    'verre-lentille',
    '<table><tr><td><img src=\"images/logo/Essilor-logo.jpg\" alt=\"logo essilor\" /></td><td><h2>Essilor</h2></td></tr></table>
<br />
Ver\' Son Optique works only with Essilor, for ensure you the better quality, the No. 1 worldwide in lunette lenses, a reference in terms of know-how and innovation, ESSILOR is for you the certainty that your glasses will be equipped with wich is does best.<br />
<br />
Because all lenses are not of Essilor, 1 way ensures the authenticity of your lenses :<br />
<br />
<div style=\"text-indent:100px;\">- The certificate of authenticity provided when buying your lenses, It contains essential information on your sight (sight correction, type of glass...).</div>
<br />
Essilor is one of the most international French companies, present in over 100 countries, mainly in Europe, Asia and the Americas.<br />
Strategic pillar of the company, the Research and Development entity of Essilor constitute a real laboratory for innovation.<br />
It ensure the technological lead of the group.<br />
<br />
At worldwide scale, the R & D teams are focusing on two primordial axes :<br />
- Anticipate the expectations of global markets,<br />
- Develop the lenses of the future by relying on best global expertise.<br />
<br />
<br />
<h4>Some numbers :</h4>
- N°1 worldwide in ophthalmic optics,<br />
- over 150 years experience,<br />
- 34 320 collaborators,<br />
- 3 billion euros of turnover in 2008,<br />
- 245 million of glasses of 450 thousand different references in 2008,<br />
- 5 centers of R&D,<br />
- 293 prescription laboratories,<br />
- 15 factories,<br />
- 12 logistics centers,<br />
- 500 researchers in 4 centers : United States, France, Japan, Singapore,<br />
- 5% of turnover invested annually in research and development,<br />
- Nearly 2600 patents (or applications) and designations in portfolio as at 12.31.2005<br />
- 50% of turnover from products launched within the last 5 years,<br />
- 30% of turnover generated by innovations under 3 years old.<br />
<br />
<br />
<img src=\"images/logo/Essilor-varilux-logo.jpg\" alt=\"logo essilor varilux\" />
<h4>Essilor, the inventor of Varilux</h4>
The Varilux lens was invented in 1959 by Essel, which will become part of the group Essilor thereafter, Varilux was the first progressive lens in the world, thanks to which it was possible to see easily and perfectly, at near such as far without transition and with the same pair of lenses.
Since then, different progressive lenses have appeared on the market, all developed on the basis of the original Varilux lens.
Yet, Varilux lens has never been equaled.
Today, Varilux has more than 300 million of holders satisfied worldwide (a new holder every 4 seconds) and Essilor continues to improve the performance of its products.
The majority of studies that had been made for the correction of sight, were usually incomplete.
In this sphere too, Essilor has always been one step ahead, because its only preoccupation still the needs and expectations of holders, that is why the Varilux® range has experienced six generation between 1959 and 2006<br />
<br />
<br />
<h4>Ver\' Son Optique undertakes with Essilor on the quality:</h4>
We deliver to our customers a complete information, ethics, clear and pedagogical,<br />
We reserve to their a personalized welcome,<br />
All the team is holds regularly informed on the latest technological innovations and the application of these last,<br />
Exchange with other health professionals,<br />
<br />
All of this allows us to better meet the everyday needs of each of our customers.<br />
<br />
<br />
<h4>Guarantees :</h4>
Essilor lenses are warranted against manufacturing defects for 2 years (after expertise by the laboratory)<br />
Essilor progressive lenses are guaranteed accommodation (particularly for Varilux progressive lenses) for 1 month maximum (starting of the date indicated on the certificate of authenticity Essilor).<br />
This period may be extended if, in the first month, you have expressed your discomfort and your unavailability to us so we can verify your equipment (Opening of a folder from Essilor).<br />
<br />
<h4>Recommendations :</h4>
It is still possible to scratch or break a lens, even if it is treated. We do not support the use of defects :<br />
Avoid submitting your equipment to high temperatures ( in the glove compartment of a car in the sun)<br />
Avoid submitting your equipment to chemicals ( paints, varnishes, solvents,...)<br />
Adopt only cleaning products recommended by opticians (Siclair, Sinet, Optinett,...)<br />
If you have a question or need advice on caring for your equipment,
<a href=\"http://www.essilor.fr/verre-optique/produit-essilor.htm?id=124\">find full range of Essilor lenses</a>.<br />
<br />
<h4>Essilor Services :</h4>

<table>
  <tr>
    <td>1.Consulting Service</td>
    <td>5.Steal warranty</td>
  </tr>
  <tr>
    <td>2.Guarantee of Authenticity</td>
    <td>6.Varilux Travel Support</td>
  </tr>
  <tr>
    <td>3.Satisfaction Guarantee</td>
    <td>7.Maintenance Free</td>
  </tr>
  <tr>
    <td>4.Scrap Warranty</td>
    <td></td>
  </tr>
</table>
<br />
<h4>Maintenance :</h4>
<br />
<br />
<h2>Contact lenses :</h2>
<br />

Contact lenses have many advantages :

- They are attractive, comfortable and practical,
- They are worn at any age,
- They offer a full refund of Focus,
- They allow great freedom.

Depending on your eyesight, the type of contact lenses is different.


We work with all brands of contact lenses, to get the best comfort and the best quality for you.<br />

It is not easy to wear contact lenses for the first time. That is why we support you in this process. We spend time with you to learn you to handle and care for your lenses. We remain at your entire disposal to give you all the necessary advice, and thus, wear contact lenses to become a real pleasure!<br />
The learning for handling contact lenses is provided FREE.<br />
<br />
<br />
<h4>Daily lenses :</h4>
The daily lenses are soft contact lenses, extremely comfortable, which are discarded and replaced each day.
They are an ideal option for those who would like to try contacts lenses for the first time, and certainly for those considering an alternate port with the glasses: for sport, to go out during the holidays ...
At each time we start with a new sterile lens.
It\'s really a way of wearing ultra hygienic!
Because they are discarded after a day of wearing, you still have fresh and new lenses available.<br />
<br />

<h4>Soft Lenses :</h4>
A wide range of lenses is at your disposal for myopia and hyperopia, for astigmatism, presbyopia and even for those who want to occasionally change eye color.
Available in monthly or traditional (duration of 6 months to two years) A new material, the silicone hydrogel revolutionize the offer.
Besides an added comfort, they can offer interesting solutions to those who no longer support their traditional lenses.
Their main advantages are to pass more oxygen than the materials known to date.
They are also very flexible in their use and can be worn at permanently because they comply with the eye.<br />
<br />
<h4>Maintenance :</h4>',
    'en')"
) or die(mysqli_error());

mysqli_query($link,"INSERT INTO page VALUES(
    '9',
    'mentions',
    '<h1>Legals</h1>
<h2>Publisher</h2>

<h4>Ver\'son Optique</h4>
<p>
SARL with capital of 10\'0000 ¤<br />
RCS CAEN - 503 137 259 00019<br />
APE code : 4778A<br />
Registered office: 98 Rue du General Leclerc - 14790 VERSON - France. <br />
<br />
Design and maintenance: Ver\'son Optique<br />
Publishing Director: Michael LARSONNEUR<br />
</p>
<h2>Hosting</h2>

<h4>OVH</h4>
<p>
SAS with capital of 10\'000\'000 ¤<br />
RCS Roubaix - Tourcoing 424 761 419 00045<br />
APE code : 6202A <br />
N° TVA : FR 22 424 761 419<br />
Registered office: 2 rue Kellermann - 59100 Roubaix - France.<br />
</p>
<h2>Intellectual property</h2>
<p>
This entire site raises French and international legislation on copyright and intellectual property.<br />
The entire contents of the site \"www.VerSonOptique.com\"is the exclusive property of \"Ver\'son Optique\" or the mark concerned.<br />
Any reproduction and redistribution of all or part of this content is subject to prior authorization, express written of \"Ver\'son Optique\" or the mark concerned.<br />
All rights reserved, including the iconographic and photographic documents.<br />
</p>
<h2>CNIL</h2>
<p>
The site \"www.VerSonOptique.com\" is not subject to CNIL declaration as agreed in the statement  simplified number 48.<br />
According to the law number 78-17, \" Informatique et Libertés \", of 6 January 1978, you have a right of access, rectification, deletion of the data that is concerned you.<br />
This right can be exercised online by sending an email to the webmaster via the contact form, or by mail to the Registered office mailing address of \"Ver\'son Optique\".<br />
</p>
<h2>Privacy Policy</h2>

In any case, the data collected on the site \"www.VersonOptique.com\" will not be given or sold to third parties.<br />
No email address will be transmitted to third parties, including our partners except with the written agreement of the interested.<br />
The data collected through the contact form or the statistics device are for the exclusive use of the site manager.<br />

<h2>Disclaimer</h2>
<p>
This site aims to present all or part of products sold by \"Ver\'son optique\".<br />
It does not in any way be held liable for errors, of technical problems encountered on the site and on all other sites to wich we establish links, or any interpretation of information published on these sites, together with the consequences of their use.<br />
<br />
Messages sent over the Internet can be intercepted. Do not disclose your personal information unnecessary or sensitive. If you wish to communicate such information, always use the postal mail.<br />
</p>',
    'en')"
) or die(mysqli_error());

mysqli_query($link,"INSERT INTO page VALUES(
    '10',
    'erreur',
    '<b>Impossible to find the page.</b><br />
    <br />
    It is possible that the sought page has been deleted, that had its name changed, or is not available at the moment.<br />
    <br />
    A redirection to our home page is being.',
    'en')"
) or die(mysqli_error());

mysqli_query($link,"INSERT INTO page VALUES(
    '11',
    'info',
    '',
    'en')"
) or die(mysqli_error());


echo "OK !";
?>

<meta http-equiv="refresh" content="2; url=index.php" />