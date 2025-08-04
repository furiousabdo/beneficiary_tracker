<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\Family;
use App\Models\Person;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recentFamilies = Family::with('association', 'father')
            ->latest()
            ->take(5)
            ->get();
            
        $recentPersons = Person::with('family.association')
            ->latest()
            ->take(5)
            ->get();
            
        $associationsCount = Association::count();
        $familiesCount = Family::count();
        $personsCount = Person::count();

        return view('dashboard', compact(
            'recentFamilies',
            'recentPersons',
            'associationsCount',
            'familiesCount',
            'personsCount'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $results = [];
        
        if (strlen($query) >= 3) {
            // Search in persons
            $persons = Person::where('name_ar', 'like', "%{$query}%")
                ->orWhere('national_id', 'like', "%{$query}%")
                ->with('family.association')
                ->limit(10)
                ->get();
                
            // Search in families by father name or card number
            $families = Family::whereHas('father', function($q) use ($query) {
                    $q->where('name_ar', 'like', "%{$query}%");
                })
                ->orWhere('family_card_number', 'like', "%{$query}%")
                ->with('association', 'father')
                ->limit(10)
                ->get();
                
            // Search in associations
            $associations = Association::where('name_ar', 'like', "%{$query}%")
                ->orWhere('name_en', 'like', "%{$query}%")
                ->limit(10)
                ->get();
                
            $results = [
                'persons' => $persons,
                'families' => $families,
                'associations' => $associations,
            ];
        }
        
        return view('search-results', compact('results', 'query'));
    }
    
    /**
     * Show the advanced search form
     *
     * @return \Illuminate\View\View
     */
    public function advancedSearch()
    {
        $associations = Association::orderBy('name_ar')->pluck('name_ar', 'id');
        return view('search-advanced', compact('associations'));
    }
}