@extends('layouts.app')
@section('title', 'Families')
@section('content')
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
        <h1 style="margin:0;font-size:1.5rem;font-weight:600;">Families</h1>
        <a href="{{ route('families.create') }}" class="btn btn-primary">+ Add Family</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($families as $family)
                <tr>
                    <td>{{ $family->id }}</td>
                    <td>{{ $family->family_name }}</td>
                    <td>
                        <a href="{{ route('families.show', $family) }}" class="btn btn-light">Show</a>
                        <a href="{{ route('families.edit', $family) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('families.destroy', $family) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this family?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 