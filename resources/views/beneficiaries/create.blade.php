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
            <button type="submit" class="form-btn">Add Beneficiary</button>
            <a href="{{ route('beneficiaries.index') }}" class="form-cancel btn-back">&#8592; Back to Beneficiaries</a>
        </div>
    </form>
</div>
<style>
    .form-card { max-width: 480px; margin: 2.5rem auto; background: #fff; border-radius: 14px; box-shadow: 0 2px 16px #2563eb11; padding: 2.2rem 1.5rem; }
    .form-title { text-align: center; font-size: 1.5rem; font-weight: 600; margin-bottom: 1.7rem; }
    .form-group { margin-bottom: 1.5rem; }
    label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .req { color: #f53003; font-size: 1.1em; }
    input[type="text"], input[type="date"], select { width: 100%; padding: 0.7rem; border: 1.5px solid #e5e7eb; border-radius: 7px; font-size: 1.08rem; transition: border 0.18s; }
    input[type="text"]:focus, input[type="date"]:focus, select:focus { border-color: #2563eb; outline: none; }
    .form-error { color: #f53003; font-size: 0.98rem; margin-top: 0.3rem; }
    .form-actions { display: flex; gap: 1rem; justify-content: center; align-items: center; margin-top: 2rem; }
    .form-btn { background: #2563eb; color: #fff; border: none; border-radius: 7px; padding: 0.7rem 2.2rem; font-size: 1.08rem; font-weight: 600; cursor: pointer; transition: background 0.18s, box-shadow 0.18s; box-shadow: 0 2px 8px #2563eb22; }
    .form-btn:hover { background: #174bbd; }
    .form-cancel { color: #888; text-decoration: none; font-size: 1.08rem; padding: 0.7rem 1.2rem; border-radius: 7px; transition: background 0.18s; }
    .form-cancel:hover { background: #f1f5f9; color: #222; }
    .btn-back {
        background: #f1f5f9;
        color: #2563eb;
        border: none;
        font-weight: 500;
        padding-left: 1.5rem;
        position: relative;
    }
    .btn-back:hover {
        background: #e0e7ef;
        color: #174bbd;
    }
</style>
@endsection 