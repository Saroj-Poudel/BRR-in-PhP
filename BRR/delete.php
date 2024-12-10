<?php
include("databse.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM booked_userdetails WHERE id = " . $conn->real_escape_string($id);

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    header("Location: booked_record.php");
} else {
    echo "No user ID specified.";
}
?>
