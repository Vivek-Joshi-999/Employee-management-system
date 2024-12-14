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
$sql = "SELECT empID,username,name,department,dob, gender, email, phone, address FROM users";
$result = $conn->query($sql);

$employees = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
echo json_encode($employees);

$conn->close();
?>
