<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'employee_management_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




if (isset($_SESSION['uname'])) {
    $uname = $_SESSION['uname'];
  

    
    $sql = "SELECT * FROM users WHERE username='$uname'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $employeeName = $row['name'];
        $employeeID = $row['empID'];

        $_SESSION['empId'] = $employeeID; 

    } else {
        header("Location:../emp_info/index.php");
        exit();
    }
} else {
    header("Location:../emp_info/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
</head>

<body>
<?php


if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
            <strong>' . htmlspecialchars($_SESSION['error']) . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
            <strong>' . htmlspecialchars($_SESSION['success']) . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    unset($_SESSION['success']);
}
?>

    <div class="center-content">
      
        <h2>Welcome, <span id="employeeName"><?php echo htmlspecialchars($employeeName); ?></span>!</h2>
        <p class="employee-id">Employee ID: <span id="employeeID"><?php echo htmlspecialchars($employeeID); ?></span></p>

        <button id="markAttendanceBtn" class="btn btn-custom">
            <i class="bi bi-check-circle"></i> Mark Attendance
        </button>
        <p id="attendanceMessage" style="color: green; display: none;"></p>

        <a href="leave_app/form.php" class="btn btn-custom">
            <i class="bi bi-box-arrow-down"></i> Leave Application
        </a>
        <a href="leave_status/index.php" class="btn btn-custom">
            <i class="bi bi-box-arrow-down"></i> Leave Status
        </a>
        <a href="../logout.php" class="btn btn-custom">
            <i class="lni lni-exit"></i> Logout
        </a>
    </div>

    <script>
        document.getElementById('markAttendanceBtn').addEventListener('click', function() {
           
            fetch('http://localhost/Project/emp_login/attendance/attendance.php', {
                method: 'POST'
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('attendanceMessage').textContent = data;
                document.getElementById('attendanceMessage').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
