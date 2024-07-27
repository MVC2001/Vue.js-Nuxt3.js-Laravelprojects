<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'examination_coordinator') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

//delete logic 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if id is set and not empty
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        
        // Delete the user from the database
        $deleteQuery = mysqli_query($connect, "DELETE FROM `invigilationdetail` WHERE `id` = $id");
        
        if ($deleteQuery) {
            // 	booklet_id deleted successfully
            header('Location: invigilationDetails.php'); // Redirect to 	invigilationDetails
            exit();
        } else {
            // Error deleting user
            echo "Error delete invigilationDetails.";
        }
    } else {
        // user_id not set or empty
        echo "Invalid 	id.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Invigilation details </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
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
                                class="fa fa-hand-o-right" style="background-color:#273D55"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./EC_dashboard.php">Back-now</a></li>
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
                            <h4 style="color:#032B58">Invigilation details here</h4>
                        </div>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                   
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-dark btn-block" style="width:150px;background-color:#032B58"><a href="addInvigilationDetail.php">Add-New-Detail</a></button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                               <th>No#</th>
                                                <th>Day</th>
                                                <th>Starded_AT</th>
                                                <th>Ended_AT</th>
                                                <th>Venue</th>
                                                <th>TotalStudents</th>
                                                <th>BookletsUsed</th>
                                                <th>UnUsedBooklets</th>
                                                <th>Description</th>
                                                <th>School</th>
                                                <th>Department</th>
                                                <th>Program</th>
                                                <th>CourseCode</th>
                                                <th>Invigilator</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                         <?php 
                 $count=1;
                 $select_all = "SELECT * FROM `invigilationdetail` ORDER BY id DESC";
                 $result = mysqli_query($connect,$select_all);
                 $number = mysqli_num_rows($result);
                 if ($number > 0) {
                     while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                            <td><?php echo $count ?></td>
                                <td><?php echo $row['day']; ?></td>
                                <td><?php echo $row['started_at']; ?></td>
                                <td><?php echo $row['ended_at']; ?></td>
                                    <td><?php echo $row['venueNo']; ?></td>
                                      <td><?php echo $row['totalStudents']; ?></td>
                                      <td><?php echo $row['bookletsUsed']; ?></td>
                                       <td><?php echo $row['unUsed']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                         <td><?php echo $row['School']; ?></td>
                                          <td><?php echo $row['Dept']; ?></td>
                                           <td><?php echo $row['program']; ?></td>
                                            <td><?php echo $row['courseCode']; ?></td>
                                             <td><?php echo $row['fullName']; ?></td>
                                       <td><?php echo $row['created_at']; ?></td>
                                <td>
                                    <a href="updateInvDetail.php?id=<?php echo $row['id'] ?>">
                                    <button class="btn btn-warning btn-sm">
                                    <i class="fa fa-pencil"></i></button> </a>
                                    <span>
                                    <td>
                                    <form action="" method="POST">
                                       <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                 <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this detail?')">
                                  <i class="fa fa-trash"></i>
                              </button>
                            </form>
</td>

                                    </span>
                                </td>
                            </tr>
                            <?php $count++?>
                        <?php }} ?>
                                        </tbody>             
                                    </table>
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
    


    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

</body>

</html>