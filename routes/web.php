<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\PersonController;

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Search Routes
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/search/advanced', [HomeController::class, 'advancedSearch'])->name('search.advanced');

// Association Routes
Route::resource('associations', AssociationController::class)->except(['show']);
Route::get('associations/{association}', [AssociationController::class, 'show'])
    ->name('associations.show')
    ->where('association', '[0-9]+');

// Family Routes
Route::resource('families', FamilyController::class);
Route::get('families/{family}/tree', [FamilyController::class, 'tree'])
    ->name('families.tree');

// Person Routes
Route::get('/persons', [PersonController::class, 'index'])->name('persons.index');
Route::get('/persons/create', [PersonController::class, 'create'])->name('persons.create');
Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');

// Nested routes for when family is known
Route::prefix('families/{family}')->group(function () {
    Route::get('persons/create', [PersonController::class, 'create'])->name('families.persons.create');
    Route::post('persons', [PersonController::class, 'store'])->name('families.persons.store');
    Route::get('persons/{person}', [PersonController::class, 'show'])->name('persons.show');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
