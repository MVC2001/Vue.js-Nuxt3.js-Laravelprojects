<?php
include("./connection/include.php");
session_start(); 

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'examination_coordinator') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

function addUser($connect,$fullName,$School,$department,$courseCode,$program, $totalStudentsDo_exams,$bookletsUsed,$unUsedBooklets,$scriptsUsed,$unUsedScripts,$description) {

    // Check if  already exists
    $checkEmailQuery = mysqli_query($connect, "SELECT * FROM `invigilation_reportv1` WHERE `id` = '$id'");
    if (mysqli_num_rows($checkEmailQuery) > 0) {
        return "Detail already exist already exists.";
    }


    // Insert user into database
    $insertQuery = mysqli_query($connect, "INSERT INTO `invigilation_reportv1` (`fullName`,`School`,`department`,`courseCode`,`program`,`totalStudentsDo_exams`,`bookletsUsed`,`unUsedBooklets`,`scriptsUsed`,`unUsedScripts`,`description`) VALUES ('$fullName','$School','$department','$courseCode','$program','$totalStudentsDo_exams','$bookletsUsed','$unUsedBooklets','$scriptsUsed','$unUsedScripts', '$description')");
    if ($insertQuery) {
        return "New Booklet Detail  added successfully.";
    } else {
        return "Failed to add new detail.";
    }
}


// Usage example
if (isset($_POST['add-function'])) {
    $fullName = $_POST['fullName']; 
    $department =$_POST['department'];
    $School = $_POST['School']; 
    $courseCode =$_POST['courseCode'];
    $program =$_POST['program'];
    $totalStudentsDo_exams = $_POST['totalStudentsDo_exams']; 
    $bookletsUsed = $_POST['bookletsUsed'];
    $unUsedBooklets = $_POST['unUsedBooklets'];
    $scriptsUsed = $_POST['scriptsUsed'];
    $unUsedScripts = $_POST['unUsedScripts'];
       $description = $_POST['description'];


    $result = addUser($connect,$fullName,$School,$department,$courseCode,$program, $totalStudentsDo_exams,$bookletsUsed,$unUsedBooklets,$scriptsUsed,$unUsedScripts,$description);
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
    <title>BookletDetails registration </title>
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
                        <div class="header-left">
                            
                        </div>

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
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav" style="background-color:#032B58">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first"></li><hr>
                    <!-- <li><a href="index.html"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li> -->
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./overAllInvigilatinReport.php">Back-now</a></li>
                    </li>
                
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
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 style="color:#032B58">Assign  booklets to Examiner for Marking here</h4>
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
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
                                          <div class="col-sm-6">
                                            <input name="fullName" required type="text" <?php 
                                          $select_all_roles = "select fullName from users  WHERE `user_id`='$_SESSION[user_id]'" or die(mysqli_error($connect));
                                          $result = mysqli_query($connect,$select_all_roles);
                                          $number = mysqli_num_rows($result);
                                             if ($number > 0) {
                                           while($row = mysqli_fetch_assoc($result)) { ?>
                                             value=
                                                "<?php echo $row['fullName']; ?>"
                                           <?php } } ?>
                                                
                                                class="form-control">
                                            </div>

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                             <input name="School" required type="text" <?php 
                                          $select_all_roles = "select School from users  WHERE `user_id`='$_SESSION[user_id]'" or die(mysqli_error($connect));
                                          $result = mysqli_query($connect,$select_all_roles);
                                          $number = mysqli_num_rows($result);
                                             if ($number > 0) {
                                           while($row = mysqli_fetch_assoc($result)) { ?>
                                             value=
                                                "<?php echo $row['School']; ?>"
                                           <?php } } ?>
                                                
                                                class="form-control">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
                                          <div class="col-sm-4">
                                           <input name="department" required type="text" <?php 
                                          $select_all_roles = "select Dept from users  WHERE `user_id`='$_SESSION[user_id]'" or die(mysqli_error($connect));
                                          $result = mysqli_query($connect,$select_all_roles);
                                          $number = mysqli_num_rows($result);
                                             if ($number > 0) {
                                           while($row = mysqli_fetch_assoc($result)) { ?>
                                             value=
                                                "<?php echo $row['Dept']; ?>"
                                           <?php } } ?> class="form-control" style="width:300px">
                                            </div>

                                            <div class="col-md-4">
                                              <input type="text" class="form-control" name="courseCode"  placeholder="Enter courseCode here">
                                            </div>

                                            <div class="col-md-4">
                                             <input type="text" class="form-control" name="program"  placeholder="Enter program here">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
                                          <div class="col-sm-6">
                                           <input type="number" class="form-control" name="totalStudentsDo_exams"  placeholder="Enter student conduct exams here">
                                            </div>

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                         <input type="number" class="form-control" name="bookletsUsed"  placeholder="Enter 	booklets Used here">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
                                          <div class="col-sm-6">
                                           <input type="number" class="form-control" name="unUsedBooklets"  placeholder="Enter unused booklets here">
                                            </div>

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                         <input type="number" class="form-control" name="scriptsUsed"  placeholder="Enter 	scripts Used here">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>


                         <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
                                          <div class="col-sm-6">
                                           <input type="number" class="form-control" name="unUsedScripts"  placeholder="Enter unused scripts here">
                                            </div>

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                         <textarea type="text" class="form-control" name="description"  placeholder="Enter 	more info ere"></textarea>
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                              
                        <div class="card">
                          
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <button type="submit" name="add-function" class="btn btn-primary mb-2" style="background-color:#032B58">Create now</button>
                                        <span> <button type="button" class="btn btn-primary mb-2"><a href="./overAllInvigilatinReport.php" style="color:white">Cancel</button></a></span>
                                    </form>
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