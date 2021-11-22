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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
</head>

<body class="container-float">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse">
            <ul id="nav" class="navbar-nav mr-auto">

                <?php if (isset($_SESSION['user_id'])) : ?>
                    <!-- Owner -->
                    <?php if ($_SESSION['level_user'] == '1') : ?>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> HIKAM WEB APP </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> Home </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Customer" class="nav-link"> Customer </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Supplier" class="nav-link"> Supplier </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Product" class="nav-link"> Product </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Invoice" class="nav-link"> Invoice </a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Purchase Order
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="<?= BASEURL; ?>/Purchase/index" class="nav-link"> Supplier</a>
                                <a href="<?= BASEURL; ?>/Purchase/index2" class="nav-link"> Customer </a>
                            </div>
                        </li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Delivery" class="nav-link"> Delivery Order </a></li>
                        <!-- <li class="nav-item active"><a href="<?= BASEURL; ?>/Users" class="nav-link">Users </a></li> -->
                        <li class="nav-item active ml-auto">
                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <a href="<?= BASEURL; ?>/users/logout" class="nav-link"> Logout </a>
                            <?php else : ?>
                                <a href="<?= BASEURL; ?>/users/login" class="nav-link"> Login </a>
                            <?php endif; ?>
                        </li>

                        <!-- Admin -->
                    <?php elseif ($_SESSION['level_user'] == '2') : ?>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> HIKAM WEB APP </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> Home </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Customer" class="nav-link"> Customer </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Product" class="nav-link"> Product </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Invoice" class="nav-link"> Invoice </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Delivery" class="nav-link"> Delivery Order </a></li>
                        <li class="nav-item active ml-auto">
                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <a href="<?= BASEURL; ?>/users/logout" class="nav-link"> Logout </a>
                            <?php else : ?>
                                <a href="<?= BASEURL; ?>/users/login" class="nav-link"> Login </a>
                            <?php endif; ?>
                        </li>

                        <!-- Purchase -->
                    <?php elseif ($_SESSION['level_user'] == '3') : ?>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> HIKAM WEB APP </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> Home </a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Purchase Order
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="<?= BASEURL; ?>/Purchase/index" class="nav-link"> Supplier</a>
                            </div>
                        </li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Supplier" class="nav-link"> Supplier </a></li>
                        <li class="nav-item active ml-auto">
                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <a href="<?= BASEURL; ?>/users/logout" class="nav-link"> Logout </a>
                            <?php else : ?>
                                <a href="<?= BASEURL; ?>/users/login" class="nav-link"> Login </a>
                            <?php endif; ?>
                        </li>

                        <!-- Sales -->
                    <?php elseif ($_SESSION['level_user'] == '4') : ?>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> HIKAM WEB APP </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> Home </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Customer" class="nav-link"> Customer </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Product" class="nav-link"> Product </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Delivery" class="nav-link"> Delivery Order </a></li>
                        <li class="nav-item active ml-auto">
                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <a href="<?= BASEURL; ?>/users/logout" class="nav-link"> Logout </a>
                            <?php else : ?>
                                <a href="<?= BASEURL; ?>/users/login" class="nav-link"> Login </a>
                            <?php endif; ?>
                        </li>

                        <!-- MarketingSupport -->
                    <?php elseif ($_SESSION['level_user'] == '5') : ?>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> HIKAM WEB APP </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> Home </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Delivery" class="nav-link"> Delivery Order </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>/Invoice" class="nav-link"> Invoice </a></li>
                        <li class="nav-item active ml-auto">
                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <a href="<?= BASEURL; ?>/Users/logout" class="nav-link"> Logout </a>
                            <?php else : ?>
                                <a href="<?= BASEURL; ?>/Users/login" class="nav-link"> Login </a>
                            <?php endif; ?>
                        </li>

                    <?php else : ?>
                        <!-- Default -->
                        <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> HIKAM WEB APP </a></li>
                        <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> Home </a></li>
                        <li class="nav-item active ml-auto">
                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <a href="<?= BASEURL; ?>/users/logout" class="nav-link"> Logout </a>
                            <?php else : ?>
                                <a href="<?= BASEURL; ?>/users/login" class="nav-link"> Login </a>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php else : ?>
                    <!-- Default -->
                    <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> HIKAM WEB APP </a></li>
                    <li class="nav-item active"><a href="<?= BASEURL; ?>" class="nav-link"> Home </a></li>
                    <li class="nav-item active ml-auto">
                        <?php if (isset($_SESSION['user_id'])) : ?>
                            <a href="<?= BASEURL; ?>/users/logout" class="nav-link"> Logout </a>
                        <?php else : ?>
                            <a href="<?= BASEURL; ?>/users/login" class="nav-link"> Login </a>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>