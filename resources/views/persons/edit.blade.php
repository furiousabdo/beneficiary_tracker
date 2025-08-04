@extends('layouts.app')

@section('title', 'تعديل بيانات الفرد')
@section('header', 'تعديل بيانات الفرد')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('persons.update', [$family, $person]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الاسم (عربي) *</label>
                        <input type="text" name="name_ar" class="form-control" 
                               value="{{ old('name_ar', $person->name_ar) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">رقم الهوية *</label>
                        <input type="text" name="national_id" class="form-control" 
                               value="{{ old('national_id', $person->national_id) }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">تاريخ الميلاد *</label>
                        <input type="date" name="birth_date" class="form-control" 
                               value="{{ old('birth_date', $person->birth_date->format('Y-m-d')) }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">النوع *</label>
                        <select name="gender" class="form-select" required>
                            <option value="ذكر" {{ $person->gender == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                            <option value="أنثى" {{ $person->gender == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">الحالة الاجتماعية *</label>
                        <select name="marital_status" class="form-select" required>
                            <option value="أعزب" {{ $person->marital_status == 'أعزب' ? 'selected' : '' }}>أعزب</option>
                            <option value="متزوج" {{ $person->marital_status == 'متزوج' ? 'selected' : '' }}>متزوج</option>
                            <option value="مطلق" {{ $person->marital_status == 'مطلق' ? 'selected' : '' }}>مطلق</option>
                            <option value="أرمل" {{ $person->marital_status == 'أرمل' ? 'selected' : '' }}>أرمل</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">رقم الجوال</label>
                        <input type="text" name="phone" class="form-control" 
                               value="{{ old('phone', $person->phone) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">المهنة *</label>
                        <input type="text" name="occupation" class="form-control" 
                               value="{{ old('occupation', $person->occupation) }}" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">العنوان</label>
                <input type="text" name="address" class="form-control" 
                       value="{{ old('address', $person->address) }}">
            </div>
            
            @if(!$person->is_family_head)
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الأب (اختياري)</label>
                        <select name="father_id" class="form-select">
                            <option value="">-- اختر الأب --</option>
                            @foreach($familyMembers as $id => $name)
                                <option value="{{ $id }}" {{ $person->father_id == $id ? 'selected' : '' }}>{{ $name }}</option>
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
                                <option value="{{ $id }}" {{ $person->mother_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @endif
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                <a href="{{ route('persons.show', [$family, $person]) }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection