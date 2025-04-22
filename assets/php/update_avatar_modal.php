<?php

require_once 'connect.php';
require_once 'functions.php';

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("Invalid query" . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    echo "
    <div class='modal fade' role='dialog' tabindex='-1' id='avatar-" . $row['user_id'] . "'>
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
                                            <form action='../assets/php/update_avatar.php'class='user login-clean' method='post' enctype='multipart/form-data'>
                                                <div class='form-group row'>
                                                    <div class='form-group row'>
                                                        <div class='col-sm-12 mb-3'>
                                                            <input type='file' class='form-control ' id ='avatar' name ='avatar'
                                                                placeholder='avatar'>
                                                        </div>
                                                        <div class='col-sm-12 mb-3 '>
                                                            <input hidden type='text' class='form-control form-control-user' id ='user' name ='user'
                                                                placeholder='Username' value='" . $row['username'] . "'>
                                                            <input hidden type='number' class='form-control form-control-user' id ='id' name ='id'
                                                                placeholder='id' value='" . $row['user_id'] . "'>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type='submit' href ='index.php' class='btn btn-primary d-block w-100' name='profile'>
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
    </div>";
}
?>