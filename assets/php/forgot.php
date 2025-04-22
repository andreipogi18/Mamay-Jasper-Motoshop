<?php
//intialize connect and function php
require_once 'connect.php';
require_once 'functions.php';

// set the fuction to work after clicking submit

if (isset($_POST['submit'])) {
    //login form variables

    $username = $_POST['username'];
    $email = $_POST['username'];

    // check if user Exist
    if (uidExist($conn, $username, $email)) {
        // creating a query for the user request to the admin 
        $uidExist = uidExist($conn, $username, $email);
        if (requestExist($conn, $uidExist['user_id'], "1")) {
            include 'forgot_password.php';
            echo "
            <div class='row'>
            <div class='col-md-3 col-xxl-3 offset-xxl-0 p-3'>
            </div>
            <div class='col-md-6 col-xxl-6 offset-xxl-0 p-3'>
            <div id='content mx-auto'>
                <div class='container-fluid'>
                        <h3 class='text-dark mb-4 text-light'></h3>
                            <div class='card shadow'>
                                <div class='card-header py-3 'style='background-color:#7d5110'>
                                    <p class='text-light m-0 fw-bold'>Request Approved</p>
                                </div>
            <h3 class='text-center'>Change Your Password Here</h3>
            <button class='btn btn-dark btn-sm' type='button'  data-bs-toggle='modal' data-bs-target='#pass-" . $uidExist['user_id'] . "'>Change Your Password</button>
                    </div>
                </div>
            </div>
            </div>
            <div class='col-md-3 col-xxl-3 offset-xxl-0 p-3'>
            </div>
            </div>
            ";
        } elseif (requestExist($conn, $uidExist['user_id'], "0")) {
            echo "<script>alert('Request Already Exist');</script>";
        } else {
            createRequest($conn, $uidExist['user_id']);
        }

    }
    //prompt an error message then redirect to home page 
    else {
        echo "<script>alert('No such user Exist');</script>";
    }
}

?>