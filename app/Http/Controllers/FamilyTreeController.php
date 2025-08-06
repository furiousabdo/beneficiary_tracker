<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Person;
use Illuminate\Http\Request;

class FamilyTreeController extends Controller
{
    /**
     * Display the family tree for a specific family
     */
    public function show(Family $family)
    {
        $family->load(['father', 'persons']);
        
        // Get the family head (father)
        $familyHead = $family->father;
        
        if (!$familyHead) {
            return redirect()->route('families.show', $family)
                ->with('error', 'لا يوجد رب أسرة لهذه العائلة');
        }

        // Get family tree data
        $familyTreeData = $familyHead->getFamilyTreeData();
        
        return view('family-tree.show', compact('family', 'familyHead', 'familyTreeData'));
    }

    /**
     * Show form to add a child to a family head
     */
    public function addChild(Family $family, Person $person)
    {
        // Ensure the person is a family head
        if (!$person->is_family_head) {
            return redirect()->route('families.show', $family)
                ->with('error', 'يمكن إضافة الأطفال لرب الأسرة فقط');
        }

        $familyMembers = $family->persons()
            ->where('id', '!=', $person->id)
            ->pluck('name_ar', 'id');

        return view('family-tree.add-child', compact('family', 'person', 'familyMembers'));
    }

    /**
     * Store a new child
     */
    public function storeChild(Request $request, Family $family, Person $person)
    {
        // Ensure the person is a family head
        if (!$person->is_family_head) {
            return redirect()->route('families.show', $family)
                ->with('error', 'يمكن إضافة الأطفال لرب الأسرة فقط');
        }

        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'national_id' => 'required|string|max:20|unique:persons,national_id',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:ذكر,أنثى',
            'marital_status' => 'required|in:أعزب,متزوج,مطلق,أرمل',
            'occupation' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'mother_id' => 'nullable|exists:persons,id',
        ], [
            'name_ar.required' => 'الاسم مطلوب',
            'national_id.required' => 'رقم الهوية مطلوب',
            'national_id.unique' => 'رقم الهوية مستخدم مسبقاً',
            'birth_date.required' => 'تاريخ الميلاد مطلوب',
            'birth_date.before' => 'تاريخ الميلاد يجب أن يكون في الماضي',
            'gender.required' => 'النوع مطلوب',
            'marital_status.required' => 'الحالة الاجتماعية مطلوبة',
            'occupation.required' => 'المهنة مطلوبة',
        ]);

        $validated['family_id'] = $family->id;
        $validated['father_id'] = $person->id; // Set the family head as father
        $validated['is_family_head'] = false;

        Person::create($validated);

        return redirect()->route('family-tree.show', $family)
            ->with('success', 'تم إضافة الطفل بنجاح');
    }

    /**
     * Show form to add a spouse to a family head
     */
    public function addSpouse(Family $family, Person $person)
    {
        // Ensure the person is a family head
        if (!$person->is_family_head) {
            return redirect()->route('families.show', $family)
                ->with('error', 'يمكن إضافة الزوج/الزوجة لرب الأسرة فقط');
        }

        // Check if already has a spouse
        if ($person->spouse_id) {
            return redirect()->route('family-tree.show', $family)
                ->with('error', 'رب الأسرة لديه زوج/زوجة بالفعل');
        }

        $familyMembers = $family->persons()
            ->where('id', '!=', $person->id)
            ->where('gender', '!=', $person->gender) // Opposite gender
            ->pluck('name_ar', 'id');

        return view('family-tree.add-spouse', compact('family', 'person', 'familyMembers'));
    }

    /**
     * Store a new spouse relationship
     */
    public function storeSpouse(Request $request, Family $family, Person $person)
    {
        // Ensure the person is a family head
        if (!$person->is_family_head) {
            return redirect()->route('families.show', $family)
                ->with('error', 'يمكن إضافة الزوج/الزوجة لرب الأسرة فقط');
        }

        $validated = $request->validate([
            'spouse_id' => 'required|exists:persons,id',
        ], [
            'spouse_id.required' => 'يجب اختيار الزوج/الزوجة',
            'spouse_id.exists' => 'الشخص المختار غير موجود',
        ]);

        // Check if the selected person is of opposite gender
        $spouse = Person::find($validated['spouse_id']);
        if ($spouse->gender === $person->gender) {
            return back()->withInput()->with('error', 'يجب أن يكون الزوج/الزوجة من الجنس الآخر');
        }

        // Update both persons to link them as spouses
        $person->update(['spouse_id' => $validated['spouse_id']]);
        $spouse->update(['spouse_id' => $person->id]);

        return redirect()->route('family-tree.show', $family)
            ->with('success', 'تم ربط الزوج/الزوجة بنجاح');
    }

    /**
     * Remove spouse relationship
     */
    public function removeSpouse(Family $family, Person $person)
    {
        if (!$person->spouse_id) {
            return redirect()->route('family-tree.show', $family)
                ->with('error', 'لا يوجد زوج/زوجة لإزالته');
        }

        $spouse = Person::find($person->spouse_id);
        
        // Remove spouse relationship from both persons
        $person->update(['spouse_id' => null]);
        $spouse->update(['spouse_id' => null]);

        return redirect()->route('family-tree.show', $family)
            ->with('success', 'تم إزالة رابطة الزوجية بنجاح');
    }
}
