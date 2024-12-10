<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BRR</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="index_styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="images\BRR_logo.jpg" alt="Company Logo"> Bansbari Reading Room</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Book Package</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Packages Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Holiday</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Login</button>
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrationModal">Register</button>
                   <!-- <a href="registration.php"><button class="btn btn-outline-success my-2 my-sm-0" type="button" id="loginBtn">Register</button></a> -->
                </form>
            </div>
        </div>
    </nav>

    <!-- Image Slider -->
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images\study_room_image1.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images\study_room_image2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images\study_room_image3.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mt-4">
        <h2>About Us</h2>
        <p>Bansbari reading room (BRR) is the organization which is established to provide the free space for those who need the suitable environment for their academic related activities</p>
        <h2>Features</h2>
        <ul>
            <li>Free Wifi</li>
            <li>Free Parking Space</li>
            <li>Exotic Study Environment</li>
        </ul>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container text-center">
            <p>Location: Bansbari,Budhanilkantha,Nepal | Phone: 01-506070 | Email: brr@gmail.com</p>
        </div>
    </footer>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel"> BRR Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- login form goes here -->
        <?php
    if (isset($_POST["login"])) {
        $email=$_POST["email"];
        $password=$_POST["password"];
        require_once "databse.php";
        $sql= "SELECT * from registration_details where email='$email'";
        $result=mysqli_query($conn,$sql);
        $user=mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($user) {
            if (password_verify($password, $user["password"])) {
                header("Location:student_dashboard.php");
                die();
            }else{
            echo "<div class='alert alert-danger'>Invalid Password</div>";
            }
        }else{
            echo "<div class='alert alert-danger'>Invalid Email</div>";
        }
    }
    ?>
    <form action="login.php" method="post">
    <div class="form-group">
            <label for="username">Email</label>
            <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
          </div>
    <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
          </div>
        <input type="submit" value="Login" name="login">
        <label for="">Have not registered?</label><a href="registration.php"><u>Click to register.</u></a>
    </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registrationModalLabel"> BRR Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <!--  registration form goes here -->
        <?php
    if(isset($_POST["register"])){
        $full_name=$_POST["fullname"];
        $address=$_POST["address"];
        $email=$_POST["email"];
        $phone=$_POST["phone"];
        $password=$_POST["password"];
        $confirm_password=$_POST["confirm_password"];
        $gender=$_POST["gender"];
        $passwordHash= password_hash($password, PASSWORD_DEFAULT);
        $errors=array();
        if (empty($full_name) OR empty($gender) OR empty($address) OR empty($email) OR empty($phone) OR empty($password) OR empty($confirm_password)) {
            array_push($errors,"All Fields are required");
        }
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            array_push($errors,"email is not validate");
        }
        if (strlen($phone)<10) {
            array_push($errors,"Phone number not valid");
        
        }
        if(strlen($password)<8){
            array_push($errors,"Password must be at least 8 character");
        }
        if ($password!==$confirm_password) {
            array_push($errors,"Enter same password");
        }
        require_once "databse.php";
        $sql= "SELECT * from registration_details Where email='$email'";
        $result= mysqli_query($conn,$sql);
        $rowCount= mysqli_num_rows($result);
        if($rowCount>0){
            array_push($errors,"Email already existed");
        }
        if(count($errors)>0){
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }}
            else{
                 require_once "databse.php";
                $sql= "INSERT INTO registration_details(full_name,gender,address,email,phone,password,confirm_password) VALUES(?,?,?,?,?,?,?)";
                $stmt=mysqli_stmt_init($conn);
                $prepareStmt=mysqli_stmt_prepare($stmt,$sql);
                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt,"sssssss",$full_name,$gender,$address,$email,$phone,$passwordHash,$confirm_password);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Registered Successfully</div>";

                }else {
                    die("something went wrong");
                }
            }
        }

    ?>
    <form id="registrationForm" action="registration.php" method="post">
        <div class="form-group">
            <label for="fullname">Your Name</label>
            <input type="text" class="form-control" id="fullname" placeholder="Enter your name" name="fullname">
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
        <input type="text" id="address" name="address" class="form-control" >
        </div>
        <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" class="form-control" >
        </div>
       
        <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" class="form-control" >
        </div>
        
        <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="form-control">

        </div>
        <div class="form-group">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" class="form-control" >

        </div>
        <div class="form-group">
        <input type="submit" value="Register" name="register" class="form-control">
        <label for="">Already registered?</label><a href="login.php"><u>Click to login.</u></a>
        </div>
    </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (jQuery is required) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="index_script.js"></script>
    <script src="js/scripts.js"></script>

</body>
</html>
