<?php
// Include necessary PHP code here for handling the form submission and password reset logic if required
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Forgot Password - Mamay Jasper Works</title>
    <link rel="icon" href="assets/img/logo/jasperworks.png" type="image/png" />
    <link rel="shortcut icon" href="assets/img/logo/jasperworks.png" type="image/png" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #3A5D9C);
            font-family: 'Poppins', sans-serif;
            color: #333;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mb-4 {
            font-weight: 700;
        }

        .card {
            background-color: white;
            border-radius: 20px;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 5px solid rgba(255, 255, 255, 0.3);
        }

        .btn-item {
            background-color: #3A5D9C;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.7rem;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .btn-item:hover {
            background-color: rgb(82, 129, 216);
        }

        .form-control {
            background-color: #f1f1f1;
            color: #333;
            border: 1px solid #ccc;
            margin-bottom: 1rem;
            border-radius: 10px;
            padding: 0.6rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #3A5D9C;
        }

        .illustration img {
            width: 90px;
            height: auto;
            margin-bottom: 1rem;
        }

        .signup {
            color: #3A5D9C;
            text-align: center;
            display: block;
            margin-top: 0.5rem;
            text-decoration: none;
        }

        .signup:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="illustration"><img src="assets/img/logo/jasperworks.png" alt="Logo"></div>
        <h3 class="mb-4">Forgot Your Password?</h3>
        <form method="post">
            <input class="form-control" type="email" name="email" placeholder="Enter your email address" required>
            <button class="btn btn-item w-100" name="submit" type="submit">Reset Password</button>
            <a class="signup" href="index.php">Back to Login</a>
        </form>
    </div>

    <?php
    // You can add PHP logic here for the password reset functionality, for example, send email with reset link
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];

        // Here you can implement the password reset logic (e.g., check if email exists and send reset link)
        // Example:
        // if (email_exists_in_database($email)) {
        //     send_password_reset_email($email);
        //     echo "<p>Password reset link sent to your email address!</p>";
        // } else {
        //     echo "<p>No account found with that email address!</p>";
        // }
    }
    ?>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
