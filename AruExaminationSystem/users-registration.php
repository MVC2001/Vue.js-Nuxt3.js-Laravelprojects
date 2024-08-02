<?php
include("./connection/include.php");
session_start(); 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

function addUser($connect, $fullName, $role, $school_id, $department_id, $email, $password) {
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }

    // Check if the role is selected
    if ($role == "None-user") {
        return "Please select a role.";
    }

    // Check if email already exists
    $checkEmailQuery = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");
    if (mysqli_num_rows($checkEmailQuery) > 0) {
        return "Email already exists.";
    }

    // Hash the password
    $hashedPassword = md5($password);

    // Insert user into database
    $insertUserQuery = "INSERT INTO `users` (`fullName`,`role`, `school_id`, `department_id`, `email`, `password`) VALUES ('$fullName','$role', '$school_id', '$department_id', '$email', '$hashedPassword')";
    if (mysqli_query($connect, $insertUserQuery)) {
        // Get the user_id of the newly inserted user
        $userId = mysqli_insert_id($connect);

        // Insert the user_id and role into the user_role table
        $insertUserRoleQuery = "INSERT INTO `user_role` (`user_id`, `role`) VALUES ('$userId', '$role')";
        if (mysqli_query($connect, $insertUserRoleQuery)) {
            return "User added successfully.";
        } else {
            return "Failed to add user role.";
        }
    } else {
        return "Failed to add user.";
    }
}

// Usage example
if (isset($_POST['add-function'])) {
    // Assuming $connect is your database connection
    $fullName = $_POST['fullName'];
    $role = $_POST['role']; // Corrected name attribute
    $school_id = $_POST['school_id'];
    $department_id = $_POST['department_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = addUser($connect, $fullName, $role, $school_id, $department_id, $email, $password);
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
    <title>User registration </title>
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
                <nav class="navbar navbar-expand" style="background-color:#032B58">
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
                                        <i class="icon-key" style="color:#032B58"></i>
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
                <hr>
                    <!-- <li><a href="index.html"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li> -->
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./users.php">Back-now</a></li>
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
                            <h4 style="color:#273D55">Create new user</h4>
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
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="fullName" required type="text" class="form-control" placeholder="fullname">
                                            </div>
                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="email" required type="text" class="form-control" placeholder="Email">
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
                                         <select type="text" name="role" class="form-control">
                                          <option value="None-user">--Selct-----role--------</option>
                                          <option value="admin">System admin</option>
                                           <option value="exams_administrator_manager">Exams Administrstor Manager</option>
                                           <option value="examination_coordinator">Examination coordinator</option>
                                            <option value="quality_assurance_officer">Quality Assurance Officer</option>
                                           <option value="examiner">Examiner</option>
                                           <option value="invigilator">invigilator</option>
                                            <option value="others">Others</option>
                                           </select>
</div>

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                              <input name="school_id" required type="text" class="form-control" placeholder="school_id">
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
                                        <input name="department_id" required type="text" class="form-control" placeholder="department_id">
                                          
</div>
                          <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input type="text" class="form-control" name="password" placeholder="password">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                       
                        <div class="card">
                          
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <button type="submit" name="add-function" class="btn btn-primary mb-2" style="background-color:#0C488A ">Create now</button>
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