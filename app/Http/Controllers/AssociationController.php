<?php
namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    public function index()
    {
        $associations = Association::all();
        return view('associations.index', compact('associations'));
    }

    public function create()
    {
        return view('associations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Association::create($validated);
        return redirect()->route('associations.index');
    }

    public function show(Association $association)
    {
        return view('associations.show', compact('association'));
    }

    public function edit(Association $association)
    {
        return view('associations.edit', compact('association'));
    }

    public function update(Request $request, Association $association)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $association->update($validated);
        return redirect()->route('associations.index');
    }

    public function destroy(Association $association)
    {
        $association->delete();
        return redirect()->route('associations.index');
    }
} 