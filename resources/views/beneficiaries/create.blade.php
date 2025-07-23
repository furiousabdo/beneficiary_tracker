@extends('layouts.app')
@section('title', 'Add Beneficiary')
@section('content')
<div class="form-card">
    <h2 class="form-title">Add New Beneficiary</h2>
    <form action="{{ route('beneficiaries.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="form-group">
            <label for="name">Name <span class="req">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus placeholder="e.g. Fatima Al-Sayed">
            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
            @error('date_of_birth')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="contact_info">Contact Info</label>
            <input type="text" name="contact_info" id="contact_info" value="{{ old('contact_info') }}" placeholder="e.g. 555-1234 or email">
            @error('contact_info')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="family_id">Family <span class="req">*</span></label>
            <select name="family_id" id="family_id" required>
                <option value="">Select Family</option>
                @foreach($families as $family)
                    <option value="{{ $family->id }}" @if(old('family_id') == $family->id) selected @endif>{{ $family->family_name }}</option>
                @endforeach
            </select>
            @error('family_id')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Add Beneficiary</button>
            <a href="{{ route('beneficiaries.index') }}" class="btn btn-back">&#8592; Back to Beneficiaries</a>
        </div>
    </form>
</div>
@endsection 