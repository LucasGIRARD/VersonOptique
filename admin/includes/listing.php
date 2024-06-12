<?php
if ($element == "lunette") {
    $filtre = checkboxSelect("marque");
    $filtre .= selectSelect("genre");
    $filtre .= selectSelect("type");

    $listing = lunette();
?>
    <table id="tabLunette">
        <tr>
            <td id="filtreLunette">
                <form method="post" action="index.php">
                <?php
                echo $filtre;
                ?>
                <br />
                <br />
                <input type="submit" value="Filtrer" />
                <input type="hidden" value="lunette" name="element" />
                <input type="hidden" value="<?php echo $action; ?>" name="action" />
            </form>
        </td>
        <td id="separateurLunette"></td>
        <td id="listeLunette">
            <?php
                //nouveauté auto
                //existe en plusieurs coloris
                echo $listing;
            ?>
            </td>
        </tr>
    </table>
<?php
            } else {
                $tableauElement = select("SELECT * FROM " . $element . "");
                echo "<table><tr>";
                if ($action == "modifier") {


                    foreach ($tableauElement as $ligneElement) {
                        echo "<td>" . $ligneElement["nom_$element"] . "<br /><center><form method='post' action='index.php'><input type='hidden' value='" . $element . "' name='element' /><input type='hidden' value='" . $ligneElement["id_$element"] . "' name='id' /><input type='hidden' value='modifForm' name='action' /><input type='submit' value='Modifier' /></form></center></td>";
                    }
                } else {


                    foreach ($tableauElement as $ligneElement) {
                        echo "<td>" . $ligneElement["nom_$element"] . "<br /><center><form method='post' action='index.php'><input type='hidden' value='" . $element . "' name='element' /><input type='hidden' value='" . $ligneElement["id_$element"] . "' name='id' /><input type='hidden' value='supprBdd' name='action' /><input type='submit' value='Supprimer' /></form></center></td>";
                    }
                }
                echo "</tr></table>";
            }
?>