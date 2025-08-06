@extends('layouts.app')

@section('title', 'تفاصيل العائلة')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h3 class="mb-0">
                <i class="fas fa-home me-2"></i>عائلة {{ $family->name_ar ?? 'غير محدد' }}
            </h3>
            @if($family->father)
                <small class="text-muted">رب الأسرة: {{ $family->father->name_ar }}</small>
            @endif
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('families.edit', $family) }}" class="btn btn-outline-secondary">
                <i class="fas fa-edit me-1"></i>تعديل
            </a>
            <a href="{{ route('families.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-right me-1"></i>عودة
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h5 class="text-primary mb-3">المعلومات الأساسية</h5>
                <table class="table table-borderless">
                    <tr>
                        <th class="text-muted" style="width: 150px;">رقم البطاقة العائلية:</th>
                        <td><strong>{{ $family->family_card_number ?? 'غير محدد' }}</strong></td>
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
                        <th class="text-muted">تاريخ التسجيل:</th>
                        <td>
                            @if($family->registration_date)
                                {{ \Carbon\Carbon::parse($family->registration_date)->format('Y/m/d') }}
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
                    @if($family->notes)
                        <tr>
                            <th class="text-muted">الملاحظات:</th>
                            <td>{{ $family->notes }}</td>
                        </tr>
                    @endif
                </table>

                <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                    <h5 class="text-success mb-0">أفراد العائلة</h5>
                    <a href="{{ route('families.persons.create', $family) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus me-1"></i>إضافة فرد جديد
                    </a>
                </div>
                @if($family->persons->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>الاسم</th>
                                    <th>رقم الهوية</th>
                                    <th>النوع</th>
                                    <th>العلاقة</th>
                                    <th>العمر</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($family->persons as $person)
                                    <tr>
                                        <td><strong>{{ $person->name_ar ?? 'غير محدد' }}</strong></td>
                                        <td>{{ $person->national_id ?? 'غير محدد' }}</td>
                                        <td>
                                            @if($person->gender == 'ذكر')
                                                <span class="badge bg-primary">ذكر</span>
                                            @elseif($person->gender == 'أنثى')
                                                <span class="badge bg-pink">أنثى</span>
                                            @else
                                                <span class="text-muted">غير محدد</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($person->is_family_head)
                                                <span class="badge bg-success">رب الأسرة</span>
                                            @else
                                                {{ $person->relationship ?? '-' }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($person->birth_date)
                                                {{ \Carbon\Carbon::parse($person->birth_date)->age }} سنة
                                            @else
                                                <span class="text-muted">غير محدد</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('persons.show', [$family, $person]) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="عرض">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-users fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">لا يوجد أفراد مسجلين في هذه العائلة</p>
                        <a href="{{ route('families.persons.create', $family) }}" class="btn btn-success mt-2">
                            <i class="fas fa-plus me-1"></i>إضافة أول فرد
                        </a>
                    </div>
                @endif
            </div>
            
            <div class="col-md-4">
                <h5 class="text-info mb-3">بيانات رب الأسرة</h5>
                @if($family->father)
                    <div class="card bg-light">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th class="text-muted" style="width: 100px;">الاسم:</th>
                                    <td><strong>{{ $family->father->name_ar ?? 'غير محدد' }}</strong></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">رقم الهوية:</th>
                                    <td>{{ $family->father->national_id ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">تاريخ الميلاد:</th>
                                    <td>
                                        @if($family->father->birth_date)
                                            {{ \Carbon\Carbon::parse($family->father->birth_date)->format('Y/m/d') }}
                                        @else
                                            <span class="text-muted">غير محدد</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">العمر:</th>
                                    <td>
                                        @if($family->father->birth_date)
                                            {{ \Carbon\Carbon::parse($family->father->birth_date)->age }} سنة
                                        @else
                                            <span class="text-muted">غير محدد</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">رقم الجوال:</th>
                                    <td>{{ $family->father->phone ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">المهنة:</th>
                                    <td>{{ $family->father->occupation ?? 'غير محدد' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-user-slash fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">لا يوجد بيانات لرب الأسرة</p>
                    </div>
                @endif

                <h5 class="text-warning mb-3 mt-4">إحصائيات العائلة</h5>
                <div class="row">
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h4 class="text-primary mb-0">{{ $family->persons->count() }}</h4>
                                <small class="text-muted">إجمالي الأفراد</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h4 class="text-success mb-0">{{ $family->persons->where('gender', 'ذكر')->count() }}</h4>
                                <small class="text-muted">الذكور</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h4 class="text-pink mb-0">{{ $family->persons->where('gender', 'أنثى')->count() }}</h4>
                                <small class="text-muted">الإناث</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h4 class="text-info mb-0">
                                    {{ $family->persons->filter(function($person) {
                                        return $person->birth_date && \Carbon\Carbon::parse($person->birth_date)->age < 18;
                                    })->count() }}
                                </h4>
                                <small class="text-muted">الأطفال</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('family-tree.show', $family) }}" class="btn btn-info">
                <i class="fas fa-sitemap me-1"></i>عرض الشجرة العائلية
            </a>
        </div>
    </div>
</div>
@endsection