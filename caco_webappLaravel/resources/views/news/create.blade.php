
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

<div class="container" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;height:500px">
    <h2>Create New Update</h2>
    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn" style="color:white;background-color: #1c5593;width:240px">Create</button>
    </form>
</div>
@endsection

</div>



    <!-- Bootstrap JS Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
