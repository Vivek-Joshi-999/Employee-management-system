<?php

header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee_management_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize empID
if (isset($_GET['empID']) && is_numeric($_GET['empID'])) {
    $empID = intval($_GET['empID']);
} else {
    echo json_encode(['error' => 'Invalid empID']);
    exit();
}

// Query for attendance
$sql = "SELECT status, time FROM attendance WHERE empID = $empID AND date = CURDATE()";
$result = $conn->query($sql);

$response = [];
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['status'] = $row['status']; // Fetch attendance status
    $response['time'] = $row['time'];    // Fetch attendance time
} else {
    $response['status'] = 'Absent'; // Default if no attendance is found
    $response['time'] = '-';        // No time for absent employees
}

echo json_encode($response);

$conn->close();
?>
