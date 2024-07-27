<?php
include("./connection/include.php");
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'quality_assurance_officer') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

function updateUser($connect,$id,$evaluatorsName,$date,$courseCode,$program,$reasonFor,$venueNo,$NoOfAdmittedStudents,$examsRoomCapacity,$name,$invRank,$allStudentsIdentifiedAtEntry,$studentsFoundWithId,$studentsFoundWithExpiredId,$studentsFoundWithForgedId,$studentsFoundWithoutARUId,$studentsFoundWithpRPdUPpermission,$studentsFoundWithPoliceReport,$reasonForQualityAssessment,$restrictionOfUnauthorizedMaterial,$wereCorrectionsMadeToExamsPaper,$commitmentOfInv,$generalConductOfUE,$godOrBadOnPracticesObserved,$recommendation,$sittingArrOfStudents,$chairsAndTables,$roomVentilation) {
    
    // Update funt in the database
    $updateQuery = mysqli_query($connect, "UPDATE `allquestionnairesdetails` SET  `evaluatorsName`='$evaluatorsName',`date`='$date',`courseCode`='$courseCode',`program`='$program',`reasonFor`='$reasonFor',`venueNo`='$venueNo',`NoOfAdmittedStudents`='$NoOfAdmittedStudents',`examsRoomCapacity`='$examsRoomCapacity',`name`='$name',`invRank`='$invRank',`allStudentsIdentifiedAtEntry`='$allStudentsIdentifiedAtEntry',`studentsFoundWithId`='$studentsFoundWithId',`studentsFoundWithExpiredId`='$studentsFoundWithExpiredId',`studentsFoundWithForgedId`='$studentsFoundWithForgedId',`studentsFoundWithoutARUId`='$studentsFoundWithoutARUId',`studentsFoundWithpRPdUPpermission`='$studentsFoundWithpRPdUPpermission',`studentsFoundWithPoliceReport`='$studentsFoundWithPoliceReport',`reasonForQualityAssessment`='$reasonForQualityAssessment',`restrictionOfUnauthorizedMaterial`='$restrictionOfUnauthorizedMaterial',`wereCorrectionsMadeToExamsPaper`='$wereCorrectionsMadeToExamsPaper',`commitmentOfInv`='$commitmentOfInv',`generalConductOfUE`='$generalConductOfUE',`godOrBadOnPracticesObserved`='$godOrBadOnPracticesObserved',`recommendation`='$recommendation',`sittingArrOfStudents`='$sittingArrOfStudents',`chairsAndTables`='$chairsAndTables',`roomVentilation`='$roomVentilation' WHERE `id`='$id'");
    if ($updateQuery) {
        return "Booklets detail updated successfully.";
    } else {
        return "Failed to update bookletsDetail.";
    }
}

// Usage example
if (isset($_POST['update-function'])) {
    $id = $_GET['id'];
    $evaluatorsName = $_POST['evaluatorsName'];
    $date = $_POST['date'];
    $courseCode = $_POST['courseCode'];
    $program = $_POST['program'];
    $reasonFor = $_POST['reasonFor'];
     $venueNo = $_POST['venueNo'];
      $NoOfAdmittedStudents = $_POST['NoOfAdmittedStudents'];
       $examsRoomCapacity = $_POST['examsRoomCapacity'];
        $name = $_POST['name'];
         $invRank = $_POST['invRank'];
          $allStudentsIdentifiedAtEntry = $_POST['allStudentsIdentifiedAtEntry'];
           $studentsFoundWithId = $_POST['studentsFoundWithId'];
            $studentsFoundWithExpiredId = $_POST['studentsFoundWithExpiredId'];
             $studentsFoundWithForgedId = $_POST['studentsFoundWithForgedId'];
             $studentsFoundWithoutARUId = $_POST['studentsFoundWithoutARUId'];
             $studentsFoundWithpRPdUPpermission = $_POST['studentsFoundWithpRPdUPpermission'];
             $studentsFoundWithPoliceReport = $_POST['studentsFoundWithPoliceReport'];
             $reasonForQualityAssessment = $_POST['reasonForQualityAssessment'];
             $restrictionOfUnauthorizedMaterial = $_POST['restrictionOfUnauthorizedMaterial'];
             $wereCorrectionsMadeToExamsPaper = $_POST['wereCorrectionsMadeToExamsPaper'];
              $commitmentOfInv = $_POST['commitmentOfInv'];
               $generalConductOfUE = $_POST['generalConductOfUE'];
                $godOrBadOnPracticesObserved = $_POST['godOrBadOnPracticesObserved'];
                 $recommendation = $_POST['recommendation'];
                  $sittingArrOfStudents = $_POST['sittingArrOfStudents'];
                   $chairsAndTables = $_POST['chairsAndTables'];
                    $roomVentilation = $_POST['roomVentilation'];

    //update function
    $result = updateUser($connect,$id,$evaluatorsName,$date,$courseCode,$program,$reasonFor,$venueNo,$NoOfAdmittedStudents,$examsRoomCapacity,$name,$invRank,$allStudentsIdentifiedAtEntry,$studentsFoundWithId,$studentsFoundWithExpiredId,$studentsFoundWithForgedId,$studentsFoundWithoutARUId,$studentsFoundWithpRPdUPpermission,$studentsFoundWithPoliceReport,$reasonForQualityAssessment,$restrictionOfUnauthorizedMaterial,$wereCorrectionsMadeToExamsPaper,$commitmentOfInv,$generalConductOfUE,$godOrBadOnPracticesObserved,$recommendation,$sittingArrOfStudents,$chairsAndTables,$roomVentilation);
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }
    header("Location: all_questionnairesDetails.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Update QuestionnaireDetails</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
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
                            <li><a href="./all_questionnairesDetails.php">Back-now</a></li>
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
                            <h4>Edit info  here</h4>
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
                $select = "select * from allquestionnairesdetails where id  = '" .$_GET['id']. "'";
                $result = mysqli_query($connect, $select);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="evaluatorsName">EvaluatorsName</label>
                                                <input name="evaluatorsName" value="<?php echo $row['evaluatorsName']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="date">Date</label>
                                                <input name="date" value="<?php echo $row['date']; ?>" required type="text"  class="form-control" placeholder="">
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
                                            <label for="courseCode">CourseCode</label>
                                                <input name="courseCode" value="<?php echo $row['courseCode']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="program">Program</label>
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
                                             <div class="col-sm-12 mt-2 mt-sm-0">
                                             <label for="reasonFor">ReasonFor</label>
                                                <input name="reasonFor" value="<?php echo $row['reasonFor']; ?>" required type="text"  class="form-control" placeholder="">
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
                                            <label for="examsRoomCapacity">Room Capacity</label>
                                                <input name="examsRoomCapacity" value="<?php echo $row['examsRoomCapacity']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="name">Invigilator Name</label>
                                                <input name="name" value="<?php echo $row['name']; ?>" required type="text" class="form-control" placeholder="">
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
                                            <label for="invRank">Invigilator Rank</label>
                                                <input name="invRank" value="<?php echo $row['invRank']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="allStudentsIdentifiedAtEntry">All students aere identified at Entry?</label>
                                                <input name="allStudentsIdentifiedAtEntry" value="<?php echo $row['allStudentsIdentifiedAtEntry']; ?>" required type="text" class="form-control" placeholder="">
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
                                            <label for="studentsFoundWithId">Students found with ID</label>
                                                <input name="studentsFoundWithId" value="<?php echo $row['studentsFoundWithId']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="studentsFoundWithExpiredId">With WithExpired ID</label>
                                                <input name="studentsFoundWithExpiredId" value="<?php echo $row['studentsFoundWithExpiredId']; ?>" required type="text" class="form-control" placeholder="">
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
                                            <label for="studentsFoundWithForgedId">Students found with Forged ID</label>
                                                <input name="studentsFoundWithForgedId" value="<?php echo $row['studentsFoundWithForgedId']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="studentsFoundWithoutARUId">Without ARU ID </label>
                                                <input name="studentsFoundWithoutARUId" value="<?php echo $row['studentsFoundWithoutARUId']; ?>" required type="text" class="form-control" placeholder="">
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
                                            <label for="studentsFoundWithpRPdUPpermission">Students found with PRP/DUP permission</label>
                                                <input name="studentsFoundWithpRPdUPpermission" value="<?php echo $row['studentsFoundWithpRPdUPpermission']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="studentsFoundWithPoliceReport">With Police report </label>
                                                <input name="studentsFoundWithPoliceReport" value="<?php echo $row['studentsFoundWithPoliceReport']; ?>" required type="text" class="form-control" placeholder="">
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
                                            <label for="reasonForQualityAssessment">Reason for quality Assessment</label>
                                                <input name="reasonForQualityAssessment" value="<?php echo $row['reasonForQualityAssessment']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="restrictionOfUnauthorizedMaterial">Restriction of Unauthorized material</label>
                                                <input name="restrictionOfUnauthorizedMaterial" value="<?php echo $row['restrictionOfUnauthorizedMaterial']; ?>" required type="text" class="form-control" placeholder="">
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
                                            <label for="wereCorrectionsMadeToExamsPaper">Were correction made to exams paper</label>
                                                <input name="wereCorrectionsMadeToExamsPaper" value="<?php echo $row['wereCorrectionsMadeToExamsPaper']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="commitmentOfInv">Commitment of invigilator</label>
                                                <input name="commitmentOfInv" value="<?php echo $row['commitmentOfInv']; ?>" required type="text" class="form-control" placeholder="">
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
                                            <label for="generalConductOfUE">General conduct of UE</label>
                                                <input name="generalConductOfUE" value="<?php echo $row['generalConductOfUE']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="godOrBadOnPracticesObserved">comment on good/bad practice</label>
                                                <input name="godOrBadOnPracticesObserved" value="<?php echo $row['godOrBadOnPracticesObserved']; ?>" required type="text" class="form-control" placeholder="">
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
                                            <label for="sittingArrOfStudents">Sitting arragement of students</label>
                                                <input name="sittingArrOfStudents" value="<?php echo $row['sittingArrOfStudents']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="chairsAndTables">Chairs and table</label>
                                                <input name="chairsAndTables" value="<?php echo $row['chairsAndTables']; ?>" required type="text" class="form-control" placeholder="">
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
                                            <label for="roomVentilation">Room ventillation</label>
                                                <input name="roomVentilation" value="<?php echo $row['roomVentilation']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="recommendation">recommendation</label>
                                                <input name="recommendation" value="<?php echo $row['recommendation']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>



                    <?php }}?>
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                        <button id="form_submit" type="submit" class="btn btn-dark"  name="update-function" style="background-color:#032B58" >Edit<i class="ti-arrow-right"></i></button>
                                        <span><button type="button" class="btn btn-primary mb-2"><a href="./all_questionnairesDetails.php" style="color:white">Cancel</button></a></span>
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
