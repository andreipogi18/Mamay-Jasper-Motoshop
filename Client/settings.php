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
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="icon" href="../assets/img/logo/jasperworks.png" type="image/png" />
    <link rel="shortcut icon" href="../assets/img/logo/jasperworks.png" type="image/png" />
</head>

<body id="page-top" style="background-color:beige">
    <div id="wrapper">
        <?php include '../assets/php/update_modal.php' ?>
        <?php include '../assets/php/update_password.php' ?>
        <?php include '../assets/php/update_avatar_modal.php' ?>
        <?php include '../assets/php/client_start.php' ?>

        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion  p-0"
            style="background-color:#3A5D9C">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon " style="color:whitesmoke;"><img src="../assets/img/logo/jasperworks.png"
                            class=" w-100 img-fluid " style="height: 90px;"></div>
                    <div class="sidebar-brand-text mx-3"></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="home.php"><i
                                class="fa fa-home"></i><span>Home</span></a></li>
                    <li class="nav-item"><a class="nav-link " href="index.php?status=0"><i
                                class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="settings.php"><i
                                class="fa fa-cogs"></i><span>Settings</span></a></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>

        <div class="d-flex flex-column " id="content-wrapper" style="background-color:whitesmoke;">
            <nav class="navbar navbar-dark navbar-expand shadow mb-4 topbar static-top"
                style="background-color:#3A5D9C">
                <div class="container-fluid"><button id="sidebarToggleTop"
                        class="btn btn-link d-md-none rounded-circle me-3" type="button"><i
                            class="fas fa-bars text-light"></i></button>
                    <ul class="navbar-nav flex-nowrap ms-auto">
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                                    href="#">
                                    <span class="d-none d-lg-inline me-2 text-light small">
                                        <?php echo $row['firstName']; ?>&nbsp;
                                        <?php echo $row['lastName']; ?>
                                    </span>
                                    <img class="border rounded-circle img-profile" src="../assets/img/avatars/<?php if ($row['avatar'] == NULL) {
                                        echo "avatar1.jpeg";
                                    } else {
                                        echo $row['avatar'];
                                    } ?>" />
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                    <a class="dropdown-item" href="index.php?status=0"><i
                                            class="fas fa-user fa-sm fa-fw me-2 text-gray-400">
                                        </i> Profile</a>
                                    <a class="dropdown-item" href="#"><i
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
                <div class="container-fluid ">

                    <h3 class="text-dark mb-4">Settings</h3>
                    <div class="row mb-3 rounded " style="background-color:whitesmoke;">
                        <div class=" col-12 col-sm-12 col-lg-12 ">
                            <div class="card mb-3 bg-transparent border-0">
                                <div class="card-body text-center"><a href="?updateid=<?php echo $row['user_id'] ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#avatar-<?php echo $row['user_id'] ?>"><img
                                            class="ms-auto w-50 img-fluid border-light rounded-circle mb-3 mt-4" src="../assets/img/avatars/<?php if ($row['avatar'] == NULL) {
                                                echo "avatar1.jpeg";
                                            } else {
                                                echo $row['avatar'];
                                            } ?>"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-lg-12 text-light ">
                            <div class="card  border-0 mb-3" style="background-color:#3A5D9C">
                                <div class="container card-body ">
                                    <div class="row  ">
                                        <div class="col-lg-6 text-start mb-3">
                                            <span><strong>Edit User</strong></span>
                                        </div>
                                        <div class="col-lg-6 text-end mb-3">
                                            <button class="btn btn-dark btn-sm" type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal-<?php echo $row['user_id'] ?>">
                                                <i class="fa fa-cog"></i>
                                            </button>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <h3>
                                                <?php echo $row['firstName']; ?>&nbsp;
                                                <?php echo $row['lastName']; ?>
                                            </h3>
                                        </div>
                                        <div class="col-lg-6 text-center">
                                            <span>
                                                <?php echo $row['email']; ?>
                                            </span>
                                        </div>
                                        <div class="col-lg-6 text-center">
                                            <span>
                                                <?php echo $row['role']; ?>
                                            </span>
                                        </div>
                                        <div class="col-lg-12">
                                            <h1>&nbsp;&nbsp;</h1>
                                        </div>
                                        <div class="col-lg-6 text-start">
                                            <span><strong>Edit Password</strong></span>
                                        </div>
                                        <div class="col-lg-6 text-end mb-3">
                                            <button class="btn btn-dark btn-sm" type="button" data-bs-toggle="modal"
                                                data-bs-target="#pass-<?php echo $row['user_id'] ?>">
                                                <i class="fa fa-cog"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>