@extends('layouts.app')

@section('title', 'إضافة سجل مساعدة جديد')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">
            <i class="fas fa-plus me-2"></i>إضافة سجل مساعدة جديد
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('aid-records.store') }}" method="POST" autocomplete="off">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="beneficiary_id" class="form-label">المستفيد <span class="text-danger">*</span></label>
                        <select class="form-select @error('beneficiary_id') is-invalid @enderror" 
                                id="beneficiary_id" 
                                name="beneficiary_id" 
                                required>
                            <option value="">اختر المستفيد</option>
                            @foreach($beneficiaries as $beneficiary)
                                <option value="{{ $beneficiary->id }}" 
                                        {{ old('beneficiary_id', $selectedBeneficiaryId) == $beneficiary->id ? 'selected' : '' }}>
                                    {{ $beneficiary->name }}
                                    @if($beneficiary->family)
                                        - {{ $beneficiary->family->family_name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('beneficiary_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="association_id" class="form-label">الجمعية <span class="text-danger">*</span></label>
                        <select class="form-select @error('association_id') is-invalid @enderror" 
                                id="association_id" 
                                name="association_id" 
                                required>
                            <option value="">اختر الجمعية</option>
                            @foreach($associations as $association)
                                <option value="{{ $association->id }}" 
                                        {{ old('association_id') == $association->id ? 'selected' : '' }}>
                                    {{ $association->name_ar ?? $association->name_en ?? $association->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('association_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="aid_type" class="form-label">نوع المساعدة <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('aid_type') is-invalid @enderror" 
                               id="aid_type" 
                               name="aid_type" 
                               value="{{ old('aid_type') }}" 
                               required 
                               placeholder="مثال: طعام، مال، ملابس">
                        @error('aid_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="amount" class="form-label">المبلغ</label>
                        <input type="number" 
                               class="form-control @error('amount') is-invalid @enderror" 
                               id="amount" 
                               name="amount" 
                               value="{{ old('amount') }}" 
                               step="0.01" 
                               placeholder="مثال: 100">
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date" class="form-label">تاريخ المساعدة <span class="text-danger">*</span></label>
                        <input type="date" 
                               class="form-control @error('date') is-invalid @enderror" 
                               id="date" 
                               name="date" 
                               value="{{ old('date', date('Y-m-d')) }}" 
                               required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  id="notes" 
                                  name="notes" 
                                  rows="3" 
                                  placeholder="أي ملاحظات إضافية">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('aid-records.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right me-1"></i>عودة
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>حفظ السجل
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 