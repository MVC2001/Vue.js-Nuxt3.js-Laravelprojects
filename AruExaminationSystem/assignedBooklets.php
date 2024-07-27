<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'examination_coordinator') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BookletDetails</title>
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
        <!-- Header end -->

        <!-- Sidebar start -->
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
        <!-- Sidebar end -->

        <!-- Content body start -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Assigned Booklets Information Here</h4>
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
                                        <thead style="color:white;background-color:#032B58">
                                            <tr>
                                                <th style="color:white">No#</th>
                                            
                                                <th style="color:white">Quantity</th>
                                                <th style="color:white">Description</th>
                                                <th style="color:white">Comfirmation</th>
                                                <th style="color:white">Given At</th>
                                                <th style="color:white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color:#032B58">
                                            <?php 
                                            $count = 1;
                                            $user_id = $_SESSION['user_id']; // Assign session variable to a PHP variable
                                            $select_all = "SELECT assignedbooklets.booklet_id, assignedbooklets.user_id, assignedbooklets.school_id, assignedbooklets.department_id, assignedbooklets.quantity, assignedbooklets.description, assignedbooklets.confirmation, assignedbooklets.created_at, users.user_id 
                                                           FROM assignedbooklets 
                                                           JOIN users ON assignedbooklets.user_id = users.user_id 
                                                           WHERE assignedbooklets.user_id = '$user_id' 
                                                           ORDER BY booklet_id DESC";
                                            $result = mysqli_query($connect, $select_all);
                                            $number = mysqli_num_rows($result);
                                            if ($number > 0) {
                                                while($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><?php echo $count ?></td>
                                                        
                                                        <td><button class="btn btn-primary"><?php echo $row['quantity']; ?></button></td>
                                                        <td><?php echo $row['description']; ?></td>
                                                        <td><button class="btn btn-success"><?php echo $row['confirmation']; ?></button></td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        <td><a href="comfirmAssignedBooklets.php?booklet_id=<?php echo $row['booklet_id'] ?>"><button class="btn btn" style="background-color:#273D55">Comfirm</button></a></td>
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
