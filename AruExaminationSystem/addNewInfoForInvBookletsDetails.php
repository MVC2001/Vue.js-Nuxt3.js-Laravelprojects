<?php
include("./connection/include.php");
session_start(); 

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'examination_coordinator') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

function addUser($connect,$fullName,$School,$Dept,$quantity,$coseCode,$program) {

    // Check if  already exists
    $checkEmailQuery = mysqli_query($connect, "SELECT * FROM `invassignedbookletsdetails` WHERE `id` = '$id'");
    if (mysqli_num_rows($checkEmailQuery) > 0) {
        return "Detail already exist already exists.";
    }


    // Insert user into database
    $insertQuery = mysqli_query($connect, "INSERT INTO `invassignedbookletsdetails` (`fullName`, `School`,`Dept`,`quantity`,`coseCode`,`program`) VALUES ('$fullName', '$School','$Dept','$quantity','$coseCode','$program')");
    if ($insertQuery) {
        return "New Booklet Detail  added successfully.";
    } else {
        return "Failed to add new detail.";
    }
}


// Usage example
if (isset($_POST['add-function'])) {
    $fullName = $_POST['fullName']; 
    $School = $_POST['School'];
    $Dept = $_POST['Dept'];
    $quantity = $_POST['quantity'];
    $coseCode = $_POST['coseCode'];
    $program = $_POST['program'];


    $result = addUser($connect,$fullName,$School,$Dept,$quantity,$coseCode,$program);
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
                            <li><a href="./allInvBookletsDetails.php">Back-now</a></li>
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
                    <div class="col-sm-12 p-md-0">
                        <div class="welcome-text">
                            <h4 style="color:#032B58">Assign new booklet detail to Invigilator for Invigilation</h4>
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
                                           <input type="text" class="form-control" name="fullName" required placeholder="Enter invigilator name">
                                            </div>

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                               <select type="text" name="School" class="form-control">
                                          <option value="None-user">--Select-----School--------</option>
                                           <option value="SACEM">SACEM</option>
                                           <option value="SSPSS">SSPSS</option>
                                            <option value="SERBI">SERBI</option>
                                           <option value="SEES">SEES</option>
                                           </select>
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
                                           <select type="text" name="Dept" class="form-control">
                                          <option value="None">--Select-----Dept--------</option>
                                           <option value="Building-Economics"Building-Economics</option>
                                           <option value="Architecture">Architecture</option>
                                            <option value="Interior-Design">Interior-Design</option>
                                           <option value="Geospatial-Sciences and Technology">Geospatial-Sciences and Technology</option>
                                           <option value="Computer-Systems and Mathematics">Computer-Systems and Mathematics</option>
                                           <option value="Business Studies">Business Studies</option>
                                            <option value="Land-Management and Valuation">Land-Management and valuation</option>
                                             <option value="Civil and Environmental-Engineering">Civil and Environmental-Engineering</option>
                                              <option value="Environmental-Science and Management">Environmental-Science and Management</option>
                                               <option value="Urban and Regional-Planning">Urban and Regional-Planning</option>
                                                <option value="Economics and Social-Studies">Economics and Social-Studies</option>
                                                   <option value="Others">Others</option>
                                           </select>
                                            </div>

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                           <input type="number" class="form-control" name="quantity" placeholder="Enter quantity here">
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
                                            <input type="text" class="form-control" name="coseCode"  placeholder="Enter  coseCode here eg. IS314">
                                            </div>

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                           <input type="text" class="form-control" name="program" placeholder="program eg ISM,CSN,LMV">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>
                              
                        <div class="card">
                          
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <button type="submit" name="add-function" class="btn btn-primary mb-2" style="background-color:#032B58">Create now</button>
                                        <span> <button type="button" class="btn btn-primary mb-2"><a href="./allInvBookletsDetails.php" style="color:white">Cancel</button></a></span>
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