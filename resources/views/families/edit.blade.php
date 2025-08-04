@extends('layouts.app')

@section('title', 'تعديل بيانات العائلة')
@section('header', 'تعديل بيانات العائلة')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('families.update', $family) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الجمعية *</label>
                        <select name="association_id" class="form-select" required>
                            @foreach($associations as $association)
                                <option value="{{ $association->id }}" {{ $family->association_id == $association->id ? 'selected' : '' }}>
                                    {{ $association->name_ar }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">رقم البطاقة العائلية *</label>
                        <input type="text" name="family_card_number" class="form-control" 
                               value="{{ old('family_card_number', $family->family_card_number) }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">تاريخ التسجيل *</label>
                        <input type="date" name="registration_date" class="form-control" 
                               value="{{ old('registration_date', $family->registration_date->format('Y-m-d')) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">حالة السكن *</label>
                        <select name="housing_status" class="form-select" required>
                            <option value="مستأجر" {{ $family->housing_status == 'مستأجر' ? 'selected' : '' }}>مستأجر</option>
                            <option value="مستفيد من سكن حكومي" {{ $family->housing_status == 'مستفيد من سكن حكومي' ? 'selected' : '' }}>مستفيد من سكن حكومي</option>
                            <option value="يمتلك سكناً" {{ $family->housing_status == 'يمتلك سكناً' ? 'selected' : '' }}>يمتلك سكناً</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">العنوان *</label>
                <input type="text" name="address" class="form-control" 
                       value="{{ old('address', $family->address) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ملاحظات</label>
                <textarea name="notes" class="form-control" rows="3">{{ old('notes', $family->notes) }}</textarea>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                <a href="{{ route('families.show', $family) }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection