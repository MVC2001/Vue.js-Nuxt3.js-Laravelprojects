<?php
include("./connection/include.php");
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'examination_coordinator') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

function updateUser($connect, $id, $comfirmation) {
    
    // Update Detail in the database
    $updateQuery = mysqli_query($connect, "UPDATE `overallinvigilationreport` SET `comfirmation`='$comfirmation' WHERE `id`='$id'");
    if ($updateQuery) {
        return "detail updated successfully.";
    } else {
        return "Failed to update Detail.";
    }
}

// Usage example
if (isset($_POST['update-function'])) {
    $id= $_GET['id']; // assuming id is sent via GET
    $comfirmation = $_POST['comfirmation'];

    $result = updateUser($connect, $id , $comfirmation);
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }
    header("Location: invSubmittionReport.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Update assignedBooklets</title>
    <!-- Favicon icon -->
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>



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
                            <li><a href="./assignedScriptsV1.php">Back-now</a></li>
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
                            <h4>Comfirm AssignedBooklets</h4>
                                <!-- Success message -->
 
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                                <div class="basic-form">
                                    <form class="form-inline" action="" method="POST">
                                    <?php
                $select = "select * from overallinvigilationreport where id = '" .$_GET['id']. "'";
                $result = mysqli_query($connect, $select);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="form-row">
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="day" >Invigilator ID</label>
                                                <input name="user_id" value="<?php echo $row['user_id']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="School" >School ID</label>
                                                 <input name="school_id" value="<?php echo $row['school_id']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                          <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="form-row">
    
                                          <div class="col-sm-6 mt-2 mt-sm-0">
                                          <label for="ended_at" >courseCode</label>
                                                <input name="courseCode" value="<?php echo $row['courseCode']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="program" >Program</label>
                                                 <input name="program" value="<?php echo $row['program']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="form-row">
    
                                          <div class="col-sm-6 mt-2 mt-sm-0">
                                          <label for="totalStudents" >Total students</label>
                                                <input name="totalStudents" value="<?php echo $row['totalStudents']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="bookletsUsed" >Booklets used</label>
                                                 <input name="bookletsUsed" value="<?php echo $row['bookletsUsed']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="form-row">
    
                                          <div class="col-sm-6 mt-2 mt-sm-0">
                                          <label for="unUsedBooklets" >Unused Booklets</label>
                                                <input name="unUsedBooklets" value="<?php echo $row['unUsedBooklets']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="usedScripts" >Used Scripts</label>
                                                 <input name="usedScripts" value="<?php echo $row['usedScripts']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="form-row">
    
                                          <div class="col-sm-12 mt-2 mt-sm-0">
                                          <label for="unUsedBooklets" >Unused Scripts</label>
                                                <input name="unUsedScripts" value="<?php echo $row['unUsedScripts']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                           <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="form-row">
    
                                          <div class="col-sm-6 mt-2 mt-sm-0">
                                          <label for="totalStudents" >Description</label>
                                                <input name="description" value="<?php echo $row['description']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="bookletsUsed" >Comfirm here</label>
                                                 <select type="text" name="comfirmation" class="form-control">
                                          <option value="None-user">--Selct-----to Comfirm--------</option>
                                          <option value="comfirmed">Comfirm</option>
                                          <option value="Not-comfirmation">Not-Comfirm</option>
                               
                                           </select>
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>


                        
                    <?php }}?>
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                        <button id="form_submit" type="submit" class="btn btn-dark"  name="update-function" style="background-color:#032B58" >Comfirm<i class="ti-arrow-right"></i></button>
                                        <span> <button type="button" class="btn btn-primary mb-2"><a href="./invSubmittionReport.php" style="color:white">Cancel</button></a></span>
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