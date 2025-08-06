@extends('layouts.app')

@section('title', 'اسكان متابعة - الرئيسية')
@section('header', 'لوحة التحكم')

@section('content')
<!-- Search Form -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('search') }}" method="GET" class="row g-3">
            <div class="col-md-10">
                <div class="input-group">
                    <input type="text" name="q" class="form-control form-control-lg" placeholder="ابحث عن عائلة أو شخص أو جمعية..." required>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search me-1"></i> بحث
                    </button>
                </div>
                <small class="text-muted">يمكنك البحث باسم رب الأسرة، رقم الهوية، رقم البطاقة العائلية، أو اسم الجمعية</small>
            </div>
            <div class="col-md-2 text-md-end">
                <a href="{{ route('search.advanced') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-sliders-h me-1"></i> بحث متقدم
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">الجمعيات</h5>
                        <h2 class="mb-0">{{ $associationsCount }}</h2>
                    </div>
                    <i class="fas fa-building fa-3x"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('associations.index') }}">عرض التفاصيل</a>
                <div class="small text-white"><i class="fas fa-angle-left"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">العائلات</h5>
                        <h2 class="mb-0">{{ $familiesCount }}</h2>
                    </div>
                    <i class="fas fa-home fa-3x"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('families.index') }}">عرض التفاصيل</a>
                <div class="small text-white"><i class="fas fa-angle-left"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">الأفراد</h5>
                        <h2 class="mb-0">{{ $personsCount }}</h2>
                    </div>
                    <i class="fas fa-users fa-3x"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('persons.index') }}">عرض التفاصيل</a>
                <div class="small text-white"><i class="fas fa-angle-left"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">المستفيدين</h5>
                        <h2 class="mb-0">{{ $beneficiariesCount }}</h2>
                    </div>
                    <i class="fas fa-heart fa-3x"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('beneficiaries.index') }}">عرض التفاصيل</a>
                <div class="small text-white"><i class="fas fa-angle-left"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-danger mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">سجلات المساعدة</h5>
                        <h2 class="mb-0">{{ $aidRecordsCount }}</h2>
                    </div>
                    <i class="fas fa-hand-holding-heart fa-3x"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('aid-records.index') }}">عرض التفاصيل</a>
                <div class="small text-white"><i class="fas fa-angle-left"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">أحدث العائلات المسجلة</h5>
        <div class="btn-group" role="group">
            <a href="{{ route('associations.create') }}" class="btn btn-outline-primary btn-sm me-2">
                <i class="fas fa-plus"></i> إضافة جمعية
            </a>
            <a href="{{ route('families.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> إضافة عائلة جديدة
            </a>
        </div>
    </div>
    <div class="card-body">
        @if($recentFamilies->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>رقم البطاقة</th>
                            <th>اسم رب الأسرة</th>
                            <th>الجمعية</th>
                            <th>تاريخ التسجيل</th>
                            <th>حالة السكن</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentFamilies as $family)
                            <tr>
                                <td>{{ $family->family_card_number }}</td>
                                <td>{{ $family->father->name_ar ?? 'غير محدد' }}</td>
                                <td>{{ $family->association->name_ar }}</td>
                                <td>{{ $family->registration_date->format('Y-m-d') }}</td>
                                <td>{{ $family->housing_status }}</td>
                                <td>
                                    <a href="{{ route('families.show', $family) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('families.edit', $family) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">لا توجد عائلات مسجلة بعد.</div>
        @endif
    </div>
</div>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">أحدث الأفراد المسجلين</h5>
        <a href="{{ route('persons.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> إضافة فرد جديد
        </a>
    </div>
    <div class="card-body">
        @if(isset($recentPersons) && $recentPersons->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>رقم الهوية</th>
                            <th>العائلة</th>
                            <th>الجمعية</th>
                            <th>تاريخ الميلاد</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentPersons as $person)
                            <tr>
                                <td>{{ $person->name_ar }}</td>
                                <td>{{ $person->national_id }}</td>
                                <td>{{ $person->family->father->name_ar ?? 'غير محدد' }}</td>
                                <td>{{ $person->family->association->name_ar ?? 'غير محدد' }}</td>
                                <td>{{ $person->birth_date->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('persons.show', ['family' => $person->family_id, 'person' => $person->id]) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('persons.edit', ['family' => $person->family_id, 'person' => $person->id]) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">لا توجد سجلات أفراد مسجلة بعد.</div>
        @endif
    </div>
</div>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">أحدث المستفيدين المسجلين</h5>
        <a href="{{ route('beneficiaries.create') }}" class="btn btn-warning btn-sm">
            <i class="fas fa-plus"></i> إضافة مستفيد جديد
        </a>
    </div>
    <div class="card-body">
        @if(isset($recentBeneficiaries) && $recentBeneficiaries->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>تاريخ الميلاد</th>
                            <th>العائلة</th>
                            <th>معلومات الاتصال</th>
                            <th>عدد المساعدات</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentBeneficiaries as $beneficiary)
                            <tr>
                                <td><strong>{{ $beneficiary->name }}</strong></td>
                                <td>
                                    @if($beneficiary->date_of_birth)
                                        {{ \Carbon\Carbon::parse($beneficiary->date_of_birth)->format('Y/m/d') }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($beneficiary->family)
                                        <a href="{{ route('families.show', $beneficiary->family) }}" class="text-decoration-none">
                                            {{ $beneficiary->family->family_name }}
                                        </a>
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($beneficiary->contact_info)
                                        {{ $beneficiary->contact_info }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $beneficiary->aidRecords->count() }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('beneficiaries.show', $beneficiary) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('beneficiaries.edit', $beneficiary) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">لا توجد مستفيدين مسجلين بعد.</div>
        @endif
    </div>
</div>

<!-- Add Person Modal -->
<div class="modal fade" id="addPersonModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة فرد جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>الرجاء اختيار العائلة أولاً:</p>
                <select class="form-select mb-3" id="familySelect">
                    <option value="">-- اختر العائلة --</option>
                    @foreach($recentFamilies as $family)
                        <option value="{{ route('families.persons.create', $family) }}">
                            {{ $family->father->name_ar ?? 'عائلة ' . $family->id }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <a href="#" id="proceedToAddPerson" class="btn btn-primary">متابعة</a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const familySelect = document.getElementById('familySelect');
        const proceedBtn = document.getElementById('proceedToAddPerson');
        
        familySelect.addEventListener('change', function() {
            proceedBtn.href = this.value;
            proceedBtn.disabled = !this.value;
        });
        
        // Initialize button state
        proceedBtn.disabled = true;
    });
</script>
@endpush

@endsection