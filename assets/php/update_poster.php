<?php
require_once "connect.php";
require_once "functions.php";

$location = '../img/poster/';
$poster = $_POST['prev'];
$id = $_POST['id'];

$image = $_FILES['poster']['name'];
$img = $_FILES['poster']['tmp_name'];

$productName = $_POST['productName'];

unlink('../img/poster/' . $poster);


if (isset($_POST['Update-poster'])) {

   if (isImage($image)) {

      $extension = pathinfo($image, PATHINFO_EXTENSION);
      $newImagename = $productName . ".png";
      $finalImage = str_replace(' ', '-', $newImagename);

      if (move_uploaded_file($img, $location . $finalImage)) {
         updatePoster($conn, $finalImage, $id);
      }

   }
}
?>