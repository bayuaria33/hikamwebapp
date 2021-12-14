<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Halaman <?= $data['judul']; ?></title>
  <!-- Boxiocns CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="<?= BASEURL; ?>/css/style1.css">
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  
</head>

<body>
  <div class="sidebar close">
    <div class="logo-details">
      <i class="bx bx-menu" style="color:white"></i>
      <span class="logo_name" style="color:hsl(180, 100%, 44%)">Hikam Abadi</span>
    </div>

    <ul class="nav-links" style="color:blueviolet">
      <?php if (isset($_SESSION['user_id'])) : ?>
        <!-- Owner -->
        <?php if ($_SESSION['level_user'] == '1') : ?>
          <li>
            <a href="<?= BASEURL; ?>">
              <i class="bx bx-tachometer"></i>
              <span class="link_name">Dashboard</span>
            </a>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Customer">
              <i class='bx bx-user'></i>
              <span class="link_name">Customer</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Customer">Customer</a></li>
            </ul>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Product">
              <i class='bx bx-collection'></i>
              <span class="link_name">Product</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Product">Product</a></li>
            </ul>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Supplier">
              <i class='bx bx-package'></i>
              <span class="link_name">Supplier</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Supplier">Supplier</a></li>
            </ul>
          </li>

          <li>
            <div class="iocn-link">
              <a href="<?= BASEURL; ?>">
                <i class='bx bx-purchase-tag-alt'></i>
                <span class="link_name">Purchase Order</span>
              </a>
              <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="<?= BASEURL; ?>">Purchase Order</a></li>
              <li><a href="<?= BASEURL; ?>/Purchase/index">Supplier</a></li>
              <li><a href="<?= BASEURL; ?>/Purchase/index2">Customer</a></li>
            </ul>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Invoice">
              <i class='bx bx-dollar'></i>
              <span class="link_name">Invoice</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Invoice">Invoice</a></li>
            </ul>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Delivery">
              <i class='bx bx-bus'></i>
              <span class="link_name">Delivery Order</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Delivery">Delivery Order</a></li>
            </ul>
          </li>

          <li>
            <div class="profile-details">
              <div class="profile-content">
                <!--<img src="image/profile.jpg" alt="profileImg">-->
              </div>
              <div class="name-job">
                <div class="profile_name"><?= $_SESSION['username']; ?></div>
              </div>
              <a href="<?= BASEURL; ?>/Users/logout" class="nav-link"> <i class='bx bx-log-out'></i> </a>

            </div>
          </li>
          <!-- Admin -->
        <?php elseif ($_SESSION['level_user'] == '2') : ?>
          <li>
            <a href="<?= BASEURL; ?>">
              <i class="bx bx-tachometer"></i>
              <span class="link_name">Dashboard</span>
            </a>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Customer">
              <i class='bx bx-user'></i>
              <span class="link_name">Customer</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Customer">Customer</a></li>
            </ul>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Product">
              <i class='bx bx-collection'></i>
              <span class="link_name">Product</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Product">Product</a></li>
            </ul>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Invoice">
              <i class='bx bx-dollar'></i>
              <span class="link_name">Invoice</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Invoice">Invoice</a></li>
            </ul>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Delivery">
              <i class='bx bx-bus'></i>
              <span class="link_name">Delivery Order</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Delivery">Delivery Order</a></li>
            </ul>
          </li>

          <li>
            <div class="profile-details">
              <div class="profile-content">
                <!--<img src="image/profile.jpg" alt="profileImg">-->
              </div>
              <div class="name-job">
                <div class="profile_name"><?= $_SESSION['username']; ?></div>
              </div>
              <a href="<?= BASEURL; ?>/Users/logout" class="nav-link"> <i class='bx bx-log-out'></i> </a>

            </div>
          </li>
          <!-- Purchase -->
        <?php elseif ($_SESSION['level_user'] == '3') : ?>
          <li>
            <a href="<?= BASEURL; ?>">
              <i class="bx bx-tachometer"></i>
              <span class="link_name">Dashboard</span>
            </a>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Product">
              <i class='bx bx-collection'></i>
              <span class="link_name">Product</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Product">Product</a></li>
            </ul>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Supplier">
              <i class='bx bx-package'></i>
              <span class="link_name">Supplier</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Supplier">Supplier</a></li>
            </ul>
          </li>

          <li>
            <div class="iocn-link">
              <a href="<?= BASEURL; ?>">
                <i class='bx bx-purchase-tag-alt'></i>
                <span class="link_name">Purchase Order</span>
              </a>
              <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="<?= BASEURL; ?>">Purchase Order</a></li>
              <li><a href="<?= BASEURL; ?>/Purchase/index">Supplier</a></li>
            </ul>
          </li>

          <li>
            <div class="profile-details">
              <div class="profile-content">
                <!--<img src="image/profile.jpg" alt="profileImg">-->
              </div>
              <div class="name-job">
                <div class="profile_name"><?= $_SESSION['username']; ?></div>
              </div>
              <a href="<?= BASEURL; ?>/Users/logout" class="nav-link"> <i class='bx bx-log-out'></i> </a>

            </div>
          </li>
          <!-- Sales -->
        <?php elseif ($_SESSION['level_user'] == '4') : ?>
          <li>
            <a href="<?= BASEURL; ?>">
              <i class="bx bx-tachometer"></i>
              <span class="link_name">Dashboard</span>
            </a>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Customer">
              <i class='bx bx-user'></i>
              <span class="link_name">Customer</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Customer">Customer</a></li>
            </ul>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Product">
              <i class='bx bx-collection'></i>
              <span class="link_name">Product</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Product">Product</a></li>
            </ul>
          </li>

          <li>
            <div class="iocn-link">
              <a href="<?= BASEURL; ?>">
                <i class='bx bx-purchase-tag-alt'></i>
                <span class="link_name">Purchase Order</span>
              </a>
              <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="<?= BASEURL; ?>">Purchase Order</a></li>
              <li><a href="<?= BASEURL; ?>/Purchase/index2">Customer</a></li>
            </ul>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Delivery">
              <i class='bx bx-bus'></i>
              <span class="link_name">Delivery Order</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Delivery">Delivery Order</a></li>
            </ul>
          </li>

          <li>
            <div class="profile-details">
              <div class="profile-content">
                <!--<img src="image/profile.jpg" alt="profileImg">-->
              </div>
              <div class="name-job">
                <div class="profile_name"><?= $_SESSION['username']; ?></div>
              </div>
              <a href="<?= BASEURL; ?>/Users/logout" class="nav-link"> <i class='bx bx-log-out'></i> </a>

            </div>
          </li>

          <!-- MarketingSupport -->
        <?php elseif ($_SESSION['level_user'] == '5') : ?>
          <li>
            <a href="<?= BASEURL; ?>">
              <i class="bx bx-tachometer"></i>
              <span class="link_name">Dashboard</span>
            </a>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Product">
              <i class='bx bx-collection'></i>
              <span class="link_name">Product</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Product">Product</a></li>
            </ul>
          </li>

          <li>
            <div class="iocn-link">
              <a href="<?= BASEURL; ?>">
                <i class='bx bx-bus'></i>
                <span class="link_name">Purchase Order</span>
              </a>
              <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="<?= BASEURL; ?>">Purchase Order</a></li>
              <li><a href="<?= BASEURL; ?>/Purchase/index2">Customer</a></li>
            </ul>
          </li>

          <li>
            <a href="<?= BASEURL; ?>/Delivery">
              <i class='bx bx-bus'></i>
              <span class="link_name">Delivery Order</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>/Delivery">Delivery Order</a></li>
            </ul>
          </li>

          <li>
            <div class="profile-details">
              <div class="profile-content">
                <!--<img src="image/profile.jpg" alt="profileImg">-->
              </div>
              <div class="name-job">
                <div class="profile_name"><?= $_SESSION['username']; ?></div>
              </div>
              <a href="<?= BASEURL; ?>/Users/logout" class="nav-link"> <i class='bx bx-log-out'></i> </a>

            </div>
          </li>

        <?php else : ?>
          <!-- Default -->

          <li>
            <a href="<?= BASEURL; ?>">
              <i class='bx bx-tachometer'></i>
              <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?= BASEURL; ?>">Dashboard</a></li>
            </ul>
          </li>

          <li class="nav-item active ml-auto">
            <?php if (isset($_SESSION['user_id'])) : ?>

              <a href="<?= BASEURL; ?>/Users/logout">
                <i class='bx bx-log-out'></i>
                <span class="link_name">Logout</span>
              </a>

            <?php else : ?>

              <a href="<?= BASEURL; ?>/Users/login">
                <i class='bx bx-log-out'></i>
                <span class="link_name">Login</span>
              </a>

            <?php endif; ?>
          </li>

        <?php endif; ?>
      <?php else : ?>
        <!-- Default -->
        <li>
          <a href="<?= BASEURL; ?>">
            <i class='bx bx-tachometer'></i>
            <span class="link_name">Dashboard</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="<?= BASEURL; ?>">Dashboard</a></li>
          </ul>
        </li>

        <li class="nav-item active ml-auto">
          <?php if (isset($_SESSION['user_id'])) : ?>

            <a href="<?= BASEURL; ?>/Users/logout">
              <i class='bx bx-log-out'></i>
              <span class="link_name">Logout</span>
            </a>

          <?php else : ?>

            <a href="<?= BASEURL; ?>/Users/login">
              <i class='bx bx-log-out'></i>
              <span class="link_name">Login</span>
            </a>

          <?php endif; ?>
        </li>
      <?php endif; ?>

    </ul>
  </div>
  <!-- end of sidebar -->

  <section class="home-section">
    <!-- content -->
</body>

</html>