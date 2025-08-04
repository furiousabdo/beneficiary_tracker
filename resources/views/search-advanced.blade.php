@extends('layouts.app')

@section('title', 'بحث متقدم')
@section('header', 'بحث متقدم')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('search') }}" method="GET" class="needs-validation" novalidate>
            <div class="row g-3">
                <!-- Search Query -->
                <div class="col-md-12">
                    <label for="q" class="form-label">كلمة البحث</label>
                    <input type="text" class="form-control" id="q" name="q" 
                           value="{{ request('q') }}" placeholder="أدخل كلمة البحث...">
                </div>

                <!-- Search Type -->
                <div class="col-md-4">
                    <label class="form-label">نوع البحث</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="all" value="all" 
                               {{ request('type', 'all') == 'all' ? 'checked' : '' }}>
                        <label class="form-check-label" for="all">
                            الكل
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="persons" value="persons"
                               {{ request('type') == 'persons' ? 'checked' : '' }}>
                        <label class="form-check-label" for="persons">
                            الأفراد
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="families" value="families"
                               {{ request('type') == 'families' ? 'checked' : '' }}>
                        <label class="form-check-label" for="families">
                            العائلات
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="associations" value="associations"
                               {{ request('type') == 'associations' ? 'checked' : '' }}>
                        <label class="form-check-label" for="associations">
                            الجمعيات
                        </label>
                    </div>
                </div>

                <!-- Additional Filters -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="association_id" class="form-label">الجمعية</label>
                        <select class="form-select" id="association_id" name="association_id">
                            <option value="">جميع الجمعيات</option>
                            @foreach($associations as $id => $name)
                                <option value="{{ $id }}" {{ request('association_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">الجنس</label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="">الكل</option>
                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                        </select>
                    </div>
                </div>

                <!-- Date Range -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="from_date" class="form-label">من تاريخ</label>
                        <input type="date" class="form-control" id="from_date" name="from_date" 
                               value="{{ request('from_date') }}">
                    </div>

                    <div class="mb-3">
                        <label for="to_date" class="form-label">إلى تاريخ</label>
                        <input type="date" class="form-control" id="to_date" name="to_date"
                               value="{{ request('to_date') }}">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search me-1"></i> بحث
                </button>
                <a href="{{ route('search.advanced') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-undo me-1"></i> إعادة تعيين
                </a>
            </div>
        </form>
    </div>
</div>

@if(isset($results))
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">نتائج البحث</h5>
    </div>
    <div class="card-body">
        @if(empty($results['persons']) && empty($results['families']) && empty($results['associations']))
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                لا توجد نتائج للبحث
            </div>
        @else
            @include('partials.search-results')
        @endif
    </div>
</div>
@endif

@push('scripts')
<script>
    // Enable Bootstrap form validation
    (function () {
        'use strict'
        
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endpush

@endsection
