<?php

namespace App\Http\Controllers;

use App\Models\AidRecord;
use App\Models\Beneficiary;
use App\Models\Association;
use Illuminate\Http\Request;

class AidRecordController extends Controller
{
    public function index()
    {
        $aidRecords = AidRecord::with(['beneficiary.family', 'association'])->latest()->get();
        return view('aid_records.index', compact('aidRecords'));
    }

    public function create(Request $request)
    {
        $beneficiaries = Beneficiary::with('family')->orderBy('name')->get();
        $associations = Association::orderBy('name_ar')->get();
        $selectedBeneficiaryId = $request->query('beneficiary_id');
        
        return view('aid_records.create', compact('beneficiaries', 'associations', 'selectedBeneficiaryId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'association_id' => 'required|exists:associations,id',
            'aid_type' => 'required|string|max:255',
            'amount' => 'nullable|numeric|min:0',
            'date' => 'required|date|before_or_equal:today',
            'notes' => 'nullable|string|max:1000',
        ], [
            'beneficiary_id.required' => 'المستفيد مطلوب',
            'beneficiary_id.exists' => 'المستفيد المختار غير موجود',
            'association_id.required' => 'الجمعية مطلوبة',
            'association_id.exists' => 'الجمعية المختارة غير موجودة',
            'aid_type.required' => 'نوع المساعدة مطلوب',
            'aid_type.max' => 'نوع المساعدة يجب أن لا يتجاوز 255 حرف',
            'amount.numeric' => 'المبلغ يجب أن يكون رقم',
            'amount.min' => 'المبلغ يجب أن يكون أكبر من صفر',
            'date.required' => 'تاريخ المساعدة مطلوب',
            'date.date' => 'تاريخ المساعدة يجب أن يكون تاريخ صحيح',
            'date.before_or_equal' => 'تاريخ المساعدة يجب أن يكون اليوم أو في الماضي',
            'notes.max' => 'الملاحظات يجب أن لا تتجاوز 1000 حرف',
        ]);

        AidRecord::create($validated);
        
        return redirect()->route('aid-records.index')
            ->with('success', 'تم إضافة سجل المساعدة بنجاح');
    }

    public function show(AidRecord $aidRecord)
    {
        $aidRecord->load(['beneficiary.family', 'association']);
        return view('aid_records.show', compact('aidRecord'));
    }

    public function edit(AidRecord $aidRecord)
    {
        $beneficiaries = Beneficiary::with('family')->orderBy('name')->get();
        $associations = Association::orderBy('name_ar')->get();
        return view('aid_records.edit', compact('aidRecord', 'beneficiaries', 'associations'));
    }

    public function update(Request $request, AidRecord $aidRecord)
    {
        $validated = $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'association_id' => 'required|exists:associations,id',
            'aid_type' => 'required|string|max:255',
            'amount' => 'nullable|numeric|min:0',
            'date' => 'required|date|before_or_equal:today',
            'notes' => 'nullable|string|max:1000',
        ], [
            'beneficiary_id.required' => 'المستفيد مطلوب',
            'beneficiary_id.exists' => 'المستفيد المختار غير موجود',
            'association_id.required' => 'الجمعية مطلوبة',
            'association_id.exists' => 'الجمعية المختارة غير موجودة',
            'aid_type.required' => 'نوع المساعدة مطلوب',
            'aid_type.max' => 'نوع المساعدة يجب أن لا يتجاوز 255 حرف',
            'amount.numeric' => 'المبلغ يجب أن يكون رقم',
            'amount.min' => 'المبلغ يجب أن يكون أكبر من صفر',
            'date.required' => 'تاريخ المساعدة مطلوب',
            'date.date' => 'تاريخ المساعدة يجب أن يكون تاريخ صحيح',
            'date.before_or_equal' => 'تاريخ المساعدة يجب أن يكون اليوم أو في الماضي',
            'notes.max' => 'الملاحظات يجب أن لا تتجاوز 1000 حرف',
        ]);

        $aidRecord->update($validated);
        
        return redirect()->route('aid-records.index')
            ->with('success', 'تم تحديث سجل المساعدة بنجاح');
    }

    public function destroy(AidRecord $aidRecord)
    {
        $aidRecord->delete();
        
        return redirect()->route('aid-records.index')
            ->with('success', 'تم حذف سجل المساعدة بنجاح');
    }
} 