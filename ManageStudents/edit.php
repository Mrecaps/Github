<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../db.php";

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $stmt = $conn->prepare("SELECT 
            id,
            studentnumber,
            rfid,
            firstname,
            surname,
            course 
            FROM rfidtable_attendance WHERE id = ?");
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            throw new Exception('Student not found', 404);
        }

        $student = $result->fetch_assoc();
        echo json_encode($student);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'id' => (int)$_POST['id'],
            'studentnumber' => (int)$_POST['studentnumber'],
            'rfid' => (int)$_POST['rfid'],
            'firstname' => htmlspecialchars($_POST['firstname']),
            'surname' => htmlspecialchars($_POST['surname']),
            'course' => htmlspecialchars($_POST['course'])
        ];

        $stmt = $conn->prepare("UPDATE rfidtable_attendance SET 
            studentnumber = ?,
            rfid = ?,
            firstname = ?,
            surname = ?,
            course = ?
            WHERE id = ?");

        $stmt->bind_param("iisssi",
            $data['studentnumber'],
            $data['rfid'],
            $data['firstname'],
            $data['surname'],
            $data['course'],
            $data['id']
        );

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            throw new Exception("Update failed: ".$stmt->error);
        }
        exit();
    }

} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
    exit();
}

$conn->close();