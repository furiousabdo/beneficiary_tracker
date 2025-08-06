@extends('layouts.app')

@section('title', 'تفاصيل الجمعية')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-building me-2"></i>تفاصيل الجمعية
        </h3>
        <div class="btn-group" role="group">
            <a href="{{ route('associations.edit', $association) }}" class="btn btn-outline-secondary">
                <i class="fas fa-edit me-1"></i>تعديل
            </a>
            <a href="{{ route('associations.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-right me-1"></i>عودة
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-primary mb-3">المعلومات الأساسية</h5>
                <table class="table table-borderless">
                    <tr>
                        <th class="text-muted" style="width: 150px;">الاسم (عربي):</th>
                        <td><strong>{{ $association->name_ar ?? 'غير محدد' }}</strong></td>
                    </tr>
                    <tr>
                        <th class="text-muted">الاسم (إنجليزي):</th>
                        <td>{{ $association->name_en ?? 'غير محدد' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">العنوان:</th>
                        <td>{{ $association->address ?? 'غير محدد' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">الهاتف:</th>
                        <td>
                            @if($association->phone)
                                <i class="fas fa-phone me-1"></i>{{ $association->phone }}
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">البريد الإلكتروني:</th>
                        <td>
                            @if($association->email)
                                <i class="fas fa-envelope me-1"></i>{{ $association->email }}
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">الموقع الإلكتروني:</th>
                        <td>
                            @if($association->website)
                                <a href="{{ $association->website }}" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-globe me-1"></i>{{ $association->website }}
                                </a>
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">الحالة:</th>
                        <td>
                            <span class="badge bg-{{ $association->is_active ? 'success' : 'danger' }}">
                                {{ $association->is_active ? 'نشطة' : 'غير نشطة' }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="col-md-6">
                <h5 class="text-success mb-3">الوصف</h5>
                @if($association->description)
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-0">{{ $association->description }}</p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-file-alt fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">لا يوجد وصف للجمعية</p>
                    </div>
                @endif
                
                <h5 class="text-info mb-3 mt-4">الإحصائيات</h5>
                <div class="row">
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h4 class="text-primary mb-0">{{ $association->families->count() }}</h4>
                                <small class="text-muted">العائلات</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h4 class="text-success mb-0">{{ $association->aidRecords->count() }}</h4>
                                <small class="text-muted">سجلات المساعدة</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection