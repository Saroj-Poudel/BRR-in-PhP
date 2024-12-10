<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Database connection
$hostName="localhost";
$dbUser="root";
$dbPassword="";
$dbName="brr";
$conn=mysqli_connect($hostName,$dbUser,$dbPassword,$dbName);
if (!$conn) {
    die("something went wrong;");
}

if(isset($_POST["book_seat"])){
    require_once "databse.php";
    // Insert data SQL
    $insertDataSql = "INSERT INTO booked_userdetails (username, address, phone, email, package, date_of_booking, pay_mode, amount)
    SELECT 
        r.full_name, 
        r.address, 
        r.phone, 
        r.email, 
        sb.package, 
        sb.joining_date, 
        sb.pay_mode, 
        sb.amount
    FROM 
        registration_details r
    JOIN 
        seat_booking sb
    ON 
        r.email = sb.email";
    
    // Execute insert data query
    if ($conn->query($insertDataSql) === TRUE) {
        echo "Data inserted into booked_userdetails successfully.<br>";
    } else {
        echo "Error inserting data: " . $conn->error . "<br>";
    }   
    
    $conn->close();
}

?>
<form action="booked_userdetails.php" method="POST">
<input type="submit" class="btn btn-success" value="Book Seat" name="book_seat">
</form>
</body>
</html>

