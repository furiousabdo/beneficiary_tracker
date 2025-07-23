@extends('layouts.app')
@section('title', 'Edit Aid Record')
@section('content')
    <h1>Edit Aid Record</h1>
    <form action="{{ route('aid_records.update', $aidRecord) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="beneficiary_id">Beneficiary:</label>
        <select name="beneficiary_id" id="beneficiary_id" required>
            @foreach($beneficiaries as $beneficiary)
                <option value="{{ $beneficiary->id }}" @if($aidRecord->beneficiary_id == $beneficiary->id) selected @endif>{{ $beneficiary->name }}</option>
            @endforeach
        </select><br>
        <label for="association_id">Association:</label>
        <select name="association_id" id="association_id" required>
            @foreach($associations as $association)
                <option value="{{ $association->id }}" @if($aidRecord->association_id == $association->id) selected @endif>{{ $association->name }}</option>
            @endforeach
        </select><br>
        <label for="aid_type">Aid Type:</label>
        <input type="text" name="aid_type" id="aid_type" value="{{ $aidRecord->aid_type }}" required><br>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" step="0.01" value="{{ $aidRecord->amount }}" required><br>
        <label for="date_given">Date Given:</label>
        <input type="date" name="date_given" id="date_given" value="{{ $aidRecord->date_given }}" required><br>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('aid_records.index') }}">Back to Aid Records</a>
@endsection 