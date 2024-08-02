<!-- resources/views/updates/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Update</h2>
        <form action="{{ route('updates.update', $update->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" id="comment" name="comment" required>{{ $update->comment }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
