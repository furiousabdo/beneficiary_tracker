@extends('layouts.app')

@section('title', 'الجمعيات')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-building me-2"></i>الجمعيات
        </h3>
        <a href="{{ route('associations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>إضافة جمعية جديدة
        </a>
    </div>
    <div class="card-body">
        @if($associations->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>الاسم (عربي)</th>
                            <th>الاسم (إنجليزي)</th>
                            <th>الهاتف</th>
                            <th>البريد الإلكتروني</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($associations as $association)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $association->name_ar ?? 'غير محدد' }}</strong>
                                </td>
                                <td>{{ $association->name_en ?? 'غير محدد' }}</td>
                                <td>
                                    @if($association->phone)
                                        {{ $association->phone }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($association->email)
                                        {{ $association->email }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $association->is_active ? 'success' : 'danger' }}">
                                        {{ $association->is_active ? 'نشطة' : 'غير نشطة' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('associations.show', $association) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('associations.edit', $association) }}" 
                                           class="btn btn-sm btn-outline-secondary" 
                                           title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('associations.destroy', $association) }}" 
                                              method="POST" 
                                              style="display:inline;"
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذه الجمعية؟')">
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
                <i class="fas fa-building fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">لا توجد جمعيات مسجلة</h5>
                <p class="text-muted">ابدأ بإضافة جمعية جديدة</p>
                <a href="{{ route('associations.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>إضافة جمعية جديدة
                </a>
            </div>
        @endif
    </div>
</div>
@endsection