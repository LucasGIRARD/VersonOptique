
<div id="alerts">
    <noscript>
        <p>
            <strong>CKEditor à besoin que JavaScript ne soit pas bloqué pour fonctionner</strong>.<br />
            Pour le réactiver, regardez <a target="_blank" href="http://www.libellules.ch/browser_javascript_activ.php" >ici</a>


            <?php
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE) {
                echo ' ou <a target="_blank" href="http://www.google.fr/search?hl=fr&q=%22activer%22+AND+%22javascript%22+AND+%22firefox%22&btnG=Rechercher">ici</a>';
            } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE) {
                echo ' ou <a target="_blank" href="http://www.google.fr/search?hl=fr&q=%22activer%22+AND+%22javascript%22+AND+%22opera%22&btnG=Rechercher">ici</a>';
            } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE) {
                echo ' ou <a target="_blank" href="http://www.google.fr/search?hl=fr&q=%22activer%22+AND+%22javascript%22+AND+%22safari%22&btnG=Rechercher">ici</a>';
            } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
                echo ' ou <a target="_blank" href="http://www.google.fr/search?hl=fr&q=%22activer%22+AND+%22javascript%22+AND+%22IE%22&btnG=Rechercher">ici</a>';
            }
            $SQL_contenuFR = mysqli_query($link,"SELECT contenu_page FROM page WHERE langue='fr' AND nom_page='" . $page . "' ") or die(mysql_error());
            $tableau_contenuFR = mysqli_fetch_array($SQL_contenuFR);

            $SQL_contenuEN = mysqli_query($link,"SELECT contenu_page FROM page WHERE langue='en' AND nom_page='" . $page . "' ") or die(mysql_error());
            $tableau_contenuEN = mysqli_fetch_array($SQL_contenuEN);
            ?>
            <br />
            <br />
            <br />
        </p>
    </noscript>

</div>
<form action="index.php" method="post">
    <textarea cols="80" id="editor1" name="editor1" rows="10"><div id="body"><?php echo $tableau_contenuFR[0]; ?></div></textarea>
    <script type="text/javascript">
        //<![CDATA[

        CKEDITOR.replace( 'editor1',
        {
            /*
             * Height of the editor
             */
            height : '400px',
            /*
             * Style sheet for the contents
             */
            contentsCss : 'Base.css',
            /*
             * Base for media elements
             */
            baseHref : 'http://www.versonoptique.net/',
            /*
             * Toolbar conf
             */
            toolbar : 'Michael',
            toolbar_Michael :
                [
                ['Maximize'],
                ['About'],
                ['Source','ShowBlocks'],
                ['Preview','Print'],
                ['Undo','Redo'],
                ['Cut','Copy','Paste','PasteText','PasteFromWord'],
                ['SpellChecker', 'Scayt'],
                ['Find','Replace'],
                ['SelectAll','RemoveFormat'],
                ['Templates'],
                '/',
                ['Format','FontSize'],
                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Outdent','Indent'],
                ['Bold','Italic','Underline','Strike','Blockquote','Subscript','Superscript'],
                ['TextColor','BGColor'],
                ['NumberedList','BulletedList'],
                ['Link','Unlink','Anchor'],
                ['Image','Flash','CreateDiv','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe']
            ],
    filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
    
    filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });
        //]]>
    </script>
    <textarea cols="80" id="editor2" name="editor2" rows="10"><div id="body"><?php echo $tableau_contenuEN[0]; ?></div></textarea>
    <script type="text/javascript">
        //<![CDATA[

        CKEDITOR.replace( 'editor2',
        {
            /*
             * Height of the editor
             */
            height : '400px',
            /*
             * Style sheet for the contents
             */
            contentsCss : 'Base.css',
            /*
             * Base for media elements
             */
            baseHref : 'http://www.versonoptique.net/',
            /*
             * Toolbar conf
             */
            toolbar : 'Michael',
            toolbar_Michael :
                [
                ['Maximize'],
                ['About'],
                ['Source','ShowBlocks'],
                ['Preview','Print'],
                ['Undo','Redo'],
                ['Cut','Copy','Paste','PasteText','PasteFromWord'],
                ['SpellChecker', 'Scayt'],
                ['Find','Replace'],
                ['SelectAll','RemoveFormat'],
                ['Templates'],
                '/',
                ['Format','FontSize'],
                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Outdent','Indent'],
                ['Bold','Italic','Underline','Strike','Blockquote','Subscript','Superscript'],
                ['TextColor','BGColor'],
                ['NumberedList','BulletedList'],
                ['Link','Unlink','Anchor'],
                ['Image','Flash','CreateDiv','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe']
            ],
            
    filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
    
    filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'


        });
        CKFinder.setupCKEditor( null, '../ckfinder/' );
                //]]>
    </script>

    <p>
        <input type='hidden' name='page' value="<?php echo $page; ?>" />
        <input type='hidden' name='action' value="<?php echo $action; ?>" />
        <input type='hidden' name='element' value="<?php echo $element; ?>" />
        <input type="submit" value="Submit" />
    </p>

</form>
