<?php
include "db.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $conn->real_escape_string($_POST['id']);
    $stmt = $conn->prepare("DELETE FROM rfidtable_attendance WHERE `id` = ?");
    $stmt->bind_param("s", $id);
    
    if ($stmt->execute()) {
        echo "Student record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "Invalid request method";
}

$conn->close();
?>