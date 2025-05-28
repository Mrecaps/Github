<?php
header('Content-Type: application/json');

include "db.php";

$sql = "
    SELECT 
        firstname, surname, studentnumber, course, 
        DATE_FORMAT(time_in, '%h:%i:%s %p') AS time_in, 
        DATE_FORMAT(time_out, '%h:%i:%s %p') AS time_out, 
        date 
    FROM recentlogs_table 
    ORDER BY time_in DESC 
    LIMIT 100";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode(['error' => 'Query failed: ' . $conn->error]);
    exit;
}

$logs = [];
while ($row = $result->fetch_assoc()) {
    $logs[] = [
        'firstname' => $row['firstname'],
        'surname' => $row['surname'],
        'studentnumber' => $row['studentnumber'],
        'course' => $row['course'],
        'time_in' => $row['time_in'],
        'time_out' => $row['time_out'] ?? '-',
        'date' => $row['date']
    ];
}

echo json_encode($logs);