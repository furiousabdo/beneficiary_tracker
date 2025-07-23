@extends('layouts.app')
@section('title', 'Beneficiary Details')
@section('content')
    <h1>Beneficiary Details</h1>
    <p><strong>ID:</strong> {{ $beneficiary->id }}</p>
    <p><strong>Name:</strong> {{ $beneficiary->name }}</p>
    <p><strong>Date of Birth:</strong> {{ $beneficiary->date_of_birth }}</p>
    <p><strong>Contact Info:</strong> {{ $beneficiary->contact_info }}</p>
    <p><strong>Family:</strong> {{ $beneficiary->family->family_name ?? 'N/A' }}</p>
    <h3>Aid Records</h3>
    <ul>
        @foreach($beneficiary->aidRecords as $aid)
            <li>{{ $aid->aid_type }}: ${{ number_format($aid->amount, 2) }} ({{ $aid->date_given }})</li>
        @endforeach
    </ul>
    <a href="{{ route('beneficiaries.edit', $beneficiary) }}">Edit</a> |
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