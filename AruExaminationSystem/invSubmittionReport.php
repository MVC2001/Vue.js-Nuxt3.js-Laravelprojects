<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'examination_coordinator') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

// Fetch invigilation reports for users with role 'invigilator'
$select_all = "SELECT overallinvigilationreport.id, overallinvigilationreport.user_id, overallinvigilationreport.school_id, overallinvigilationreport.department_id, overallinvigilationreport.courseCode, overallinvigilationreport.program, overallinvigilationreport.totalStudents, overallinvigilationreport.bookletsUsed, overallinvigilationreport.unUsedBooklets, overallinvigilationreport.usedScripts, overallinvigilationreport.unUsedScripts, overallinvigilationreport.description, overallinvigilationreport.comfirmation, overallinvigilationreport.created_at, users.user_id 
FROM overallinvigilationreport 
JOIN users ON overallinvigilationreport.user_id = users.user_id 
WHERE users.role = 'invigilator' 
ORDER BY overallinvigilationreport.id DESC";

$result = mysqli_query($connect, $select_all);

if (!$result) {
    die("Query failed: " . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BookletDetails</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
</head>
<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="nav-header" style="background-color:#032B58">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
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
        <div class="quixnav" style="background-color:#032B58">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first"></li>
                    <hr>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-hand-o-right" style="background-color:#273D55"></i>
                            <span class="nav-text">Back-home</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./EC_dashboard.php">Back-now</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Invigilation report submitted by invigilators</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display table-bordered" style="width:100%">
                                        <thead style="color:white;background-color:#032B58">
                                            <tr>
                                                <th style="color:white">No#</th>
                                                <th style="color:white">InvigilatorID</th>
                                                 <th style="color:white">Total Students</th>
                                                <th style="color:white">Booklet Used</th>
                                                <th style="color:white">Unused Booklets</th>
                                                <th style="color:white">Used Scripts</th>
                                                <th style="color:white">Unused Scripts</th>
                                                <th style="color:white">Description</th>
                                                <th style="color:white">Comfirmation</th>
                                                <th style="color:white">Submitted At</th>
                                                <th style="color:white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color:#032B58" >
                                            <?php 
                                            if (mysqli_num_rows($result) > 0) {
                                                $count = 1;
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                         <td><?php echo $row['user_id']; ?></td>
                                                        <td><?php echo $row['totalStudents']; ?></td>
                                                        <td><?php echo $row['bookletsUsed']; ?></td>
                                                        <td><?php echo $row['unUsedBooklets']; ?></td>
                                                        <td><?php echo $row['usedScripts']; ?></td>
                                                        <td><?php echo $row['unUsedScripts']; ?></td>
                                                        <td><?php echo $row['description']; ?></td>
                                                        <td><button class="btn btn-success"><?php echo $row['comfirmation']; ?></button></td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        <td>
                                                            <a href="comfirmSubmittionReportV1.php?id=<?php echo $row['id']; ?>">
                                                                <button class="btn btn" style="background-color:#273D55">Comfirm Here</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                            <?php $count++; }
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
    </div>
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>
</body>
</html>
