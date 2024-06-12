<?php
if ($langue == 'en') {
    $txtFiltrer = "Filter";
    $filtre = checkboxSelect("marque","brand");
    $filtre .= selectSelect("genre","gender");
    $filtre .= selectSelect("type","type");
} else {
    $txtFiltrer = "Filtrer";
    $filtre = checkboxSelect("marque","marque");
    $filtre .= selectSelect("genre","genre");
    $filtre .= selectSelect("type","type");
}
$lunette = lunette();
?>
<table id="tabLunette">
    <tr>
        <td id="filtreLunette">
            <form method="post" action="index.php?page=lunettes">
                <?php
                echo $filtre;
                ?>
				<div>
                <br />
                <input type="submit" value="<?php echo $txtFiltrer;?>" />
				</div>
            </form>
        </td>
        <td id="separateurLunette"></td>
        <td id="listeLunette">
            <?php
                echo $lunette;
            ?>
        </td>
    </tr>
</table>




