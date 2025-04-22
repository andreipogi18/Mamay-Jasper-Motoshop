<?php

require_once "connect.php";
require_once "functions.php";
//query for Retrieving stock and product contents on the database
$stmt = $conn->prepare("SELECT * FROM stock INNER JOIN product ON stock.product_id = product.product_id");
$stmt->execute();
$result = $stmt->get_result();
//error if there are no results
if (!$result) {
    die("Invalid query" . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    if ($_SESSION['userRole']=="Admin") {
       $option ="
       <a  class='fa fa-trash btn btn-danger btn-sm' href= '?title=stock&deleteid=" . $row["stock_id"] . "'onclick=\"javascript: return confirm('Please confirm deletion');\" id='Delete' name='Delete' > </a>   ";
    }
    else {
        $option="";
    }
    $checkStock = checkStock_batch($conn,$row['product_id'],$row['stock_id']);
    if ($checkStock >= $row['quantity']/3 && $checkStock !=0) {
        $status = "<span class='badge badge-sm good-level'><i class='fa fa-check'></i> (Good)</span>";
    }elseif ($checkStock <= $row['quantity']/3 && $checkStock>=$row['quantity']/4 && $checkStock !=0) {
        $status = "<span class='badge badge-sm warning-level'><i class='fa fa-warning'></i> (Warning)</span>";
    } elseif ($checkStock<$row['quantity']/4&& $checkStock !=0) {
        $status = "<span class='badge badge-sm danger-level'> <i class='fa fa-warning'></i>(Minimum Stock)</span>";
    } elseif ($checkStock==0) {
        $status = "<span class='badge badge-sm empty_'><i class='fa fa-times'></i> (Out of Stock)</span>";
    } else{
        $status ="";
    }
    
    echo "  <tr>
                <td >" . $row["product"] ." ".$status."</td>
                <td>" . $row["quantity"] . "</td>
                <td>" . $row["remaining"] . "</td>
                <td>" . $row["datein"] . "</td>
                <td>" . $option . "</td>
            </tr>
            ";

}

//Delete by Getting the Id 
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    //prepare stmt 
    $picture = $conn->prepare("DELETE FROM stock WHERE stock_id = ? ");
    //bind parameters
    $picture->bind_param("s", $id);
    //execute query
    $picture->execute();
}

?>