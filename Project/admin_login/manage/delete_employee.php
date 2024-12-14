<?php
// delete_employee.php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee_management_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

// Check if empID is provided
if (isset($_POST['empID'])) {
    $empID = $conn->real_escape_string($_POST['empID']);

    // Delete the employee record
    $sql = "DELETE FROM users WHERE empID = '$empID'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Employee deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting employee: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'empID not provided']);
}

$conn->close();
?>
