<?php
namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Family;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function index()
    {
        $beneficiaries = Beneficiary::with(['family', 'aidRecords'])->get();
        return view('beneficiaries.index', compact('beneficiaries'));
    }

    public function create()
    {
        $families = Family::orderBy('family_name')->get();
        return view('beneficiaries.create', compact('families'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date|before:today',
            'contact_info' => 'nullable|string|max:255',
            'family_id' => 'required|exists:families,id',
        ], [
            'name.required' => 'اسم المستفيد مطلوب',
            'name.max' => 'اسم المستفيد يجب أن لا يتجاوز 255 حرف',
            'date_of_birth.date' => 'تاريخ الميلاد يجب أن يكون تاريخ صحيح',
            'date_of_birth.before' => 'تاريخ الميلاد يجب أن يكون في الماضي',
            'contact_info.max' => 'معلومات الاتصال يجب أن لا تتجاوز 255 حرف',
            'family_id.required' => 'العائلة مطلوبة',
            'family_id.exists' => 'العائلة المختارة غير موجودة',
        ]);

        Beneficiary::create($validated);
        
        return redirect()->route('beneficiaries.index')
            ->with('success', 'تم إضافة المستفيد بنجاح');
    }

    public function show(Beneficiary $beneficiary)
    {
        $beneficiary->load(['family', 'aidRecords.association']);
        return view('beneficiaries.show', compact('beneficiary'));
    }

    public function edit(Beneficiary $beneficiary)
    {
        $families = Family::orderBy('family_name')->get();
        return view('beneficiaries.edit', compact('beneficiary', 'families'));
    }

    public function update(Request $request, Beneficiary $beneficiary)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date|before:today',
            'contact_info' => 'nullable|string|max:255',
            'family_id' => 'required|exists:families,id',
        ], [
            'name.required' => 'اسم المستفيد مطلوب',
            'name.max' => 'اسم المستفيد يجب أن لا يتجاوز 255 حرف',
            'date_of_birth.date' => 'تاريخ الميلاد يجب أن يكون تاريخ صحيح',
            'date_of_birth.before' => 'تاريخ الميلاد يجب أن يكون في الماضي',
            'contact_info.max' => 'معلومات الاتصال يجب أن لا تتجاوز 255 حرف',
            'family_id.required' => 'العائلة مطلوبة',
            'family_id.exists' => 'العائلة المختارة غير موجودة',
        ]);

        $beneficiary->update($validated);
        
        return redirect()->route('beneficiaries.index')
            ->with('success', 'تم تحديث بيانات المستفيد بنجاح');
    }

    public function destroy(Beneficiary $beneficiary)
    {
        // Check if beneficiary has aid records
        if ($beneficiary->aidRecords()->count() > 0) {
            return redirect()->route('beneficiaries.index')
                ->with('error', 'لا يمكن حذف المستفيد لوجود سجلات مساعدة مرتبطة به');
        }

        $beneficiary->delete();
        
        return redirect()->route('beneficiaries.index')
            ->with('success', 'تم حذف المستفيد بنجاح');
    }
} 