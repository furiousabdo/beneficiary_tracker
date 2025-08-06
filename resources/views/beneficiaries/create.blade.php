@extends('layouts.app')

@section('title', 'إضافة مستفيد جديد')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">
            <i class="fas fa-plus me-2"></i>إضافة مستفيد جديد
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('beneficiaries.store') }}" method="POST" autocomplete="off">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم المستفيد <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">تاريخ الميلاد</label>
                        <input type="date" 
                               class="form-control @error('date_of_birth') is-invalid @enderror" 
                               id="date_of_birth" 
                               name="date_of_birth" 
                               value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="contact_info" class="form-label">معلومات الاتصال</label>
                        <input type="text" 
                               class="form-control @error('contact_info') is-invalid @enderror" 
                               id="contact_info" 
                               name="contact_info" 
                               value="{{ old('contact_info') }}" 
                               placeholder="رقم الهاتف أو البريد الإلكتروني">
                        @error('contact_info')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="family_id" class="form-label">العائلة <span class="text-danger">*</span></label>
                        <select class="form-select @error('family_id') is-invalid @enderror" 
                                id="family_id" 
                                name="family_id" 
                                required>
                            <option value="">اختر العائلة</option>
                            @foreach($families as $family)
                                <option value="{{ $family->id }}" {{ old('family_id') == $family->id ? 'selected' : '' }}>
                                    {{ $family->family_name }} - {{ $family->head_of_family }}
                                </option>
                            @endforeach
                        </select>
                        @error('family_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('beneficiaries.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right me-1"></i>عودة
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>حفظ المستفيد
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 