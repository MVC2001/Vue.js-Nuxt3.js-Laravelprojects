<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("./connection/include.php");

// Check if user is not logged in or not an examination_coordinator, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'examination_coordinator') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

function addInvigilationReport($connect, $user_id, $school_id, $department_id, $courseCode, $program, $totalStudentsDo_exams, $bookletsUsed, $unUsedBooklets, $scriptsUsed, $unUsedScripts, $description) {
    // Insert data into invigilation_reportv1
    $insertQuery = mysqli_query($connect, "INSERT INTO `invigilation_reportv1` (`user_id`, `school_id`, `department_id`, `courseCode`, `program`, `totalStudentsDo_exams`, `bookletsUsed`, `unUsedBooklets`, `scriptsUsed`, `unUsedScripts`, `description`) VALUES ('$user_id', '$school_id', '$department_id', '$courseCode', '$program', '$totalStudentsDo_exams', '$bookletsUsed', '$unUsedBooklets', '$scriptsUsed', '$unUsedScripts', '$description')");
    if ($insertQuery) {
        return "New invigilation report added successfully.";
    } else {
        return "Failed to add new invigilation report.";
    }
}

// Usage example
if (isset($_POST['add-function'])) {
    $user_id = $_SESSION['user_id']; // Automatically use logged in user_id
    $school_id = $_POST['school_id'];
    $department_id = $_POST['department_id'];
    $courseCode = $_POST['courseCode'];
    $program = $_POST['program'];
    $totalStudentsDo_exams = $_POST['totalStudentsDo_exams'];
    $bookletsUsed = $_POST['bookletsUsed'];
    $unUsedBooklets = $_POST['unUsedBooklets'];
    $scriptsUsed = $_POST['scriptsUsed'];
    $unUsedScripts = $_POST['unUsedScripts'];
    $description = $_POST['description'];

    $result = addInvigilationReport($connect, $user_id, $school_id, $department_id, $courseCode, $program, $totalStudentsDo_exams, $bookletsUsed, $unUsedBooklets, $scriptsUsed, $unUsedScripts, $description);
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Assign invigilation report to examination coordinator</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header" style="background-color:#032B58">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header" style="background-color:#032B58">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left"></div>
                        <ul class="navbar-nav header-right">
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
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav" style="background-color:#032B58">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first"></li>
                    <hr>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-hand-o-right"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./overAllInvigilatinReport.php">Back-now</a></li>
                        </ul>
                    </li>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-12 p-md-0">
                        <div class="welcome-text">
                            <h4 style="color:#032B58">Assign new invigilation report to Examination coordinator</h4>
                            <!-- Success message -->
                            <?php if(isset($_SESSION['success_message'])): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_SESSION['success_message']; ?>
                            </div>
                            <?php unset($_SESSION['success_message']); ?>
                            <?php endif; ?>
                            <!-- Error message -->
                            <?php if(isset($_SESSION['error_message'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['error_message']; ?>
                            </div>
                            <?php unset($_SESSION['error_message']); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <div class="basic-form">
                            <form class="form-inline" action="" method="POST">
                        </div>

                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="courseCode" required placeholder="Enter Course Code">
                                        </div>
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <input type="text" class="form-control" name="program" required placeholder="Enter Program">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                             <input type="text" class="form-control" name="school_id" required placeholder="Enter school id">
                                        </div>
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <input type="text" class="form-control" name="department_id" required placeholder="Enter department id">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" name="totalStudentsDo_exams" placeholder="Total Students Doing Exams">
                                        </div>
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <input type="number" class="form-control" name="bookletsUsed" placeholder="Booklets Used">
                                        </div>
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <input type="number" class="form-control" name="unUsedBooklets" placeholder="Unused Booklets">
                                        </div>
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <input type="number" class="form-control" name="scriptsUsed" placeholder="Scripts Used">
                                        </div>
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <input type="number" class="form-control" name="unUsedScripts" placeholder="Unused Scripts">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Description</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <textarea type="text" class="form-control" name="description" placeholder="Enter description here"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                    <button type="submit" name="add-function" class="btn btn-primary mb-2" style="background-color:#032B58">Submit Report</button>
                                    <span>
                                        <button type="button" class="btn btn-primary mb-2">
                                            <a href="./allBookletsInfo.php" style="color:white">Cancel</a>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

</body>

</html>
