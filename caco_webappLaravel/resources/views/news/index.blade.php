
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
    <h2>CACO UPDATES</h2>
    <a href="{{ route('news.create') }}" class="btn" style="color:white;background-color: #1c5593;width:240px">Create New Update</a>
    <table class="table mt-3 table-striped" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->content }}</td>
                <td>
                    @if($item->image)
                        <img src="{{ asset('images/news/' . $item->image) }}" alt="News Image" style="max-width: 100px;">
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    <a href="{{ route('news.show', $item->id) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('news.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('news.destroy', $item->id) }}" method="post" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

    </div>


    <!-- Bootstrap JS Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

