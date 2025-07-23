@extends('layouts.app')
@section('title', 'Aid Record Details')
@section('content')
<div class="card">
    <h2 style="font-size:1.5rem;font-weight:600;margin-bottom:1.2rem;">Aid Record Details</h2>
    <p><strong>ID:</strong> {{ $aidRecord->id }}</p>
    <p><strong>Beneficiary:</strong> {{ $aidRecord->beneficiary->name ?? 'N/A' }}</p>
    <p><strong>Association:</strong> {{ $aidRecord->association->name ?? 'N/A' }}</p>
    <p><strong>Type:</strong> {{ $aidRecord->aid_type }}</p>
    <p><strong>Amount:</strong> ${{ number_format($aidRecord->amount, 2) }}</p>
    <p><strong>Date Given:</strong> {{ $aidRecord->date_given }}</p>
    <div style="margin-top:2rem;">
        <a href="{{ route('aid_records.edit', $aidRecord) }}" class="btn btn-secondary">Edit</a>
        <a href="{{ route('aid_records.index') }}" class="btn btn-back">&#8592; Back to Aid Records</a>
    </div>
</div>
@endsection 