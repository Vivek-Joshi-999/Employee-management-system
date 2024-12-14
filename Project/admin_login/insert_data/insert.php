
<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Form</title>
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<?php
    if (isset($_SESSION['error'])) {
      echo '<div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
              <strong>' . $_SESSION['error'] . '</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
      unset($_SESSION['error']);
    }
    ?>
<?php
     if (isset($_SESSION['success'])) {
      echo '<div class="alert alert-success  alert-dismissible fade show custom-alert" role="alert">
              <strong>' . $_SESSION['success'] . '</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
      unset($_SESSION['success']);
    }
    ?>
  <div class="container mt-5">
    <h2 class="text-center">Add New Employee</h2>
    <form action="submit.php" method="POST">
      <div class="form-row">
        
        <div class="form-group col-md-6">
          <label for="inputName">Name</label>
          <input type="text" class="form-control" id="inputName" name="name" placeholder="Full Name" required>
        </div>
        
      
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group col-md-6">
          <label for="email">Username</label>
          <input type="text" class="form-control" id="uname" name="uname" placeholder="Username" required>
        </div>
   
        <div class="form-group col-md-6">
          <label for="inputPassword4">Create Password</label>
          <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Password" required>
        </div>
      
        <div class="form-group col-md-6">
          <label for="inputPhone">Phone Number</label>
          <input type="tel" class="form-control" id="inputPhone" name="phone" placeholder="Enter Phone Number" required>
        </div>
       
        <div class="form-group col-md-6">
          <label for="inputDOB">Date of Birth</label>
          <input type="date" class="form-control" id="inputDOB" name="dob" required>
        </div>
        <div class="form-group col-md-6">
    <label for="departmentSelect">Department</label>
    <select class="form-control" id="department" name="department" required>
        <option value="" disabled selected>Select a department</option>
        <option value="HR">HR</option>
        <option value="IT">IT</option>
        <option value="Finance">Finance</option>
        
    </select>
</div>

        
        <div class="form-group col-md-6">
          <label>Gender</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="genderMale" name="gender" value="Male" required>
            <label class="form-check-label" for="genderMale">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="genderFemale" name="gender" value="Female">
            <label class="form-check-label" for="genderFemale">Female</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="genderOther" name="gender" value="Other">
            <label class="form-check-label" for="genderOther">Other</label>
          </div>
        </div>

        <div class="form-group col-md-6">
          <label for="inputAddress">Address</label>
          <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St" required>
        </div>

      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>
