<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PriorityController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/priority', [PriorityController::class, 'index'])->name('priority.index');
Route::resource('families', App\Http\Controllers\FamilyController::class);
Route::resource('beneficiaries', App\Http\Controllers\BeneficiaryController::class);
Route::resource('associations', App\Http\Controllers\AssociationController::class);
Route::resource('aid_records', App\Http\Controllers\AidRecordController::class);
