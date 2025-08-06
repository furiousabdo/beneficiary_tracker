@extends('layouts.app')

@section('title', 'الشجرة العائلية')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">
            <i class="fas fa-sitemap me-2"></i>الشجرة العائلية - {{ $family->family_card_number }}
        </h3>
        <div class="btn-group" role="group">
            <a href="{{ route('family-tree.add-child', [$family, $familyHead]) }}" class="btn btn-outline-success">
                <i class="fas fa-baby me-1"></i>إضافة طفل
            </a>
            @if(!$familyHead->spouse_id)
                <a href="{{ route('family-tree.add-spouse', [$family, $familyHead]) }}" class="btn btn-outline-info">
                    <i class="fas fa-heart me-1"></i>إضافة زوج/زوجة
                </a>
            @endif
            <a href="{{ route('families.show', $family) }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-right me-1"></i>عودة
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div id="family-tree-container" class="text-center">
                    <div id="family-tree"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-user me-1"></i>رب الأسرة
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">{{ $familyHead->name_ar }}</h6>
                        <p class="mb-1"><small class="text-muted">رقم الهوية:</small> {{ $familyHead->national_id }}</p>
                        <p class="mb-1"><small class="text-muted">تاريخ الميلاد:</small> 
                            {{ $familyHead->birth_date ? $familyHead->birth_date->format('Y/m/d') : 'غير محدد' }}
                        </p>
                        <p class="mb-1"><small class="text-muted">المهنة:</small> {{ $familyHead->occupation }}</p>
                        <p class="mb-0"><small class="text-muted">رقم الجوال:</small> {{ $familyHead->phone ?? 'غير محدد' }}</p>
                    </div>
                </div>

                @if($familyHead->spouse)
                <div class="card bg-light mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-heart me-1"></i>الزوج/الزوجة
                        </h5>
                        <form action="{{ route('family-tree.remove-spouse', [$family, $familyHead]) }}" 
                              method="POST" 
                              class="d-inline" 
                              onsubmit="return confirm('هل أنت متأكد من إزالة رابطة الزوجية؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <h6 class="text-info">{{ $familyHead->spouse->name_ar }}</h6>
                        <p class="mb-1"><small class="text-muted">رقم الهوية:</small> {{ $familyHead->spouse->national_id }}</p>
                        <p class="mb-1"><small class="text-muted">تاريخ الميلاد:</small> 
                            {{ $familyHead->spouse->birth_date ? $familyHead->spouse->birth_date->format('Y/m/d') : 'غير محدد' }}
                        </p>
                        <p class="mb-1"><small class="text-muted">المهنة:</small> {{ $familyHead->spouse->occupation }}</p>
                        <p class="mb-0"><small class="text-muted">رقم الجوال:</small> {{ $familyHead->spouse->phone ?? 'غير محدد' }}</p>
                    </div>
                </div>
                @endif

                <div class="card bg-light mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-child me-1"></i>الأطفال ({{ $familyHead->children->count() }})
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($familyHead->children->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($familyHead->children as $child)
                                    <div class="list-group-item d-flex justify-content-between align-items-center p-2">
                                        <div>
                                            <strong>{{ $child->name_ar }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                @if($child->gender == 'ذكر')
                                                    <i class="fas fa-male text-primary"></i> ذكر
                                                @else
                                                    <i class="fas fa-female text-pink"></i> أنثى
                                                @endif
                                                @if($child->birth_date)
                                                    - {{ \Carbon\Carbon::parse($child->birth_date)->age }} سنة
                                                @endif
                                            </small>
                                        </div>
                                        <a href="{{ route('persons.show', [$family, $child]) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted text-center mb-0">لا يوجد أطفال مسجلين</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .family-tree-node {
        display: inline-block;
        margin: 10px;
        padding: 15px;
        border: 2px solid #007bff;
        border-radius: 10px;
        background: #fff;
        min-width: 200px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .family-tree-node:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .family-tree-node.family-head {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border-color: #0056b3;
    }
    
    .family-tree-node.spouse {
        background: linear-gradient(135deg, #e83e8c, #c73e6b);
        color: white;
        border-color: #c73e6b;
    }
    
    .family-tree-node.child {
        background: linear-gradient(135deg, #28a745, #1e7e34);
        color: white;
        border-color: #1e7e34;
    }
    
    .family-tree-connection {
        position: relative;
        margin: 20px 0;
    }
    
    .family-tree-connection::before {
        content: '';
        position: absolute;
        top: -10px;
        left: 50%;
        width: 2px;
        height: 20px;
        background: #007bff;
    }
    
    .family-tree-row {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
    }
    
    .family-tree-parents {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .family-tree-children {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const familyTreeData = @json($familyTreeData);
    const container = document.getElementById('family-tree');
    
    function createFamilyTree(data) {
        let html = '<div class="family-tree-row">';
        
        // Family Head
        html += `<div class="family-tree-node family-head">
            <i class="fas fa-crown mb-2"></i><br>
            <strong>${data.name}</strong><br>
            <small>رب الأسرة</small>
        </div>`;
        
        // Spouse (if exists)
        if (data.spouse) {
            html += `<div class="family-tree-node spouse">
                <i class="fas fa-heart mb-2"></i><br>
                <strong>${data.spouse.name}</strong><br>
                <small>الزوج/الزوجة</small>
            </div>`;
        }
        
        html += '</div>';
        
        // Children
        if (data.children && data.children.length > 0) {
            html += '<div class="family-tree-connection"></div>';
            html += '<div class="family-tree-children">';
            
            data.children.forEach(child => {
                html += `<div class="family-tree-node child">
                    <i class="fas fa-child mb-2"></i><br>
                    <strong>${child.name}</strong><br>
                    <small>${child.gender === 'ذكر' ? 'ابن' : 'ابنة'}</small>
                </div>`;
            });
            
            html += '</div>';
        }
        
        return html;
    }
    
    container.innerHTML = createFamilyTree(familyTreeData);
});
</script>
@endpush
@endsection 