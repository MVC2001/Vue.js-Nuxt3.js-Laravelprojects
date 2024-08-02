<?php
include("./connection/include.php");
session_start(); 

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

function addRole($connect, $role, $description) {
    // Check if role already exists
    $checkRoleQuery = mysqli_query($connect, "SELECT * FROM `role` WHERE `role` = '$role'");
    if (mysqli_num_rows($checkRoleQuery) > 0) {
        return "Role already exists.";
    }

    // Insert role into database
    $insertRoleQuery = "INSERT INTO `role` (`role`, `description`) VALUES ('$role', '$description')";
    if (mysqli_query($connect, $insertRoleQuery)) {
        // Get the role_id of the newly inserted role
        $roleId = mysqli_insert_id($connect);

        // Get the user_id of the first user in ascending order with the same role
        $userQuery = "SELECT `user_id` FROM `users` WHERE `role` = '$role' ORDER BY `user_id` ASC LIMIT 1";
        $userResult = mysqli_query($connect, $userQuery);
        if ($userResult && mysqli_num_rows($userResult) > 0) {
            $userRow = mysqli_fetch_assoc($userResult);
            $userId = $userRow['user_id'];

            // Insert the role_id and user_id into the user_role table
            $insertUserRoleQuery = "INSERT INTO `user_role` (`role_id`, `user_id`) VALUES ('$roleId', '$userId')";
            if (mysqli_query($connect, $insertUserRoleQuery)) {
                return "Role added successfully.";
            } else {
                return "Failed to add user role.";
            }
        } else {
            return "No users found with the specified role.";
        }
    } else {
        return "Failed to add role.";
    }
}

// Usage example
if (isset($_POST['add-function'])) {
    $role = $_POST['role']; 
    $description = $_POST['description'];

    $result = addRole($connect, $role, $description);
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
    <title>add role </title>
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
                    <hr>
                    <!-- <li><a href="index.html"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li> -->
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./roles.php">Back-now</a></li>
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
                            <h4 style="color:#032B58">Create new role</h4>
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
                                           <select type="text" name="role" class="form-control" required>
                                          <option value="None-user">--Selct-----role--------</option>
                                          <option value="admin">System admin</option>
                                           <option value="exams_administrator_manager">Exams Administrstor Manager</option>
                                           <option value="examination_coordinator">Examination coordinator</option>
                                            <option value="quality_assurance_officer">Quality Assurance Officer</option>
                                           <option value="Invigilator">invigilator</option>
                                           </select>
                                            </div>

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                           <textarea type="text" class="form-control" name="description" placeholder="Enter description" required></textarea>
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                              
                        <div class="card">
                          
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <button type="submit" name="add-function" class="btn btn-primary mb-2" style="background-color:#032B58">Create now</button>
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