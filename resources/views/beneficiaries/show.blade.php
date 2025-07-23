@extends('layouts.app')
@section('title', 'Beneficiary Details')
@section('content')
<div class="card">
    <h2 style="font-size:1.5rem;font-weight:600;margin-bottom:1.2rem;">Beneficiary Details</h2>
    <p><strong>ID:</strong> {{ $beneficiary->id }}</p>
    <p><strong>Name:</strong> {{ $beneficiary->name }}</p>
    <p><strong>Date of Birth:</strong> {{ $beneficiary->date_of_birth }}</p>
    <p><strong>Contact Info:</strong> {{ $beneficiary->contact_info }}</p>
    <p><strong>Family:</strong> {{ $beneficiary->family->family_name ?? 'N/A' }}</p>
    <h3 style="margin-top:2rem;">Aid Records</h3>
    <ul>
        @foreach($beneficiary->aidRecords as $aid)
            <li>{{ $aid->aid_type }}: ${{ number_format($aid->amount, 2) }} ({{ $aid->date_given }})</li>
        @endforeach
    </ul>
    <div style="margin-top:2rem;">
        <a href="{{ route('beneficiaries.edit', $beneficiary) }}" class="btn btn-secondary">Edit</a>
        <a href="{{ route('beneficiaries.index') }}" class="btn btn-back">&#8592; Back to Beneficiaries</a>
    </div>
</div>
@endsection 