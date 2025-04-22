<?php
require_once "connect.php";
require_once "functions.php";
$poster = $_POST['poster'];
$productName = $_POST['productName'];
$id = $_POST['id'];
$category = $_POST['category'];

if (isset($_POST['updateProduct'])) {
     updateProductlist($conn, $productName, $poster, $category, $id);
}

?>