<?php
require('GenPDF/fpdf.php');
date_default_timezone_set('Asia/Manila');

// Database connection
$host = 'localhost';
$db = 'attendance_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// Create PDF instance (Portrait)
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Title
$pdf->Cell(0, 10, 'Attendance Logs Report', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 8, 'Generated: ' . date('Y-m-d h:i A'), 0, 1, 'C');
$pdf->Ln(8);

// Column widths
$widths = [
    'num' => 15,
    'name' => 45,
    'studentnum' => 30,
    'course' => 25,
    'timein' => 25,
    'timeout' => 25,
    'date' => 25
];

// Table header
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($widths['num'], 8, 'No.', 1, 0, 'C');
$pdf->Cell($widths['name'], 8, 'Name', 1, 0, 'C');
$pdf->Cell($widths['studentnum'], 8, 'Student No.', 1, 0, 'C');
$pdf->Cell($widths['course'], 8, 'Course', 1, 0, 'C');
$pdf->Cell($widths['timein'], 8, 'Time In', 1, 0, 'C');
$pdf->Cell($widths['timeout'], 8, 'Time Out', 1, 0, 'C');
$pdf->Cell($widths['date'], 8, 'Date', 1, 1, 'C');

// Fetch data
$result = $conn->query("
    SELECT 
        firstname, surname, studentnumber, course, 
        DATE_FORMAT(time_in, '%h:%i %p') AS time_in,
        DATE_FORMAT(time_out, '%h:%i %p') AS time_out,
        date
    FROM recentlogs_table
    ORDER BY date DESC, time_in DESC
");

// Table data
$pdf->SetFont('Arial', '', 10);
$counter = 1;
while ($row = $result->fetch_assoc()) {
    $pdf->Cell($widths['num'], 8, $counter++, 1, 0, 'C');
    $pdf->Cell($widths['name'], 8, $row['firstname'] . ' ' . $row['surname'], 1);
    $pdf->Cell($widths['studentnum'], 8, $row['studentnumber'], 1, 0, 'C');
    $pdf->Cell($widths['course'], 8, $row['course'], 1, 0, 'C');
    $pdf->Cell($widths['timein'], 8, $row['time_in'], 1, 0, 'C');
    $pdf->Cell($widths['timeout'], 8, $row['time_out'] ?? '-', 1, 0, 'C');
    $pdf->Cell($widths['date'], 8, $row['date'], 1, 1, 'C');
}

// Output PDF
$pdf->Output('D', 'attendance_report_'.date('Ymd').'.pdf');
?>