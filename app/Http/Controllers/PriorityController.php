<?php
namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function index()
    {
        $families = Family::with(['beneficiaries.aidRecords'])
            ->get()
            ->sortBy(function($family) {
                return $family->totalAid();
            });
        return view('priority', compact('families'));
    }
} 