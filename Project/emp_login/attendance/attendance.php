<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'employee_management_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_SESSION['uname'])) {
    $uname = $_SESSION['uname']; 

    
    $empIDResult = $conn->query("SELECT empID FROM users WHERE username = '$uname'");

    if ($empIDResult->num_rows > 0) {
        $empIDRow = $empIDResult->fetch_assoc();
        $empID = $empIDRow['empID'];

       
        $checkAttendance = $conn->query("SELECT * FROM attendance WHERE empID = $empID AND date = CURDATE()");

        if ($checkAttendance->num_rows > 0) {
           
            $attendanceRow = $checkAttendance->fetch_assoc();
            echo "Attendance has already been marked for today. Status: " . $attendanceRow['status'];
        } else {
            
            $attendanceInsert = $conn->query("INSERT INTO attendance (empID, username, date, status) VALUES ($empID, '$uname', CURDATE(), 'Present')");

            if ($attendanceInsert) {
                echo "Attendance marked as Present successfully.";
            } else {
                echo "Error marking attendance: " . $conn->error;
            }
        }
    } else {
        echo "Employee ID not found in users table.";
    }
} else {
    header("Location:../emp_info/index.php");
    exit();
}

$conn->close();
?>
