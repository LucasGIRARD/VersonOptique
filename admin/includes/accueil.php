<script type="text/javascript" language="JavaScript">
    function ucfirst(str) {
        var firstLetter = str.slice(0,1);
        return firstLetter.toUpperCase() + str.substring(1);
    }


    function verif()
    {
        if (document.layers)
        {
            formulaire = document.forms.formulaireAdmin;
        }
        else
        {
            formulaire = document.formulaireAdmin;
        }
    }

    function formulaireE1(value)
    {
        verif();
        formulaire.page.style.display = 'none';
        document.getElementById('nbrAjout').style.display = 'none';
        if (value == 'ajouter')
        {
            var typesElements = new Array("-- choisissez un type d'élément", "lunette", "marque", "genre", "type");


            document.getElementById('nbrAjout').style.display = 'inline';
        }
        if (value == 'modifier')
        {
            var typesElements = new Array("-- choisissez un type d'élément", "page", "lunette", "marque", "genre", "type");
        }
        if(value == 'supprimer')
        {
            var typesElements = new Array("-- choisissez un type d'élément", "lunette", "marque", "genre", "type");
        }

        if (value == 'ajouter' || value == 'supprimer' || value == 'modifier')
        {
            formulaire.element.options.length = typesElements.length;

            formulaire.element.options[0].value = 0;
            formulaire.element.options[0].text = ucfirst(typesElements[0]);
            for (i=1; i<typesElements.length; i++)
            {
                formulaire.element.options[i].value = typesElements[i];
                formulaire.element.options[i].text = ucfirst(typesElements[i]);
            }
            document.formulaireAdmin.element.options.selectedIndex = 0;
        }
        else
        {
            formulaire.element.options.length = 1;
            formulaire.element.options[0].value = 0;
            formulaire.choixTypeElement.options[0].text = "-- choisissez un type d'élément";
        }

    }

    function formulaireE2(value)
    {
        verif();
        formulaire.page.style.display = 'none';
        if (value == "page")
        {
            var pages = new Array("-- choisissez une page", "info", "accueil", "verre-lentille", "localisation", "mentions", "erreur");

            formulaire.page.options.length = pages.length;

            formulaire.page.options[0].value = 0;
            formulaire.page.options[0].text = ucfirst(pages[0]);
            for (i=1; i<pages.length; i++)
            {
                formulaire.page.options[i].value = pages[i];
                formulaire.page.options[i].text = ucfirst(pages[i]);
            }
            document.formulaireAdmin.page.options.selectedIndex = 0;
            formulaire.page.style.display = 'inline';
        }

    }
    function submitform()
    {
        verif();
        if(formulaire.action.value != "0"){            
            if(formulaire.element.value != "0"){
                if((formulaire.element.value == "page" && formulaire.page.value == "0") || (formulaire.action.value == "ajouter" && (formulaire.nbrAjoutv.value == "" || formulaire.nbrAjoutv.value <= "0") )){
                    alert("aucune page sélectionné ou le nombre d'ajout est nul!");
                }
                else{
                    document.formulaireAdmin.submit();
                }

            }
            else{
                alert("élément non sélectionné!");
            }
        }
        else{
            alert("action non sélectionné!");
        }
    }

</script>

<form name="formulaireAdmin" method="post" action="index.php">
    <select name="action" onChange="formulaireE1(this.options[this.selectedIndex].value);">
        <option value="0" selected>-- choisissez une action</option>
        <option value="ajouter">Ajouter</option>
        <option value="modifier">Modifier</option>
        <option value="supprimer">Supprimer</option>
    </select>

    <select name="element" onChange="formulaireE2(this.options[this.selectedIndex].value);">
        <option value="0" selected>-- choisissez un type d'élément</option>
    </select>

    <select name="page" style="display:none;">
        <option value="0" selected>-- choisissez une page</option>
    </select>

    <div id="nbrAjout" style="display: none;">nombre d'ajout : <input type='text' name='nbrAjoutv' size='1' maxlength='2' value="1" /></div>
    <br />
    <br />
</form>
<input type="submit" onclick="submitform();" value="Envoyer" />