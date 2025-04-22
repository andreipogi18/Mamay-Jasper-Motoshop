<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Mamay Jasper Motoshop</title>
    <link rel="icon" href="assets/img/logo/jasperworks.png" type="image/png" />
    <link rel="shortcut icon" href="../assets/img/logo/jasperworks.png" type="image/png" />
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

    .card {
        background-color: white;
        border-radius: 20px;
        padding: 2rem;
        width: 100%;
        max-width: 500px;
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

    .text-center a {
        color: #3A5D9C;
        text-decoration: none;
    }

    .text-center a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="card">
        <h3>Create an Account!</h3>
        <?php if (isset($_GET["error"])) {
            echo "<div class='text-center alert alert-danger'>";
            switch ($_GET["error"]) {
                case "EmptyInput":
                    echo "Please fill in all fields.";
                    break;
                case "passwordsDontMatch":
                    echo "Passwords do not match.";
                    break;
                case "invalidUid":
                    echo "Invalid username.";
                    break;
                case "invalidemail":
                    echo "Invalid email address.";
                    break;
                case "UsernameTaken":
                    echo "Username is already taken.";
                    break;
                case "stmtfailed":
                    echo "Something went wrong. Please try again.";
                    break;
            }
            echo "</div>";
        } ?>
        <form action="assets/php/register.php" method="post">
            <input type="text" class="form-control" name="firstName" placeholder="First Name" required>
            <input type="text" class="form-control" name="lastName" placeholder="Last Name" required>
            <input type="text" class="form-control" name="role" id='role' value='Client' hidden >
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <input type="password" class="form-control" name="rptpass" placeholder="Repeat Password" required>
            <button class="btn btn-item w-100" type="submit" name="Register">Sign Up</button>
        </form>
        <hr>
        <div class="text-center">
            <a href="index.php">Already have an account? Login!</a>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>