@extends('layouts.app')
@section('title', 'Edit Beneficiary')
@section('content')
<div class="form-card">
    <h2 class="form-title">Edit Beneficiary</h2>
    <form action="{{ route('beneficiaries.update', $beneficiary) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name <span class="req">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $beneficiary->name) }}" required autofocus>
            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $beneficiary->date_of_birth) }}">
            @error('date_of_birth')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="contact_info">Contact Info</label>
            <input type="text" name="contact_info" id="contact_info" value="{{ old('contact_info', $beneficiary->contact_info) }}">
            @error('contact_info')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="family_id">Family <span class="req">*</span></label>
            <select name="family_id" id="family_id" required>
                <option value="">Select Family</option>
                @foreach($families as $family)
                    <option value="{{ $family->id }}" @if(old('family_id', $beneficiary->family_id) == $family->id) selected @endif>{{ $family->family_name }}</option>
                @endforeach
            </select>
            @error('family_id')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Beneficiary</button>
            <a href="{{ route('beneficiaries.index') }}" class="btn btn-back">&#8592; Back to Beneficiaries</a>
        </div>
    </form>
</div>
@endsection 