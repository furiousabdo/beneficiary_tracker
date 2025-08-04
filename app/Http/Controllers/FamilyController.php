<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Association;
use App\Models\Person;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::with(['association', 'father'])->latest()->paginate(10);
        return view('families.index', compact('families'));
    }

    public function create()
    {
        $associations = Association::active()->get();
        return view('families.create', compact('associations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'association_id' => 'required|exists:associations,id',
            'family_card_number' => 'required|string|max:50|unique:families',
            'registration_date' => 'required|date',
            'housing_status' => 'required|in:مستأجر,مستفيد من سكن حكومي,يمتلك سكناً',
            'address' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'father' => 'required|array',
            'father.name_ar' => 'required|string|max:255',
            'father.national_id' => 'required|string|max:20|unique:persons,national_id',
            'father.birth_date' => 'required|date',
            'father.phone' => 'required|string|max:20',
            'father.occupation' => 'required|string|max:100',
        ]);

        \DB::beginTransaction();
        try {
            $family = Family::create($validated);

            $father = Person::create([
                'name_ar' => $validated['father']['name_ar'],
                'national_id' => $validated['father']['national_id'],
                'birth_date' => $validated['father']['birth_date'],
                'phone' => $validated['father']['phone'],
                'occupation' => $validated['father']['occupation'],
                'gender' => 'ذكر',
                'marital_status' => 'متزوج',
                'family_id' => $family->id,
                'is_family_head' => true,
            ]);

            $family->update(['father_id' => $father->id]);

            \DB::commit();
            return redirect()->route('families.show', $family)
                ->with('success', 'تم إضافة العائلة بنجاح');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withInput()->with('error', 'حدث خطأ أثناء حفظ البيانات');
        }
    }

    public function show(Family $family)
    {
        $family->load(['father', 'mother', 'persons']);
        return view('families.show', compact('family'));
    }

    public function edit(Family $family)
    {
        $associations = Association::active()->get();
        $family->load('father');
        return view('families.edit', compact('family', 'associations'));
    }

    public function update(Request $request, Family $family)
    {
        $validated = $request->validate([
            'association_id' => 'required|exists:associations,id',
            'family_card_number' => 'required|string|max:50|unique:families,family_card_number,' . $family->id,
            'registration_date' => 'required|date',
            'housing_status' => 'required|in:مستأجر,مستفيد من سكن حكومي,يمتلك سكناً',
            'address' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $family->update($validated);

        return redirect()->route('families.show', $family)
            ->with('success', 'تم تحديث بيانات العائلة بنجاح');
    }

    public function destroy(Family $family)
    {
        if ($family->persons()->count() > 1) {
            return redirect()->back()
                ->with('error', 'لا يمكن حذف العائلة لأنها تحتوي على أفراد');
        }

        \DB::beginTransaction();
        try {
            $family->persons()->delete();
            $family->delete();
            \DB::commit();
            return redirect()->route('families.index')
                ->with('success', 'تم حذف العائلة بنجاح');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء حذف العائلة');
        }
    }

    public function tree(Family $family)
    {
        $family->load(['father.children', 'mother']);
        return view('families.tree', compact('family'));
    }
}