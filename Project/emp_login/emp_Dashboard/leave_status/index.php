<?php
session_start();

$conn = new mysqli("localhost", "root", "", "employee_management_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$empId = $_SESSION['empId']; 

 
$sql = "SELECT LeaveId, sdate, edate, typeof_leave, othreason, status 
        FROM leave_application_form 
        WHERE EmpId = '$empId'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Leave Status</title>
</head>
<body>
  <div class="container">
    <h2 class="my-4 text-center">Leave Status</h2>
    <table class="table">
      <thead class="thead-custom-head">
        <tr>
          <th scope="col">Leave Id</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
          <th scope="col">Type of Leave</th>
          <th scope="col">Other Reasons</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $statusColor = '';
              switch ($row['status']) {
                  case 'Approved':
                      $statusColor = 'text-success'; // Green for approved
                      break;
                  case 'Rejected':
                      $statusColor = 'text-danger'; // Red for rejected
                      break;
                  case 'Pending':
                      $statusColor = 'text-warning'; // Orange for pending
                      break;
                  default:
                      $statusColor = 'text-muted'; // Grey for unknown
                      break;
              }
              echo "<tr>
                      <td>{$row['LeaveId']}</td>
                      <td>{$row['sdate']}</td>
                      <td>{$row['edate']}</td>
                      <td>{$row['typeof_leave']}</td>
                      <td>{$row['othreason']}</td>
                      <td class='$statusColor'>{$row['status']}</td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='6' class='text-center'>No leave applications found.</td></tr>";
      }
      ?>
      </tbody>
    </table>
  </div>
</body>
</html>
<?php
$conn->close();
?>
