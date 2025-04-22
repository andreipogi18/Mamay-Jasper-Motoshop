<?php
$tcount = 0;
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?  OR email =?");
$stmt->bind_param('ss', $_SESSION['userid'], $_SESSION['userid']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$order = $conn->prepare("SELECT * FROM order_slip WHERE username =? OR email =?");
$order->bind_param('is', $_SESSION['userid'], $_SESSION['userid']);
$order->execute();
$result_t = $order->get_result();


while ($row_t = $result_t->fetch_assoc()) {
    $tcount++;
}

if ($_SESSION['userid'] == NULL) {
    echo "
                <script>alert('Login First');setTimeout(function(){window.location = '../index.php';}, 100);</script>";
    die();
}
$getcat = categoryView($conn);
?>

<script type="text/javascript">
    window.setTimeout( function() {
    window.location.reload();
    }, 30000);
</script>