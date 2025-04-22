<?php
require_once "../assets/php/connect.php";
require_once "../assets/php/functions.php";
$getcat = categoryView($conn);
$getcat2 = categoryView($conn);
?>

<div class="d-flex flex-column " id="content-wrapper" style="background-color:whitesmoke;">
    <div id="content">
        <nav class="row p-3 mx-auto">
            <select class="form-select form-selector" aria-label="Select">
                <option selected disabled>Choose an action</option>
                <option value="create">Create</option>
                <option value="delete">Delete</option>
                <option value="edit">Edit</option>
            </select>
        </nav>
        <div class="dropdown-divider"></div><br>
        <!-- Create Form-->
        <div class="form-container p-3 create-form" style="display: none;">
            <form class="modal" method="post">
                <div class="mb-3">
                    <label for="productCategory" class="form-label">Product Category</label>
                    <input type="text" class="form-control" name="productCategory" id="productCategory"
                        placeholder="Enter Product Category" required>
                </div>
                <div class="form-group mb-3">
                    <label for="size" class="form-label">Size/s</label>
                    <select class="form-select size-selector" id="size">
                        <option value="none">None</option>
                        <option value="click125/160">CLick 125/160</option>
                        <option value="nmaxV1/V2">Nmax V1/V2</option>
                        <option value="adv 160">Adv 160</option>
                        <option value="aerox">Aerox</option>
                        <option value="mioi125">Mio i125</option>
                        <option value="mioSporty">Mio Sporty</option>
                    </select>
                </div>
                <div class="form-group-row row justify-content-center">
                    <div class="col-md-6 mb-3 costMedium-container">
                        <label for="costMedium" class="form-label">Medium</label>
                        <input name="medium" id='medium' type="number" class="form-control costMedium"
                            placeholder="Enter cost for Medium">
                    </div>
                    <div class="col-md-6 mb-3 costLarge-container">
                        <label for="costLarge" class="form-label">Large</label>
                        <input name='large' id='large' type="number" class="form-control costLarge"
                            placeholder="Enter cost for Large">
                    </div>
                </div>
                <input type="submit" class="btn btn-item mx-auto d-block w-75" name="Create">
            </form>
        </div>
        <!-- Delete Form-->
        <div class="form-container p-3 delete-form" style="display: none;">
            <form class="modal" method="post">
                <div class="mb-3">
                    <select name='productCategory' id='productCategory' class="form-select" aria-label="Select"
                        required>
                        <option selected>Product Category</option>
                        <?php while ($row = $getcat->fetch_assoc()) {
                            echo '<option value="' . $row['categoryName'] . '">' . $row['categoryName'] . '</option>';
                        } ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-item mx-auto d-block w-75" name="Delete">
            </form>
        </div>
        <!-- Edit Form-->
        <div class="form-container p-3 edit-form" style="display: none;">
            <form class="modal" method="post">
                <div class="mb-3">
                    <label for="productCategory" class="form-label">Product Category</label>
                    <select name="productCategory" id="productCategory" class="form-select" aria-label="Select" required>
                        <option selected disabled>Product Category</option>
                        <?php while ($row2 = $getcat2->fetch_assoc()) {
                            echo '<option value="' . $row2['categoryName'] . '">' . $row2['categoryName'] . '</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group-row row justify-content-center">
                    <div class="col-md-6 mb-3 costMedium-container">
                        <label for="costMedium" class="form-label">Medium</label>
                        <input name="medium" id='medium' type="number" class="form-control costMedium"
                            placeholder="Enter cost for Medium">
                    </div>
                    <div class="col-md-6 mb-3 costLarge-container">
                        <label for="costLarge" class="form-label">Large</label>
                        <input name='large' id='large' type="number" class="form-control costLarge"
                            placeholder="Enter cost for Large">
                    </div>
                </div>
                <input type="submit" class="btn btn-item mx-auto d-block w-75" name="Edit">
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['Create'])) {
    $categoryName = $_POST['productCategory'];
    $medium = $_POST['medium'];
    $large = $_POST['large'];
    addCategory($conn, $categoryName, $medium, $large);
}
if (isset($_POST['Delete'])) {
    $categoryName = $_POST['productCategory'];
    deleteCategory($conn, $categoryName);
}
if (isset($_POST['Edit'])) {
    $categoryName = $_POST['productCategory'];
    $medium = $_POST['medium'];
    $large = $_POST['large'];
    updateCategory($conn, $categoryName, $medium, $large);
}
?>
<script src='../assets/js/custom.js'></script>