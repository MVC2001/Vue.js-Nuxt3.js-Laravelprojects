<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an examination coordinator, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'examination_coordinator') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

// Get the department ID of the logged-in examination coordinator
$user_id = $_SESSION['user_id'];
$query = "SELECT department_id FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$department_id = $row['department_id'];

// Fetch invigilators and examiners who belong to the same department
$select_all_users = "
    SELECT u.user_id, u.fullName, u.role, u.email, u.department_id, u.school_id
    FROM users u
    WHERE (u.role = 'invigilator' OR u.role = 'examiner') AND u.department_id = '$department_id'
";
$result = mysqli_query($connect, $select_all_users);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Invigilators</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Preloader start -->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!-- Preloader end -->

    <!-- Main wrapper start -->
    <div id="main-wrapper">

        <!-- Nav header start -->
        <div class="nav-header" style="background-color:#032B58">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!-- Nav header end -->

        <!-- Header start -->
        <div class="header" style="background-color:#032B58">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left"></div>
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                <i class="mdi mdi-account"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="./logout.php" class="dropdown-item">
                                    <i class="icon-key"></i>
                                    <span class="ml-2">Logout</span>
                                </a>
                            </div>
                        </li>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Header end -->

        <!-- Sidebar start -->
        <div class="quixnav" style="background-color:#032B58">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first"></li><hr>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-hand-o-right" style="background-color:#273D55"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./EC_dashboard.php">Back-now</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Sidebar end -->

        <!-- Content body start -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>All invigilators and examiners</h4>
                        </div>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display table-bordered" style="width:100%">
                                        <thead  style="color:white;background-color:#032B58">
                                            <tr>
                                               <th style="color:white">No#</th>
                                                <th style="color:white">Name</th>
                                                <th style="color:white">ID</th>
                                                <th style="color:white">School</th>
                                                <th style="color:white">Dept</th>
                                                <th style="color:white">Position</th>
                                                <th style="color:white">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color:#032B58">
                                            <?php 
                                            $count = 1;
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><?php echo $count ?></td>
                                                        <td><?php echo $row['fullName']; ?></td>
                                                        <td><?php echo $row['user_id']; ?></td>
                                                        <td><?php echo $row['school_id']; ?></td>
                                                        <td><?php echo $row['department_id']; ?></td>
                                                        <td><button class="btn btn-success"><?php echo $row['role']; ?></button></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                    </tr>
                                                    <?php $count++;
                                                }
                                            } ?>
                                        </tbody>             
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content body end -->
    </div>
    <!-- Main wrapper end -->

    <!-- Scripts -->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>
</body>

</html>
