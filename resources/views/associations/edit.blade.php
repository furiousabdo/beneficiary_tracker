@extends('layouts.app')

@section('title', 'تعديل بيانات الجمعية')
@section('header', 'تعديل بيانات الجمعية')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('associations.update', $association) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الاسم (عربي) *</label>
                        <input type="text" name="name_ar" class="form-control @error('name_ar') is-invalid @enderror" 
                               value="{{ old('name_ar', $association->name_ar) }}" required>
                        @error('name_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الاسم (إنجليزي)</label>
                        <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror" 
                               value="{{ old('name_en', $association->name_en) }}">
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">العنوان *</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" 
                               value="{{ old('address', $association->address) }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الهاتف *</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                               value="{{ old('phone', $association->phone) }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $association->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">الموقع الإلكتروني</label>
                        <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" 
                               value="{{ old('website', $association->website) }}">
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">الوصف</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                          rows="3">{{ old('description', $association->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" id="is_active" 
                       {{ old('is_active', $association->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">نشطة</label>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                <a href="{{ route('associations.show', $association) }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection