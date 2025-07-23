@extends('layouts.app')
@section('title', 'Association Details')
@section('content')
<div class="card">
    <h2 style="font-size:1.5rem;font-weight:600;margin-bottom:1.2rem;">Association Details</h2>
    <p><strong>ID:</strong> {{ $association->id }}</p>
    <p><strong>Name:</strong> {{ $association->name }}</p>
    <div style="margin-top:2rem;">
        <a href="{{ route('associations.edit', $association) }}" class="btn btn-secondary">Edit</a>
        <a href="{{ route('associations.index') }}" class="btn btn-back">&#8592; Back to Associations</a>
    </div>
</div>
@endsection 