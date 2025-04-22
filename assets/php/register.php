<?php
require_once "connect.php";
require_once "functions.php";
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$rptpass = $_POST['rptpass'];
$role = $_POST['role'];
$saveRole = $_SESSION['userRole'];



if (isset($_POST['Register'])) {

    if (pwdMatch($password, $rptpass) !== false) {
        header("location: ../../register.php?error=passwordsDontMatch");
        exit();
    }
    if (invalidUid($username) !== false) {
        header("location: ../../register.php?error=invalidUid");
        exit();
    }
    if (uidExist($conn, $username, $email) !== false) {
        header("location: ../../register.php?error=UsernameTaken");
        exit();
    }

    createUser($conn, $firstName, $lastName, $username, $email, $password, $role);
}

if (isset($_POST['Add'])) {

    if (pwdMatch($password, $rptpass) !== false) {
        echo "<script>alert('Password Does Not Match');";
        echo "setTimeout(function(){window.location = '../../Admin/index.php?title=user&role=".$role."';}, 100);</script>";
            exit();
    }
    if (invalidUid($username) !== false) {
        echo "<script>alert('Invalid Username');";
        echo "setTimeout(function(){window.location = '../../Admin/index.php?title=user&role=".$role."';}, 100);</script>";
            exit();
    }
    if (uidExist($conn, $username, $email) !== false) {
        echo "<script>alert('UsernameTaken');";
    echo "setTimeout(function(){window.location = '../../Admin/index.php?title=user&role=".$role."';}, 100);</script>";
        exit();
    }

    createUser($conn, $firstName, $lastName, $username, $email, $password, $role);
}
?>