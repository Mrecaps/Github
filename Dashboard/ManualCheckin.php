<?php
include 'db.php';

if(isset($_POST['studentnumber'])) {
    $studentnumber = $_POST['studentnumber'];
    $time = $_POST['time'];
    $date = $_POST['date'];

    // Check if already timed in today without a timeout
    $check = $conn->prepare("SELECT * FROM recentlogs_table WHERE studentnumber = ? AND date = ? AND time_out IS NULL");
    $check->bind_param("ss", $studentnumber, $date);
    $check->execute();
    $result = $check->get_result();

    if($result->num_rows > 0) {
        // If exists — time them out
        $update = $conn->prepare("UPDATE recentlogs_table SET time_out = ? WHERE studentnumber = ? AND date = ? AND time_out IS NULL");
        $update->bind_param("sss", $time, $studentnumber, $date);
        if($update->execute()) {
            echo json_encode(['success' => true, 'action' => 'timeout']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to time out.']);
        }
    } else {
        // If not, fetch student info from rfidtable_attendance
        $fetch = $conn->prepare("SELECT * FROM rfidtable_attendance WHERE studentnumber = ?");
        $fetch->bind_param("s", $studentnumber);
        $fetch->execute();
        $student = $fetch->get_result()->fetch_assoc();

        if($student) {
            // Insert new time in log
            $insert = $conn->prepare("INSERT INTO recentlogs_table (rfid, firstname, surname, studentnumber, course, time_in, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $insert->bind_param("sssssss", $student['rfid'], $student['firstname'], $student['surname'], $student['studentnumber'], $student['course'], $time, $date);
            if($insert->execute()) {
                echo json_encode(['success' => true, 'action' => 'timein']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to time in.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Student not found.']);
        }
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request.']);
}
?>
