@extends('layouts.app')
@section('title', 'Edit Aid Record')
@section('content')
<div class="form-card">
    <h2 class="form-title">Edit Aid Record</h2>
    <form action="{{ route('aid_records.update', $aidRecord) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="beneficiary_id">Beneficiary <span class="req">*</span></label>
            <select name="beneficiary_id" id="beneficiary_id" required autofocus>
                @foreach($beneficiaries as $beneficiary)
                    <option value="{{ $beneficiary->id }}" @if(old('beneficiary_id', $aidRecord->beneficiary_id) == $beneficiary->id) selected @endif>{{ $beneficiary->name }}</option>
                @endforeach
            </select>
            @error('beneficiary_id')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="association_id">Association <span class="req">*</span></label>
            <select name="association_id" id="association_id" required>
                @foreach($associations as $association)
                    <option value="{{ $association->id }}" @if(old('association_id', $aidRecord->association_id) == $association->id) selected @endif>{{ $association->name }}</option>
                @endforeach
            </select>
            @error('association_id')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="aid_type">Aid Type <span class="req">*</span></label>
            <input type="text" name="aid_type" id="aid_type" value="{{ old('aid_type', $aidRecord->aid_type) }}" required>
            @error('aid_type')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="amount">Amount <span class="req">*</span></label>
            <input type="number" name="amount" id="amount" value="{{ old('amount', $aidRecord->amount) }}" step="0.01" required>
            @error('amount')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="date_given">Date Given <span class="req">*</span></label>
            <input type="date" name="date_given" id="date_given" value="{{ old('date_given', $aidRecord->date_given) }}" required>
            @error('date_given')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Aid Record</button>
            <a href="{{ route('aid_records.index') }}" class="btn btn-back">&#8592; Back to Aid Records</a>
        </div>
    </form>
</div>
@endsection 