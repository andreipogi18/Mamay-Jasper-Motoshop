<?php
//top 3 from all products
if(isset($_GET['category'])){
    $category = $_GET['category'];
    $stmt = $conn->prepare('SELECT * FROM product WHERE category = ? AND hidden="0"');
    $stmt -> bind_param('s',$category);
    $stmt->execute();
    $result = $stmt->get_result();
}
else{
$stmt = $conn->prepare('SELECT * FROM product WHERE hidden="0"');
$stmt->execute();
$result = $stmt->get_result();}
//array container
$productName = array();
$productTop = array();
$Top3 = array();
$Top3_label = array();
$Top3_data = array();
$label3 = array();
$productID = array();
$productPurchases = array();
$Highest = "";
$total_revenue = 0;
//
while ($row = $result->fetch_assoc()) {
    $productName[] = $row['product'];
    $stmt2 = $conn->prepare('SELECT *,SUM(Quantity) AS total FROM order_slip WHERE product_id = ? AND `status` != "0" AND `status` != "4"');
    $stmt2->bind_param('s', $row['product_id']);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    while ($row2 = $result2->fetch_assoc()) {
        $productID[] = $row2['product_id'];
        $productPurchases[] = $row2['total'];
    }
}
$stmt3 = $conn->prepare('SELECT COUNT(product_id),SUM(Quantity)AS total FROM order_slip WHERE `status` != "0" AND `status` != "4" ORDER BY COUNT(product_id) LIMIT 1');
$stmt3->execute();
$result3 = $stmt3->get_result();
while ($row3 = $result3->fetch_assoc()) {
    $productTotal[] = $row3['total'];
}
//start sorting for the Top 3 product
for ($i = 0; $i < sizeof($productName); $i++) {
    if ($productID[$i] == null) {
        $productTop[] = array("0", 0);
    } else {
        $productTop[] = array(strval($productID[$i]), (int) $productPurchases[$i]);
    }
}
if ($productTop != null) {
    heapSort($productTop, 1);
    for ($o = sizeof($productTop) - 1; $o > sizeof($productTop) - 4; $o--) {
        if ($o < 0) {
            $Top3[] = null;
        } else {
            $Top3[] = $productTop[$o];
        }
    }
    foreach ($Top3 as $item) {
        if ($item == 0) {
            $Top3[] = NUll;
        } else {
            $Top3_label[] = $item[0];
            $Top3_data[] = $item[1];
        }
    }
    foreach ($Top3_label as $item) {
        if ($item == 0) {
            $label3[] = Null;
        } else {
            $stmt4 = $conn->prepare('SELECT product FROM product WHERE product_id = ?');
            $stmt4->bind_param("s", $item);
            $stmt4->execute();
            $result = $stmt4->get_result();
            $row4 = $result->fetch_assoc();
            $label3[] = $row4['product'];
        }
    }
    //highest data
    if ($Top3_data == null) {
        $Highest = null;
    } else {
        $Highest = $Top3_data[0];
    }
}
$date = date('m');
$date = date('Y-m-d H:i');
$stmt5 = $conn->prepare("SELECT YEAR(`date`) AS Year, date_format(`date`,'%M') AS Month, SUM(`Quantity`*`price`) AS Total_Sales FROM order_slip   INNER JOIN order_price ON order_slip.price_id = order_price.price_id WHERE `date`= CURRENT_DATE AND (`status`!='0' AND `status`!='4')GROUP BY YEAR,Month ; ");
$stmt5->execute();
$result5 = $stmt5->get_result();
while ($row5 = $result5->fetch_assoc()) {
    $total_revenue = $row5['Total_Sales'];
}
// end of sorting for the Top 3 product
?>