@extends('layouts.app')
@section('title', 'Family Details')
@section('content')
<div class="card">
    <h2 style="font-size:1.5rem;font-weight:600;margin-bottom:1.2rem;">Family Details</h2>
    <p><strong>ID:</strong> {{ $family->id }}</p>
    <p><strong>Name:</strong> {{ $family->family_name }}</p>
    <div style="margin-top:2rem;">
        <a href="{{ route('families.edit', $family) }}" class="btn btn-secondary">Edit</a>
        <a href="{{ route('families.index') }}" class="btn btn-back">&#8592; Back to Families</a>
    </div>
</div>
@endsection 