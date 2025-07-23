@extends('layouts.app')
@section('title', 'Family Details')
@section('content')
    <h1>Family Details</h1>
    <p><strong>ID:</strong> {{ $family->id }}</p>
    <p><strong>Name:</strong> {{ $family->family_name }}</p>
    <a href="{{ route('families.edit', $family) }}">Edit</a> |
    <a href="{{ route('families.index') }}">Back to Families</a>
@endsection 