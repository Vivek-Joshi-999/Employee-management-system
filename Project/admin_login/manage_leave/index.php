<?php
session_start();
$conn = new mysqli("localhost", "root", "", "employee_management_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Approve or Reject action
if (isset($_GET['action']) && isset($_GET['LeaveId'])) {
    $leaveId = $_GET['LeaveId'];
    $newStatus = $_GET['action'] === 'approve' ? 'Approved' : 'Rejected';

    $updateSql = "UPDATE leave_application_form SET status = '$newStatus' WHERE LeaveId = '$leaveId'";
    if ($conn->query($updateSql) === TRUE) {
        // No alert message required
    } else {
        echo "<script>alert('Failed to update status.');</script>";
    }
}

// Retrieve only pending leave requests
$sql = "SELECT LeaveId, EmpId, sdate, edate, typeof_leave, othreason, status FROM leave_application_form WHERE status = 'Pending'";
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
<h2 class="my-4 text-center">Manage Leaves</h2>
<table class="table">
    <thead class="thead-custom-head">
    <tr>
        <th scope="col">Leave ID</th>
        <th scope="col">EmpID</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Type of Leave</th>
        <th scope="col">Other Reasons</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['LeaveId']}</td>
                    <td>{$row['EmpId']}</td>
                    <td>{$row['sdate']}</td>
                    <td>{$row['edate']}</td>
                    <td>{$row['typeof_leave']}</td>
                    <td>{$row['othreason']}</td>
                    <td class='text-warning'>Pending</td>
                    <td>
                        <a href='?action=approve&LeaveId={$row['LeaveId']}' class='btn btn-success btn-sm'>Approve</a>
                        <a href='?action=reject&LeaveId={$row['LeaveId']}' class='btn btn-danger btn-sm'>Reject</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8' class='text-center'>No pending leave applications found.</td></tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>
<?php
$conn->close();
?>
