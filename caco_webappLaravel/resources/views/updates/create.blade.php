<!-- resources/views/updates/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Update</h2>
        <form action="{{ route('updates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" id="comment" name="comment" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
