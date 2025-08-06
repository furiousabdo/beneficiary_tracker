@extends('layouts.app')

@section('title', 'تفاصيل المستفيد')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-heart me-2"></i>تفاصيل المستفيد
        </h3>
        <div class="btn-group" role="group">
            <a href="{{ route('beneficiaries.edit', $beneficiary) }}" class="btn btn-outline-secondary">
                <i class="fas fa-edit me-1"></i>تعديل
            </a>
            <a href="{{ route('beneficiaries.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-right me-1"></i>عودة
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-primary mb-3">المعلومات الأساسية</h5>
                <table class="table table-borderless">
                    <tr>
                        <th class="text-muted" style="width: 150px;">الاسم:</th>
                        <td><strong>{{ $beneficiary->name }}</strong></td>
                    </tr>
                    <tr>
                        <th class="text-muted">تاريخ الميلاد:</th>
                        <td>
                            @if($beneficiary->date_of_birth)
                                {{ \Carbon\Carbon::parse($beneficiary->date_of_birth)->format('Y/m/d') }}
                                <small class="text-muted">({{ \Carbon\Carbon::parse($beneficiary->date_of_birth)->age }} سنة)</small>
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">معلومات الاتصال:</th>
                        <td>
                            @if($beneficiary->contact_info)
                                {{ $beneficiary->contact_info }}
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">العائلة:</th>
                        <td>
                            @if($beneficiary->family)
                                <a href="{{ route('families.show', $beneficiary->family) }}" class="text-decoration-none">
                                    <i class="fas fa-home me-1"></i>{{ $beneficiary->family->family_name }}
                                </a>
                                <br>
                                <small class="text-muted">رب الأسرة: {{ $beneficiary->family->head_of_family }}</small>
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="col-md-6">
                <h5 class="text-success mb-3">سجلات المساعدة</h5>
                @if($beneficiary->aidRecords->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>التاريخ</th>
                                    <th>نوع المساعدة</th>
                                    <th>الجمعية</th>
                                    <th>القيمة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($beneficiary->aidRecords->take(5) as $aidRecord)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($aidRecord->date)->format('Y/m/d') }}</td>
                                        <td>{{ $aidRecord->aid_type }}</td>
                                        <td>
                                            @if($aidRecord->association)
                                                {{ $aidRecord->association->name }}
                                            @else
                                                <span class="text-muted">غير محدد</span>
                                            @endif
                                        </td>
                                        <td>{{ $aidRecord->amount ?? 'غير محدد' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($beneficiary->aidRecords->count() > 5)
                        <div class="text-center mt-2">
                            <small class="text-muted">عرض أول 5 سجلات من أصل {{ $beneficiary->aidRecords->count() }}</small>
                        </div>
                    @endif
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-hand-holding-heart fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">لا توجد سجلات مساعدة لهذا المستفيد</p>
                    </div>
                @endif
                
                <div class="mt-3">
                    <a href="{{ route('aid-records.create') }}?beneficiary_id={{ $beneficiary->id }}" 
                       class="btn btn-success btn-sm">
                        <i class="fas fa-plus me-1"></i>إضافة مساعدة جديدة
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 