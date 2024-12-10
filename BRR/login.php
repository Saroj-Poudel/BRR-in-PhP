<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/registration.css">
</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
    <?php
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        require_once "databse.php";
        $sql = "SELECT * FROM registration_details WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($user) {
            if (password_verify($password, $user["password"])) {
                // Store user ID in session
                $_SESSION["id"] = $user["id"];
                header("Location: student_dashboard.php");
                die();
            } else {
                echo "<div class='alert alert-danger text-center'>Invalid Password</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Invalid Email</div>";
        }
    }
    ?>
    <form action="login.php" method="post">
        <h2>BRR STUDENT Login</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login" name="login">
        <label for="">Have not registered?</label><a href="registration.php"><u>Click to register.</u></a>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
</body>
</html>
