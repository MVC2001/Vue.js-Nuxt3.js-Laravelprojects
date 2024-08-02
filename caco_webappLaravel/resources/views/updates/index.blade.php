<!-- resources/views/updates/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Updates</h2>
        <a class="btn btn-success" href="{{ route('updates.create') }}"> Create New Update</a>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Comment</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($updates as $update)
                <tr>
                    <td>{{ $update->id }}</td>
                    <td><img src="{{ asset('images/' . $update->image) }}" alt="Update Image" style="max-width: 100px;"></td>
                    <td>{{ $update->comment }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('updates.edit', $update->id) }}">Edit</a>
                        <form action="{{ route('updates.destroy', $update->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
