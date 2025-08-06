@extends('layouts.app')

@section('title', 'تفاصيل سجل المساعدة')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-hand-holding-heart me-2"></i>تفاصيل سجل المساعدة
        </h3>
        <div class="btn-group" role="group">
            <a href="{{ route('aid-records.edit', $aidRecord) }}" class="btn btn-outline-secondary">
                <i class="fas fa-edit me-1"></i>تعديل
            </a>
            <a href="{{ route('aid-records.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-right me-1"></i>عودة
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-primary mb-3">معلومات المساعدة</h5>
                <table class="table table-borderless">
                    <tr>
                        <th class="text-muted" style="width: 150px;">نوع المساعدة:</th>
                        <td><span class="badge bg-info fs-6">{{ $aidRecord->aid_type }}</span></td>
                    </tr>
                    <tr>
                        <th class="text-muted">المبلغ:</th>
                        <td>
                            @if($aidRecord->amount)
                                <strong>{{ number_format($aidRecord->amount, 2) }} ريال</strong>
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">تاريخ المساعدة:</th>
                        <td>
                            @if($aidRecord->date)
                                {{ \Carbon\Carbon::parse($aidRecord->date)->format('Y/m/d') }}
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">الجمعية:</th>
                        <td>
                            @if($aidRecord->association)
                                <strong>{{ $aidRecord->association->name_ar ?? $aidRecord->association->name_en ?? $aidRecord->association->name }}</strong>
                            @else
                                <span class="text-muted">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    @if($aidRecord->notes)
                        <tr>
                            <th class="text-muted">الملاحظات:</th>
                            <td>{{ $aidRecord->notes }}</td>
                        </tr>
                    @endif
                </table>
            </div>
            
            <div class="col-md-6">
                <h5 class="text-success mb-3">معلومات المستفيد</h5>
                @if($aidRecord->beneficiary)
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-muted" style="width: 150px;">الاسم:</th>
                            <td>
                                <strong>{{ $aidRecord->beneficiary->name }}</strong>
                                <a href="{{ route('beneficiaries.show', $aidRecord->beneficiary) }}" 
                                   class="btn btn-sm btn-outline-primary ms-2">
                                    <i class="fas fa-eye"></i> عرض
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">تاريخ الميلاد:</th>
                            <td>
                                @if($aidRecord->beneficiary->date_of_birth)
                                    {{ \Carbon\Carbon::parse($aidRecord->beneficiary->date_of_birth)->format('Y/m/d') }}
                                    <small class="text-muted">({{ \Carbon\Carbon::parse($aidRecord->beneficiary->date_of_birth)->age }} سنة)</small>
                                @else
                                    <span class="text-muted">غير محدد</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">معلومات الاتصال:</th>
                            <td>
                                @if($aidRecord->beneficiary->contact_info)
                                    {{ $aidRecord->beneficiary->contact_info }}
                                @else
                                    <span class="text-muted">غير محدد</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">العائلة:</th>
                            <td>
                                @if($aidRecord->beneficiary->family)
                                    <a href="{{ route('families.show', $aidRecord->beneficiary->family) }}" class="text-decoration-none">
                                        <i class="fas fa-home me-1"></i>{{ $aidRecord->beneficiary->family->family_name }}
                                    </a>
                                    <br>
                                    <small class="text-muted">رب الأسرة: {{ $aidRecord->beneficiary->family->head_of_family }}</small>
                                @else
                                    <span class="text-muted">غير محدد</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-user-slash fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">المستفيد غير محدد</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 