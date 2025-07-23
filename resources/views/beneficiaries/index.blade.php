@extends('layouts.app')
@section('title', 'Beneficiaries')
@section('content')
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
        <h1 style="margin:0;font-size:1.5rem;font-weight:600;">Beneficiaries</h1>
        <a href="{{ route('beneficiaries.create') }}" class="btn btn-primary">+ Add Beneficiary</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Family</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($beneficiaries as $beneficiary)
                <tr>
                    <td>{{ $beneficiary->id }}</td>
                    <td>{{ $beneficiary->name }}</td>
                    <td>{{ $beneficiary->family->family_name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('beneficiaries.show', $beneficiary) }}" class="btn btn-light">Show</a>
                        <a href="{{ route('beneficiaries.edit', $beneficiary) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('beneficiaries.destroy', $beneficiary) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this beneficiary?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 