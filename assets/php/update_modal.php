<?php

require_once "connect.php";
require_once "functions.php";


$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result();
$admin = "";
$savePassword = "";
if (!$result) {
    die("Invalid query" . $conn->error);
}
while ($row = $result->fetch_assoc()) {

    echo "
            <div class='modal fade' role='dialog' tabindex='-1' id='modal-" . $row["user_id"] . "'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header bg-info'>
                            <h4 class='modal-title text-light'>Update User</h4><button type='button' class='btn-close btn-danger' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                    <div class='modal-body'>
                        <div class='container '>
                            <div class=' bg-transparent'>
                                <!-- Nested Row within Card Body -->
                                <div class='row justify-content-center bg-transparent gap-3 p-3 m-auto rounded-3'style='background-color: whitesmoke;opacity: .9;' >
                                    <div class='col-lg-12 '>
                                        <div class='p-0 '>
                                            <form class='user login-clean' method='post'>
                                                <div class='form-group row'>
                                                    <div class='col-sm-6 mb-3 mb-sm-0'>
                                                        <input type='text' class='form-control form-control-user' id ='firstName' name ='firstName'
                                                            placeholder='First Name' value='" . $row["firstName"] . "'required>
                                                    </div>
                                                    <div class='col-sm-6 mb-3'>
                                                        <input type='text' class='form-control form-control-user' id ='lastName' name ='lastName'
                                                            placeholder='Last Name' value='" . $row["lastName"] . "'required>
                                                    </div>
                                                </div>
                                                <div class='form-group mb-3'>
                                                    <input type='username' class='form-control form-control-user' id ='username' name ='username'
                                                        placeholder='Username' value='" . $row["username"] . "'required>
                                                </div>
                                                <div hidden class='form-group mb-3'>
                                                    <input type='number' class='form-control form-control-user' id ='id' name ='id'
                                                        placeholder='ID' value='" . $row["user_id"] . "'>
                                                </div>
                                                <div class='form-group mb-3'>
                                                    <input type='email' class='form-control form-control-user' id ='email' name ='email'
                                                        placeholder='Email Address' value='" . $row["email"] . "'required>
                                                </div>
                                                <div class='form-group row'>
                                                    <div class='col-sm-6 mb-3 '>
                                                        <input type='password' class='form-control form-control-user w-100'
                                                            id ='password' name ='password' placeholder='Password' value='" . $savePassword . "' required>
                                                    </div>
                                                    <div class='col-sm-6 mb-3'>
                                                        <input type='password' class='form-control form-control-user w-100'
                                                            name='rptpass' id='rptpass' placeholder='Repeat Password'value='" . $savePassword . "'required>
                                                    </div>
                                                    <div hidden class='col-sm-4 mb-3'>
                                                        <input type='text' class='form-control form-control-user w-100'
                                                            name='id' id='id' placeholder='ID'value='" . $row["user_id"] . "'>
                                                    </div>
                                                    <div class='mb-3 col-sm-4 mb-3'>
                                                        <select class='form-select' name='role' id='role'>
                                                          <option selected value='" . $row["role"] . "'>" . $row["role"] . "</option>  
                                                          <option value='Client'>Client</option>
                                                          
                                                          
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type='submit' class='btn btn-info d-block w-100' name='Update'>
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
//
if (isset($_POST['Update'])) {
    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rptpass = $_POST['rptpass'];
    $role = $_POST['role'];
    $saveRole = $_SESSION['userRole'];


    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $checkpass = base64_decode($row['password']);
    if (pwdMatch($password, $rptpass) !== false) {
        echo "<script>alert('Invalid password');</script>";
        exit();
    }
    if ($_SESSION['userRole'] == 'Client') {
        if ($checkpass == $password) {
            if (invalidUid($username) !== false) {
                echo "<script>alert('Invalid Username');</script>";
            }
            if (UidExist($conn, $username, $username)) {
                $username = $row['username'];
            }
            if (UidExist($conn, $email, $email)) {
                $email = $row['email'];
            }

            if ($_SESSION['userRole'] == 'Client') {
                session_unset();
                $_SESSION['userid'] = $username;
                $_SESSION['userRole'] = $saveRole;

            }
            updateUser($conn, $firstName, $lastName, $username, $email, $password, $role, $id);
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        if (invalidUid($username) !== false) {
            echo "<script>alert('Invalid Username');</script>";
            exit();
        }
        if (UidExist($conn, $username, $username)) {
            $username = $row['username'];
        }
        if (UidExist($conn, $email, $email)) {
            $email = $row['email'];
        }

        if ($_SESSION['userRole'] == 'Client') {
            session_unset();
            $_SESSION['userid'] = $username;
            $_SESSION['userRole'] = $saveRole;

        }
        updateUser($conn, $firstName, $lastName, $username, $email, $password, $role, $id);
    }
}

?>