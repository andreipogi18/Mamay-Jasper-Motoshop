<?php

require_once 'connect.php';
require_once 'functions.php';

$stmt = $conn->prepare("SELECT * FROM order_slip");
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("Invalid query" . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    echo "
    <div class='modal fade' role='dialog' tabindex='-1' id='view_payment-" . $row['order_id'] . "'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                    <div class='modal-header bg-dark'>
                        <h4 class='modal-title text-light '>Update Avatar</h4><button type='button' class='btn-close btn-danger' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='container  '>
                            <div class=' bg-transparent'>
                                <!-- Nested Row within Card Body -->
                                <div class='row justify-content-center bg-transparent gap-3 p-3 m-auto rounded-3'style='background-color: whitesmoke;opacity: .9;' >
                                    <div class='col-lg-12 '>
                                        <div class='p-0 '>
                                            <img class='img-fluid w-100' style='height:350px;' src='../assets/img/payment/".$row['payment']."'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class='modal-footer'></div>
            </div>
        </div>
    </div>";
}
?>