<?php
namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::all();
        return view('families.index', compact('families'));
    }

    public function create()
    {
        return view('families.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'family_name' => 'nullable|string|max:255',
        ]);
        Family::create($validated);
        return redirect()->route('families.index');
    }

    public function show(Family $family)
    {
        return view('families.show', compact('family'));
    }

    public function edit(Family $family)
    {
        return view('families.edit', compact('family'));
    }

    public function update(Request $request, Family $family)
    {
        $validated = $request->validate([
            'family_name' => 'nullable|string|max:255',
        ]);
        $family->update($validated);
        return redirect()->route('families.index');
    }

    public function destroy(Family $family)
    {
        $family->delete();
        return redirect()->route('families.index');
    }
} 