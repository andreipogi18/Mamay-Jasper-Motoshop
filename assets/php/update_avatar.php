<?php
require_once "connect.php";
require_once "functions.php";
//get file information
$avatar = $_FILES['avatar']['name'];
$img = $_FILES['avatar']['tmp_name'];
$location = '../img/avatars/';
//get user information
$username = $_POST['user'];
$id = $_POST['id'];
if (isset($_POST['profile'])) {
   if (isImage($avatar)) {

      //prepare stmt 
      $picture = $conn->prepare("SELECT * FROM users WHERE user_id = ? ");
      //bind parameters
      $picture->bind_param("i", $id);
      //execute query
      $picture->execute();
      //get result
      $result = $picture->get_result();
      //get associate row 
      $row = $result->fetch_assoc();
      //get previous avatar
      $picture_name = $row['avatar'];
      //delete previous avatar
      unlink('../img/avatars/' . $picture_name);


      $extension = pathinfo($avatar, PATHINFO_EXTENSION);
      $new_file_name = $username . "." . $extension;
      $final_file = str_replace(' ', '-', $new_file_name);
      if (move_uploaded_file($img, $location . $final_file)) {
         updatePicture($conn, $final_file, $id);
         echo "<script>alert('Update Successfully');";
         echo "setTimeout(function(){window.location = '../../Client/';}, 100);</script>";
      } else {
      }
   } else {
      echo "<script>alert('Invalid File Uploaded');";
      echo "setTimeout(function(){window.location = '../../Client/';}, 100);</script>";
   }
}
?>