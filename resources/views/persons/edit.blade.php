@extends('layouts.app')

@section('title', 'تعديل بيانات الفرد')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-user-edit me-2"></i>تعديل بيانات الفرد
        </h3>
        <a href="{{ route('persons.show', [$family, $person]) }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-right me-1"></i>عودة
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('persons.update', [$family, $person]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <h5 class="text-primary mb-3">المعلومات الأساسية</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            الاسم (عربي) <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control @error('name_ar') is-invalid @enderror" 
                               value="{{ old('name_ar', $person->name_ar) }}" required>
                        @error('name_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            رقم الهوية <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="national_id" id="national_id" class="form-control @error('national_id') is-invalid @enderror" 
                               value="{{ old('national_id', $person->national_id) }}" required>
                        @error('national_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">
                            تاريخ الميلاد <span class="text-danger">*</span>
                        </label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" 
                               value="{{ old('birth_date', $person->birth_date ? $person->birth_date->format('Y-m-d') : '') }}" required>
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">
                            النوع <span class="text-danger">*</span>
                        </label>
                        <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                            <option value="">-- اختر النوع --</option>
                            <option value="ذكر" {{ old('gender', $person->gender) == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                            <option value="أنثى" {{ old('gender', $person->gender) == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">
                            الحالة الاجتماعية <span class="text-danger">*</span>
                        </label>
                        <select name="marital_status" id="marital_status" class="form-select @error('marital_status') is-invalid @enderror" required>
                            <option value="">-- اختر الحالة --</option>
                            <option value="أعزب" {{ old('marital_status', $person->marital_status) == 'أعزب' ? 'selected' : '' }}>أعزب</option>
                            <option value="متزوج" {{ old('marital_status', $person->marital_status) == 'متزوج' ? 'selected' : '' }}>متزوج</option>
                            <option value="مطلق" {{ old('marital_status', $person->marital_status) == 'مطلق' ? 'selected' : '' }}>مطلق</option>
                            <option value="أرمل" {{ old('marital_status', $person->marital_status) == 'أرمل' ? 'selected' : '' }}>أرمل</option>
                        </select>
                        @error('marital_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">
                            العلاقة برب الأسرة <span class="text-danger">*</span>
                        </label>
                        <select name="relationship_to_family_head" id="relationship_to_family_head" class="form-select @error('relationship_to_family_head') is-invalid @enderror" required>
                            <option value="">-- اختر العلاقة --</option>
                            <option value="رب الأسرة" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'رب الأسرة' ? 'selected' : '' }}>رب الأسرة</option>
                            <option value="زوجة" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'زوجة' ? 'selected' : '' }}>زوجة</option>
                            <option value="ابن" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'ابن' ? 'selected' : '' }}>ابن</option>
                            <option value="ابنة" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'ابنة' ? 'selected' : '' }}>ابنة</option>
                            <option value="أب" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'أب' ? 'selected' : '' }}>أب</option>
                            <option value="أم" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'أم' ? 'selected' : '' }}>أم</option>
                            <option value="أخ" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'أخ' ? 'selected' : '' }}>أخ</option>
                            <option value="أخت" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'أخت' ? 'selected' : '' }}>أخت</option>
                            <option value="جد" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'جد' ? 'selected' : '' }}>جد</option>
                            <option value="جدة" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'جدة' ? 'selected' : '' }}>جدة</option>
                            <option value="عم" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'عم' ? 'selected' : '' }}>عم</option>
                            <option value="عمة" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'عمة' ? 'selected' : '' }}>عمة</option>
                            <option value="خال" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'خال' ? 'selected' : '' }}>خال</option>
                            <option value="خالة" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'خالة' ? 'selected' : '' }}>خالة</option>
                            <option value="ابن الأخ" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'ابن الأخ' ? 'selected' : '' }}>ابن الأخ</option>
                            <option value="ابنة الأخ" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'ابنة الأخ' ? 'selected' : '' }}>ابنة الأخ</option>
                            <option value="ابن الأخت" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'ابن الأخت' ? 'selected' : '' }}>ابن الأخت</option>
                            <option value="ابنة الأخت" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'ابنة الأخت' ? 'selected' : '' }}>ابنة الأخت</option>
                            <option value="حفيد" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'حفيد' ? 'selected' : '' }}>حفيد</option>
                            <option value="حفيدة" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'حفيدة' ? 'selected' : '' }}>حفيدة</option>
                            <option value="أخرى" {{ old('relationship_to_family_head', $person->relationship_to_family_head) == 'أخرى' ? 'selected' : '' }}>أخرى</option>
                        </select>
                        @error('relationship_to_family_head')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">رقم الجوال</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" 
                               value="{{ old('phone', $person->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            المهنة <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="occupation" id="occupation" class="form-control @error('occupation') is-invalid @enderror" 
                               value="{{ old('occupation', $person->occupation) }}" required>
                        @error('occupation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">العنوان</label>
                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" 
                       value="{{ old('address', $person->address) }}">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <h5 class="text-success mb-3 mt-4">العلاقات الأسرية</h5>
            <div class="row">
                @if(!$person->is_family_head)
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">الأب (اختياري)</label>
                        <select name="father_id" id="father_id" class="form-select @error('father_id') is-invalid @enderror">
                            <option value="">-- اختر الأب --</option>
                            @foreach($familyMembers as $id => $name)
                                <option value="{{ $id }}" {{ old('father_id', $person->father_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('father_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">الأم (اختياري)</label>
                        <select name="mother_id" id="mother_id" class="form-select @error('mother_id') is-invalid @enderror">
                            <option value="">-- اختر الأم --</option>
                            @foreach($familyMembers as $id => $name)
                                <option value="{{ $id }}" {{ old('mother_id', $person->mother_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('mother_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @endif
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">الزوج/الزوجة (اختياري)</label>
                        <select name="spouse_id" id="spouse_id" class="form-select @error('spouse_id') is-invalid @enderror">
                            <option value="">-- اختر الزوج/الزوجة --</option>
                            @foreach($familyMembers as $id => $name)
                                <option value="{{ $id }}" {{ old('spouse_id', $person->spouse_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('spouse_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>حفظ التغييرات
                </button>
                <a href="{{ route('persons.show', [$family, $person]) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-1"></i>إلغاء
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const genderSelect = document.getElementById('gender');
    const relationshipSelect = document.getElementById('relationship_to_family_head');
    
    function updateRelationshipOptions() {
        const selectedGender = genderSelect.value;
        const currentValue = relationshipSelect.value;
        
        // Reset options
        relationshipSelect.innerHTML = '<option value="">-- اختر العلاقة --</option>';
        
        // Always show family head option
        relationshipSelect.innerHTML += '<option value="رب الأسرة">رب الأسرة</option>';
        
        if (selectedGender === 'ذكر') {
            // Male-specific relationships
            relationshipSelect.innerHTML += `
                <option value="ابن">ابن</option>
                <option value="أب">أب</option>
                <option value="أخ">أخ</option>
                <option value="جد">جد</option>
                <option value="عم">عم</option>
                <option value="خال">خال</option>
                <option value="ابن الأخ">ابن الأخ</option>
                <option value="ابن الأخت">ابن الأخت</option>
                <option value="حفيد">حفيد</option>
            `;
        } else if (selectedGender === 'أنثى') {
            // Female-specific relationships
            relationshipSelect.innerHTML += `
                <option value="زوجة">زوجة</option>
                <option value="ابنة">ابنة</option>
                <option value="أم">أم</option>
                <option value="أخت">أخت</option>
                <option value="جدة">جدة</option>
                <option value="عمة">عمة</option>
                <option value="خالة">خالة</option>
                <option value="ابنة الأخ">ابنة الأخ</option>
                <option value="ابنة الأخت">ابنة الأخت</option>
                <option value="حفيدة">حفيدة</option>
            `;
        }
        
        // Add "other" option
        relationshipSelect.innerHTML += '<option value="أخرى">أخرى</option>';
        
        // Restore previous value if it's still valid
        if (currentValue) {
            const option = relationshipSelect.querySelector(`option[value="${currentValue}"]`);
            if (option) {
                option.selected = true;
            }
        }
    }
    
    genderSelect.addEventListener('change', updateRelationshipOptions);
    
    // Initialize on page load
    updateRelationshipOptions();
});
</script>
@endsection