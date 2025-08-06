<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    /**
     * Display a listing of persons.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $persons = Person::with(['family.association', 'family.father'])
            ->latest()
            ->paginate(15);
            
        $families = Family::with('father')
            ->orderBy('id', 'desc')
            ->limit(100)
            ->get();
            
        return view('persons.index', compact('persons', 'families'));
    }

    public function create(Family $family = null)
    {
        $familyMembers = collect();
        
        if ($family && $family->exists) {
            $family->load('father');
            $familyMembers = $family->persons()->pluck('name_ar', 'id');
        } else {
            // If no family provided, get recent families for the family dropdown
            $recentFamilies = Family::with('father')
                ->orderBy('id', 'desc')
                ->limit(50)
                ->get();
            
            return view('persons.create', [
                'family' => null,
                'recentFamilies' => $recentFamilies,
                'familyMembers' => $familyMembers
            ]);
        }
        
        return view('persons.create', compact('family', 'familyMembers'));
    }

    public function store(Request $request, Family $family = null)
    {
        // If no family provided in URL, get it from the request
        if (!$family || !$family->exists) {
            $request->validate(['family_id' => 'required|exists:families,id']);
            $family = Family::findOrFail($request->family_id);
        }
        
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'national_id' => 'required|string|max:20|unique:persons,national_id',
            'birth_date' => 'required|date',
            'gender' => 'required|in:ذكر,أنثى',
            'marital_status' => 'required|in:أعزب,متزوج,مطلق,أرمل',
            'occupation' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'father_id' => 'nullable|exists:persons,id',
            'mother_id' => 'nullable|exists:persons,id',
            'spouse_id' => 'nullable|exists:persons,id',
            'relationship_to_family_head' => 'required|in:رب الأسرة,زوجة,ابن,ابنة,أب,أم,أخ,أخت,جد,جدة,عم,عمة,خال,خالة,ابن الأخ,ابنة الأخ,ابن الأخت,ابنة الأخت,حفيد,حفيدة,أخرى',
        ]);

        $validated['family_id'] = $family->id;
        
        // Set is_family_head based on the relationship
        $validated['is_family_head'] = ($validated['relationship_to_family_head'] === 'رب الأسرة');

        $person = Person::create($validated);
        
        // If the person is not the family head, update their relationship automatically
        if (!$person->is_family_head) {
            $person->updateRelationshipToFamilyHead();
        }

        return redirect()->route('families.show', $family)
            ->with('success', 'تمت إضافة الفرد بنجاح');
    }

    public function show(Family $family, Person $person)
    {
        $person->load(['family.association', 'father', 'mother', 'spouse', 'children']);
        return view('persons.show', compact('person', 'family'));
    }

    public function edit(Family $family, Person $person)
    {
        $familyMembers = $family->persons()
            ->where('id', '!=', $person->id)
            ->pluck('name_ar', 'id');
            
        return view('persons.edit', compact('person', 'family', 'familyMembers'));
    }

    public function update(Request $request, Family $family, Person $person)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'national_id' => 'required|string|max:20|unique:persons,national_id,' . $person->id,
            'birth_date' => 'required|date',
            'gender' => 'required|in:ذكر,أنثى',
            'marital_status' => 'required|in:أعزب,متزوج,مطلق,أرمل',
            'occupation' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'father_id' => 'nullable|exists:persons,id',
            'mother_id' => 'nullable|exists:persons,id',
            'spouse_id' => 'nullable|exists:persons,id',
            'relationship_to_family_head' => 'required|in:رب الأسرة,زوجة,ابن,ابنة,أب,أم,أخ,أخت,جد,جدة,عم,عمة,خال,خالة,ابن الأخ,ابنة الأخ,ابن الأخت,ابنة الأخت,حفيد,حفيدة,أخرى',
        ]);

        // Set is_family_head based on the relationship
        $validated['is_family_head'] = ($validated['relationship_to_family_head'] === 'رب الأسرة');

        $person->update($validated);
        
        // If the person is not the family head, update their relationship automatically
        if (!$person->is_family_head) {
            $person->updateRelationshipToFamilyHead();
        }

        return redirect()->route('families.show', $family)
            ->with('success', 'تم تحديث بيانات الفرد بنجاح');
    }

    public function destroy(Family $family, Person $person)
    {
        if ($person->is_family_head) {
            return redirect()->back()
                ->with('error', 'لا يمكن حذف رب الأسرة');
        }

        $person->delete();

        return redirect()->route('families.show', $family)
            ->with('success', 'تم حذف الفرد بنجاح');
    }
}