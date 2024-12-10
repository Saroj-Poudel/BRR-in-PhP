<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Room Seat Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/registration.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h2><b>BRR Book Package</b></h2>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_POST["book_seat"])) {
                            $email = $_POST["email"];
                            $package = $_POST["package"];
                            $joinDate = $_POST["join_date"];
                            $payMode = $_POST["pay_mode"];
                            $amount = $_POST["amount"];
                            $errors = array();
                            if (empty($email) OR empty($package) OR empty($joinDate) OR empty($payMode) OR empty($amount)) {
                                array_push($errors, "All Fields are required");
                            }

                            require_once "databse.php";
                            $sql = "INSERT INTO seat_booking(email, package, joining_date, pay_mode, amount) VALUES(?,?,?,?,?)";
                            $stmt = mysqli_stmt_init($conn);
                            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                            if ($prepareStmt) {
                                mysqli_stmt_bind_param($stmt, "ssssd", $email, $package, $joinDate, $payMode, $amount);
                                mysqli_stmt_execute($stmt);
                                echo "<div class='alert alert-success text-center'>Booked Successfully</div>";
                            } else {
                                die("something went wrong");
                            }
                        }
                        ?>
                        <form id="bookingForm" action="test_student_seatbook.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="package">Choose Package</label>
                                <select name="package" id="package" class="form-control">
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="half_month">Half Month</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="half_year">Half Year</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="join_date">Join Date</label>
                                <input type="date" id="join_date" name="join_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="pay_mode">Pay Mode</label>
                                <select name="pay_mode" id="pay_mode" class="form-control" required>
                                    <option value="cash">Cash</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter amount" required>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-success" value="Book Seat" name="book_seat">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#email').on('blur', function() {
                var email = $(this).val();
                $.ajax({
                    url: 'check_email.php',
                    method: 'POST',
                    data: { email: email },
                    success: function(response) {
                        if(response == "exists") {
                            $('#emailHelp').text('Email is valid.').css('color', 'green');
                            $('#bookingForm input[type="submit"]').prop('disabled', false);
                        } else {
                            $('#emailHelp').text('Email is not registered.').css('color', 'red');
                            $('#bookingForm input[type="submit"]').prop('disabled', true);
                        }
                    }
                });
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlYCulhXY6r+ueMQFT79OXgRZb6m3tw8Hlpb/0dO1KcUlm7B9EdPvmYYkI5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+XZn1Q+cEtdUHC6vBIFf5cJ05W7NX1rgh60BfEjEJc2nF8A+jR8z4pGMW" crossorigin="anonymous"></script>
</body>
</html>
