<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    public function index()
    {
        $associations = Association::withCount('families')->latest()->paginate(10);
        return view('associations.index', compact('associations'));
    }

    public function create()
    {
        return view('associations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Association::create($validated);

        return redirect()->route('associations.index')
            ->with('success', 'تم إضافة الجمعية بنجاح');
    }

    public function show(Association $association)
    {
        $association->load('families.father');
        return view('associations.show', compact('association'));
    }

    public function edit(Association $association)
    {
        return view('associations.edit', compact('association'));
    }

    public function update(Request $request, Association $association)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $association->update($validated);

        return redirect()->route('associations.index')
            ->with('success', 'تم تحديث بيانات الجمعية بنجاح');
    }

    public function destroy(Association $association)
    {
        if ($association->families()->exists()) {
            return redirect()->back()
                ->with('error', 'لا يمكن حذف الجمعية لأنها تحتوي على عائلات مسجلة');
        }

        $association->delete();

        return redirect()->route('associations.index')
            ->with('success', 'تم حذف الجمعية بنجاح');
    }
}