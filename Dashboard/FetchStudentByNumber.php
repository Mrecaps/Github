<?php
include 'db.php';

if(isset($_GET['studentnumber'])) {
    $studentnumber = $_GET['studentnumber'];

    $stmt = $conn->prepare("SELECT * FROM rfidtable_attendance WHERE studentnumber = ?");
    $stmt->bind_param("s", $studentnumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        echo json_encode(['success' => true, 'student' => $student]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Student not found.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No student number provided.']);
}
?>
