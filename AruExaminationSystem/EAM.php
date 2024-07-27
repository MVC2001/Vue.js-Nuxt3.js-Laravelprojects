<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'exams_administrator_manager') {
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
    <title>E-Adm-Manager </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
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
            <a href="#" class="brand-logo">
                <img class="logo-abbr" src="./assets/images/aruLogo.png" alt="">
            </a>

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
                            <div class="search_bar dropdown">
                                <div class="dropdown-menu p-0 m-0">
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <b>Welcome: </b><a class="nav-link" href="#" role="button" data-toggle="dropdown" style="color:white">
                                    <?php   $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                                   $fetch = mysqli_fetch_array($query);
                                  echo "" . $fetch['email'] . " "; ?><i class="mdi mdi-account"></i>
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
                   
                    <li class="nav-label"></li>
                    <hr>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">Reset-Password</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./resertPasswordv1c.php">Resert</a></li>
                        </ul>
                    </li>
                     <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">assignBooklets</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./allBookletsInfo.php">Manage</a></li>
                        </ul>
                    </li>

                     <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">assignScripts</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./assgignedScripts.php">Manage</a></li>
                        </ul>
                    </li>

                   <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">Invigilators</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./Inv_lists.php">View</a></li>
                        </ul>
                    </li>
                    


                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">Exams-Coordinators</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./exams_lists.php">View</a></li>
                        </ul>
                    </li>


                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">QualityAssu-Officers</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./qualtiyAssu.php">View</a></li>
                        </ul>
                    </li>
                    
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">QuestionnaireDetails</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./allQuestionnaireDetils.php">View</a></li>
                        </ul>
                    </li>

                     <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-hand-o-right"></i><span class="nav-text">InvigilationReports</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./overAllInvigilatinReportV1.php">View</a></li>
                        </ul>
                    </li>
        
                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Invigilators</div>
                                      <?php
                           $countv = mysqli_query($connect,"select user_id from users where role='invigilator'") or die(mysqli_error($connect));
                                $countv = mysqli_num_rows($countv);
                                    if(empty($countv) >= 0){  ?>
                                    <div class="stat-digit"> <i class="fa fa-dashboard"></i><?php echo $countv;?></div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">ExamsCoordinators</div>
                                     <?php
                           $count = mysqli_query($connect,"select user_id from users where role='examination_coordinator'") or die(mysqli_error($connect));
                                $count = mysqli_num_rows($count);
                                    if(empty($count) >= 0){  ?>
                                    <div class="stat-digit"> <i class="fa fa-dashboard"></i><?php echo $count;?></div>
                                     <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Q.A-Officers</div>
                                      <?php
                           $countv1 = mysqli_query($connect,"select user_id from users where role='quality_assurance_officer'") or die(mysqli_error($connect));
                                $countv1 = mysqli_num_rows($countv1);
                                    if(empty($countv1) >= 0){  ?>
                                    <div class="stat-digit"> <i class="fa fa-dashboard"></i><?php echo $countv1;?></div>
                                     <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">QuestionnaireDetails</div>
                                    <div class="stat-digit"> 
                                      <?php
                           $countv1 = mysqli_query($connect,"select id from allquestionnairesdetails") or die(mysqli_error($connect));
                                $countv1 = mysqli_num_rows($countv1);
                                    if(empty($countv1) >= 0){  ?>
                                    <div class="stat-digit"> <i class="fa fa-dashboard"></i><?php echo $countv1;?></div>
                                     <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <div style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;height:14px;background-color:#032B58;width:100%;border-radius:10px"></div>
                    <!-- /# column -->
                </div></div>
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


    <!-- Vectormap -->
    <script src="./vendor/raphael/raphael.min.js"></script>
    <script src="./vendor/morris/morris.min.js"></script>


    <script src="./vendor/circle-progress/circle-progress.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="./vendor/gaugeJS/dist/gauge.min.js"></script>

    <!--  flot-chart js -->
    <script src="./vendor/flot/jquery.flot.js"></script>
    <script src="./vendor/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="./vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="./vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="./vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="./vendor/jquery.counterup/jquery.counterup.min.js"></script>


    <script src="./js/dashboard/dashboard-1.js"></script>

</body>

</html>