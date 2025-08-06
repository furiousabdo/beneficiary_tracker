@extends('layouts.app')

@section('title', 'إضافة طفل')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-baby me-2"></i>إضافة طفل لـ {{ $person->name_ar }}
        </h3>
        <a href="{{ route('family-tree.show', $family) }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-right me-1"></i>عودة
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('family-tree.store-child', [$family, $person]) }}" method="POST">
            @csrf
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                سيتم إضافة الطفل كابن/ابنة لرب الأسرة: <strong>{{ $person->name_ar }}</strong>
            </div>

            <h5 class="text-primary mb-3">المعلومات الأساسية</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            الاسم (عربي) <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control @error('name_ar') is-invalid @enderror" value="{{ old('name_ar') }}" required>
                        @error('name_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الاسم (إنجليزي)</label>
                        <input type="text" name="name_en" id="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en') }}">
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            رقم الهوية <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="national_id" id="national_id" class="form-control @error('national_id') is-invalid @enderror" value="{{ old('national_id') }}" required>
                        @error('national_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            تاريخ الميلاد <span class="text-danger">*</span>
                        </label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}" required>
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">
                            النوع <span class="text-danger">*</span>
                        </label>
                        <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                            <option value="">-- اختر النوع --</option>
                            <option value="ذكر" {{ old('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                            <option value="أنثى" {{ old('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">
                            الحالة الاجتماعية <span class="text-danger">*</span>
                        </label>
                        <select name="marital_status" id="marital_status" class="form-select @error('marital_status') is-invalid @enderror" required>
                            <option value="">-- اختر الحالة --</option>
                            <option value="أعزب" {{ old('marital_status') == 'أعزب' ? 'selected' : '' }}>أعزب</option>
                            <option value="متزوج" {{ old('marital_status') == 'متزوج' ? 'selected' : '' }}>متزوج</option>
                            <option value="مطلق" {{ old('marital_status') == 'مطلق' ? 'selected' : '' }}>مطلق</option>
                            <option value="أرمل" {{ old('marital_status') == 'أرمل' ? 'selected' : '' }}>أرمل</option>
                        </select>
                        @error('marital_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">
                            المهنة <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="occupation" id="occupation" class="form-control @error('occupation') is-invalid @enderror" value="{{ old('occupation') }}" required>
                        @error('occupation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">رقم الجوال</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">العنوان</label>
                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <h5 class="text-success mb-3 mt-4">العلاقات الأسرية</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الأم (اختياري)</label>
                        <select name="mother_id" id="mother_id" class="form-select @error('mother_id') is-invalid @enderror">
                            <option value="">-- اختر الأم --</option>
                            @foreach($familyMembers as $id => $name)
                                <option value="{{ $id }}" {{ old('mother_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('mother_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>إضافة الطفل
                </button>
                <a href="{{ route('family-tree.show', $family) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-1"></i>إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 