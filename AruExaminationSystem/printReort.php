<?php
include("./connection/include.php");
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'exams_administrator_manager') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

// Function to update the confirmation status
function updateUser($connect, $script_id, $confirmation) {
    $updateQuery = mysqli_query($connect, "UPDATE `assignedscripts` SET `confirmation`='$confirmation' WHERE `script_id`='$script_id'");
    if ($updateQuery) {
        return "Detail updated successfully.";
    } else {
        return "Failed to update detail.";
    }
}

// Handle the form submission for date range filtering
$from_date = '';
$to_date = '';
$result = null;
if (isset($_POST['search'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    // Fetch data based on the date range
    $select_all_users = "SELECT * FROM `invigilation_reportv1` WHERE created_at BETWEEN '$from_date' AND '$to_date' ORDER BY id DESC";
    $result = mysqli_query($connect, $select_all_users);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Assigned Booklets Report</title>
    <link href="./css/style.css" rel="stylesheet">
    <style>
        .print-button, .search-form { display: block; }
        @media print {
            .print-button, .search-form { display: none; }
            table { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <div id="container" style="margin-top:40px">
        <!-- Navigation and Header omitted for brevity -->

        <!-- Search Form -->
        <form method="POST" action="" class="search-form">
            <div class="row">
                <div class="col-md-5">
                    <input type="date" name="from_date" class="form-control" value="<?php echo $from_date; ?>" required>
                </div>
                <div class="col-md-5">
                    <input type="date" name="to_date" class="form-control" value="<?php echo $to_date; ?>" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <!-- Data Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="display table-bordered" style="width:100%; margin: auto;">
                        <thead style="color:white;background-color:#032B58">
                            <tr>
                                <th style="color:white">No#</th>
                                <th style="color:white">Full Name</th>
                                <th style="color:white">ExamsCoord ID</th>
                                <th style="color:white">School ID</th>
                                <th style="color:white">Department ID</th>
                                <th style="color:white">CourseCode</th>
                                <th style="color:white">Program</th>
                                <th style="color:white">Total Students</th>
                                <th style="color:white">Booklets Used</th>
                                <th style="color:white">Unused Booklets</th>
                                <th style="color:white">Scripts Used</th>
                                <th style="color:white">Unused Scripts</th>
                                <th style="color:white">Description</th>
                                <th style="color:white">Confirmation</th>
                                <th style="color:white">Created At</th>
                            </tr>
                        </thead>
                        <tbody style="color:#032B58">
                        <?php 
                            if ($result && mysqli_num_rows($result) > 0) {
                                $count = 1;
                                while($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $row['fullName']; ?></td>
                                        <td><?php echo $row['user_id']; ?></td>
                                        <td><?php echo $row['school_id']; ?></td>
                                        <td><?php echo $row['department_id']; ?></td>
                                        <td><?php echo $row['courseCode']; ?></td>
                                        <td><?php echo $row['program']; ?></td>
                                        <td><?php echo $row['totalStudentsDo_exams']; ?></td>
                                        <td><?php echo $row['bookletsUsed']; ?></td>
                                        <td><?php echo $row['unUsedBooklets']; ?></td>
                                        <td><?php echo $row['scriptsUsed']; ?></td>
                                        <td><?php echo $row['unUsedScripts']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                        <td><button class="btn btn-success"><?php echo $row['comfirmation']; ?></button></td>
                                        <td><?php echo $row['created_at']; ?></td>
                                    </tr>
                                    <?php $count++; ?>
                                <?php } 
                            } else { ?>
                                <tr><td colspan="16">No records found</td></tr>
                            <?php } ?>
                        </tbody>             
                    </table>
                </div>
                <button onclick="printReport()" class="btn btn-primary print-button">Print Report</button>
                
            </div>
        </div>
    </div>

    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <script>
        function printReport() {
            window.print();
        }
    </script>
</body>
</html>
