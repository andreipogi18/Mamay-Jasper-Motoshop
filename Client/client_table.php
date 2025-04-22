<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] == '0') {
        $status_0 = " ";
        $active_0 = "active";
    } else {
        $status_0 = "disabled";
        $active_0 = " ";
    }
    if ($_GET['status'] == '1') {
        $status_1 = " ";
        $active_1 = "active";
    } else {
        $status_1 = "disabled";
        $active_1 = " ";
    }
    if ($_GET['status'] == '2') {
        $status_2 = " ";
        $active_2 = "active";
    } else {
        $status_2 = "disabled";
        $active_2 = " ";
    }
    if ($_GET['status'] == '3') {
        $status_3 = " ";
        $active_3 = "active";
    } else {
        $status_3 = "disabled";
        $active_3 = " ";
    }
    if ($_GET['status'] == '4') {
        $status_4 = "active ";
        $active_4 = "active";
    } else {
        $status_4 = "disabled";
        $active_4 = " ";
    }
}

?>
<div>
    <ul class="nav nav-tabs justify-content-around ">
        <li class="nav-item <?php echo $status_0 ?>">
            <a href="?status=0" class="fas fa-shopping-cart text-dark nav-link <?php echo $active_0 ?>"
                aria-current="page"> Placed Order</a>
        </li>
        <li class="nav-item <?php echo $status_1 ?>">
            <a href="?status=1" class="fa fa-refresh text-dark nav-link <?php echo $active_1 ?>"> Ongoing</a>
        </li>
        <li class="nav-item <?php echo $status_2 ?>">
            <a href="?status=2" class="fa fa-clock-o text-dark nav-link <?php echo $active_2 ?>"> Ready</a>
        </li>
        <li class="nav-item <?php echo $status_3 ?>">
            <a href="?status=3" class="fa fa-check text-dark nav-link <?php echo $active_3 ?>"> Completed Order</a>
        </li>
        <li class="nav-item <?php echo $status_4 ?>">
            <a href="?status=4" class="fa fa-ban text-dark nav-link <?php echo $active_4 ?>"> Cancelled</a>
        </li>
    </ul>
</div>

<div class="card-body">
    <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
        <table class="table table-bordered" id="userTable" height="100%" width="100%" cellspacing="1">
            <thead>
                <tr>

                    <th colspan="2" class='text-center'>Product Name</th>
                    <th>Qty </th>
                    <th>Cost</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody action="">

                <?php include "../assets/php/client.php" ?>

            </tbody>

        </table>
    </div>
</div>