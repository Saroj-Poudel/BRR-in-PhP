<?php
session_start();
include("databse.php");

// Check if user is logged in
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION["id"];

// Fetch package details for the logged-in user
$sql = "SELECT package, date_of_booking, id FROM booked_userdetails WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

function calculate_end_date($start_date, $package) {
    $date = new DateTime($start_date);
    switch ($package) {
        case 'daily':
            return $date->format('Y-m-d');
        case 'weekly':
            $date->modify('+7 days');
            break;
        case 'half_month':
            $date->modify('+15 days');
            break;
        case 'monthly':
            $date->modify('+30 days');
            break;
        case 'half_year':
            $date->modify('+182 days'); // Using 182 days to cover half year
            break;
        case 'yearly':
            $date->modify('+365 days');
            break;
        default:
            return null;
    }
    return $date->format('Y-m-d');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Packages</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .package-details {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }
        .package-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .package-message {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="package-header">Your Booked Packages</h1>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $end_date = calculate_end_date($row['date_of_booking'], $row['package']);
                ?>
                <div class="package-details">
                    <h3>Package: <?php echo ucfirst($row['package']); ?></h3>
                    <p>Package Start Date: <strong><?php echo $row['date_of_booking']; ?></strong></p>
                    <p>Package End Date: <strong><?php echo $end_date; ?></strong></p>
                    <div class="package-message alert alert-success">
                        Have a successful life journey. Best wishes.
                    </div>
                    <div class="package-contact alert alert-info">
                        For administrative help, please contact at <strong>9848405159</strong>.
                        OR feel free to mail us at <strong>bansbarireadingroom@gmail.com</strong>
                    </div>
                </div>
                <?php
            }
        }
         else {
            echo "<p>No packages found.</p>";
            
        }
        ?>
        <a href="student_dashboard.php" class="btn btn-primary">Back to Home Page</a>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
