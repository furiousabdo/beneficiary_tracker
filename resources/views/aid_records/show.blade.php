@extends('layouts.app')
@section('title', 'Aid Record Details')
@section('content')
    <h1>Aid Record Details</h1>
    <p><strong>ID:</strong> {{ $aidRecord->id }}</p>
    <p><strong>Beneficiary:</strong> {{ $aidRecord->beneficiary->name ?? 'N/A' }}</p>
    <p><strong>Association:</strong> {{ $aidRecord->association->name ?? 'N/A' }}</p>
    <p><strong>Type:</strong> {{ $aidRecord->aid_type }}</p>
    <p><strong>Amount:</strong> ${{ number_format($aidRecord->amount, 2) }}</p>
    <p><strong>Date Given:</strong> {{ $aidRecord->date_given }}</p>
    <a href="{{ route('aid_records.edit', $aidRecord) }}">Edit</a> |
    <a href="{{ route('aid_records.index') }}">Back to Aid Records</a>
@endsection 