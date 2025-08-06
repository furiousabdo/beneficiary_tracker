@extends('layouts.app')

@section('title', 'سجلات المساعدة')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-hand-holding-heart me-2"></i>سجلات المساعدة
        </h3>
        <a href="{{ route('aid-records.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>إضافة سجل مساعدة جديد
        </a>
    </div>
    <div class="card-body">
        @if($aidRecords->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>المستفيد</th>
                            <th>الجمعية</th>
                            <th>نوع المساعدة</th>
                            <th>المبلغ</th>
                            <th>التاريخ</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aidRecords as $aid)
                            <tr>
                                <td>{{ $aid->id }}</td>
                                <td>
                                    <strong>{{ $aid->beneficiary->name ?? 'غير محدد' }}</strong>
                                    @if($aid->beneficiary && $aid->beneficiary->family)
                                        <br>
                                        <small class="text-muted">{{ $aid->beneficiary->family->family_name }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($aid->association)
                                        {{ $aid->association->name_ar ?? $aid->association->name_en ?? 'غير محدد' }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $aid->aid_type }}</span>
                                </td>
                                <td>
                                    @if($aid->amount)
                                        {{ number_format($aid->amount, 2) }} ريال
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($aid->date)
                                        {{ \Carbon\Carbon::parse($aid->date)->format('Y/m/d') }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('aid-records.show', $aid) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('aid-records.edit', $aid) }}" 
                                           class="btn btn-sm btn-outline-secondary" 
                                           title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('aid-records.destroy', $aid) }}" 
                                              method="POST" 
                                              style="display:inline;"
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذا السجل؟')">
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
                <i class="fas fa-hand-holding-heart fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">لا توجد سجلات مساعدة مسجلة</h5>
                <p class="text-muted">ابدأ بإضافة سجل مساعدة جديد</p>
                <a href="{{ route('aid-records.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>إضافة سجل مساعدة جديد
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 