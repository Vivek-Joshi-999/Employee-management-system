<?php
session_start(); 
if (!isset($_SESSION['user_logged_in'])) {
   
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Admin</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" onclick="openDashboard()">
                        <i class="bi bi-speedometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" onclick="loadPage('http://localhost/Project/admin_login/search/index.html')">
                        <i class="bi bi-search"></i>
                        <span>Search</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" onclick="loadPage('http://localhost/Project/admin_login/attendance/index.html')">
                    <i class="bi bi-card-checklist"></i>
                        <span>Attendance</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="bi bi-people-fill"></i>
                        <span>Staff</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link" onclick="loadPage('http://localhost/Project/admin_login/insert_data/insert.php')">Add</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link" onclick="loadPage('http://localhost/Project/admin_login/manage/index.html')">Manage</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#leave" aria-expanded="false" aria-controls="leave">
                        <i class="bi bi-box-arrow-down"></i>
                        <span>Leave</span>
                    </a>
                    <ul id="leave" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link" onclick="loadPage('http://localhost/Project/admin_login/manage_leave/index.php')">Manage leave</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-footer">
            <a href="../logout.php"class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        
        <div class="main p-5">
          
            <div id="dashboard-cards" class="container mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Employees</h5>
                                
                                <?php
                                include('db_connection.php'); 
                                $query = "SELECT COUNT(*) AS total FROM users";  
                                $result = mysqli_query($conn, $query);
                                $data = mysqli_fetch_assoc($result);
                                echo '<p class="card-text display-6">' . $data['total'] . '</p>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Employees on Leave</h5>

                                <?php
                                $query = "SELECT COUNT(distinct EmpId) AS total FROM leave_application_form WHERE status ='Approved' AND CURDATE() BETWEEN sdate AND edate";  
                                $result = mysqli_query($conn, $query);
                                
                                if ($result) {
                                    $data = mysqli_fetch_assoc($result);
                                    $total = isset($data['total']) ? $data['total'] : 0; 
                                    echo '<p class="card-text display-6">' . $total . '</p>';
                                } else {
                                    echo '<p class="card-text display-6">0</p>'; 
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Pending Leave Requests</h5>
                                <?php
                                include('db_connection.php'); 
                                $query = "SELECT COUNT(*) AS total FROM leave_application_form WHERE status = 'pending'";  
                                $result = mysqli_query($conn, $query);
                                $data = mysqli_fetch_assoc($result);
                                echo '<p class="card-text display-6">' . $data['total'] . '</p>';
                               ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Employee Present </h5>
                               
                                <?php
    include('db_connection.php'); 
    
    
    $query = "SELECT COUNT(*) AS total_present FROM attendance WHERE status = 'Present' AND date = CURDATE()";

    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo '<p class="card-text display-6">' . $data['total_present'] . '</p>';
    } else {
        
        echo '<p class="card-text display-6">Error fetching data</p>';
    }
?>

                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-green text-white mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Department </h5>
                                <p class="card-text display-6">3</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <!-- Main content iframe -->
            <div id="content-area">
                <iframe id="main-content-frame" src="" frameborder="0" style="width: 100%; height: 600px;"></iframe>
            </div>
        </div>
    </div>

    

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>
</html>



