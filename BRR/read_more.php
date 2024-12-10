<?php
include("databse.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM booked_userdetails WHERE id = " . $conn->real_escape_string($id);
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User Details</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container mt-5">
                <h2>User Details</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td><?php echo $row['id']; ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><?php echo $row['username']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $row['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td><?php echo $row['phone']; ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo $row['address']; ?></td>
                    </tr>
                    <tr>
                        <th>Date of Booking</th>
                        <td><?php echo $row['date_of_booking']; ?></td>
                    </tr>
                    <tr>
                        <th>Package</th>
                        <td><?php echo $row['package']; ?></td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td><?php echo $row['amount']; ?></td>
                    </tr>
                    <tr>
                        <th>Payment Mode</th>
                        <td><?php echo $row['pay_mode']; ?></td>
                    </tr>
                </table>
                <a href="booked_record.php" class="btn btn-primary">Back</a>
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
