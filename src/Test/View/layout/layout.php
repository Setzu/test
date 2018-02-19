<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 19/02/18
 * Time: 20:14
 */
?>

<!DOCTYPE html>
<title>Test technique</title>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/form.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>

<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </div>
        </div>
    </nav>
</header>

<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php echo $this->flashMessages(); ?>
            </div>
        </div>
    <?php include_once ($this->content); ?>
</div>

<footer>
    <div class="container"></div>
</footer>

</body>

</html>