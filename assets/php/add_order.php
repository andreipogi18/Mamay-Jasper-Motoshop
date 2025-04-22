<?php 
require_once 'connect.php';
require_once 'functions.php';

if (isset($_POST['set-order'])) {
    $productID = $_POST['product-id'];
    $productSize = $_POST['product-size'];
    $productAmount = $_POST['product-amount'];

    $stmt = $conn->prepare('SELECT * FROM order_price WHERE product_id= ? AND size= ? ');
    $stmt->bind_param('is', $productID, $productSize);
    $stmt->execute();
    $result = $stmt->get_result();
    echo $productID;
    echo $productSize;
    echo $productAmount;
    echo "<a href='../../Client/home.php'>Click Me</a>";
}





?>