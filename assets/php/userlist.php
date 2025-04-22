<?php

require_once "connect.php";
require_once "functions.php";
if (isset($_GET['role'])) {
    $role = $_GET['role'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE role='$role'");
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $stmt = $conn->prepare("SELECT * FROM users WHERE role='Client' OR role='Staff'");
    $stmt->execute();
    $result = $stmt->get_result();
}
if (!$result) {
    die("Invalid query" . $conn->error);
}
while ($row = $result->fetch_assoc()) {
    echo "
            <tr>
                <td>" . $row["firstName"] . "</td>
                <td>" . $row["lastName"] . "</td>
                <td>" . $row["username"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>
                    <a class='btn btn-primary btn-xl fa fa-cog' href='?title=user&updateid=" . $row["user_id"] . "' data-bs-toggle='modal' data-bs-target='#modal-" . $row["user_id"] . "'id='Update' name='Update'></a>
                     <a  class='fa fa-trash btn btn-danger btn-sm' href= '?title=user&deleteid=" . $row["user_id"] . "'onclick=\"javascript: return confirm('Please confirm deletion');\" id='Delete' name='Delete' > </a>   
                </td>

            </tr>

            ";

}


if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    //prepare stmt 
    $picture = $conn->prepare("SELECT * FROM users WHERE user_id = ? ");
    //bind parameters
    $picture->bind_param("i", $id);
    //execute query
    $picture->execute();
    $result = $picture->get_result();
    $row = $result->fetch_assoc();
    $picture_name = $row['avatar'];
    unlink('../assets/img/avatars/' . $picture_name);
    deleteUser($conn, $id);
}

?>