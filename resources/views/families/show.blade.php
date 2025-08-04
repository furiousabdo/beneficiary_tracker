@extends('layouts.app')

@section('title', 'عرض بيانات العائلة')
@section('header', 'عرض بيانات العائلة')

@section('actions')
    <a href="{{ route('families.edit', $family) }}" class="btn btn-warning">
        <i class="fas fa-edit"></i> تعديل
    </a>
    <a href="{{ route('families.index') }}" class="btn btn-secondary">
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
                        <p><strong>رقم البطاقة العائلية:</strong> {{ $family->family_card_number }}</p>
                        <p><strong>الجمعية:</strong> {{ $family->association->name_ar }}</p>
                        <p><strong>تاريخ التسجيل:</strong> {{ $family->registration_date->format('Y-m-d') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>حالة السكن:</strong> {{ $family->housing_status }}</p>
                        <p><strong>العنوان:</strong> {{ $family->address }}</p>
                        @if($family->notes)
                            <p><strong>ملاحظات:</strong> {{ $family->notes }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">أفراد العائلة</h5>
                <a href="{{ route('persons.create', $family) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> إضافة فرد
                </a>
            </div>
            <div class="card-body">
                @if($family->persons->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>رقم الهوية</th>
                                    <th>النوع</th>
                                    <th>العلاقة</th>
                                    <th>العمر</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($family->persons as $person)
                                    <tr>
                                        <td>{{ $person->name_ar }}</td>
                                        <td>{{ $person->national_id }}</td>
                                        <td>{{ $person->gender }}</td>
                                        <td>
                                            @if($person->is_family_head)
                                                رب الأسرة
                                            @else
                                                {{ $person->relationship ?? '-' }}
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($person->birth_date)->age }} سنة</td>
                                        <td>
                                            <a href="{{ route('persons.show', [$family, $person]) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">لا يوجد أفراد مسجلين في هذه العائلة.</div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">بيانات رب الأسرة</h5>
            </div>
            <div class="card-body">
                @if($family->father)
                    <p><strong>الاسم:</strong> {{ $family->father->name_ar }}</p>
                    <p><strong>رقم الهوية:</strong> {{ $family->father->national_id }}</p>
                    <p><strong>تاريخ الميلاد:</strong> {{ $family->father->birth_date->format('Y-m-d') }}</p>
                    <p><strong>العمر:</strong> {{ \Carbon\Carbon::parse($family->father->birth_date)->age }} سنة</p>
                    <p><strong>رقم الجوال:</strong> {{ $family->father->phone }}</p>
                    <p><strong>المهنة:</strong> {{ $family->father->occupation }}</p>
                @else
                    <div class="alert alert-warning">لا يوجد بيانات لرب الأسرة</div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">إحصائيات العائلة</h5>
            </div>
            <div class="card-body">
                <p><strong>عدد الأفراد:</strong> {{ $family->persons->count() }}</p>
                <p><strong>عدد الذكور:</strong> {{ $family->persons->where('gender', 'ذكر')->count() }}</p>
                <p><strong>عدد الإناث:</strong> {{ $family->persons->where('gender', 'أنثى')->count() }}</p>
                <p><strong>عدد الأطفال (أقل من 18 سنة):</strong> 
                    {{ $family->persons->filter(function($person) {
                        return \Carbon\Carbon::parse($person->birth_date)->age < 18;
                    })->count() }}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('families.tree', $family) }}" class="btn btn-info">
        <i class="fas fa-sitemap"></i> عرض الشجرة العائلية
    </a>
</div>
@endsection