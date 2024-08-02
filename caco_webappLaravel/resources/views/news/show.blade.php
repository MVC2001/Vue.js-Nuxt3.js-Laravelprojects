
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
@extends('layouts.app')
@section('content')

   <!-- Sidebar -->
    <div class="sidebar" style="margin-top:70px;background-color: #d6eaf8;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
        <hr>
         <ul class="nav flex-column" style="margin-top: 80px;">
            <li class="nav-item">
                <a class="nav-link" href="/home" style="color:#17202a;">Back home</a>
            </li>
        </ul>
    </div>

    <!-- Page Content -->
    <div class="content">

<div class="container">
<div class="row">
<div class="col-md-6">
<div class="card" style="width:800px;height:800px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
<hr>
 <div style="margin-left:320px">
        <strong>Title:</strong> {{ $news->title }}
    </div>
    <hr>
<div style="margin-left:250px">
     @if($news->image)
            <img src="{{ asset('images/news/' . $news->image) }}" alt="News Image" style="max-width: 300px;">
        @else
            No Image
        @endif
        </div>
        <div style="margin-top:30px;margin-left:120px;">
       <strong>Comment:</strong><p style="box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset;">{{ $news->content }}</p>
        <div>
</div>
<div>
<div>
</div>
@endsection
    </div>


    <!-- Bootstrap JS Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

