<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Record</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <?php
        // Retrieve filter values
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
        $package = isset($_GET['package']) ? $_GET['package'] : '';
        $payment_mode = isset($_GET['payment_mode']) ? $_GET['payment_mode'] : '';
        ?>
        <form method="GET" action="">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $end_date; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="package">Package</label>
                    <select class="form-control" id="package" name="package">
                        <option value="">All</option>
                        <option value="daily" <?php echo ($package == 'daily') ? 'selected' : ''; ?>>Daily</option>
                        <option value="weekly" <?php echo ($package == 'weekly') ? 'selected' : ''; ?>>Weekly</option>
                        <option value="half_month" <?php echo ($package == 'half_month') ? 'selected' : ''; ?>>Half Month</option>
                        <option value="monthly" <?php echo ($package == 'monthly') ? 'selected' : ''; ?>>Monthly</option>
                        <option value="half_year" <?php echo ($package == 'half_year') ? 'selected' : ''; ?>>Half Year</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="payment_mode">Payment Mode</label>
                    <select class="form-control" id="payment_mode" name="payment_mode">
                        <option value="">All</option>
                        <option value="online" <?php echo ($payment_mode == 'online') ? 'selected' : ''; ?>>Online</option>
                        <option value="cash" <?php echo ($payment_mode == 'cash') ? 'selected' : ''; ?>>Cash</option>
                    </select>
                </div>
                <div class="form-group col-md-3 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="export.php?start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>&package=<?php echo $package; ?>&payment_mode=<?php echo $payment_mode; ?>" class="btn btn-success">Export to Excel</a>
                </div>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Student Name</th>
                    <th>Package</th>
                    <th>Amount</th>
                    <th>Payment Mode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("databse.php");

                // Build the query
                $sql = "SELECT * FROM booked_userdetails WHERE 1=1";

                if ($start_date && $end_date) {
                    $sql .= " AND date_of_booking BETWEEN '" . $conn->real_escape_string($start_date) . "' AND '" . $conn->real_escape_string($end_date) . "'";
                } elseif ($start_date) {
                    $sql .= " AND date_of_booking >= '" . $conn->real_escape_string($start_date) . "'";
                } elseif ($end_date) {
                    $sql .= " AND date_of_booking <= '" . $conn->real_escape_string($end_date) . "'";
                }
                if ($package) {
                    $sql .= " AND package = '" . $conn->real_escape_string($package) . "'";
                }
                if ($payment_mode) {
                    $sql .= " AND pay_mode = '" . $conn->real_escape_string($payment_mode) . "'";
                }

                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["id"] ?></td>
                        <td><?php echo $row["date_of_booking"] ?></td>
                        <td><?php echo $row["username"] ?></td>
                        <td><?php echo $row["package"] ?></td>
                        <td><?php echo $row["amount"] ?></td>
                        <td><?php echo $row["pay_mode"] ?></td>
                        <td>
                            <a href="" class="btn btn-info">Read More</a>
                            <a href="" class="btn btn-warning">Edit</a>
                            <a href="" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
