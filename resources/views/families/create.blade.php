@extends('layouts.app')

@section('title', 'إضافة عائلة جديدة')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">
            <i class="fas fa-plus me-2"></i>إضافة عائلة جديدة
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('families.store') }}" method="POST" autocomplete="off">
            @csrf
            
            <h5 class="text-primary mb-3">معلومات العائلة</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="association_id" class="form-label">الجمعية <span class="text-danger">*</span></label>
                        <select class="form-select @error('association_id') is-invalid @enderror" 
                                id="association_id" 
                                name="association_id" 
                                required>
                            <option value="">اختر الجمعية</option>
                            @foreach($associations as $association)
                                <option value="{{ $association->id }}" {{ old('association_id') == $association->id ? 'selected' : '' }}>
                                    {{ $association->name_ar ?? $association->name_en ?? $association->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('association_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="family_card_number" class="form-label">رقم البطاقة العائلية <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('family_card_number') is-invalid @enderror" 
                               id="family_card_number" 
                               name="family_card_number" 
                               value="{{ old('family_card_number') }}" 
                               required>
                        @error('family_card_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="registration_date" class="form-label">تاريخ التسجيل <span class="text-danger">*</span></label>
                        <input type="date" 
                               class="form-control @error('registration_date') is-invalid @enderror" 
                               id="registration_date" 
                               name="registration_date" 
                               value="{{ old('registration_date', date('Y-m-d')) }}" 
                               required>
                        @error('registration_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="housing_status" class="form-label">حالة السكن <span class="text-danger">*</span></label>
                        <select class="form-select @error('housing_status') is-invalid @enderror" 
                                id="housing_status" 
                                name="housing_status" 
                                required>
                            <option value="">اختر حالة السكن</option>
                            <option value="مستأجر" {{ old('housing_status') == 'مستأجر' ? 'selected' : '' }}>مستأجر</option>
                            <option value="مستفيد من سكن حكومي" {{ old('housing_status') == 'مستفيد من سكن حكومي' ? 'selected' : '' }}>مستفيد من سكن حكومي</option>
                            <option value="يمتلك سكناً" {{ old('housing_status') == 'يمتلك سكناً' ? 'selected' : '' }}>يمتلك سكناً</option>
                        </select>
                        @error('housing_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">العنوان <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control @error('address') is-invalid @enderror" 
                       id="address" 
                       name="address" 
                       value="{{ old('address') }}" 
                       required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="notes" class="form-label">ملاحظات</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" 
                          id="notes" 
                          name="notes" 
                          rows="3">{{ old('notes') }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <h5 class="text-success mb-3">بيانات رب الأسرة (الأب)</h5>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="father_name_ar" class="form-label">الاسم (عربي) <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('father.name_ar') is-invalid @enderror" 
                               id="father_name_ar" 
                               name="father[name_ar]" 
                               value="{{ old('father.name_ar') }}" 
                               required>
                        @error('father.name_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="father_national_id" class="form-label">رقم الهوية <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('father.national_id') is-invalid @enderror" 
                               id="father_national_id" 
                               name="father[national_id]" 
                               value="{{ old('father.national_id') }}" 
                               required>
                        @error('father.national_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="father_birth_date" class="form-label">تاريخ الميلاد <span class="text-danger">*</span></label>
                        <input type="date" 
                               class="form-control @error('father.birth_date') is-invalid @enderror" 
                               id="father_birth_date" 
                               name="father[birth_date]" 
                               value="{{ old('father.birth_date') }}" 
                               required>
                        @error('father.birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="father_phone" class="form-label">رقم الجوال <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('father.phone') is-invalid @enderror" 
                               id="father_phone" 
                               name="father[phone]" 
                               value="{{ old('father.phone') }}" 
                               required>
                        @error('father.phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="father_occupation" class="form-label">المهنة <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('father.occupation') is-invalid @enderror" 
                               id="father_occupation" 
                               name="father[occupation]" 
                               value="{{ old('father.occupation') }}" 
                               required>
                        @error('father.occupation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('families.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right me-1"></i>عودة
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>حفظ العائلة
                </button>
            </div>
        </form>
    </div>
</div>
@endsection