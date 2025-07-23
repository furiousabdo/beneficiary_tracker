@extends('layouts.app')
@section('title', 'Edit Family')
@section('content')
    <h1>Edit Family</h1>
    <form action="{{ route('families.update', $family) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="family_name">Family Name:</label>
        <input type="text" name="family_name" id="family_name" value="{{ $family->family_name }}">
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('families.index') }}">Back to Families</a>
@endsection 