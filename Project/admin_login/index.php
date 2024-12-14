<?php
session_start();


$conn = new mysqli('localhost', 'root', '', 'employee_management_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM admin_login WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
          $_SESSION['user_logged_in'] = true;
            header("Location: admin_dashboard/index.php");
            exit();
        } else {
            $_SESSION['error'] = "Password incorrect!";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid Username!";
        header("Location: index.php");
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body class="bg-custom text-white">

<?php
if (isset($_SESSION['error'])) {
  echo '<div class="alert alert-dismissible fade show custom-alert" role="alert"    >
          <strong>' . $_SESSION['error'] . '</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  unset($_SESSION['error']);
}

?>


<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-center">
          <h1>Login</h1>
        </div>
        <div class="card-body">
          <form method="post" action="">
            <h2 class="text-center">As Admin</h2>
            <div class="mb-3">
              <label for="username" class="form-label"></label>
              <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label"></label>
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="d-grid">
              <button id="btn" type="submit" class="btn btn-primary">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>
