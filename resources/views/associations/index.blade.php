@extends('layouts.app')

@section('title', 'الجمعيات')
@section('header', 'قائمة الجمعيات')

@section('actions')
    <div class="btn-group" role="group">
        <a href="{{ route('associations.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-list"></i> عرض الكل
        </a>
        <a href="{{ route('associations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> إضافة جمعية جديدة
        </a>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>الاسم (عربي)</th>
                        <th>الاسم (إنجليزي)</th>
                        <th>الهاتف</th>
                        <th>البريد الإلكتروني</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($associations as $association)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $association->name_ar }}</td>
                            <td>{{ $association->name_en }}</td>
                            <td>{{ $association->phone }}</td>
                            <td>{{ $association->email ?? '--' }}</td>
                            <td>
                                <span class="badge bg-{{ $association->is_active ? 'success' : 'danger' }}">
                                    {{ $association->is_active ? 'نشطة' : 'غير نشطة' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('associations.show', $association) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('associations.edit', $association) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('associations.destroy', $association) }}" method="POST" 
                                      class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">لا توجد جمعيات مسجلة</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $associations->links() }}
        </div>
    </div>
</div>
@endsection