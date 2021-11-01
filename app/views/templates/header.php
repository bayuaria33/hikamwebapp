<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman <?= $data['judul']; ?></title>
    <link rel="hikamlogo" href="<?= BASEURL; ?>/img/hikamlogo.ico">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
</head>

<body>
    <ul id="nav">
        <li><a href="<?= BASEURL; ?>"> HIKAM WEB APP </a></li>
        <li><a href="<?= BASEURL; ?>"> Home </a></li>
        <li><a href="<?= BASEURL; ?>/Customer"> Customer </a></li>
        <li><a href="<?= BASEURL; ?>/Supplier"> Supplier </a></li>
        <li><a href="<?= BASEURL; ?>/Product"> Product </a></li>
        <li><a href="<?= BASEURL; ?>/Invoice"> Invoice </a></li>
        <li><a href="<?= BASEURL; ?>/Purchase"> Purchase Order </a></li>
        <li><a href="<?= BASEURL; ?>/Delivery"> Delivery Order </a></li>
        <!-- <li><a href="<?= BASEURL; ?>/InfoProduct"> InfoProduct </a></li> -->
        <!-- <li><a href="<?= BASEURL; ?>/About"> About </a></li> -->

        <li style="float:right"><a href="<?= BASEURL; ?>"> Login </a></li>
    </ul>