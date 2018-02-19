<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 19/02/18
 * Time: 20:04
 */
?>

<div class="row">
    <div class="col-md-4 col-md-offset-4 cadre-form">
        <form enctype="multipart/form-data" action="/" method="post" class="form-horizontal">
            <div class="form-group">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                <label for="userfile">Sélectionnez un fichier texte (.txt) : </label>
                <input name="userfile" type="file" />
            </div>
            <div class="form-group">
                <input type="submit" value="Envoyer le fichier" />
            </div>
        </form>
    </div>
</div>