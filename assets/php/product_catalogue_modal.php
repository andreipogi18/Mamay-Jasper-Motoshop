<?php

require_once "connect.php";
require_once "functions.php";


if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $stmt = $conn->prepare("SELECT * FROM product INNER JOIN order_price ON product.category = order_price.category_id WHERE category = ? AND `hidden`='0'");
    $stmt->bind_param('s', $category);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $stmt = $conn->prepare("SELECT * FROM product INNER JOIN order_price ON product.category = order_price.category_id WHERE `hidden` = '0'");
    $stmt->execute();
    $result = $stmt->get_result();
}
if (!$result) {
    die("Invalid query" . $conn->error);
}
while ($modal = $result->fetch_assoc()) {
    //check Stock in the inventory
    $checkStock = checkStock($conn, $modal['product_id']);
    if ($checkStock == 0) {
        //hide the product
        productStatus($conn, 1, $modal['product_id']);
    } else {
    }


    //modal info for product's amount of order and size
    echo "
            <div class=' modal fade' role='dialog' data-bs-backdrop='static' tabindex='1' id='productid-" . $modal["product_id"] . "'>
                <div class=' modal-dialog modal-lg' role='document'>
                    <div class=' modal-content'>
                        <div class='modal-header bg-dark'>
                            <h4 class='modal-title text-light'>" . $modal["product"] . "</h4><button type='button' class='btn-close btn-danger' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                    <div class=' modal-body'>
                        <div class='container '>
                            <div class=' bg-transparent'>
                                <!-- Nested Row within Card Body -->
                                <div class='row justify-content-center bg-transparent gap-3 p-3 m-auto rounded-3'style='background-color: whitesmoke;opacity: .9;' >
                                    <div class='col-md-5 '>
                                        <img class=' img-fluid align-center w-100' style='height:auto;' src='../assets/img/poster/" . $modal["poster"] . "'>
                                    </div>
                                    <div class='col-md-6 '>
                                    <form class='user' method='post' enctype='multipart/form-data'>
                                        <div class='form-group row'>
                                            <div class='col-sm-6 mb-4 '>
                                                <h3>Ouantity</h3>
                                                <input type='number' class='form-control w-100'id ='product-amount' name ='product-amount' min='1' max='10'placeholder='Quantity' required >
                                                <span class='badge badge-sm text-dark'> Available : " . $checkStock . "</span>
                                            </div>
                                            
                                            <div hidden class='col-sm-6 mb-4'>
                                                <input  type='number' class='form-control w-100'name='product-id' id='product-id' value='" . $modal["product_id"] . "'required>
                                                
                                            </div>
                                                <div class='col-sm-6 mb-4'>
                                                <h3>Size</h3>
                                                    <select class='form-select' name='product-size' id='product-size'>
                                                    <option selected disabled>Choose Size</option>
                                                    ";

                                                    $cup = $conn->prepare("SELECT price,cupsize FROM order_price WHERE category_id = ?");
                                                    $cup->bind_param('s', $modal['category_id']);
                                                    $cup->execute();
                                                    $cups = $cup->get_result();
                                                    
                                                    while ($cupss = $cups->fetch_assoc()) {
                                                        $cupss['price'] = number_format($cupss['price'], 2);
                                                        echo "<option value='$cupss[cupsize]'>$cupss[cupsize] ₱ $cupss[price]</option>";
                                                    }
                                                    ;



    echo "
                                                    </select>
                                                </div>
                                                <div class='col-sm-6 mb-4'>";

    echo '
                                            <h3> Payment</h3>
                                                <select id="select_type_' . $modal["product_id"] . '" name="payment-type" class="form-select" onchange="toggleImage' . $modal["product_id"] . '()" required>
                                                <option value="0" selected disabled >Select...</option>
                                                <option value="Cash">Cash</option>
                                                <option value="GCash">GCash</option>
                                            </select>
                                            </div>
                                            <div class="col-sm-6">
                                            <div id="input_container_' . $modal["product_id"] . '" style="display:none;">
                                                <div id="input_file_' . $modal["product_id"] . '" class="col-sm-12 mb-4">
                                                <h3><strong> QR Code</strong></h3>
                                                    <input  type="file" class="form-control w-100"name="product-payment" id="product-payment">
                                                </div>
                                                <div  class="col-sm-12 mb-4">
                                                    <img id="Qr_Code_' . $modal["product_id"] . '" class="img-fluid" src="../assets/img/payment/hello.jpg">
                                                </div>
                                            </div>
                                            </div>
                                    
                                        <script>
                                            function toggleImage' . $modal["product_id"] . '() {
                                                var selectedOption = document.getElementById("select_type_' . $modal["product_id"] . '").value;
                                                var inputContainer = document.getElementById("input_container_' . $modal["product_id"] . '");
                                                var Qr_Code_ = document.getElementById("Qr_Code_' . $modal["product_id"] . '");
                                                var input_file_ = document.getElementById("input_file_' . $modal["product_id"] . '");
                                    
                                                // Hide all images first
                                                Qr_Code_.style.display = "none";
                                                input_file_.style.display = "none";
                                    
                                                // Check which image to show based on selected option value
                                                if (selectedOption == "GCash") {
                                                    Qr_Code_.style.display = "block";
                                                    input_file_.style.display = "block";
                                                }
                                    
                                                // Show the container if an option is selected, otherwise, hide it
                                                if (selectedOption == 0) {
                                                    inputContainer.style.display = "none";
                                                } else {
                                                    inputContainer.style.display = "block";
                                                }
                                            }
                                        </script>';


    echo "</div>
                                            </div>
                                        <input type='submit' href ='index.php' class='btn btn-item d-block w-100' name='set-order'>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  <div class='modal-footer'></div>
                </div>
            </div>
        </div>
        ";


}
if (isset($_POST['set-order'])) {
    $date = date('Y-m-d');

    $productPayment = $_FILES['product-payment']['name'];
    $temp_payment = $_FILES['product-payment']['tmp_name'];
    $folder = "../assets/img/payment/";

    $productID = $_POST['product-id'];
    $productSize = $_POST['product-size'];
    $productAmount = $_POST['product-amount'];
    $productType = $_POST['payment-type'];
    //query for the product price 

    $price = $conn->prepare('SELECT * FROM order_price INNER JOIN product ON product.category = order_price.category_id WHERE product_id= ? AND cupsize= ?');
    $price->bind_param('is', $productID, $productSize);
    $price->execute();
    $result_price = $price->get_result();
    $price = $result_price->fetch_assoc();
    //check if its an image 
    if ($productType == "Cash") {
        createOrder($conn, $row['user_id'], $row['email'], $row['username'], "0", $productID, $price['price_id'], $productAmount, $productType, $date);
    } else {
        if (isImage($productPayment)) {
            $extension = pathinfo($productPayment, PATHINFO_EXTENSION);
            $rand = rand(0, 99999999);
            $new_file_name = $rand . $date . " " . $username . "." . $extension;
            $final_file = str_replace(' ', '-', $new_file_name);
            if (move_uploaded_file($temp_payment, $folder . $final_file)) {
                createOrder($conn, $row['user_id'], $row['email'], $row['username'], "0", $productID, $price['price_id'], $productAmount, $final_file, $date);
            }
        } else {
            echo "<script>alert('Please Import a valid Image')</script>";
        }
    }
}


//
?>