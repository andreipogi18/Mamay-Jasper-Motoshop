<?php
require_once "connect.php";
require_once "functions.php";

$poster = $_FILES['poster']['name'];
$img = $_FILES['poster']['tmp_name'];
$location = '../img/poster/';


$productName = $_POST['productName'];
$brand = $_POST['category'];

    $stmt = $conn->prepare('SELECT categoryCode FROM category WHERE category_id = ? ');
    $stmt->bind_param('s', $brand);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result ->fetch_assoc();
    $productCode = $row['categoryCode'];

if (isset($_POST['add_product'])) {
   if (productExist($conn, $productName)) {
      echo "<script>alert('product Already Uploaded');";
      echo "setTimeout(function(){window.location = '../../Admin';}, 100);</script>";
      die();
   }
   if (isImage($poster)) {

      $extension = pathinfo($poster, PATHINFO_EXTENSION);
      $newImagename = $productName . "." . $extension;
      $finalImage = str_replace(' ', '-', $newImagename);


      if (move_uploaded_file($img, $location . $finalImage)) {
         createProductlist($conn,$productCode, $productName, $finalImage, $brand);
      }
   } else {
      echo "<script>alert('Invalid File Uploaded');";
      echo "setTimeout(function(){window.location = '../../Admin';}, 100);</script>";
   }
}
?>