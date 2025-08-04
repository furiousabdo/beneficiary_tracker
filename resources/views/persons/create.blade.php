@extends('layouts.app')

@section('title', 'إضافة فرد جديد')
@section('header', 'إضافة فرد جديد')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ $family ? route('families.persons.store', $family) : route('persons.store') }}" method="POST">
            @csrf
            
            @if(!$family)
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        الرجاء اختيار العائلة أولاً
                    </div>
                    <div class="mb-3">
                        <label class="form-label">اختر العائلة *</label>
                        <select name="family_id" class="form-select" required>
                            <option value="">-- اختر العائلة --</option>
                            @foreach($recentFamilies as $family)
                                <option value="{{ $family->id }}">
                                    {{ $family->father ? $family->father->name_ar : 'عائلة ' . $family->id }}
                                    @if($family->association)
                                        - {{ $family->association->name_ar }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الاسم (عربي) *</label>
                        <input type="text" name="name_ar" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">رقم الهوية *</label>
                        <input type="text" name="national_id" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">تاريخ الميلاد *</label>
                        <input type="date" name="birth_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">النوع *</label>
                        <select name="gender" class="form-select" required>
                            <option value="ذكر">ذكر</option>
                            <option value="أنثى">أنثى</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">الحالة الاجتماعية *</label>
                        <select name="marital_status" class="form-select" required>
                            <option value="أعزب">أعزب</option>
                            <option value="متزوج">متزوج</option>
                            <option value="مطلق">مطلق</option>
                            <option value="أرمل">أرمل</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">رقم الجوال</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">المهنة *</label>
                        <input type="text" name="occupation" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">العنوان</label>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الأب (اختياري)</label>
                        <select name="father_id" class="form-select">
                            <option value="">-- اختر الأب --</option>
                            @foreach($familyMembers as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الأم (اختياري)</label>
                        <select name="mother_id" class="form-select">
                            <option value="">-- اختر الأم --</option>
                            @foreach($familyMembers as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{ $family ? route('families.show', $family) : route('persons.index') }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection