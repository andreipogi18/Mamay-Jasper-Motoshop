<?php
require_once "connect.php";
require_once "functions.php";
//query for product selection  
$stmt = $conn->prepare('SELECT product_id,product FROM product');
$stmt->execute();
$result = $stmt->get_result();

?>
<div class="modal fade" role="dialog" tabindex="-1" id="stock">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#000000;">
                <h4 class="modal-title text-light ">Add Stock</h4><button type="button" class="btn-close btn-danger"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container  ">
                    <div class=" bg-transparent">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center bg-transparent gap-3 p-3 m-auto rounded-3"
                            style="background-color: whitesmoke;opacity: .9;">
                            <div class="col-lg-12 ">
                                <div class="p-0 ">
                                    <form class="user login-clean" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="form-group row">
                                                <div class="col-sm-12 mb-3">
                                                    <span>Ouantity</span>
                                                    <input type="number" class="form-control " id="quantity"
                                                        name="quantity" placeholder="quantity" min='1' value="0"
                                                        required>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Product</label>
                                                        <select class="form-select form-select-md" name="category"
                                                            id="category" required>
                                                            <option selected disabled>Select one</option>
                                                            <?php
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo "<option value=" . $row['product_id'] . ">" . $row['product'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12 mb-3 ">

                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" href="index.php" class="btn btn-item d-block w-100"
                                            name="add_stock">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['add_stock'])) {
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];

    createStock($conn, $category, $quantity,);

}


?>