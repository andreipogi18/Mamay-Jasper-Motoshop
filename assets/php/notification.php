
<?php
require_once "connect.php";
require_once "functions.php";
if(isset($_GET['title'])){
$title =$_GET['title'];
if ($_GET['title']=="order"){
$title = $_GET['title'].'&status='.$_GET['status'];
}
elseif($_GET["title"]=="product"&&isset($_GET["hiddenitems"])!='0') {
    $title = $_GET['title'].'&hiddenitems='.$_GET['hiddenitems'];
}
elseif ($_GET['title']=="product") {
    $title = $_GET['title'].'&category='.$_GET['category'];
}
$stmt =$conn->prepare("SELECT * FROM request INNER JOIN users ON users.user_id = request.user_id WHERE `status`= '0'");
$stmt -> execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
    if($row['avatar']==Null){
        $row['avatar'] ="avatar1.jpeg";
    }
echo"
    <div class='dropdown-item d-flex align-items-center'>
    <div class='dropdown-list-image mr-3'>
        <img class='rounded-circle' src='../assets/img/avatars/".$row["avatar"]."' alt='profile'>
        <div class='status-indicator bg-success'></div>
    </div>
    <div>
        <div class='small text-gray-500'>Change Password Request by ".$row['username']."</div>
        <span class='font-weight-bold'>Would you allow it ?</span>
        <a class='btn btn-danger btn-sm'onclick=\"javascript: return confirm('Are you sure to Deny this request');\" href='?title=".$title."&notifno=".$row['user_id']."'><i class='fa fa-ban'></i></a>
        <a class='btn btn-success btn-sm' onclick=\"javascript: return confirm('Are you sure to Accept this request');\" href='?title=".$title."&notifyes=".$row['user_id']."'><i class='fa fa-check'></i></a>
    </div>
</div>";
}
if(isset($_GET['notifno'])){
 deleteRequest($conn,$_GET['notifno']);
 echo "<script>";
    echo "setTimeout(function(){window.location = 'index.php?title=".$title."';}, 100);</script>";
}
if(isset($_GET['notifyes'])){
    acceptRequest($conn,$_GET['notifyes']);
    echo "<script>";
    echo "setTimeout(function(){window.location = 'index.php?title=".$title."';}, 100);</script>";
   }}
?>
