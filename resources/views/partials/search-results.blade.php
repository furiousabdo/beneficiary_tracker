@if(!empty($results['persons']) && $results['persons']->count() > 0)
    <div class="mb-5">
        <h5 class="mb-3">
            <i class="fas fa-users me-2"></i>
            الأفراد ({{ $results['persons']->count() }})
        </h5>
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
                    @foreach($results['persons'] as $person)
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

@if(!empty($results['families']) && $results['families']->count() > 0)
    <div class="mb-5">
        <h5 class="mb-3">
            <i class="fas fa-home me-2"></i>
            العائلات ({{ $results['families']->count() }})
        </h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>رقم البطاقة</th>
                        <th>رب الأسرة</th>
                        <th>الجمعية</th>
                        <th>تاريخ التسجيل</th>
                        <th>حالة السكن</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results['families'] as $family)
                        <tr>
                            <td>{{ $family->family_card_number }}</td>
                            <td>{{ $family->father->name_ar ?? 'غير محدد' }}</td>
                            <td>{{ $family->association->name_ar ?? 'غير محدد' }}</td>
                            <td>{{ $family->registration_date->format('Y-m-d') }}</td>
                            <td>{{ $family->housing_status }}</td>
                            <td>
                                <a href="{{ route('families.show', $family) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

@if(!empty($results['associations']) && $results['associations']->count() > 0)
    <div class="mb-5">
        <h5 class="mb-3">
            <i class="fas fa-building me-2"></i>
            الجمعيات ({{ $results['associations']->count() }})
        </h5>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>العنوان</th>
                        <th>الهاتف</th>
                        <th>البريد الإلكتروني</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results['associations'] as $association)
                        <tr>
                            <td>{{ $association->name_ar }}</td>
                            <td>{{ Str::limit($association->address, 30) }}</td>
                            <td>{{ $association->phone }}</td>
                            <td>{{ $association->email ?? 'غير محدد' }}</td>
                            <td>
                                @if($association->is_active)
                                    <span class="badge bg-success">نشطة</span>
                                @else
                                    <span class="badge bg-secondary">غير نشطة</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('associations.show', $association) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
