@extends('layouts.app')

@section('title', 'الأفراد')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-users me-2"></i>الأفراد
        </h3>
        <div class="d-flex gap-2">
            <a href="{{ route('families.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-home me-1"></i>العائلات
            </a>
            <a href="{{ route('persons.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>إضافة فرد جديد
            </a>
        </div>
    </div>
    <div class="card-body">
        @if($persons->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>رقم الهوية</th>
                            <th>اسم العائلة</th>
                            <th>الجمعية</th>
                            <th>الجنس</th>
                            <th>العلاقة برب الأسرة</th>
                            <th>تاريخ الميلاد</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($persons as $person)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $person->name_ar ?? 'غير محدد' }}</strong>
                                </td>
                                <td>
                                    @if($person->national_id)
                                        {{ $person->national_id }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($person->family)
                                        <strong>{{ $person->family->name_ar ?? 'غير محدد' }}</strong>
                                        @if($person->family->father)
                                            <br><small class="text-muted">رب الأسرة: {{ $person->family->father->name_ar }}</small>
                                        @endif
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($person->family && $person->family->association)
                                        {{ $person->family->association->name_ar ?? $person->family->association->name_en ?? 'غير محدد' }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
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
                                        <span class="badge bg-warning">رب الأسرة</span>
                                    @elseif($person->relationship_to_family_head)
                                        <span class="badge bg-info">{{ $person->relationship_to_family_head }}</span>
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($person->birth_date)
                                        {{ \Carbon\Carbon::parse($person->birth_date)->format('Y/m/d') }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('persons.show', ['family' => $person->family_id, 'person' => $person->id]) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('persons.edit', ['family' => $person->family_id, 'person' => $person->id]) }}" 
                                           class="btn btn-sm btn-outline-secondary" 
                                           title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('persons.destroy', ['family' => $person->family_id, 'person' => $person->id]) }}" 
                                              method="POST" 
                                              style="display:inline;"
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذا الفرد؟')">
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
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">لا توجد أفراد مسجلين</h5>
                <p class="text-muted">ابدأ بإضافة عائلة جديدة أو فرد جديد</p>
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('families.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-home me-1"></i>إضافة عائلة جديدة
                    </a>
                    <a href="{{ route('persons.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>إضافة فرد جديد
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
