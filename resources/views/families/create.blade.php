@extends('layouts.app')
@section('title', 'Add Family')
@section('content')
<div class="form-card">
    <h2 class="form-title">Add New Family</h2>
    <form action="{{ route('families.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="form-group">
            <label for="family_name">Family Name <span class="req">*</span></label>
            <input type="text" name="family_name" id="family_name" value="{{ old('family_name') }}" required autofocus placeholder="e.g. Al-Sayed Family">
            @error('family_name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Add Family</button>
            <a href="{{ route('families.index') }}" class="btn btn-back">&#8592; Back to Families</a>
        </div>
    </form>
</div>
@endsection 