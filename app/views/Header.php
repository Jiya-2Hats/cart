<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/app/assets/css/bootstrap/bootstrap.min.css" />
    <script src="<?= BASE_URL ?>/app/assets/js/jquery/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>/app/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <?php
    if (isset($data['css'])) {
        foreach ($data['css'] as $cssFile) : ?>
            <link rel="stylesheet" href="<?= BASE_URL ?>/app/assets/css/<?= $cssFile ?>" />
        <?php endforeach;
    }
    if (isset($data['js'])) {
        foreach ($data['js'] as $jsFile) : ?>
            <script src="<?= BASE_URL ?>/app/assets/js/<?= $jsFile ?>"></script>
    <?php endforeach;
    }
    ?>

</head>

<body>