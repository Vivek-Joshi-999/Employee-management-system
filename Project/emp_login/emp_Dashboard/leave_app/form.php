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
  
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="container">
    <h2 class="text-center">Leave Application Form</h2>
    <form action="leave_submit.php" method="POST">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputsdate">Start Date</label>
          <input type="date" class="form-control" id="inputsdate" name="sdate" required>
        </div>
        <div class="form-group col-md-6">
          <label for="inputedate">End Date</label>
          <input type="date" class="form-control" id="inputedate" name="edate" required>
        </div>
        <div class="form-group col-md-12 mt-3">
          <label for="typeofleave">Type of Leave</label>
          <select class="form-control" id="typeofleave" name="typeofleave" >
            <option value="" disabled selected>Type of Leave</option>
            <option value="Casual Leave">Casual Leave</option>
            <option value="Sick Leave">Sick Leave</option>
            <option value="Paid Leave">Paid Leave</option>
          </select>
        </div>
        <div class="form-group col-md-12 mt-3">
          <label for="textarea">Other Reasons</label>
          <textarea class="form-control" id="textarea" name="othreason" rows="3" placeholder="Specify other reasons"></textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-primary w-100 mt-3">Submit</button>
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
