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
            <button type="submit" class="form-btn">Add Association</button>
            <a href="{{ route('associations.index') }}" class="form-cancel">Cancel</a>
        </div>
    </form>
</div>
<style>
    .form-card { max-width: 420px; margin: 2.5rem auto; background: #fff; border-radius: 14px; box-shadow: 0 2px 16px #2563eb11; padding: 2.2rem 1.5rem; }
    .form-title { text-align: center; font-size: 1.5rem; font-weight: 600; margin-bottom: 1.7rem; }
    .form-group { margin-bottom: 1.5rem; }
    label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .req { color: #f53003; font-size: 1.1em; }
    input[type="text"] { width: 100%; padding: 0.7rem; border: 1.5px solid #e5e7eb; border-radius: 7px; font-size: 1.08rem; transition: border 0.18s; }
    input[type="text"]:focus { border-color: #2563eb; outline: none; }
    .form-error { color: #f53003; font-size: 0.98rem; margin-top: 0.3rem; }
    .form-actions { display: flex; gap: 1rem; justify-content: center; align-items: center; margin-top: 2rem; }
    .form-btn { background: #2563eb; color: #fff; border: none; border-radius: 7px; padding: 0.7rem 2.2rem; font-size: 1.08rem; font-weight: 600; cursor: pointer; transition: background 0.18s, box-shadow 0.18s; box-shadow: 0 2px 8px #2563eb22; }
    .form-btn:hover { background: #174bbd; }
    .form-cancel { color: #888; text-decoration: none; font-size: 1.08rem; padding: 0.7rem 1.2rem; border-radius: 7px; transition: background 0.18s; }
    .form-cancel:hover { background: #f1f5f9; color: #222; }
</style>
@endsection 