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
        <form action="/" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="filename">Saisir le nom d'un fichier</label>
                <input type="text" name="filename" placeholder="example.txt" maxlength="50" required="required"/>
            </div>
            <div class="form-group">
                <input type="submit" value="Créer le fichier"/>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <h3>Fichiers stockés : </h3>
    <ul>
        <?php if (isset($this->aFilesList)) { ?>
            <?php foreach($this->aFilesList as $fileName) { ?>
                <li><?= $fileName; ?></li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>