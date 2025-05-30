<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Mamay Jasper Motoshop</title>
    <link rel="icon" href="../assets/img/logo/jasperworks.png" type="image/png" />
    <link rel="shortcut icon" href="../assets/img/logo/jasperworks.png" type="image/png" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body id="page-top" style="background-color: beige;">
    <div id="wrapper" style="background: var(--bs-light);">
        <?php include '../assets/php/update_modal.php' ?>
        <?php include '../assets/php/create_modal.php' ?>
        <?php include '../assets/php/add_product_modal.php' ?>
        <?php include '../assets/php/update_product_modal.php' ?>
        <?php include '../assets/php/admin_start.php' ?>
        <?php include '../assets/php/add_stock.php' ?>
        <?php include '../assets/php/view_payment.php' ?>
        <?php
        $stmt   =    $conn->prepare("SELECT category_id,categoryName FROM category");
        $stmt   ->   execute()                                          ;
        $result =    $stmt->get_result()                                ;
        ?>
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion p-0"
            style="background-color:#3A5D9C;">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon " style="color:beige;"><img src="../assets/img/logo/jasperworks.png"
                            class=" w-100 img-fluid "
                            style="height: 120px; padding-top: 30px; scale: 10px; padding-bottom: 10px"></div>
                    <div class="sidebar-brand-text mx-3"></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <br>
                    <div class="sidebar-heading">
                        Dashboard
                    </div>
                    <li class="nav-item"><a class="nav-link" href="?title=home"><i
                                class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user"
                            aria-expanded="true" aria-controls="user">
                            <i class="fas fa-fw fa-user-alt"></i>
                            <span>User</span>
                        </a>
                        <div id="user" class="collapse" aria-labelledby="order" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Role:</h6>
                                <a class="collapse-item" href="index.php?title=user&role=Client">Customer</a>
                                <a class="collapse-item" href="index.php?title=user&role=Staff">Staff</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#order"
                            aria-expanded="true" aria-controls="order">
                            <i class="fas fa-cart-arrow-down"></i>
                            <span>Order</span>
                        </a>
                        <div id="order" class="collapse" aria-labelledby="order" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Status:</h6>
                                <a class="collapse-item" href="index.php?title=order&status=0">Place Order</a>
                                <a class="collapse-item" href="index.php?title=order&status=1">Ongoing</a>
                                <a class="collapse-item" href="index.php?title=order&status=2"> Ready</a>
                                <a class="collapse-item" href="index.php?title=order&status=3"> Complete</a>
                                <a class="collapse-item" href="index.php?title=order&status=4"> Canceled</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ProductDropdownCat"
                            aria-expanded="true" aria-controls="ProductDropdownCat">
                            <i class="fas fa-motorcycle"></i>
                            <span>Product</span>
                        </a>
                        <div id="ProductDropdownCat" class="collapse" aria-labelledby="ProductDropdown"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Edit:</h6>
                                <a class="collapse-item" href="index.php?title=settings">Settings</a>
                                <h6 class="collapse-header">Category:</h6>
                                <a class="collapse-item" href="index.php?title=product&hiddenitems=0">Hidden</a>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    echo "<a class='collapse-item' href='index.php?title=product&category=$row[category_id]'>$row[categoryName]</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inventory"
                            aria-expanded="true" aria-controls="inventory">
                            <i class="fas fa-fw fa-clipboard-list"></i>
                            <span>Inventory</span>
                        </a>
                        <div id="inventory" class="collapse" aria-labelledby="inventory"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Settings:</h6>
                                <a class="collapse-item" href="index.php?title=stock"> Stock</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sales"
                            aria-expanded="true" aria-controls="sales">
                            <i class="fas fa-fw fa-line-chart"></i>
                            <span>Sales Report</span>
                        </a>
                        <div id="sales" class="collapse" aria-labelledby="sales" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Settings:</h6>
                                <a class="collapse-item" href="index.php?title=sales"> Display</a>
                                <a class="collapse-item" href="index.php?title=record"> Monthly Sales Record</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column " id="content-wrapper" style="background-color:beige;">
            <nav class="navbar navbar-dark navbar-expand shadow mb-4 topbar static-top"
                style="background-color:#FFFFFF;">
                <div class="container-fluid"><button id="sidebarToggleTop"
                        class="btn btn-link d-md-none rounded-circle me-3" type="button"><i
                            class="fas fa-bars text-light"></i></button></div>
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                </a>
                <div class="container-fluid rounded-3">
                    <ul class="navbar-nav flex-nowrap ms-auto">
                        <!-- nav-->
                        <!---->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span style="color: #000000;">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter">
                                        <?php echo $notif_count ?>
                                    </span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="bg-dark border-0 dropdown-header">
                                    Alerts Center
                                </h6>
                                <?php include '../assets/php/notification.php' ?>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                                    href="#">
                                    <span class="d-none d-lg-inline me-2 text-dark small">
                                        <?php echo $row_a['lastName']; ?>
                                    </span>
                                    <img class="border rounded-circle img-profile"
                                        src="assets/img/avatars/avatar5.jpeg" />
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                    <a class="dropdown-item" href="../index.php"><i
                                            class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="content" style="color: var(--bs-dark);">
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">
                            <?php if (isset($_GET["title"])) {
                                if ($_GET["title"] == "home") {
                                    echo "Dashboard";
                                } else if ($_GET["title"] == "user") {
                                    echo "User Information";
                                } else if ($_GET["title"] == "order") {
                                    echo "Order Information";
                                } elseif ($_GET["title"] == "settings") {
                                    echo "Product Settings";
                                } elseif ($_GET["title"] == "product" && isset($_GET["hiddenitems"]) != '0') {
                                    echo "Hidden Items";
                                } else if ($_GET["title"] == "product") {
                                    echo "Product Information";
                                } else if ($_GET["title"] == "stock") {
                                    echo "Stock Information";
                                } else if ($_GET["title"] == "sales") {
                                    echo "Sales Report";
                                } else if ($_GET["title"] == "record") {
                                    echo "Monthly Sales Record";
                                }
                            } else {
                                echo "Dashboard";
                            }
                            ?>
                        </h3>
                    </div>
                    <?php if (isset($_GET["title"])) {
                        if ($_GET["title"] == "home") { ?>
                    <div class="row">
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card shadow border-start-primary py-2" style="background-color:#3A5D9C;">
                                <div class="card-body"><a href="?title=user" style="text-decoration: none;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="fw-bold h5 mb-0" id="userno" style="color:white ;"><span>
                                                        <?php echo $ucount; ?>
                                                    </span><span>&nbsp; &nbsp; Users</span></div>
                                            </div>
                                            <div class="col-auto" style="color:white ;"><i
                                                    class="fas fa-address-book  fa-2x "></i></div>
                                        </div>
                                </div>
                            </div>
                        </div></a>
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card shadow border-start-success py-2" style="background-color:#3A5D9C;">
                                <div class="card-body"><a href="?title=order&status=3" style="text-decoration: none;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class=" fw-bold h5 mb-0" style="color:white ;"><span
                                                        id="order&status=3">
                                                        <?php echo $tcount; ?>
                                                    </span><span>&nbsp; &nbsp; Order/s</span></div>
                                            </div>
                                            <div class="col-auto" style="color:white ;"><i
                                                    class="fas fa-cart-arrow-down fa-2x"></i></div>
                                        </div>
                                </div>
                            </div>
                        </div></a>
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card shadow border-start-success py-2" style="background-color:#3A5D9C;">
                                <div class="card-body"><a href="?title=product" style="text-decoration: none;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class=" fw-bold h5 mb-0" style="color:white ;"><span
                                                        id="productno">
                                                        <?php echo $mcount; ?>
                                                    </span><span>&nbsp; &nbsp; Product/s&nbsp;</span></div>
                                            </div>
                                            <div class="col-auto" style="color:white ;"><i
                                                    class="fas fa-motorcycle  fa-2x "></i></div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div></a>
                    <?php include "graphs.php";
                        }
                    } else { ?>
                    <div class="row">
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card shadow border-start-primary py-2" style="background-color:#3A5D9C;">
                                <div class="card-body"><a href="?title=user" style="text-decoration: none;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="fw-bold h5 mb-0" id="userno" style="color:white ;"><span>
                                                        <?php echo $ucount; ?>
                                                    </span><span>&nbsp; &nbsp; Customer</span></div>
                                            </div>
                                            <div class="col-auto" style="color:white ;"><i
                                                    class="fas fa-users fa-2x "></i></div>
                                        </div>
                                </div>
                            </div>
                        </div></a>
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card shadow border-start-success py-2" style="background-color:#3A5D9C;">
                                <div class="card-body"><a href="?title=order&status=3" style="text-decoration: none;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class=" fw-bold h5 mb-0" style="color:white ;"><span
                                                        id="order&status=3">
                                                        <?php echo $tcount; ?>
                                                    </span><span>&nbsp; &nbsp; Order/s</span></div>
                                            </div>
                                            <div class="col-auto" style="color:white ;"><i
                                                    class=" fas fa-cart-arrow-down fa-2x"></i></div>
                                        </div>
                                </div>
                            </div>
                        </div></a>
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card shadow border-start-success py-2" style="background-color:#3A5D9C;">
                                <div class="card-body"><a href="?title=product" style="text-decoration: none;">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class=" fw-bold h5 mb-0" style="color:white ;"><span
                                                        id="productno">
                                                        <?php echo $mcount; ?>
                                                    </span><span>&nbsp; &nbsp; Product/s&nbsp;</span></div>
                                            </div>
                                            <div class="col-auto" style="color:white ;"><i
                                                    class="fas fa-motorcycle fa-2x "></i></div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div></a>
                    <?php include "graphs.php";
                    } ?>
                    <?php
                    if (isset($_GET["title"])) {
                        if ($_GET["title"] != "home") { ?>
                    <div class="d-flex flex-column bg-transparent" id="content-wrapper">
                        <div id="content">
                            <div class="container-fluid p-0">
                                <h3 class="text-dark text-light"></h3>
                                <div class="card border-0">
                                    <div class="card-header border-0 py-3 " style="background-color:#3A5D9C;">
                                        <div class="row">
                                            <div class="col-md-12 col-xl-11 mb-0">
                                                <p class=" m-0 fw-bold" style="color:white ;">Info</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-color:white;">
                                        <div class="table-responsive-sm " id="">
                                            <table
                                                class="table table-sm table-hover table-light table-striped table-bordered"
                                                id="userTable" height="100%" width="100%" cellspacing="0">
                                                <?php
                                                        $set = $_GET['title'];
                                                        if ($_GET["title"] == "user") {
                                                            include "user_table.php";
                                                        } else if ($_GET["title"] == "order") {
                                                            include "order_table.php";
                                                        } else if ($_GET["title"] == "settings") {
                                                            include "settings.php";
                                                        } else if ($_GET["title"] == "product") {
                                                            include "product_table.php";
                                                        } else if ($_GET["title"] == "stock") {
                                                            include "stock_table.php";
                                                        } else if ($_GET["title"] == "record") {
                                                            include "monthly_table.php";
                                                        } else {
                                                            include "graphs.php";
                                                        }
                                                        ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/chart.js/Chart.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="../assets/js/tooltip.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../assets/js/datatable.js"></script>
    <script src="../assets/js/chart-area.js"></script>
    <script src="../assets/js/chart-bar.js"></script>
    <script src="../assets/js/chart-pie.js"></script>


</body>

</html>