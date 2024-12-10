<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRR</title>
    <link rel="stylesheet" href="index_styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>
<body>
    <!-- Menu Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="images\BRR_logo.jpg" alt="Company Logo"> Bansbari Reading Room</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Your Package</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Re-new Package</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Holiday</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                   <a href="index.php"><button class="btn btn-outline-success my-2 my-sm-0" type="button" id="logoutBtn">Logout</button></a> 
                </form>
            </div>
        </div>
    </nav>

    <?php
    if(isset($_POST["book_seat"])){
        $package=$_POST["package"];
        $joinDate=$_POST["join_date"];
        $payMode=$_POST["pay_mode"];
        $amount=$_POST["amount"];
        $errors=array();
        if (empty($package) OR empty($joinDate) OR empty($payMode) OR empty($amount) ) {
            array_push($errors,"All Fields are required");
        }
        
        require_once "databse.php";
                $sql= "INSERT INTO seat_booking(package,joining_date,pay_mode,amount) VALUES(?,?,?,?)";
                $stmt=mysqli_stmt_init($conn);
                $prepareStmt=mysqli_stmt_prepare($stmt,$sql);
                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt,"sssd",$package,$joinDate,$payMode,$amount);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Booked Successfully</div>";

                }else {
                    die("something went wrong");
                }
            }

    ?>

        <h2>Book Package</h2>
    <form action="student_seatbook.php" method="POST">
        <label for="package">Choose Package:</label>
        <select name="package" id="package" class="form-control">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="half_month">Half Month</option>
            <option value="monthly">Monthly</option>
            <option value="half_year">Half Year</option>
        </select>

        <label for="join_date">Join Date:</label>
        <input type="date" id="join_date" name="join_date" required><br>

        <label for="pay_mode">Pay Mode:</label>
        <select name="pay_mode" id="pay_mode" class="form-control" required>
            <option value="cash">Cash</option>
            <option value="online">Online</option>
        </select>

        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" placeholder="Enter amount" required>

        <input type="submit" class="btn btn-success" value="Book Seat" name="book_seat">
    </form>
    
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

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="index_script.js"></script>
</body>
</html>
