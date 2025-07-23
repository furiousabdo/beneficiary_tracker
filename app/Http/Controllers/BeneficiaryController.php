<?php
namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Family;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function index()
    {
        $beneficiaries = Beneficiary::with('family')->get();
        return view('beneficiaries.index', compact('beneficiaries'));
    }

    public function create()
    {
        $families = Family::all();
        return view('beneficiaries.create', compact('families'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'contact_info' => 'nullable|string|max:255',
            'family_id' => 'required|exists:families,id',
        ]);
        Beneficiary::create($validated);
        return redirect()->route('beneficiaries.index');
    }

    public function show(Beneficiary $beneficiary)
    {
        $beneficiary->load('family', 'aidRecords');
        return view('beneficiaries.show', compact('beneficiary'));
    }

    public function edit(Beneficiary $beneficiary)
    {
        $families = Family::all();
        return view('beneficiaries.edit', compact('beneficiary', 'families'));
    }

    public function update(Request $request, Beneficiary $beneficiary)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'contact_info' => 'nullable|string|max:255',
            'family_id' => 'required|exists:families,id',
        ]);
        $beneficiary->update($validated);
        return redirect()->route('beneficiaries.index');
    }

    public function destroy(Beneficiary $beneficiary)
    {
        $beneficiary->delete();
        return redirect()->route('beneficiaries.index');
    }
} 