<?php

require_once "connect.php";
require_once "functions.php";

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $stmt = $conn->prepare("SELECT * FROM product WHERE category = ? AND `hidden`='0'");
    $stmt->bind_param('s', $category);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $stmt = $conn->prepare("SELECT * FROM product WHERE `hidden`='0'");
    $stmt->execute();
    $result = $stmt->get_result();
}

if (!$result) {
    die("Invalid query" . $conn->error);
}
echo "
    <div class='container container-fluid pt-5'>
            <h3 class='text-dark mb-4'>NOW AVAILABLE</h3>
            <div class='row mb-1 justify-content-around rounded bg-transparent'>
    
    ";
    while ($row = $result->fetch_assoc()) {

        echo "
        
                <div class='col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3 mb-4'>
                    <div class='card-body rounded shadow' style='background-color:#000000;'>
                        <div class='flip-card'>
                          <div class='flip-card-inner'>
                            <div class='flip-card-front'> 
                                <a data-bs-toggle='modal' data-bs-target='#productid-" . $row["product_id"] . "' href='?productid=" . $row['product'] . "'><img class='ms-auto w-100 img-fluid rounded-3 mb-4' style='height:350px;' src='../assets/img/poster/" . $row['poster'] . "'></a>
                            </div>
                            <div class='flip-card-back' > 
                                <a data-bs-toggle='modal' data-bs-toggle='tooltip'data-bs-target='#productid-" . $row["product_id"] . "' href='?productid=" . $row['product'] . "'><img class=' opacity-50 ms-auto w-100 img-fluid rounded-3 mb-4' style='height:350px;' src='../assets/img/poster/" . $row['poster'] . "' title='View More Info'><span class='centered text-light btn btn-item btn-xl '>Buy</span></a>
                            </div>
                           </div>
                        </div>
                    </div>
                </div>


            
        ";

    }

echo "</div>
        </div>";
if (isset($_POST['productid'])) {
    $product = $_POST['product'];
    $_SESSION['product'] = $product;
    echo "<script>";
    echo "setTimeout(function(){window.location = 'seat.php';}, 100);</script>";

}