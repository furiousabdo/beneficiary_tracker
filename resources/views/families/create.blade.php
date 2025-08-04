@extends('layouts.app')

@section('title', 'إضافة عائلة جديدة')
@section('header', 'إضافة عائلة جديدة')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('families.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الجمعية *</label>
                        <select name="association_id" class="form-select" required>
                            @foreach($associations as $association)
                                <option value="{{ $association->id }}">{{ $association->name_ar }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">رقم البطاقة العائلية *</label>
                        <input type="text" name="family_card_number" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">تاريخ التسجيل *</label>
                        <input type="date" name="registration_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">حالة السكن *</label>
                        <select name="housing_status" class="form-select" required>
                            <option value="مستأجر">مستأجر</option>
                            <option value="مستفيد من سكن حكومي">مستفيد من سكن حكومي</option>
                            <option value="يمتلك سكناً">يمتلك سكناً</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">العنوان *</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ملاحظات</label>
                <textarea name="notes" class="form-control" rows="3"></textarea>
            </div>
            
            <h5 class="mt-4 mb-3">بيانات رب الأسرة (الأب)</h5>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">الاسم (عربي) *</label>
                        <input type="text" name="father[name_ar]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">رقم الهوية *</label>
                        <input type="text" name="father[national_id]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">تاريخ الميلاد *</label>
                        <input type="date" name="father[birth_date]" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">رقم الجوال *</label>
                        <input type="text" name="father[phone]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">المهنة *</label>
                        <input type="text" name="father[occupation]" class="form-control" required>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{ route('families.index') }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection