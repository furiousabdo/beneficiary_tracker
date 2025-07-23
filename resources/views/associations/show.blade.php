@extends('layouts.app')
@section('title', 'Association Details')
@section('content')
    <h1>Association Details</h1>
    <p><strong>ID:</strong> {{ $association->id }}</p>
    <p><strong>Name:</strong> {{ $association->name }}</p>
    <a href="{{ route('associations.edit', $association) }}">Edit</a> |
    <a href="{{ route('associations.index') }}">Back to Associations</a>
@endsection 