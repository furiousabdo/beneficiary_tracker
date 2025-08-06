@extends('layouts.app')

@section('title', 'إضافة زوج/زوجة')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-heart me-2"></i>إضافة زوج/زوجة لـ {{ $person->name_ar }}
        </h3>
        <a href="{{ route('family-tree.show', $family) }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-right me-1"></i>عودة
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('family-tree.store-spouse', [$family, $person]) }}" method="POST">
            @csrf
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                سيتم ربط زوج/زوجة لرب الأسرة: <strong>{{ $person->name_ar }}</strong>
                <br>
                <small class="text-muted">سيتم عرض الأشخاص من الجنس الآخر فقط</small>
            </div>

            <h5 class="text-primary mb-3">اختيار الزوج/الزوجة</h5>
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">
                            اختر الزوج/الزوجة <span class="text-danger">*</span>
                        </label>
                        <select name="spouse_id" id="spouse_id" class="form-select @error('spouse_id') is-invalid @enderror" required>
                            <option value="">-- اختر الزوج/الزوجة --</option>
                            @foreach($familyMembers as $id => $name)
                                <option value="{{ $id }}" {{ old('spouse_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('spouse_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            @if($familyMembers->count() == 0)
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    لا يوجد أشخاص من الجنس الآخر في العائلة لإضافتهم كزوج/زوجة.
                    <br>
                    <a href="{{ route('persons.create', $family) }}" class="btn btn-sm btn-primary mt-2">
                        <i class="fas fa-plus me-1"></i>إضافة شخص جديد
                    </a>
                </div>
            @endif
            
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary" {{ $familyMembers->count() == 0 ? 'disabled' : '' }}>
                    <i class="fas fa-save me-1"></i>ربط الزوج/الزوجة
                </button>
                <a href="{{ route('family-tree.show', $family) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-1"></i>إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 