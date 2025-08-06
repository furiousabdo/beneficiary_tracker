@extends('layouts.app')

@section('title', 'المستفيدين')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-heart me-2"></i>المستفيدين
        </h3>
        <a href="{{ route('beneficiaries.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>إضافة مستفيد جديد
        </a>
    </div>
    <div class="card-body">
        @if($beneficiaries->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>تاريخ الميلاد</th>
                            <th>معلومات الاتصال</th>
                            <th>العائلة</th>
                            <th>عدد المساعدات</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beneficiaries as $beneficiary)
                            <tr>
                                <td>{{ $beneficiary->id }}</td>
                                <td>
                                    <strong>{{ $beneficiary->name }}</strong>
                                </td>
                                <td>
                                    @if($beneficiary->date_of_birth)
                                        {{ \Carbon\Carbon::parse($beneficiary->date_of_birth)->format('Y/m/d') }}
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
                                    @if($beneficiary->family)
                                        <a href="{{ route('families.show', $beneficiary->family) }}" class="text-decoration-none">
                                            {{ $beneficiary->family->family_name }}
                                        </a>
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $beneficiary->aidRecords->count() }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('beneficiaries.show', $beneficiary) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('beneficiaries.edit', $beneficiary) }}" 
                                           class="btn btn-sm btn-outline-secondary" 
                                           title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('beneficiaries.destroy', $beneficiary) }}" 
                                              method="POST" 
                                              style="display:inline;"
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذا المستفيد؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">لا توجد مستفيدين مسجلين</h5>
                <p class="text-muted">ابدأ بإضافة مستفيد جديد</p>
                <a href="{{ route('beneficiaries.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>إضافة مستفيد جديد
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 