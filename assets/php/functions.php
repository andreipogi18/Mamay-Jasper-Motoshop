<?php
//start session
session_start();




//heapSort <Start>
function heapify(&$arr, $n, $i, $col)
{
    $largest = $i;
    $left = 2 * $i + 1;
    $right = 2 * $i + 2;

    if ($left < $n && $arr[$left][$col] > $arr[$largest][$col]) {
        $largest = $left;
    }

    if ($right < $n && $arr[$right][$col] > $arr[$largest][$col]) {
        $largest = $right;
    }

    if ($largest != $i) {
        // Swap the elements
        $temp = $arr[$i];
        $arr[$i] = $arr[$largest];
        $arr[$largest] = $temp;

        // Recursively heapify the affected subtree
        heapify($arr, $n, $largest, $col);
    }
}

function heapSort(&$arr, $col)
{
    $n = count($arr);

    // Build a max heap
    for ($i = (int) ($n / 2) - 1; $i >= 0; $i--) {
        heapify($arr, $n, $i, $col);
    }

    // One by one extract elements from the heap
    for ($i = $n - 1; $i >= 0; $i--) {
        // Move the current root to the end
        $temp = $arr[0];
        $arr[0] = $arr[$i];
        $arr[$i] = $temp;

        // Call max heapify on the reduced heap
        heapify($arr, $i, 0, $col);
    }
}
//heapSort <End>
//Function to Hide Attributes on a Page<Start>



function hideTags($tagName, $minScreenWidth)
{
    $jsCode = <<<EOL
    <script>
    // Function to check screen width and hide/show productname elements accordingly
    function toggleProductNameVisibility() {
        var screenWidth = window.innerWidth;
        var productNameElements = document.getElementsByClassName('$tagName');

        // Loop through all elements with class 'productname' and hide/show them based on screen width
        for (var i = 0; i < productNameElements.length; i++) {
            if (screenWidth < $minScreenWidth) {
                productNameElements[i].style.display = 'none';
            } else {
                productNameElements[i].style.display = 'block';
            }
        }
    }

    // Call the function when the page loads and whenever the window is resized
    window.onload = toggleProductNameVisibility;
    window.onresize = toggleProductNameVisibility;
    </script>
EOL;

    echo $jsCode;
}






//Function to Hide Attributes on a Page<End>
//Error Function Call <Start>
//Check if the file is image <Start>
function isImage($image)
{
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $imgExtArr = ['jpg', 'jpeg', 'png', 'jfif'];
    if (in_array($extension, $imgExtArr)) {
        return true;
    } else {
        return false;
    }

}
function isVideo($video)
{
    $extension = pathinfo($video, PATHINFO_EXTENSION);
    $imgExtArr = ['mp4', 'flv', 'mkv'];
    if (in_array($extension, $imgExtArr)) {
        return true;
    } else {
        return false;
    }

}
//Check if the file is image <End>
// in valid username error
function invalidUid($username)
{
    $result = false;
    if (!preg_match(("/^[a-zA-Z0-9]*$/"), $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
// validate if password match
function pwdMatch($password, $rptpass)
{
    $result = false;
    if ($password !== $rptpass) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

//Error Function Call <End>
//Function to User's Information <Start>
// Create User Function <Start>

function createUser($conn, $firstName, $lastName, $username, $email, $password, $role)
{
    //prepare query statement
    $stmt = $conn->prepare("INSERT INTO users (firstName,lastName,username,email,password,role) VALUES(?,?,?,?,?,?)");
    //hash password
    $hashedpassword = base64_encode($password);
    //bind parameter of the prepared statement
    $stmt->bind_param("ssssss", $firstName, $lastName, $username, $email, $hashedpassword, $role);
    // execute query
    $stmt->execute();
    // alert User if it registered Successfully
    echo "<script>alert('Registered Successfully');";
    if (isset($_SESSION["userRole"])) {
        if ($_SESSION['userRole'] == "Admin") {
            echo "setTimeout(function(){window.location = '../../Admin/index.php?title=user&role=" . $role . "';}, 100);</script>";
        }
    } else {
        echo "setTimeout(function(){window.location = '../../index.php';}, 100);</script>";
        //close statement
        $stmt->close();
    }
}

// Create User Function <End>
// Read User Function <Start>
// check if the User Exist

function UidExist($conn, $username, $email)
{
    //prepare stmt 
    $stmt = $conn->prepare("SELECT * from `users` WHERE username= ? OR email = ? ");
    //bind parameters
    $stmt->bind_param("ss", $username, $email);
    //execute query
    $stmt->execute();
    //get query result
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row) {
        return $row;
    } else {
        $dataResult = false;
        return $dataResult;
    }
}


// Read User Function <End>

// Update User Function <Start>

function updateUser($conn, $firstName, $lastName, $username, $email, $password, $role, $id)
{
    //prepare query statement
    $stmt = $conn->prepare("UPDATE `users` SET `firstName` = ?, `lastName` = ?,`username` = ?,`email` = ?,`password` = ?,`role` = ?  WHERE `users`.`user_id` = ?");
    $hashedpassword = base64_encode($password);
    //bind parameters
    $stmt->bind_param("ssssssi", $firstName, $lastName, $username, $email, $hashedpassword, $role, $id);
    //execute query
    $stmt->execute();
    echo "<script>alert('Update Successfully');";
    echo "setTimeout(function(){window.location = 'index.php?title=user&role=" . $role . "';}, 100);</script>";
    $stmt->close();
}
function updatePassword($conn, $password, $id)
{
    //prepare query statement
    $stmt = $conn->prepare("UPDATE `users` SET `password` = ? WHERE `users`.`user_id` = ?");
    $hashedpassword = base64_encode($password);
    //bind parameters
    $stmt->bind_param("si", $hashedpassword, $id);
    //execute query
    $stmt->execute();
    echo "<script>alert('Update Successfully');";
    echo "setTimeout(function(){window.location = '../../index.php';}, 100);</script>";
    $stmt->close();
    deleteRequest($conn, $id);
}

function updatePicture($conn, $avatar, $id)
{
    //prepare query statement
    $stmt = $conn->prepare("UPDATE `users` SET `avatar` = ? WHERE `users`.`user_id` = ?");
    //bind parameters
    $stmt->bind_param("si", $avatar, $id);
    //execute query
    $stmt->execute();
    $stmt->close();
}
// Update User Function <End>

// Delete User Function <Start>

function deleteUser($conn, $id)
{
    //prepare stmt 
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ? ");
    //bind parameters
    $stmt->bind_param("s", $id);
    //execute query
    $stmt->execute();
    echo "<script>alert('Deleted Successfully');";
    echo "setTimeout(function(){window.location = 'index.php?title=user';}, 100);</script>";
    $stmt->close();
}
// Delete User Function <End>

//Function to Login User <Start>
function loginUser($conn, $username, $password)
{
    //check if user exist using email and username
    $uidExist = uidExist($conn, $username, $username);
    //if user does not exist
    if ($uidExist == false) {
        return false;
    }
    // get assoc password and role
    $savedPassword = $uidExist['password'];
    $checkpass = base64_decode($savedPassword);
    $role = $uidExist['role'];
    //return to index with error message
    if ($checkpass !== $password) {
        return false;
    }


    //if password verified then continue log in 
    else if ($checkpass == $password) {
        //save username as a userid
        $_SESSION['userid'] = $username;
        //if user's role is client redirect to Client so on and so forth
        if ($role == 'Client') {
            $_SESSION['userRole'] = "Client";
            header("location: Client/index.php?status=0");
            exit();
        }
        if ($role == 'Admin') {
            $_SESSION['userRole'] = "Admin";
            header("location: Admin/index.php?title=home");
            exit();
        }
        if ($role == 'Staff') {
            $_SESSION['userRole'] = "Staff";
            header("location: Staff/index.php");
            exit();
        }

    }
}
//Function to Login User <End>
//Function to Forgot Password<Start>
function createRequest($conn, $username)
{
    //prepare query statement
    $stmt = $conn->prepare("INSERT INTO request (user_id,`status`) VALUES(?,0)");
    //bind parameter of the prepared statement
    $stmt->bind_param("i", $username);
    // execute query
    $stmt->execute();
    // alert User if it registered Successfully
    header("location: forgot.php?requestSuccess=1");
    //close statement
    $stmt->close();

}
function acceptRequest($conn, $username)
{
    //prepare query statement
    $stmt = $conn->prepare("UPDATE request SET `status`=1 WHERE user_id = ?");
    //bind parameter of the prepared statement
    $stmt->bind_param("i", $username);
    // execute query
    $stmt->execute();
    //close statement
    $stmt->close();

}
function requestExist($conn, $username, $status)
{
    $stmt = $conn->prepare("SELECT * FROM request WHERE user_id=? AND `status`=?");
    $stmt->bind_param("ii", $username, $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row) {
        return $row;
    } else {
        $dataResult = false;
        return $dataResult;
    }
}
function deleteRequest($conn, $userid)
{
    //prepare stmt 
    $stmt = $conn->prepare("DELETE FROM request WHERE user_id = ? ");
    //bind parameters
    $stmt->bind_param("i", $userid);
    //execute query
    $stmt->execute();
    $stmt->close();
}
//Function to Forgot Password<End>
//Function to User's Information <End>
//Function to User's Order <Start>
// Create Order <Start>
function createOrder($conn, $user_id, $email, $username, $status, $product_id, $price_id, $quantity, $payment, $date)
{
    //prepare query statement
    $stmt = $conn->prepare("INSERT INTO order_slip (user_id,email,username,`status`,product_id,price_id,quantity,payment,`date`) VALUES(?,?,?,?,?,?,?,?,?)");
    //bind parameter of the prepared statement
    $stmt->bind_param("issiiiiss", $user_id, $email, $username, $status, $product_id, $price_id, $quantity, $payment, $date);
    // execute query
    $stmt->execute();
    // alert User if it registered Successfully
    unset($_SESSION['product']);
    echo "<script>alert('Purchased Successfully');";
    echo "setTimeout(function(){window.location = '../Client/index.php?status=0';}, 100);</script>";
    //close statement
    $stmt->close();
}

// Create Order Function <End>
// Update Order Status Function <Start>
//prepare stmt 
function orderStatus($conn, $status, $id)
{
    $stmt = $conn->prepare("UPDATE order_slip SET`status`= ? WHERE order_id = ?");
    //bind parameters
    $stmt->bind_param("ss", $status, $id);
    //execute query
    $stmt->execute();


}
// Update Order Status Function <End>
// Delete Order Function <Start>

function deleteOrder($conn, $id)
{
    //prepare stmt 
    $stmt = $conn->prepare("DELETE FROM order_slip WHERE order_id = ? ");
    //bind parameters
    $stmt->bind_param("i", $id);
    //execute query
    $stmt->execute();
    echo "<script>alert('Deleted Successfully');";
    echo "setTimeout(function(){window.location = 'index.php?title=ticket';}, 100);</script>";
    $stmt->close();
}
// Delete Order Function <End>

//Function to User's Order <End>
//Function to product List and Seat Reservation Number of Availability <Start>
//Check if the product is already Existing <Start>
function productExist($conn, $product)
{
    //prepare stmt 
    $stmt = $conn->prepare("SELECT * from `product` WHERE product= ?");
    //bind parameters
    $stmt->bind_param("s", $product);
    //execute query
    $stmt->execute();
    //get query result
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row) {
        return $row;
    } else {
        $dataResult = false;
        return $dataResult;
    }
}
//Check if the product is already Existing <Start>

//Create product itemlist <Start>
function createProductlist($conn,$productCode, $product, $poster, $category)
{
    $hidden = '1';
    //prepare query statement
    $stmt = $conn->prepare("INSERT INTO product (`hidden`,productcode,product,poster,category) VALUES(?,?,?,?,?)");
    //bind parameter of the prepared statement
    $stmt->bind_param("isssi", $hidden,$productCode, $product, $poster, $category);
    // execute query
    $stmt->execute();
    // alert User if it registered Successfully
    echo "<script>alert('Added Successfully');";
    echo "setTimeout(function(){window.location = '../../Admin/';}, 100);</script>";
    //close statement
    $stmt->close();
}
//Create product Item list <End>

//Update product Item list <Start>
function updateProductlist($conn, $product, $poster, $category, $id)
{
    //prepare query statement
    $stmt = $conn->prepare("UPDATE `product` SET `product` = ?,`poster`= ?,`category`=? WHERE `product`.`product_id`= ? ");
    //bind parameters
    $stmt->bind_param("sssi", $product, $poster, $category, $id);
    //execute query
    $stmt->execute();
    echo "<script>alert('Updated Successfully');";
    echo "setTimeout(function(){window.location = '../../Admin/index.php';}, 100);</script>";
    $stmt->close();
}
function updatePoster($conn, $poster, $id)
{
    //prepare query statement
    $stmt = $conn->prepare("UPDATE `product` SET `poster` = ? WHERE `product`.`product_id`= ? ");
    //bind parameters
    $stmt->bind_param("si", $poster, $id);
    //execute query
    $stmt->execute();
    echo "<script>alert('Updated Successfully');";
    echo "setTimeout(function(){window.location = '../../Admin/index.php';}, 100);</script>";
    $stmt->close();
}
//Update product Item list <End>

//Delete product Item list <Start>
function deleteproductlist($conn, $id)
{
    $stmt = $conn->prepare("DELETE FROM stock WHERE product_id = ? ");
    // Bind parameters
    $stmt->bind_param("s", $id);
    // Execute query
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM product WHERE product_id = ? ");
    // Bind parameters
    $stmt->bind_param("s", $id);
    // Execute query
    $stmt->execute();

    // After deleting, show SweetAlert
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
            Swal.fire({
                title: 'Deleted Successfully',
                text: 'The product has been deleted.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'index.php?title=product';
                }
            });
          </script>";

    $stmt->close();
}

//Delete product Item list <End>
//Hide/show product Item List<Start>
function productStatus($conn, $status, $id)
{
    //prepare stmt 
    $stmt = $conn->prepare("UPDATE product SET`hidden`=? WHERE product_id = ?");
    //bind parameters
    $stmt->bind_param("ii", $status, $id);
    //execute query
    $stmt->execute();
}

//Hide/show product Item List<End>
//Function to product List and Seat Reservation Number of Availability <End>
// Function to stock list <Start>
function createStock($conn, $category, $quantity)
{
    $date = date('Y-m-d');
    //prepare query statement
    $stmt = $conn->prepare("INSERT INTO stock (product_id,quantity,remaining,datein) VALUES(?,?,?,?,?)");
    //bind parameters
    $stmt->bind_param("siiss", $category, $quantity, $quantity, $date);
    //execute query
    $stmt->execute();
    echo "<script>alert('Created Successfully');";
    echo "setTimeout(function(){window.location = '../Admin/index.php';}, 100);</script>";
    $stmt->close();
}
// Deduct Stock Function <Start>
function deductStock($conn, $category, $minus)
{
    $stmt = $conn->prepare("SELECT `remaining`,stock_id FROM stock WHERE (product_id= ? ) AND remaining > 0 ORDER BY product_id ASC LIMIT 1");
    $stmt->bind_param('i', $category);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $quantity = $row['remaining'];
        $sid = $row['stock_id'];
    }
    $quantity -= $minus;

    if ($quantity < 0) {
        updateStock($conn, $category, 0, $sid);
        $quantity = $quantity * -1;
        deductStock($conn, $category, $quantity);
    } else {
        updateStock($conn, $category, $quantity, $sid);
    }
}
// Deduct Stock Function <End>

// Check Stock Function <Start>

function checkStock($conn, $category)
{
    $stmt = $conn->prepare("SELECT SUM(`remaining`) AS Total_stock_remaining FROM stock WHERE product_id= ?" );
    $stmt->bind_param('i', $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['Total_stock_remaining'];
}
function checkStock_batch($conn, $category, $stockId): int
{
    $stmt = $conn->prepare("SELECT remaining FROM stock WHERE product_id= ? AND stock_id=?");
    $stmt->bind_param('ii', $category, $stockId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['remaining'];
}
// Check Stock Function <Start>
// Update Stock Function <Start>
function updateStock($conn, $category, $remaining, $id)
{
    //prepare query statement
    $stmt = $conn->prepare("UPDATE `stock` SET `remaining` = ?,`product_id`=? WHERE `stock_id`= ? ");
    //bind parameters
    $stmt->bind_param("iii", $remaining, $category, $id);
    //execute query
    $stmt->execute();
    $stmt->close();
}
// Update Stock Function <Start>
// Function to stock list <End>
// Patch 1.0.1
// Function Controller For Category <Start>

function categoryExist($conn, $category)
{
    $stmt = $conn->prepare("SELECT categoryName FROM category WHERE categoryName = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row) {
        return $row;
    } else {
        $dataResult = false;
        return $dataResult;
    }
}

function categoryView($conn)
{
    $stmt = $conn->prepare("SELECT category_id,categoryName FROM category");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;

}

function deleteCategory($conn, $categoryName)
{
    $getcategory = $conn->prepare('SELECT * FROM category INNER JOIN product ON product.category = category.category_id WHERE categoryName = ?');
    $getcategory->bind_param("s", $categoryName);
    $getcategory->execute();
    $result = $getcategory->get_result();
    
    while($row = $result->fetch_assoc()){
    $stmt = $conn->prepare("DELETE FROM stock WHERE product_id = ? ");
    $stmt->bind_param("s", $row['product_id']);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM product WHERE ProductCode = ?");
    $stmt->bind_param("s", $row['CategoryCode']);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM order_price WHERE category_id = ?");
    $stmt->bind_param("s", $row['category_id']);
    $stmt->execute();

    }
    $stmt = $conn->prepare("DELETE FROM category WHERE categoryName = ?");
    $stmt->bind_param("s", $categoryName);
    $stmt->execute();
    echo "<script>alert('Deleted Successfully');";
        echo "setTimeout(function(){window.location = '../Admin/index.php';}, 100);</script>";
    
}


function addCategory($conn, $categoryName, $medium, $large)
{
    //Insert new Category name
    $stmt = $conn->prepare("INSERT INTO category (categoryName,categoryCode) VALUES(?,?)");
    $categoryCode = substr($categoryName, 0, 4);
    $stmt->bind_param("ss", $categoryName, $categoryCode);
    $stmt->execute();
    $stmt->close();
    $getcategory = $conn->prepare('SELECT * FROM category WHERE categoryName = ?');
    $getcategory->bind_param("s", $categoryName);
    $getcategory->execute();
    $result = $getcategory->get_result();
    $row = $result->fetch_assoc();
    $size_m ="Medium";
    $size_l ="Large";
    //Insert the Prices
    if (!empty($medium) && !empty($large)) {
        $price_m = $conn->prepare("INSERT INTO order_price (category_id,cupsize,price)VALUES(?,?,?)");
        $price_m->bind_param("isi", $row['category_id'], $size_m, $medium);
        $price_m->execute();

        $price_l = $conn->prepare("INSERT INTO order_price (category_id,cupsize,price)VALUES(?,?,?)");
        $price_l->bind_param("isi", $row['category_id'], $size_l, $large);
        $price_l->execute();

        echo "<script>alert('Created Successfully');";
        echo "setTimeout(function(){window.location = '../Admin/index.php';}, 100);</script>";
    } else if (empty($large)) {
        $price_m = $conn->prepare("INSERT INTO order_price (category_id,cupsize,price)VALUES(?,?,?)");
        $price_m->bind_param("isi", $row['category_id'], $size_m, $medium);
        $price_m->execute();

        echo "<script>alert('Created Successfully');";
        echo "setTimeout(function(){window.location = '../Admin/index.php';}, 100);</script>";
    } else {
        $price_m = $conn->prepare("INSERT INTO order_price (category_id,cupsize,price)VALUES(?,?,?)");
        $price_m->bind_param("isi", $row['category_id'], $size_l, $large);
        $price_m->execute();
        echo "<script>alert('Updated Successfully');";
        echo "setTimeout(function(){window.location = '../Admin/index.php';}, 100);</script>";
    }
}

function updateCategory($conn, $categoryName, $medium, $large)
{
    $getcategory = $conn->prepare('SELECT * FROM category WHERE categoryName = ?');
    $getcategory->bind_param("s", $categoryName);
    $getcategory->execute();
    $result = $getcategory->get_result();
    $row = $result->fetch_assoc();
    $size_m ="Medium";
    $size_l ="Large";
    //Insert new Category name
    $stmt = $conn->prepare("UPDATE category SET categoryName = ? WHERE category_id = ?");
    $stmt->bind_param("si", $categoryName, $row['category_id']);
    $stmt->execute();
    $stmt->close();
   

    //Insert the Prices
    if (!empty($medium) && !empty($large)) {
        $price_m = $conn->prepare("UPDATE order_price SET price=? WHERE category_id = ? AND cupsize= ?");
        $price_m->bind_param("iis", $medium, $row['category_id'], $size_m);
        $price_m->execute();

        $price_l = $conn->prepare("UPDATE order_price SET price=? WHERE category_id = ? AND cupsize= ?");
        $price_l->bind_param("iis", $large, $row['category_id'], $size_l);
        $price_l->execute();

        echo "<script>alert('Updated Successfully');";
        echo "setTimeout(function(){window.location = '../Admin/index.php';}, 100);</script>";
    } else if (empty($large)) {
        $price_m = $conn->prepare("UPDATE order_price SET price=? WHERE category_id = ? AND cupsize= ?");
        $price_m->bind_param("iis", $medium, $row['category_id'], $size_m);
        $price_m->execute();

        echo "<script>alert('Updated Successfully');";
        echo "setTimeout(function(){window.location = '../Admin/index.php';}, 100);</script>";
    } else {
        $price_l = $conn->prepare("UPDATE order_price SET price=? WHERE category_id = ? AND cupsize= ?");
        $price_l->bind_param("iis", $large, $row['category_id'], $size_l);
        $price_l->execute();
        echo "<script>alert('Updated Successfully');";
        echo "setTimeout(function(){window.location = '../Admin/index.php';}, 100);</script>";
    }
}





// Function Controller For Category <End>

?>