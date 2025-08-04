@extends('layouts.app')

@section('title', 'عرض بيانات الفرد')
@section('header', 'عرض بيانات الفرد')

@section('actions')
    <a href="{{ route('persons.edit', [$family, $person]) }}" class="btn btn-warning">
        <i class="fas fa-edit"></i> تعديل
    </a>
    <a href="{{ route('families.show', $family) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-right"></i> رجوع
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">البيانات الشخصية</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>الاسم (عربي):</strong> {{ $person->name_ar }}</p>
                        <p><strong>رقم الهوية:</strong> {{ $person->national_id }}</p>
                        <p><strong>تاريخ الميلاد:</strong> {{ $person->birth_date->format('Y-m-d') }}</p>
                        <p><strong>العمر:</strong> {{ \Carbon\Carbon::parse($person->birth_date)->age }} سنة</p>
                        <p><strong>النوع:</strong> {{ $person->gender }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>الحالة الاجتماعية:</strong> {{ $person->marital_status }}</p>
                        <p><strong>المهنة:</strong> {{ $person->occupation }}</p>
                        <p><strong>رقم الجوال:</strong> {{ $person->phone ?? 'غير محدد' }}</p>
                        <p><strong>العنوان:</strong> {{ $person->address ?? 'غير محدد' }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($person->father || $person->mother || $person->children->count() > 0)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">العلاقات الأسرية</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @if($person->father)
                    <div class="col-md-6">
                        <div class="card bg-light mb-3">
                            <div class="card-header">الأب</div>
                            <div class="card-body">
                                <p class="card-text">
                                    <a href="{{ route('persons.show', [$family, $person->father]) }}">
                                        {{ $person->father->name_ar }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($person->mother)
                    <div class="col-md-6">
                        <div class="card bg-light mb-3">
                            <div class="card-header">الأم</div>
                            <div class="card-body">
                                <p class="card-text">
                                    <a href="{{ route('persons.show', [$family, $person->mother]) }}">
                                        {{ $person->mother->name_ar }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($person->children->count() > 0)
                    <div class="col-12">
                        <h6>الأبناء</h6>
                        <div class="row">
                            @foreach($person->children as $child)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <a href="{{ route('persons.show', [$family, $child]) }}">
                                                {{ $child->name_ar }}
                                            </a>
                                        </h6>
                                        <p class="card-text text-muted">
                                            {{ $child->gender == 'ذكر' ? 'ابن' : 'ابنة' }} - 
                                            {{ \Carbon\Carbon::parse($child->birth_date)->age }} سنة
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">معلومات العائلة</h5>
            </div>
            <div class="card-body">
                <p><strong>رقم البطاقة العائلية:</strong> 
                    <a href="{{ route('families.show', $family) }}">
                        {{ $family->family_card_number }}
                    </a>
                </p>
                <p><strong>الجمعية:</strong> {{ $family->association->name_ar }}</p>
                <p><strong>حالة السكن:</strong> {{ $family->housing_status }}</p>
                <p><strong>العنوان:</strong> {{ $family->address }}</p>
            </div>
        </div>

        @if($person->is_family_head)
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">رب الأسرة</h5>
            </div>
            <div class="card-body">
                <p class="text-center">
                    <i class="fas fa-crown fa-2x text-warning mb-3"></i><br>
                    هذا الفرد هو رب الأسرة
                </p>
            </div>
        </div>
        @endif
    </div>
</div>

@if(!$person->is_family_head)
<div class="mt-4">
    <form action="{{ route('persons.destroy', [$family, $person]) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الفرد؟')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash"></i> حذف الفرد
        </button>
    </form>
</div>
@endif
@endsection