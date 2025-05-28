<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Manila');
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db.php';

$conn->query("SET time_zone = '+08:00';"); // UTC+8 for Philippines

if (!isset($_POST['rfid'])) {
    echo json_encode(['success' => false, 'error' => 'No RFID received.']);
    exit;
}

$rfid = $_POST['rfid'];
$currentTime = new DateTime('now', new DateTimeZone('Asia/Manila'));


$timeNow = $currentTime->format('H:i:s p');
$dateToday = $currentTime->format('Y-m-d');

// Getting student info
$stmt = $conn->prepare("SELECT firstname, surname, studentnumber, course FROM rfidtable_attendance WHERE rfid = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'Prepare failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param("s", $rfid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'error' => 'RFID not recognized.']);
    exit;
}

$row = $result->fetch_assoc();

// Check for existing open entry
$checkStmt = $conn->prepare("SELECT id FROM recentlogs_table WHERE rfid = ? AND time_out IS NULL ORDER BY time_in DESC LIMIT 1");
$checkStmt->bind_param("s", $rfid);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

// Assign to variables
$firstname = $row['firstname'] ?? '';
$surname = $row['surname'] ?? '';
$studentnumber = $row['studentnumber'] ?? '';
$course = $row['course'] ?? '';

if ($checkResult->num_rows > 0) {
    $existingRow = $checkResult->fetch_assoc();
    $updateStmt = $conn->prepare("UPDATE recentlogs_table SET time_out = ? WHERE id = ?");
    $updateStmt->bind_param("si", $timeNow, $existingRow['id']);
    
    if (!$updateStmt->execute()) {
        echo json_encode(['success' => false, 'error' => 'Update failed: ' . $updateStmt->error]);
        exit;
    }
} else {
    $insertStmt = $conn->prepare("
        INSERT INTO recentlogs_table 
        (rfid, firstname, surname, studentnumber, course, time_in, time_out, date)
        VALUES (?, ?, ?, ?, ?, ?, NULL, ?)
    ");
    
    $insertStmt->bind_param(
        "sssssss",
        $rfid,
        $firstname,
        $surname,
        $studentnumber,
        $course,
        $timeNow,
        $dateToday
    );
    
    if (!$insertStmt->execute()) {
        echo json_encode(['success' => false, 'error' => 'Insert failed: ' . $insertStmt->error]);
        exit;
    }
}

$logStmt = $conn->prepare("
    SELECT 
        firstname, surname, studentnumber, course, 
        DATE_FORMAT(time_in, '%h:%i:%s %p') AS time_in_12h,  -- 12-hour format
        DATE_FORMAT(time_out, '%h:%i:%s %p') AS time_out_12h, 
        date 
    FROM Recentlogs_table 
    WHERE rfid = ? 
    ORDER BY time_in DESC 
    LIMIT 1
");
$logStmt->bind_param("s", $rfid);
$logStmt->execute();
$logResult = $logStmt->get_result();
$logEntry = $logResult->fetch_assoc();

echo json_encode([
    'success' => true,
    'user' => [
        'firstname' => $logEntry['firstname'],
        'surname' => $logEntry['surname'],
        'studentnumber' => $logEntry['studentnumber'],
        'course' => $logEntry['course'],
        'time_in' => $logEntry['time_in_12h'], 
        'time_out' => $logEntry['time_out_12h'] ?? '-',
        'date' => $logEntry['date']
    ]
]);
?>