@extends('layouts.app')
@section('title', 'Edit Association')
@section('content')
<div class="form-card">
    <h2 class="form-title">Edit Association</h2>
    <form action="{{ route('associations.update', $association) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Association Name <span class="req">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $association->name) }}" required autofocus>
            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Association</button>
            <a href="{{ route('associations.index') }}" class="btn btn-back">&#8592; Back to Associations</a>
        </div>
    </form>
</div>
@endsection 