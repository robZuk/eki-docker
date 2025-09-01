<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ZasobyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImpersonationController;
use App\Http\Controllers\PolaSpisoweController;





Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

// Zasoby
Route::get('/zasoby', [ZasobyController::class, 'index'])->middleware(['auth'])->name('zasoby');
Route::get('/zasoby/create', [ZasobyController::class, 'create'])->name('createzasoby');
Route::post('/zasoby', [ZasobyController::class, 'store'])->name('storezasoby');
Route::get('/zasoby/{id}/edit', [ZasobyController::class, 'edit'])->middleware(['auth'])->name('editzasoby');
Route::put('/zasoby/{id}', [ZasobyController::class, 'update'])->middleware(['auth'])->name('updatezasoby');
Route::delete('/zasoby/{id}', [ZasobyController::class, 'destroy'])->middleware(['auth'])->name('deletezasoby');

// zasady numeracji
Route::get('/zasoby/zasady', [ZasobyController::class, 'zasadyNumeracji'])->name('zasoby.zasady');
Route::get('/zasoby/export/csv', [ZasobyController::class, 'exportCSV'])->name('zasoby.export.csv');




// Wyszukiwanie
Route::get('/search', [SearchController::class, 'search'])->middleware(['auth'])->name('search');


// Zarządzanie użytkownikami
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('edit.user');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('update.user');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('delete.user');
    Route::put('/users/{user}/password', [UserController::class, 'updatePassword'])->name('update.password');
    Route::get('/users/create', [UserController::class, 'create'])->name('create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});


// Impersonation

Route::get('/impersonate/{userId}', [ImpersonationController::class, 'impersonate'])->name('impersonate');
Route::get('/stop-impersonating', [ImpersonationController::class, 'stopImpersonating'])->name('stop.impersonating');


// Pola Spisowe
Route::middleware(['auth'])->group(function () {
    // Ujednolicamy ścieżki - usuwamy wariant z myślnikami, dodajemy przekierowanie
    Route::get('/pola_spisowe', [PolaSpisoweController::class, 'index'])->name('pola_spisowe.index');
    Route::get('/pola-spisowe', function() { 
        return redirect('/pola_spisowe'); 
    });
    
    Route::get('/pola_spisowe/create', [PolaSpisoweController::class, 'create'])->name('pola_spisowe.create');
    Route::get('/pola_spisowe/{id}/edit', [PolaSpisoweController::class, 'edit'])->name('pola_spisowe.edit');
    Route::post('/pola_spisowe/{id}', [PolaSpisoweController::class, 'update'])->name('pola_spisowe.update');
    Route::post('/pola_spisowe', [PolaSpisoweController::class, 'store'])->name('pola_spisowe.store');
});