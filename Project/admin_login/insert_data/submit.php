<?php
session_start();

$servername = "localhost"; 
$username = "root";         
$password = "";            
$dbname = "employee_management_system";   


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

  
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    

    $checkUsername = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $checkUsername->bind_param("s", $uname);
    $checkUsername->execute();
    $result = $checkUsername->get_result();
    
    if ($result->num_rows > 0) {
      
        $_SESSION['error'] = 'Username already exists. Please choose another username.';
        header("Location: insert.php");  
        exit();
    } else {
       
        $sql = "INSERT INTO users (name, username,department, email, password, phone, dob, gender, address) 
                VALUES ('$name', '$uname','$department', '$email', '$hashedPassword', '$phone', '$dob', '$gender', '$address')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = 'New Employee Added successfully';
            header("Location: insert.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

 
    $checkUsername->close();
}

$conn->close();
?>
