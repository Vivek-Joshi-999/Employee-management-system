<?php
session_start();


$conn = new mysqli("localhost", "root", "", "employee_management_system");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




$empId = $_SESSION['empId']; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $sdate = $_POST["sdate"];
    $edate = $_POST["edate"];
    $type_of_leave = $_POST["typeofleave"];
    $other_res = $_POST["othreason"];

    
    $sql = "INSERT INTO leave_application_form (EmpId, sdate, edate, typeof_leave, othreason)
            VALUES ('$empId', '$sdate', '$edate', '$type_of_leave', '$other_res')";

if ($conn->query($sql) === TRUE) {
  $_SESSION['success'] = "Leave application submitted successfully!";
} else {
  $_SESSION['error'] = "Error submitting leave application: " . $conn->error;
}
      header("Location: http://localhost/Project/emp_login/emp_Dashboard/index.php");
      exit();
      
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


$conn->close();
?>
