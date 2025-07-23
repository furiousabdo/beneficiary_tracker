@extends('layouts.app')
@section('title', 'Associations')
@section('content')
    <h1>Associations</h1>
    <a href="{{ route('associations.create') }}" class="btn btn-primary">+ Add Association</a>
    <table border="0" cellpadding="10" style="width:100%; margin-top:2rem; background:#fff; border-radius:10px; box-shadow:0 2px 8px #2563eb11;">
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
<style>
    .btn {
        display: inline-block;
        padding: 0.55rem 1.3rem;
        font-size: 1.02rem;
        font-weight: 500;
        border: none;
        border-radius: 7px;
        margin: 0 0.2rem 0.2rem 0;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.16s, color 0.16s, box-shadow 0.16s, transform 0.13s;
        box-shadow: 0 1px 4px #2563eb11;
    }
    .btn-primary {
        background: #2563eb;
        color: #fff;
    }
    .btn-primary:hover {
        background: #174bbd;
        color: #fff;
        transform: translateY(-1px) scale(1.03);
    }
    .btn-secondary {
        background: #f1f5f9;
        color: #2563eb;
    }
    .btn-secondary:hover {
        background: #e0e7ef;
        color: #174bbd;
        transform: translateY(-1px) scale(1.03);
    }
    .btn-light {
        background: #fff;
        color: #2563eb;
        border: 1.5px solid #e5e7eb;
    }
    .btn-light:hover {
        background: #f1f5f9;
        color: #174bbd;
        border-color: #2563eb33;
        transform: translateY(-1px) scale(1.03);
    }
    .btn-danger {
        background: #fff0f0;
        color: #f53003;
        border: 1.5px solid #f5300333;
    }
    .btn-danger:hover {
        background: #f53003;
        color: #fff;
        border-color: #f53003;
        transform: translateY(-1px) scale(1.03);
    }
    table th, table td { padding: 0.7rem 0.5rem; text-align: left; }
    table th { background: #f8fafc; }
</style>
@endsection 