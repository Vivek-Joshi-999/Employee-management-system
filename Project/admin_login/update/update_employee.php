<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee_management_system";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $empID = $_POST['empID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['uname'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $department = $_POST['department'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $password = $_POST['password']; 

   
    $query = "UPDATE users SET name = ?, email = ?, username = ?, phone = ?, dob = ?, department = ?, gender = ?, address = ?";
    $params = [$name, $email, $username, $phone, $dob, $department, $gender, $address];

  
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); 
        $query .= ", password = ?";
        $params[] = $hashedPassword;
    }

    $query .= " WHERE empID = ?";
    $params[] = $empID;

   
    $stmt = $conn->prepare($query);
    $stmt->bind_param(str_repeat("s", count($params)), ...$params);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Employee details updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update employee details!";
    }

  
    header("Location: ../manage/index.html?success=true");
    exit;
}
?>
