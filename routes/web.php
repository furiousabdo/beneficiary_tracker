<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\AidRecordController;
use App\Http\Controllers\FamilyTreeController;

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

// Family Tree Routes
Route::prefix('families/{family}')->group(function () {
    Route::get('family-tree', [FamilyTreeController::class, 'show'])->name('family-tree.show');
    Route::get('family-tree/add-child/{person}', [FamilyTreeController::class, 'addChild'])->name('family-tree.add-child');
    Route::post('family-tree/add-child/{person}', [FamilyTreeController::class, 'storeChild'])->name('family-tree.store-child');
    Route::get('family-tree/add-spouse/{person}', [FamilyTreeController::class, 'addSpouse'])->name('family-tree.add-spouse');
    Route::post('family-tree/add-spouse/{person}', [FamilyTreeController::class, 'storeSpouse'])->name('family-tree.store-spouse');
    Route::delete('family-tree/remove-spouse/{person}', [FamilyTreeController::class, 'removeSpouse'])->name('family-tree.remove-spouse');
});

// Person Routes
Route::get('/persons', [PersonController::class, 'index'])->name('persons.index');
Route::get('/persons/create', [PersonController::class, 'create'])->name('persons.create');
Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');

// Nested routes for when family is known
Route::prefix('families/{family}')->group(function () {
    Route::get('persons/create', [PersonController::class, 'create'])->name('families.persons.create');
    Route::post('persons', [PersonController::class, 'store'])->name('families.persons.store');
    Route::get('persons/{person}', [PersonController::class, 'show'])->name('persons.show');
    Route::get('persons/{person}/edit', [PersonController::class, 'edit'])->name('persons.edit');
    Route::put('persons/{person}', [PersonController::class, 'update'])->name('persons.update');
    Route::delete('persons/{person}', [PersonController::class, 'destroy'])->name('persons.destroy');
});

// Beneficiary Routes
Route::resource('beneficiaries', BeneficiaryController::class);

// Aid Record Routes
Route::resource('aid-records', AidRecordController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
