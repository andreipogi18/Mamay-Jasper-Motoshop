<?php

require_once 'connect.php';
require_once 'functions.php';

$stmt = $conn->prepare("SELECT * FROM product");
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("Invalid query" . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    echo "
    <div class='modal fade' role='dialog' tabindex='-1' id='updateProduct" . $row['product_id'] . "'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                    <div class='modal-header'style='background-color:#3A5D9C;'>
                        <h4 class='modal-title text-light '>Update Product</h4><button type='button' class='btn-close btn-danger' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='container  '>
                            <div class=' bg-transparent'>
                                <!-- Nested Row within Card Body -->
                                <div class='row justify-content-center bg-transparent gap-3 p-3 m-auto rounded-3'style='background-color: whitesmoke;opacity: .9;' >
                                    <div class='col-lg-12 '>
                                        <div class='p-0 '>
                                            <form action='../assets/php/update_product.php'class='user login-clean' method='post' enctype='multipart/form-data'>
                                                <div class='form-group row'>
                                                    <div class='form-group row'>
                                                        <div class='col-sm-12 mb-3'>
                                                            <input hidden type='text' class='form-control ' id ='poster' name ='poster'
                                                                placeholder='poster' value='" . $row['poster'] . "'>
                                                            <img class='w-100 img-fluid' src ='../assets/img/poster/" . $row['poster'] . "'/>
                                                        </div>
                                                        <div class='col-sm-12 mb-3 '>
                                                            <span>Product Name</span>
                                                            <input type='text' class='form-control' id ='productName' name ='productName'
                                                                placeholder='product Name' value='" . $row['product'] . "'>
                                                            <span>Product Category</span>
                                                            <select class='form-select form-select-md' name='category' id='category' required>
                                                                <option value='" . $row['category'] . "'selected>Select one</option>
                                                                <option value='CLick 125/160'>Click 125/160</option>
                                                                <option value='Nmax V1/V2'>Nmax V1/V2</option>
                                                                <option value='Adv 160'>Adv 160</option>
                                                                <option value='Aerox'>Aerox</option>
                                                                <option value='Mio i125'>Mio i125</option>
                                                                <option value='Mio Sporty'>Mio Sporty</option>
                                                            </select>
                                                            <input hidden type='number' class='form-control ' id ='id' name ='id'
                                                                placeholder='id' value='" . $row['product_id'] . "'>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <input type='submit' href ='index.php' class='btn btn-primary d-block w-100' name='updateProduct'>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class='modal-footer'></div>
            </div>
        </div>
    </div>



<div class='modal fade' role='dialog' tabindex='-1' id='update-poster" . $row['product_id'] . "'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                    <div class='modal-header bg-dark'>
                        <h4 class='modal-title text-light '>Update Poster</h4><button type='button' class='btn-close btn-danger' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='container  '>
                            <div class=' bg-transparent'>
                                <!-- Nested Row within Card Body -->
                                <div class='row justify-content-center bg-transparent gap-3 p-3 m-auto rounded-3'style='background-color: whitesmoke;opacity: .9;' >
                                    <div class='col-lg-12 '>
                                        <div class='p-0 '>
                                            <form action='../assets/php/update_poster.php'class='user login-clean' method='post' enctype='multipart/form-data'>
                                                <div class='form-group row'>
                                                    <div class='form-group row'>
                                                        <div class='col-sm-12 mb-3'>
                                                            <input type='file' class='form-control ' id ='poster' name ='poster'
                                                                placeholder='poster'>
                                                        </div>
                                                        <div hidden class='col-sm-6 mb-3 '>
                                                        <input hidden type='text' class='form-control ' id ='prev' name ='prev'
                                                                placeholder='prev' value='" . $row['poster'] . "'>
                                                            <span>product Name</span>
                                                            <input type='text' class='form-control form-control-user' id ='productName' name ='productName'
                                                                placeholder='product Name' value='" . $row['product'] . "'>
                                                             <span>Amount</span>
                                                            <input hidden type='number' class='form-control form-control-user' id ='id' name ='id'
                                                                placeholder='id' value='" . $row['product_id'] . "'>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type='submit' href ='index.php' class='btn btn-primary d-block w-100' name='Update-poster'>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class='modal-footer'></div>
            </div>
        </div>
    </div>










    ";
}
?>