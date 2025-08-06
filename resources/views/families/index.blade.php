@extends('layouts.app')

@section('title', 'العائلات')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-home me-2"></i>العائلات
        </h3>
        <a href="{{ route('families.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>إضافة عائلة جديدة
        </a>
    </div>
    <div class="card-body">
        @if($families->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>اسم العائلة</th>
                            <th>رقم البطاقة</th>
                            <th>الجمعية</th>
                            <th>تاريخ التسجيل</th>
                            <th>حالة السكن</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($families as $family)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $family->name_ar ?? 'غير محدد' }}</strong>
                                    @if($family->father)
                                        <br><small class="text-muted">رب الأسرة: {{ $family->father->name_ar }}</small>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $family->family_card_number ?? 'غير محدد' }}</strong>
                                </td>
                                <td>
                                    @if($family->association)
                                        {{ $family->association->name_ar ?? $family->association->name_en ?? 'غير محدد' }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($family->registration_date)
                                        {{ \Carbon\Carbon::parse($family->registration_date)->format('Y/m/d') }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($family->housing_status)
                                        <span class="badge bg-info">{{ $family->housing_status }}</span>
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('families.show', $family) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('families.edit', $family) }}" 
                                           class="btn btn-sm btn-outline-secondary" 
                                           title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('families.destroy', $family) }}" 
                                              method="POST" 
                                              style="display:inline;"
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذه العائلة؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-home fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">لا توجد عائلات مسجلة</h5>
                <p class="text-muted">ابدأ بإضافة عائلة جديدة</p>
                <a href="{{ route('families.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>إضافة عائلة جديدة
                </a>
            </div>
        @endif
    </div>
</div>
@endsection