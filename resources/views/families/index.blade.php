@extends('layouts.app')

@section('title', 'العائلات')
@section('header', 'قائمة العائلات')

@section('actions')
    <div class="btn-group" role="group">
        <a href="{{ route('families.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-list"></i> عرض الكل
        </a>
        <a href="{{ route('families.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> إضافة عائلة جديدة
        </a>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>رقم البطاقة</th>
                        <th>اسم رب الأسرة</th>
                        <th>الجمعية</th>
                        <th>تاريخ التسجيل</th>
                        <th>حالة السكن</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($families as $family)
                        <tr>
                            <td>{{ $family->family_card_number }}</td>
                            <td>{{ $family->father->name_ar ?? 'غير محدد' }}</td>
                            <td>{{ $family->association->name_ar }}</td>
                            <td>{{ $family->registration_date->format('Y-m-d') }}</td>
                            <td>{{ $family->housing_status }}</td>
                            <td>
                                <a href="{{ route('families.show', $family) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('families.edit', $family) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('families.destroy', $family) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">لا توجد عائلات مسجلة بعد.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $families->links() }}
        </div>
    </div>
</div>
@endsection