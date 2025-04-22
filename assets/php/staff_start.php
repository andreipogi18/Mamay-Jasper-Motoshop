<?php
$ucount = 0;
$tcount = 0;
$mcount = 0;
$newcount = 0;

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param('s', $_SESSION['userid']);
$stmt->execute();
$result = $stmt->get_result();
$row_a = $result->fetch_assoc();


$neworder = $conn->prepare("SELECT * FROM order_slip WHERE `status`='0'  ");
$neworder->execute();
$result_new = $neworder->get_result();

$order = $conn->prepare("SELECT * FROM order_slip WHERE `status`!='0' OR `status`!='4' ");
$order->execute();
$result_t = $order->get_result();

$product = $conn->prepare("SELECT * FROM product");
$product->execute();
$result_m = $product->get_result();

while ($row_new = $result_new->fetch_assoc()) {
    $newcount++;
}
while ($row_t = $result_t->fetch_assoc()) {
    $tcount++;
}
while ($row_m = $result_m->fetch_assoc()) {
    $mcount++;
}
if ($_SESSION['userid'] == NULL || $_SESSION['userRole'] == 'Client') {
    echo "
            <script>alert('Login First');setTimeout(function(){window.location = '../index.php';}, 100);</script>";
    die();
}
?>
<script type="text/javascript">
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack(),0");
    window.onunload = function () {
        null;
    }
</script>