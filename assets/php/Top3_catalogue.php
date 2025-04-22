<?php

require_once "connect.php";
require_once "functions.php";
include_once 'graph_data.php';
if (sizeof($Top3_data)>2) {
    echo "
<h3 class='text-dark mb-1 text-align-center fw-bold text-decoration-underline'>Best Seller</h3>
<div id='carouselId' style='background-color: black;' class='carousel mx-5 shadow-lg slide rounded-pill' data-bs-ride='carousel'>
<ol class='carousel-indicators'>
    <li data-bs-target='#carouselId' data-bs-slide-to='0' class='active' aria-current='true' aria-label='First slide'></li>
    <li data-bs-target='#carouselId' data-bs-slide-to='1' aria-label='Second slide'></li>
    <li data-bs-target='#carouselId' data-bs-slide-to='2' aria-label='Third slide'></li>
</ol>   
<div class='carousel-inner' style='height:500px; image-rendering:-webkit-optimize-contrast;image-rendering: crisp-edges;' role='listbox'>
    ";
    for ($i = 0; $i < sizeof($Top3_label); $i++) {
        $stmt = $conn->prepare("SELECT * FROM product WHERE product_id = ? AND `hidden`='0'");
        $stmt->bind_param('s', $Top3_label[$i]);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result) {
            die("Invalid query" . $conn->error);
        }
        //determine which place is on the top 3 products

        while ($row = $result->fetch_assoc()) {
            if ($i == 0) {
                $active = "active";
            } else {
                $active = " ";
            }
            echo "
        <div class='carousel-item " . $active . "' data-bs-interval='2000'>
            <a data-bs-toggle='modal' data-bs-toggle='tooltip'data-bs-target='#productid-" . $row["product_id"] . "' href='?productid=" . $row['product'] . "'><img src='../assets/img/poster/" . $row['poster'] . "' style='height:500px;' class=' img-fluid mx-auto d-block'  alt='First slide'></a>
        </div>
        ";

        }
    }
}
echo "   </div>
</div>";
if (isset($_POST['productid'])) {
    $product = $_POST['product'];
    $_SESSION['product'] = $product;
    echo "<script>";
    echo "setTimeout(function(){window.location = 'home.php';}, 100);</script>";

}