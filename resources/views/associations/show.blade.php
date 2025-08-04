@extends('layouts.app')

@section('title', 'عرض بيانات الجمعية')
@section('header', 'عرض بيانات الجمعية')

@section('actions')
    <a href="{{ route('associations.edit', $association) }}" class="btn btn-warning">
        <i class="fas fa-edit"></i> تعديل
    </a>
    <a href="{{ route('associations.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-right"></i> رجوع
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">البيانات الأساسية</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>الاسم (عربي):</strong> {{ $association->name_ar }}</p>
                        <p><strong>الاسم (إنجليزي):</strong> {{ $association->name_en ?? '--' }}</p>
                        <p><strong>العنوان:</strong> {{ $association->address }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>الهاتف:</strong> {{ $association->phone }}</p>
                        <p><strong>البريد الإلكتروني:</strong> {{ $association->email ?? '--' }}</p>
                        <p><strong>الموقع الإلكتروني:</strong> 
                            @if($association->website)
                                <a href="{{ $association->website }}" target="_blank">{{ $association->website }}</a>
                            @else
                                --
                            @endif
                        </p>
                    </div>
                </div>
                @if($association->description)
                    <div class="mt-3">
                        <h6>الوصف:</h6>
                        <p>{{ $association->description }}</p>
                    </div>
                @endif
                <div class="mt-3">
                    <span class="badge bg-{{ $association->is_active ? 'success' : 'danger' }}">
                        {{ $association->is_active ? 'نشطة' : 'غير نشطة' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">إحصائيات</h5>
            </div>
            <div class="card-body">
                <p><strong>عدد العائلات:</strong> {{ $association->families_count }}</p>
                <p><strong>تاريخ الإنشاء:</strong> {{ $association->created_at->format('Y-m-d') }}</p>
                <p><strong>آخر تحديث:</strong> {{ $association->updated_at->format('Y-m-d') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">العائلات التابعة</h5>
    </div>
    <div class="card-body">
        @if($association->families->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>رقم البطاقة</th>
                            <th>اسم رب الأسرة</th>
                            <th>تاريخ التسجيل</th>
                            <th>حالة السكن</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($association->families as $family)
                            <tr>
                                <td>{{ $family->family_card_number }}</td>
                                <td>{{ $family->father->name_ar ?? 'غير محدد' }}</td>
                                <td>{{ $family->registration_date->format('Y-m-d') }}</td>
                                <td>{{ $family->housing_status }}</td>
                                <td>
                                    <a href="{{ route('families.show', $family) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">لا توجد عائلات مسجلة لهذه الجمعية.</div>
        @endif
    </div>
</div>
@endsection