@extends('layouts.app')

@section('title', 'نتائج البحث')
@section('header', 'نتائج البحث عن: ' . $query)

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="q" class="form-control form-control-lg" 
                       value="{{ $query }}" placeholder="ابحث عن عائلة أو شخص أو جمعية..." required>
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search me-1"></i> بحث
                </button>
            </div>
            <div class="mt-2">
                <a href="{{ route('search.advanced') }}" class="text-primary">
                    <i class="fas fa-sliders-h me-1"></i> بحث متقدم
                </a>
            </div>
        </form>

        @if(empty($results['persons']) && empty($results['families']) && empty($results['associations']))
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                لا توجد نتائج لبحثك عن "{{ $query }}"
            </div>
        @else
            @include('partials.search-results')
        @endif
    </div>
</div>
@endsection
