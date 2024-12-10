<?php
include("databse.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM booked_userdetails WHERE id = " . $conn->real_escape_string($id);
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $date_of_booking = $_POST['date_of_booking'];
            $package = $_POST['package'];
            $amount = $_POST['amount'];
            $pay_mode = $_POST['pay_mode'];

            $update_sql = "UPDATE booked_userdetails SET 
                username = '$username', 
                email = '$email', 
                phone = '$phone', 
                address = '$address', 
                date_of_booking = '$date_of_booking', 
                package = '$package', 
                amount = '$amount', 
                pay_mode = '$pay_mode' 
                WHERE id = $id";

            if (mysqli_query($conn, $update_sql)) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit User</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container mt-5">
                <h2>Edit User</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone" value="<?php echo $row['phone']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="date_of_booking">Date of Booking</label>
                        <input type="date" class="form-control" id="date_of_booking" name="date_of_booking" value="<?php echo $row['date_of_booking']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="package">Package</label>
                        <input type="text" class="form-control" id="package" name="package" value="<?php echo $row['package']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $row['amount']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="pay_mode">Payment Mode</label>
                        <input type="text" class="form-control" id="pay_mode" name="pay_mode" value="<?php echo $row['pay_mode']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="booked_record.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "User not found.";
    }
} else {
    echo "No user ID specified.";
}
?>
