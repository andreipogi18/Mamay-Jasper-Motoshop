<?php
require_once "connect.php";
require_once "functions.php"; 
    $stmt = $conn->prepare("SELECT categoryName,category_id FROM category");
    $stmt->execute();
    $result = $stmt->get_result();
   


?>

<div class="modal fade" role="dialog" tabindex="-1" id="add_product">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#016090;">
                <h4 class="modal-title text-light ">Add Product</h4><button type="button" class="btn-close btn-danger"
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
                                    <form action='../assets/php/add_product.php' class="user login-clean" method="post"
                                        enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="form-group row">
                                                <div class="col-sm-12 mb-3">
                                                    <span>Poster</span>
                                                    <input type="file" class="form-control " id="poster" name="poster"
                                                        placeholder="poster" value="" required>
                                                    <div class="mb-3">
                                                        <div class="m-5"></div>
                                                        <label for="" class="form-label">Category</label>
                                                        <select class="form-select form-select-md" name="category"
                                                            id="category" required>
                                                            <option selected disabled>Select one</option>
                                                            <?php
                                                            while( $row = $result->fetch_assoc()){
                                                                echo "<option value ='" . $row['category_id'] ."'>" . $row['categoryName'] . "</option>";
                                                            }$stmt -> close();?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12 mb-3 ">
                                                    <span>Product Name</span>
                                                    <input type="text" class="form-control " id="productName"
                                                        name="productName"
                                                        onkeyup="this.value=this.value.replace(/[^a-zA-Z\s]/g,'');"
                                                        pattern="[a-zA-ZÀ-ž\s]{1,}"
                                                        title="Must not contain any number or special character"
                                                        placeholder="Product Name" value="" required>
                                                    <div class="m-5"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" href="index.php" class="btn btn-item d-block w-100"
                                            name="add_product">
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