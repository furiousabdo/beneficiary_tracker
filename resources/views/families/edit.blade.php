@extends('layouts.app')
@section('title', 'Edit Family')
@section('content')
<div class="form-card">
    <h2 class="form-title">Edit Family</h2>
    <form action="{{ route('families.update', $family) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="family_name">Family Name <span class="req">*</span></label>
            <input type="text" name="family_name" id="family_name" value="{{ old('family_name', $family->family_name) }}" required autofocus>
            @error('family_name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Family</button>
            <a href="{{ route('families.index') }}" class="btn btn-back">&#8592; Back to Families</a>
        </div>
    </form>
</div>
@endsection 