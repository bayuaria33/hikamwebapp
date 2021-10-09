<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman <?= $data['judul']; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
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
        <!-- <li><a href="<?= BASEURL; ?>/InfoProduct"> InfoProduct </a></li> -->
        <!-- <li><a href="<?= BASEURL; ?>/About"> About </a></li> -->

        <li style="float:right"><a href="<?= BASEURL; ?>"> Login </a></li>
    </ul>