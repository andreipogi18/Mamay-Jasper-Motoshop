<?php
//intialize connect and function php
require_once 'connect.php';
require_once 'functions.php';

// set the fuction to work after clicking submit

if (isset($_POST['submit'])) {
    //login form variables

    $username = $_POST['username'];
    $email = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION['userid'] = $username;

    // check if user Exist
    if (uidExist($conn, $username, $email)) {
        // check if username and password is valid
        if (loginUser($conn, $username, $password)) {
            loginUser($conn, $username, $password);
        }
        //check if email and password is valid
        elseif (loginUser($conn, $email, $password)) {
            loginUser($conn, $email, $password);
        }
        //prompt an error message
        else {
            echo "<script>alert('Wrong email/password');</script>";
        }
    }
    //prompt an error message then redirect to home page 
    else {
        echo "<script>alert('No such user Exist');</script>";
    }
}

?>