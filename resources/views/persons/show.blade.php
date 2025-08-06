@extends('layouts.app')

@section('title', 'تفاصيل الفرد')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-user me-2"></i>تفاصيل الفرد
        </h3>
        <div class="btn-group" role="group">
            <a href="{{ route('persons.edit', [$family, $person]) }}" class="btn btn-outline-secondary">
                <i class="fas fa-edit me-1"></i>تعديل
            </a>
            <a href="{{ route('families.show', $family) }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-right me-1"></i>عودة
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h5 class="text-primary mb-3">المعلومات الشخصية</h5>
                <table class="table table-borderless">
                    <tr>
                        <th class="text-muted" style="width: 150px;">الاسم (عربي):</th>
                        <td><strong>{{ $person->name_ar ?? 'غير محدد' }}</strong></td>
                    </tr>
                    <tr>
                        <th class="text-muted">الاسم (إنجليزي):</th>
                        <td>{{ $person->name_en ?? 'غير محدد' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">رقم الهوية:</th>
                        <td>{{ $person->national_id ?? 'غير محدد' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">تاريخ الميلاد:</th>
                        <td>
                            @if($person->birth_date)
                                {{ \Carbon\Carbon::parse($person->birth_date)->format('Y/m/d') }}
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">العمر:</th>
                        <td>
                            @if($person->birth_date)
                                {{ \Carbon\Carbon::parse($person->birth_date)->age }} سنة
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">النوع:</th>
                        <td>
                            @if($person->gender == 'ذكر')
                                <span class="badge bg-primary">ذكر</span>
                            @elseif($person->gender == 'أنثى')
                                <span class="badge bg-pink">أنثى</span>
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">الحالة الاجتماعية:</th>
                        <td>
                            @if($person->marital_status)
                                <span class="badge bg-info">{{ $person->marital_status }}</span>
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">المهنة:</th>
                        <td>{{ $person->occupation ?? 'غير محدد' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">رقم الجوال:</th>
                        <td>{{ $person->phone ?? 'غير محدد' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">العنوان:</th>
                        <td>{{ $person->address ?? 'غير محدد' }}</td>
                    </tr>
                </table>

                @if($person->father || $person->mother || $person->spouse || $person->children->count() > 0)
                <h5 class="text-success mb-3 mt-4">العلاقات الأسرية</h5>
                <div class="row">
                    @if($person->father)
                    <div class="col-md-4 mb-3">
                        <div class="card bg-light">
                            <div class="card-header">
                                <i class="fas fa-male me-1"></i>الأب
                            </div>
                            <div class="card-body">
                                <a href="{{ route('persons.show', [$family, $person->father]) }}" 
                                   class="text-decoration-none">
                                    <strong>{{ $person->father->name_ar ?? 'غير محدد' }}</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($person->mother)
                    <div class="col-md-4 mb-3">
                        <div class="card bg-light">
                            <div class="card-header">
                                <i class="fas fa-female me-1"></i>الأم
                            </div>
                            <div class="card-body">
                                <a href="{{ route('persons.show', [$family, $person->mother]) }}" 
                                   class="text-decoration-none">
                                    <strong>{{ $person->mother->name_ar ?? 'غير محدد' }}</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($person->spouse)
                    <div class="col-md-4 mb-3">
                        <div class="card bg-light">
                            <div class="card-header">
                                <i class="fas fa-heart me-1"></i>الزوج/الزوجة
                            </div>
                            <div class="card-body">
                                <a href="{{ route('persons.show', [$family, $person->spouse]) }}" 
                                   class="text-decoration-none">
                                    <strong>{{ $person->spouse->name_ar ?? 'غير محدد' }}</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($person->children->count() > 0)
                    <div class="col-12">
                        <h6 class="text-info">
                            <i class="fas fa-child me-1"></i>الأبناء ({{ $person->children->count() }})
                        </h6>
                        <div class="row">
                            @foreach($person->children as $child)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <a href="{{ route('persons.show', [$family, $child]) }}" 
                                           class="text-decoration-none">
                                            <h6 class="card-title mb-1">
                                                {{ $child->name_ar ?? 'غير محدد' }}
                                            </h6>
                                        </a>
                                        <p class="card-text text-muted small">
                                            @if($child->gender == 'ذكر')
                                                <i class="fas fa-male text-primary"></i> ابن
                                            @else
                                                <i class="fas fa-female text-pink"></i> ابنة
                                            @endif
                                            @if($child->birth_date)
                                                - {{ \Carbon\Carbon::parse($child->birth_date)->age }} سنة
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <div class="col-md-4">
                <h5 class="text-info mb-3">معلومات العائلة</h5>
                <div class="card bg-light">
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th class="text-muted" style="width: 100px;">رقم البطاقة:</th>
                                <td>
                                    <a href="{{ route('families.show', $family) }}" 
                                       class="text-decoration-none">
                                        <strong>{{ $family->family_card_number ?? 'غير محدد' }}</strong>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">الجمعية:</th>
                                <td>
                                    @if($family->association)
                                        {{ $family->association->name_ar ?? $family->association->name_en ?? 'غير محدد' }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">حالة السكن:</th>
                                <td>
                                    @if($family->housing_status)
                                        <span class="badge bg-info">{{ $family->housing_status }}</span>
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">العنوان:</th>
                                <td>{{ $family->address ?? 'غير محدد' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($person->is_family_head)
                <div class="card mt-3 bg-warning">
                    <div class="card-body text-center">
                        <i class="fas fa-crown fa-2x text-warning mb-2"></i>
                        <h6 class="mb-0">رب الأسرة</h6>
                        <small class="text-muted">هذا الفرد هو رب الأسرة</small>
                    </div>
                </div>
                @else
                <div class="card mt-3 bg-info">
                    <div class="card-body text-center">
                        <i class="fas fa-link fa-2x text-info mb-2"></i>
                        <h6 class="mb-0">العلاقة برب الأسرة</h6>
                        <small class="text-white">{{ $person->relationship_to_family_head ?? 'غير محدد' }}</small>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if(!$person->is_family_head)
        <div class="mt-4 text-center">
            <form action="{{ route('persons.destroy', [$family, $person]) }}" 
                  method="POST" 
                  class="d-inline" 
                  onsubmit="return confirm('هل أنت متأكد من حذف هذا الفرد؟')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-trash me-1"></i>حذف الفرد
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection