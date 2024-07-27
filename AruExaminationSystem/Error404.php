
<?php
session_start();
include("./connection/include.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>

    <div class="d-flex justify-content-center" style="margin-top:160px">
        <div class="card text-center" style="width: 18rem;">
            <div class="card-header" style="background-color: #032B58; color: white;marin-left:20px">
            <h4 style="margin-left:70px;color:white">Guest User</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">Status Code: 403</h5>
                <p class="card-text">You are a guest user, not a full user. Contact us at <a href="tel:+255682131140">+255682131140</a>.</p>
                <br>
                <button class="btn btn-dark btn-block" style="width:150px;background-color:#032B58;margin-left:50px"><a href="./index.php">Home</a></button>
            </div>
        </div>
    </div>

</body>

</html>
