<?php

require_once "connect.php";
require_once "functions.php";

if(isset($_POST['submit'])){
$username=$_POST['username'];
$stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
$stmt ->bind_param('ss',$username,$username);
$stmt->execute();
$result = $stmt->get_result();
}
$admin = "";
$savePassword = "";
if (!$result) {
    die("Invalid query" . $conn->error);
}
$row = $result->fetch_assoc();
    // set condition when user is an admin allow to promote any user
    $savePassword = base64_decode($row['password']);
    echo "
            <div class='modal fade' role='dialog' tabindex='-1' id='pass-" . $row["user_id"] . "'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header bg-dark text-light'>
                            <h4 class='modal-title'>Update User Password</h4><button type='button' class='btn-close btn-danger' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                    <div class='modal-body'>
                        <div class='container '>
                            <div class=' bg-transparent'>
                                <!-- Nested Row within Card Body -->
                                <div class='row justify-content-center bg-transparent gap-3 p-3 m-auto rounded-3'style='background-color: whitesmoke;opacity: .9;' >
                                    <div class='col-lg-12 '>
                                        <div class='p-0 '>
                                            <form action='assets/php/forgot_password_action.php' class='user login-clean' method='post'>
                                                <div class='form-group row'>
                                                    <div class='col-sm-6 mb-3 '>
                                                        <input type='password' class='text-center form-control form-control-user w-100'
                                                            id ='password' name ='password' placeholder='Password' value='" . $savePassword . "' required>
                                                    </div>
                                                    <div class='col-sm-6 mb-3'>
                                                        <input type='password' class='text-center form-control form-control-user w-100'
                                                            name='rptpass' id='rptpass' placeholder='Repeat Password'value='" . $savePassword . "'required>
                                                    </div>
                                                    <div hidden class='col-sm-4 mb-3'>
                                                        <input type='text' class='form-control form-control-user w-100'
                                                            name='id' id='id' placeholder='ID'value='" . $row["user_id"] . "'>
                                                    </div>
                                                </div>
                                                <input type='submit' class='btn btn-primary d-block w-100' name='UPwd'>
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



//
?>