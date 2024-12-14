<?php

$conn = new mysqli('localhost', 'root', '', 'employee_management');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = 'admin';
$password = 'admin123'; 
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO admin_login (username, password) VALUES ('$username', '$hashedPassword')";

if ($conn->query($sql) === TRUE) {
    
    echo "Admin credentials inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>  