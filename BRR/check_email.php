<?php
require_once "databse.php";

if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $query = "SELECT * FROM registration_details WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0) {
            echo "exists";
        } else {
            echo "not exists";
        }
    }
}

