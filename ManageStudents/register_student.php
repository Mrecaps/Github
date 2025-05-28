<?php
include "db.php";

$requiredFields = ['studentnumber', 'rfid', 'firstname', 'surname', 'course'];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        die("Missing POST field: $field");
    }
}

$studentnumber = $_POST['studentnumber'];
$rfid = $_POST['rfid'];
$firstname = $_POST['firstname'];
$surname = $_POST['surname'];
$course = $_POST['course'];

$sql = "INSERT INTO rfidtable_attendance (`studentnumber`, `rfid`, `firstname`, `surname`, `course`) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssss", $studentnumber, $rfid, $firstname, $surname, $course);

if ($stmt->execute()) {
    echo "✅ Student registered successfully.";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
