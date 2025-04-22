<?php
$ucount = 0;
$tcount = 0;
$mcount = 0;

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param('s', $_SESSION['userid']);
$stmt->execute();
$result = $stmt->get_result();
$row_a = $result->fetch_assoc();


$user = $conn->prepare("SELECT * FROM users WHERE role='Client'");
$user->execute();

$result = $user->get_result();
$order = $conn->prepare("SELECT * FROM order_slip");
$order->execute();

$result_t = $order->get_result();
$product = $conn->prepare("SELECT * FROM product");
$product->execute();
$result_m = $product->get_result();

$notif =$conn->prepare("SELECT COUNT(*) AS `number` FROM request WHERE `status`='0' ");
$notif -> execute();
$result_n = $notif->get_result();
$row_n = $result_n->fetch_assoc();
$notif_count =$row_n['number'];

while ($row = $result->fetch_assoc()) {
    $ucount++;
}
while ($row_t = $result_t->fetch_assoc()) {
    $tcount++;
}
while ($row_m = $result_m->fetch_assoc()) {
    $mcount++;
}
if ($_SESSION['userid'] == NULL || $_SESSION['userRole'] == 'Client'|| $_SESSION['userRole'] == null) {
    echo "
            <script>alert('Login First');setTimeout(function(){window.location = '../index.php';}, 10);</script>";
    die();
}
?>
<script type="text/javascript">
    window.setTimeout( function() {
    window.location.reload();
    }, 120000);
</script>