<?php

require_once "connect.php";
require_once "functions.php";
//query for Retrieving stock and product contents on the database
$stmt = $conn->prepare("SELECT YEAR(`date`) AS Year, date_format(`date`,'%M') AS Month, SUM(`Quantity`*`price`) AS Total_Sales FROM order_slip   INNER JOIN order_price ON order_slip.price_id = order_price.price_id WHERE `status`!='0' AND `status`!='4'GROUP BY YEAR(`date`),date_format(`date`,'%M') ; ");
$stmt->execute();
$result = $stmt->get_result();
//error if there are no results
if (!$result) {
    die("Invalid query" . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    echo "
            <tr>
                <td>" . $row["Year"] . "</td>
                <td>" . $row["Month"] . "</td>
                <td> ₱" . number_format($row["Total_Sales"],2) . "</td>
            </tr>

            ";

}



?>