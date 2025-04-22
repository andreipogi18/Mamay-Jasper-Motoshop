<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Mamay Jasper Works</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/img/logo/jasperworks.png" type="image/png" />
    <link rel="shortcut icon" href="../assets/img/logo/jasperworks.png" type="image/png" />
</head>

<body class="bg-light" id="page-top">
    <div id="wrapper">
        <?php include '../assets/php/update_modal.php' ?>
        <?php include '../assets/php/client_start.php' ?>
        <?php include '../assets/php/product_catalogue_modal.php' ?>

        <div class="d-flex flex-column " id="content-wrapper" style="background-color:beige">
            <nav class="navbar navbar-dark navbar-expand  shadow mb-4 topbar static-top "
                style="background-color:#3A5D9C">
                <div class="container-fluid ">
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon " style="color:whitesmoke;"><img
                                src="../assets/img/logo/jasperworks.png" class=" w-100 img-fluid " style="height:60px;"></div>
                    </a>
                    <ul class="navbar-nav flex-nowrap ms-auto ">
                        <!-- nav-->
                        <li class="nav-item ">
                            <div class="nav-item ">
                                <a class="nav-link active" href="home.php">
                                    <i title='Home' class=" fa fa-home fa-fw"></i>
                                </a>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                                    href="#">
                                    <span class="d-none d-lg-inline me-2 text-light small">
                                        <?php echo $row['firstName']; ?>&nbsp;
                                        <?php echo $row['lastName']; ?>
                                    </span>
                                    <img class="border rounded-circle img-profile"
                                        src="../assets/img/avatars/<?php if ($row['avatar'] == NULL) {
                                            echo "avatar1.jpeg";
                                        } else {
                                            echo $row['avatar'];
                                        } ?>" />
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                    <a class="dropdown-item" href="index.php?status=0"><i
                                            class="fas fa-user fa-sm fa-fw me-2 text-gray-400">
                                        </i> Profile</a>
                                    <a class="dropdown-item" href="settings.php"><i
                                            class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400">
                                        </i> Settings</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="../index.php"><i
                                            class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="content">


                <div class=" ">
                    <div class="row align-item-center justify-content-center mx-2">
                        <?php
                        while ($row = $getcat->fetch_assoc()) {

                            echo '
                            <div class="col-md-4 col-xl-2 mb-4">
                            <div class="card text-nowrap shadow border-start-primary py-2" style="background-color:#3A5D9C;">
                                <div class="card-body">
                                    <a href="?title=user&category=' . $row["category_id"] . '" style="text-decoration: none;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col md-2">
                                                <div class="fw-bold h5 mb-0" id="userno"  style="color:white ;"><span>' . $row["categoryName"] . '</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></a>
                            
                            ';

                        } ?>


                        <?php include '../assets/php/Top3_catalogue.php' ?>
                        <?php include '../assets/php/product_catalogue.php' ?>
                    </div>
                </div>
            </div>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/theme.js"></script>
        <script src="../assets/js/tooltip.js"></script>

</body>

</html>