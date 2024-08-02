<?php
session_start();
include './connection/include.php';

$errorMessage = ''; // Initialize error message variable

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Disable the login button
    echo '<script>document.getElementById("loginBtn").disabled = true;</script>';

    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'") or die(mysqli_connect_error());
    $fetch = mysqli_fetch_array($query);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
        $_SESSION['user_id'] = $fetch['user_id'];
        $_SESSION['role'] = $fetch['role'];
        $role = $fetch['role'];
        $School = $fetch['School'];

        // Redirect based on role
        $redirectUrl = '';
        switch ($role) {
            case 'admin':
                $redirectUrl = 'dashboard.php';
                break;
            case 'exams_administrator_manager':
                $redirectUrl = 'EAM.php';
                break;
            case 'examination_coordinator':
                $redirectUrl = 'EC_dashboard.php';
                break;
            case 'quality_assurance_officer':
                $redirectUrl = 'QAO_dashboard.php';
                break;
            case 'invigilator':
                $redirectUrl = 'Inv_dashboard.php';
                break;
            case 'examiner':
                $redirectUrl = 'examiner.php';
                break;
            default:
                $redirectUrl = 'gestPage.php';
                break;
        }

        // Redirect to appropriate page
        echo "<script>alert('You are Successfully logged in'); window.location='$redirectUrl';</script>";
        exit;
    } else {
        $errorMessage = "Wrong! invalid username or password";
    }

    // Re-enable the login button
    echo '<script>document.getElementById("loginBtn").disabled = false;</script>';
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css" rel="stylesheet">
</head>

<body class="h-100">

<div class="container" style="background-color:#032B58;height:100px;margin-top:40px;box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;"><br>
 <h4 class="text-center mb-4" style="color:white;font-size:35px">ARU EXAMINATION MANAGEMENT SYSTEM</h4>
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                            <br>
                                <div class="auth-form">
                                    <?php if (!empty($errorMessage)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $errorMessage; ?>
                                    </div>
                                    <?php } ?>
                                    <div class="card">
                                    <div class="card-header text-center" style="background-color:#032B58">
                                    <h4 class="text-center mb-4"><img class="logo-abbr shadow-lg" src="./assets/images/aruLogo.png" alt="" style="height:50px;width:70px;margin-left:150px"></h4>
                                    </div>
                                    <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" name="email" required class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" required value="">
                                        </div>
                                        
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="login" id="loginBtn" class="btn btn-secondary btn-block" style="background-color:#032B58">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                            Login</button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="./register.php">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Add JavaScript to show spinner on button click -->
    <script>
        $(document).ready(function(){
            $('form').submit(function(){
                // Show spinner when form is submitted
                $('#loginBtn').find('span').show();
            });
        });
    </script>
</body>

</html>
