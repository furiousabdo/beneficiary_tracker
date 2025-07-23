@extends('layouts.app')
@section('title', 'Associations')
@section('content')
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
        <h1 style="margin:0;font-size:1.5rem;font-weight:600;">Associations</h1>
        <a href="{{ route('associations.create') }}" class="btn btn-primary">+ Add Association</a>
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
            @foreach($associations as $association)
                <tr>
                    <td>{{ $association->id }}</td>
                    <td>{{ $association->name }}</td>
                    <td>
                        <a href="{{ route('associations.show', $association) }}" class="btn btn-light">Show</a>
                        <a href="{{ route('associations.edit', $association) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('associations.destroy', $association) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this association?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 