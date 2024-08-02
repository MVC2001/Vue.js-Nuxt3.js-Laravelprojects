<?php
include("./connection/include.php");
session_start();

// Check if user is not logged in or not an invigilator, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'invigilator') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

function addUser($connect, $user_id, $school_id, $department_id, $courseCode, $program, $totalStudents, $bookletsUsed, $unUsedBooklets, $usedScripts, $unUsedScripts, $description) {
    // Check if report already exists
    $checkQuery = mysqli_query($connect, "SELECT * FROM `overallinvigilationreport` WHERE `user_id` = '$user_id' AND `courseCode` = '$courseCode'");
    if (mysqli_num_rows($checkQuery) > 0) {
        return "Detail already exists.";
    }

    // Insert report into database
    $insertQuery = mysqli_query($connect, "INSERT INTO `overallinvigilationreport` (`user_id`, `school_id`, `department_id`, `courseCode`, `program`, `totalStudents`, `bookletsUsed`, `unUsedBooklets`, `usedScripts`, `unUsedScripts`, `description`) VALUES ('$user_id', '$school_id', '$department_id', '$courseCode', '$program', '$totalStudents', '$bookletsUsed', '$unUsedBooklets', '$usedScripts', '$unUsedScripts', '$description')");
    if ($insertQuery) {
        return "New Invigilation report created successfully.";
    } else {
        return "Failed to add new report.";
    }
}

// Fetch user details from database
$user_id = $_SESSION['user_id'];
$userDetailsQuery = mysqli_query($connect, "SELECT * FROM `users` WHERE `user_id` = '$user_id'");
$userDetails = mysqli_fetch_assoc($userDetailsQuery);

if (isset($_POST['add-function'])) {
    $courseCode = $_POST['courseCode'];
    $program = $_POST['program'];
    $totalStudents = $_POST['totalStudents']; 
    $bookletsUsed = $_POST['bookletsUsed'];
    $unUsedBooklets = $_POST['unUsedBooklets'];
    $usedScripts = $_POST['usedScripts'];
    $unUsedScripts = $_POST['unUsedScripts'];
    $description = $_POST['description'];

    $result = addUser($connect, $user_id, $userDetails['school_id'], $userDetails['department_id'], $courseCode, $program, $totalStudents, $bookletsUsed, $unUsedBooklets, $usedScripts, $unUsedScripts, $description);
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
    <title>Booklet Details Registration</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>

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
                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                <i class="mdi mdi-account"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="./logout.php" class="dropdown-item">
                                    <i class="icon-key"></i>
                                    <span class="ml-2">Logout </span>
                                </a>
                            </div>
                        </li>
                    </ul>
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
                        <i class="fa fa-hand-o-right"></i>
                        <span class="nav-text">Back-home</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="./Inv_dashboard.php">Back-now</a></li>
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
                        <h4 style="color:#032B58">Create new invigilation report here</h4>
                        <!-- Success message -->
                        <?php if (isset($_SESSION['success_message'])) : ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_SESSION['success_message']; ?>
                            </div>
                            <?php unset($_SESSION['success_message']); ?>
                        <?php endif; ?>

                        <!-- Error message -->
                        <?php if (isset($_SESSION['error_message'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['error_message']; ?>
                            </div>
                            <?php unset($_SESSION['error_message']); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-xxl-12">
                    <div class="basic-form">
                        <div class="card">
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <input name="user_id" type="hidden" value="<?php echo $user_id; ?>" class="form-control">
                                    <input name="fullName" type="hidden" value="<?php echo $userDetails['fullName']; ?>" class="form-control">
                                    <div class="col-md-6 mt-2">
                                        <input name="school_id" id="school_id" type="hidden" value="<?php echo $userDetails['school_id']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input name="department_id" id="department_id" type="hidden" value="<?php echo $userDetails['department_id']; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="courseCode">Course Code</label>
                                        <input type="text" class="form-control" id="courseCode" required name="courseCode" placeholder="Enter course code here">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="program">Program</label>
                                        <input type="text" class="form-control" id="program" required name="program" placeholder="Enter program here">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label for="totalStudents">Total Students</label>
                                        <input type="number" class="form-control" id="totalStudents" name="totalStudents" placeholder="Enter total students here">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="bookletsUsed">Booklets Used</label>
                                        <input type="number" class="form-control" id="bookletsUsed" name="bookletsUsed" placeholder="Enter booklets used here">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="unUsedBooklets">Unused Booklets</label>
                                        <input type="number" class="form-control" id="unUsedBooklets" name="unUsedBooklets" placeholder="Enter unused booklets here">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="usedScripts">Used Scripts</label>
                                        <input type="number" class="form-control" id="usedScripts" name="usedScripts" placeholder="Enter used scripts here">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="unUsedScripts">Unused Scripts</label>
                                        <input type="number" class="form-control" id="unUsedScripts" name="unUsedScripts" placeholder="Enter unused scripts here">
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="Enter more info here"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="add-function" class="btn btn-primary mb-2" style="background-color:#032B58">Create now</button>
                                        <button type="button" class="btn btn-primary mb-2">
                                            <a href="./Inv_dashboard.php" style="color:white">Cancel</a>
                                        </button>
                                    </div>
                                </div>
                                 </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

</body>

</html>
