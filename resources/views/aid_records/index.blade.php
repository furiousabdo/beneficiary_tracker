@extends('layouts.app')
@section('title', 'Aid Records')
@section('content')
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
        <h1 style="margin:0;font-size:1.5rem;font-weight:600;">Aid Records</h1>
        <a href="{{ route('aid_records.create') }}" class="btn btn-primary">+ Add Aid Record</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Beneficiary</th>
                <th>Association</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Date Given</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aidRecords as $aid)
                <tr>
                    <td>{{ $aid->id }}</td>
                    <td>{{ $aid->beneficiary->name ?? 'N/A' }}</td>
                    <td>{{ $aid->association->name ?? 'N/A' }}</td>
                    <td>{{ $aid->aid_type }}</td>
                    <td>${{ number_format($aid->amount, 2) }}</td>
                    <td>{{ $aid->date_given }}</td>
                    <td>
                        <a href="{{ route('aid_records.show', $aid) }}" class="btn btn-light">Show</a>
                        <a href="{{ route('aid_records.edit', $aid) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('aid_records.destroy', $aid) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this aid record?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 