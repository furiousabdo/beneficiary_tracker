@extends('layouts.app')
@section('title', 'Add Association')
@section('content')
<div class="form-card">
    <h2 class="form-title">Add New Association</h2>
    <form action="{{ route('associations.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="form-group">
            <label for="name">Association Name <span class="req">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus placeholder="e.g. Red Crescent">
            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Add Association</button>
            <a href="{{ route('associations.index') }}" class="btn btn-back">&#8592; Back to Associations</a>
        </div>
    </form>
</div>
@endsection 