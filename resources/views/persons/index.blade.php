@extends('layouts.app')

@section('title', 'الأشخاص')
@section('header', 'قائمة الأشخاص')

@section('actions')
    <div class="btn-group" role="group">
        <a href="{{ route('persons.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-list"></i> عرض الكل
        </a>
        <a href="{{ route('families.index') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> إضافة شخص جديد
        </a>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>رقم الهوية</th>
                        <th>العائلة</th>
                        <th>الجمعية</th>
                        <th>الجنس</th>
                        <th>تاريخ الميلاد</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($persons as $person)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $person->name_ar }}</td>
                            <td>{{ $person->national_id ?? '--' }}</td>
                            <td>{{ $person->family->father->name_ar ?? 'غير محدد' }}</td>
                            <td>{{ $person->family->association->name_ar ?? 'غير محدد' }}</td>
                            <td>
                                @if($person->gender == 'male')
                                    <span class="badge bg-primary">ذكر</span>
                                @else
                                    <span class="badge bg-pink">أنثى</span>
                                @endif
                            </td>
                            <td>{{ $person->birth_date->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('persons.show', ['family' => $person->family_id, 'person' => $person->id]) }}" 
                                   class="btn btn-sm btn-info" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('persons.edit', ['family' => $person->family_id, 'person' => $person->id]) }}" 
                                   class="btn btn-sm btn-warning" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('persons.destroy', ['family' => $person->family_id, 'person' => $person->id]) }}" 
                                      method="POST" class="d-inline" 
                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الشخص؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="حذف">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    لا توجد سجلات للأشخاص
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($persons->hasPages())
            <div class="mt-4">
                {{ $persons->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Add Person Modal -->
<div class="modal fade" id="addPersonModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة شخص جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>الرجاء اختيار العائلة أولاً:</p>
                <select class="form-select mb-3" id="familySelect">
                    <option value="">-- اختر العائلة --</option>
                    @foreach($families as $family)
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
