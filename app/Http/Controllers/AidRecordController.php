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
        $aidRecords = AidRecord::with(['beneficiary', 'association'])->get();
        return view('aid_records.index', compact('aidRecords'));
    }

    public function create()
    {
        $beneficiaries = Beneficiary::all();
        $associations = Association::all();
        return view('aid_records.create', compact('beneficiaries', 'associations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'association_id' => 'required|exists:associations,id',
            'aid_type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date_given' => 'required|date',
        ]);
        AidRecord::create($validated);
        return redirect()->route('aid_records.index');
    }

    public function show(AidRecord $aidRecord)
    {
        $aidRecord->load('beneficiary', 'association');
        return view('aid_records.show', compact('aidRecord'));
    }

    public function edit(AidRecord $aidRecord)
    {
        $beneficiaries = Beneficiary::all();
        $associations = Association::all();
        return view('aid_records.edit', compact('aidRecord', 'beneficiaries', 'associations'));
    }

    public function update(Request $request, AidRecord $aidRecord)
    {
        $validated = $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'association_id' => 'required|exists:associations,id',
            'aid_type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date_given' => 'required|date',
        ]);
        $aidRecord->update($validated);
        return redirect()->route('aid_records.index');
    }

    public function destroy(AidRecord $aidRecord)
    {
        $aidRecord->delete();
        return redirect()->route('aid_records.index');
    }
} 