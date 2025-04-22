<?php
require_once "connect.php";
require_once "functions.php";

// Include SweetAlert CDN in your page header
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>";
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

// Get the title of the page
if(isset($_GET['title'])){
    $add = "";
    if(isset($_GET["category"])){$add = "&category=".$_GET["category"];}
    if(isset($_GET["hiddenitems"])){$add = "&hiddenitems=".$_GET["hiddenitems"];}
    $title = $_GET['title'] . $add;
}

// Filter by category
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $stmt = $conn->prepare("SELECT * FROM product WHERE category='$category' AND `hidden`='0' ");
    $stmt->execute();
    $result = $stmt->get_result();
} elseif (isset($_GET['hiddenitems'])) {
    $stmt = $conn->prepare("SELECT * FROM product WHERE `hidden`='1' ");
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $stmt = $conn->prepare("SELECT * FROM product WHERE `hidden`='0' ");
    $stmt->execute();
    $result = $stmt->get_result();
}

if (!$result) {
    die("Invalid query" . $conn->error);
}

while ($row = $result->fetch_assoc()) {
    $disabled = (checkStock($conn, $row['product_id']) == 0 || checkStock($conn, $row['product_id']) == NULL) ? "hidden" : "";
    
    $option = $row['hidden'] == 1 ? "<a $disabled class='fas fa-eye btn btn-item btn-xl' href='?title=" . $title . "&showproductid=" . $row["product_id"] . "' onclick=\"javascript: return confirm('Please confirm this product will be shown');\" id='Show' name='Show'></a>" : "<a $disabled class='fas fa-eye-slash btn btn-secondary btn-xl' href='?title=" . $title . "&hideproductid=" . $row["product_id"] . "' onclick=\"javascript: return confirm('Please confirm this product will be hidden');\" id='Hide' name='Hide'></a>";
    
    echo "
    <tr>
        <td class='text-center'><img class=' img-fluid align-center' style='height:150px;width:150px;' src='../assets/img/poster/" . $row["poster"] . "'></td>
        <td class='text-sm'>" . $row["product"] . "</td>
        <td class='text-center'>
            <a class='btn btn-primary btn-xl fa fa-cogs' href='?title=" . $title . "&updateproductid=" . $row["product_id"] . "' data-bs-toggle='modal' data-bs-target='#updateProduct" . $row["product_id"] . "' id='Update' name='Update'></a>
            <a class='btn btn-warning btn-xl fa fa-image' href='?title=" . $title . "&updateposterid=" . $row["product_id"] . "' data-bs-toggle='modal' data-bs-target='#update-poster" . $row["product_id"] . "' id='Update' name='Update'></a>
            " . $option . "
            <a class='fas fa-trash btn btn-danger btn-xl' href='#' onclick='confirmDelete(" . $row["product_id"] . ")' id='Delete' name='Delete'></a>
        </td>
    </tr>";
}

// Delete action
if (isset($_GET['deleteproductid'])) {
    $id = $_GET['deleteproductid'];
    // Prepare stmt 
    $stmt = $conn->prepare("SELECT * FROM product WHERE product_id = ? ");
    // Bind parameters
    $stmt->bind_param("i", $id);
    // Execute query
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmtPicture = $row['poster'];
    // Delete previous video and posters
    unlink('../assets/img/poster/' . $stmtPicture);
    deleteproductlist($conn, $id);
}

// Hide and Show actions
if (isset($_GET['hideproductid'])) {
    $hide = '1';
    $id = $_GET['hideproductid'];
    productStatus($conn, $hide, $id);
    echo "<script>setTimeout(function(){window.location = '../Admin/index.php?title=" . $title . "';}, 10);</script>";
}

if (isset($_GET['showproductid'])) {
    $show = '0';
    $id = $_GET['showproductid'];
    productStatus($conn, $show, $id);
    echo "<script>setTimeout(function(){window.location = '../Admin/index.php?title=" . $title . "';}, 10);</script>";
}
?>

<script>
// SweetAlert delete confirmation
function confirmDelete(productId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This product will be deleted permanently!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, navigate to the delete URL
            window.location.href = '?title=<?php echo $title; ?>&deleteproductid=' + productId;
        }
    });
}
</script>
