<?php
require_once "connect.php";
require_once "functions.php";


//get the title of the page 
if(isset($_GET['title'])){
    $add ="";
    if(isset($_GET["status"])){$add = "&status=".$_GET["status"];}
$title =$_GET['title'].$add;}



if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $date = date('Y-m-d H:i');
    $stmt = $conn->prepare("SELECT * FROM order_slip INNER JOIN product ON order_slip.product_id = product.product_id INNER JOIN order_price ON order_slip.price_id = order_price.price_id  WHERE `status`= ?");
    $stmt->bind_param('s', $status);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $date = date('Y-m-d H:i');
    $stmt = $conn->prepare("SELECT * FROM order_slip INNER JOIN product ON order_slip.product_id = product.product_id INNER JOIN order_price ON order_slip.price_id = order_price.price_id ");
    $stmt->execute();
    $result = $stmt->get_result();
}
if (!$result) {
    die("Invalid query" . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    if($row['payment']=="Cash"){
        $payment= $row['payment'];
    }
    else{
        $payment = "<a class='align-center fas fa-eye text-light  btn btn-add btn-xl ' href='#' data-bs-toggle='modal'
        data-bs-target='#view_payment-".$row['order_id']."'></i></a>";
    }

if (isset($_GET['status'])) {
    if ($row['status'] == '0') {
        $cancel = "
            <a  class='btn btn-primary btn-sm' href= '?title=order&status=$status&confirmOrder=$row[order_id]&Quantity=$row[Quantity]&pid=$row[product_id]' id='confirm' name='confirm'>Confirm</a>
            <a  class='btn btn-danger btn-sm' href= '?title=order&status=$status&deleteOrder=$row[order_id]'onclick=\"javascript: return confirm('Please confirm Cancelation');\" id='Delete' name='Delete' >Cancel&nbsp;</a>
            ";
    } elseif ($row['status'] == '4' || $row['status'] == '3') {
        $cancel = "
            ";
            $payment = "
            ";
    } else {
        $cancel = "
            <a  class='btn btn-primary btn-sm' href= '?title=order&status=$status&confirmOrder=$row[order_id]&Quantity=$row[Quantity]&pid=$row[product_id]' id='confirm' name='confirm'>Done</a>
            ";
    }}else {
        $cancel ="";
    }
    echo "
            <tr>
                <td >" . $row["product"] . "</td>
                <td >" . $row["username"] . "</td>
                <td >" . $row["Quantity"] . "</td>
                <td >" . $row["price"] . "</td>
                <td >" . $row["Quantity"] * $row["price"] . "</td>
                <td >" . $payment . "</td>
                <td>
                    " . $cancel . "
                </td>
            </tr>

            ";
}
if (isset($_GET['deleteOrder'])) {
    $status = (int) $status + 4;
    $id = $_GET['deleteOrder'];
    orderStatus($conn,$status,$id);
    echo "<script>alert('Order Cancelled');";
    echo "setTimeout(function(){window.location = 'index.php?title=".$title."';}, 10);</script>";

}
if (isset($_GET['confirmOrder'])) {
    $status = (int) $status + 1;
    $id = $_GET['confirmOrder'];
    $pid = $_GET['pid'];
    $quantity = $_GET['Quantity'];
    orderStatus($conn,$status,$id);
    if ($status==1){
        deductStock($conn,$pid,$quantity);
    }
    echo "<script>setTimeout(function(){window.location = 'index.php?title=".$title."';}, 10);</script>";
}


?>