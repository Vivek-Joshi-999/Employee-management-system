<?php
session_start();
 
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "employee_management_system";

  $conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['empID'])) {
    $empID = $_GET['empID'];

    // Query to fetch employee data from the database
    $query = "SELECT * FROM users WHERE empID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $empID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        
        $_SESSION['error'] = "Employee not found!";
        header("Location:http://localhost/Project/admin_login/manage/index.html");
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request!";
    header("Location: http://localhost/Project/admin_login/manage/index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <strong><?php echo $_SESSION['error']; ?></strong>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="container mt-5">
        <h2 class="text-center">Update Employee Details</h2>
        <form action="update_employee.php" method="POST">
            <input type="hidden" name="empID" value="<?php echo $employee['empID']; ?>">

            <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $employee['name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $employee['email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="uname">Username</label>
                <input type="text" class="form-control" id="uname" name="uname" value="<?php echo $employee['username']; ?>" required>
            </div>

            <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password (optional)">
</div>


            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $employee['phone']; ?>" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $employee['dob']; ?>" required>
            </div>

            <div class="form-group">
                <label for="department">Department</label>
                <select class="form-control" id="department" name="department" required>
                    <option value="HR" <?php echo ($employee['department'] == 'HR') ? 'selected' : ''; ?>>HR</option>
                    <option value="IT" <?php echo ($employee['department'] == 'IT') ? 'selected' : ''; ?>>IT</option>
                    <option value="Finance" <?php echo ($employee['department'] == 'Finance') ? 'selected' : ''; ?>>Finance</option>
                </select>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label><br>
                <input type="radio" id="genderMale" name="gender" value="Male" <?php echo ($employee['gender'] == 'Male') ? 'checked' : ''; ?> required> Male
                <input type="radio" id="genderFemale" name="gender" value="Female" <?php echo ($employee['gender'] == 'Female') ? 'checked' : ''; ?>> Female
                <input type="radio" id="genderOther" name="gender" value="Other" <?php echo ($employee['gender'] == 'Other') ? 'checked' : ''; ?>> Other
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $employee['address']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Employee</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
