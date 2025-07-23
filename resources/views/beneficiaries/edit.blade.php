@extends('layouts.app')
@section('title', 'Edit Beneficiary')
@section('content')
    <h1>Edit Beneficiary</h1>
    <form action="{{ route('beneficiaries.update', $beneficiary) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $beneficiary->name }}" required><br>
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ $beneficiary->date_of_birth }}"><br>
        <label for="contact_info">Contact Info:</label>
        <input type="text" name="contact_info" id="contact_info" value="{{ $beneficiary->contact_info }}"><br>
        <label for="family_id">Family:</label>
        <select name="family_id" id="family_id" required>
            @foreach($families as $family)
                <option value="{{ $family->id }}" @if($beneficiary->family_id == $family->id) selected @endif>{{ $family->family_name }}</option>
            @endforeach
        </select><br>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('beneficiaries.index') }}" class="form-cancel btn-back">&#8592; Back to Beneficiaries</a>
@endsection

<style>
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