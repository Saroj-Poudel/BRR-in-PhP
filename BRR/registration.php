<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            padding-top: 50px;
        }
        .container {
            max-width: 600px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>BRR Student Registration</h2>
                </div>
                <div class="card-body">
                    <div id="error-messages">
                        <?php
                        if(isset($_POST["register"])){
                            $full_name = $_POST["fullname"];
                            $address = $_POST["address"];
                            $email = $_POST["email"];
                            $phone = $_POST["phone"];
                            $password = $_POST["password"];
                            $confirm_password = $_POST["confirm_password"];
                            $gender = $_POST["gender"];
                            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                            $errors = array();

                            if (empty($full_name) || empty($gender) || empty($address) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
                                array_push($errors, "All Fields are required");
                            }
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                array_push($errors, "Email is not valid");
                            }
                            if (strlen($phone) < 10) {
                                array_push($errors, "Phone number is not valid");
                            }
                            if (strlen($password) < 8) {
                                array_push($errors, "Password must be at least 8 characters");
                            }
                            if ($password !== $confirm_password) {
                                array_push($errors, "Passwords do not match");
                            }
                            require_once "databse.php";
                            $sql = "SELECT * from registration_details Where email='$email'";
                            $result = mysqli_query($conn, $sql);
                            $rowCount = mysqli_num_rows($result);
                            if ($rowCount > 0) {
                                array_push($errors, "Email already exists");
                            }
                            if (count($errors) > 0) {
                                foreach ($errors as $error) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                            } else {
                                $sql = "INSERT INTO registration_details(full_name, gender, address, email, phone, password, confirm_password) VALUES(?, ?, ?, ?, ?, ?, ?)";
                                $stmt = mysqli_stmt_init($conn);
                                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                                if ($prepareStmt) {
                                    mysqli_stmt_bind_param($stmt, "sssssss", $full_name, $gender, $address, $email, $phone, $passwordHash, $confirm_password);
                                    mysqli_stmt_execute($stmt);
                                    echo "<div class='alert alert-success text-center'>Registered Successfully</div>";
                                } else {
                                    die("Something went wrong");
                                }
                            }
                        }
                        ?>
                    </div>
                    <form id="registrationForm" action="registration.php" method="post">
                        <div class="form-group">
                            <label for="fullname">Full Name:</label>
                            <input type="text" id="fullname" name="fullname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="male" name="gender">Male</option>
                                <option value="female" name="gender">Female</option>
                                <option value="other" name="gender">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="tel" id="phone" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="Register" name="register" class="btn btn-success">
                        </div>
                        <div class="text-center">
                            <label>Already registered?</label><a href="login.php"><u>Click to login.</u></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var errorMessages = document.getElementById('error-messages');
        if (errorMessages.children.length > 0) {
            window.scrollTo({top: 0, behavior: 'smooth'});
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlYCulhXY6r+ueMQFT79OXgRZb6m3tw8Hlpb/0dO1KcUlm7B9EdPvmYYkI5" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+XZn1Q+cEtdUHC6vBIFf5cJ05W7NX1rgh60BfEjEJc2nF8A+jR8z4pGMW" crossorigin="anonymous"></script>
</body>
</html>
