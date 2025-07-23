@extends('layouts.app')
@section('title', 'Edit Association')
@section('content')
    <h1>Edit Association</h1>
    <form action="{{ route('associations.update', $association) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $association->name }}" required>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('associations.index') }}">Back to Associations</a>
@endsection 