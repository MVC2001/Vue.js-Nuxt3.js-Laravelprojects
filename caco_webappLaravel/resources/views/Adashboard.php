<?php
session_start();
include("./Config/connection.php");
if (!isset($_SESSION['user_id'])) {
  header('location:unauthorized.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 56px; /* Adjusted for the fixed navbar height */
        }

        @media (min-width: 768px) {
            body {
                padding-top: 0;
            }
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #f8f9fa;
            padding-top: 3.5rem; /* Adjusted for the fixed navbar height */
            transition: margin-left 0.3s;
        }

        .content {
            margin-left: 250px;
            padding: 15px;
        }
    </style>
    <title>Admin dashboard</title>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg   fixed-top" style="background-color: #2874a6;color: white;box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;;">
        <div class="container-fluid text-white">
            <a class="navbar-brand" href="#">CACO-ADMIN DASHBOARD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Administrator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #d6eaf8;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
        <ul class="nav flex-column" style="margin-top: 80px;">
            <li class="nav-item">
                <a class="nav-link" href="#" style="color:#17202a;">Your Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" style="color:#17202a;">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" style="color:#17202a;">Employees</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" style="color:#17202a;">Subscibes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" style="color:#17202a;">CACO updates</a>
            </li>
        </ul>
    </div>

    <!-- Page Content -->
    <div class="content">
        <h2>Main Content</h2>
       <div class="container text-center" style="margin-top: 60px;">
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="background-color: #d6eaf8;height: 130px;width: 200px;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;;">
                    <h4> <br>Users</h4>
                    <hr>
                    677
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="background-color: #d6eaf8;height: 130px;width: 200px;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;;">
                    <h4><br>Subscibes</h4>
                    <hr>
                       456
                   </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="background-color: #d6eaf8;height: 130px;width: 200px;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;;">
                    <h4><br>Employes</h4>
                    <hr>
                       8775
                   </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="background-color: #d6eaf8;height: 130px;width: 200px;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;;">
                    <h4><br>Updates</h4>
                    <hr>
                    7875
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 40px;">
            <div class="col-md-12">
                <div class="card" style="height:95px;background-color: #d6eaf8 ;width:98%;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;;">
                    <center><h4>Comments</h4></center>
                    <hr>
                    5666
                </div>
            </div>
        </div>
       </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
