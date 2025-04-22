<?php
require_once "connect.php";
require_once "functions.php";

if (isset($_POST['UPwd'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];
    $rptpass = $_POST['rptpass'];
    $saveRole = $_SESSION['userRole'];


    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $checkpass = base64_decode($row['password']);
    if (pwdMatch($password, $rptpass) !== false) {
        echo "<script>alert('Invalid Password');";
        echo "setTimeout(function(){window.location = 'settings.php';}, 100);</script>";
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
        updatePassword($conn, $password, $id);
        
    }
}
?>