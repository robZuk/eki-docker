<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentrumObslugiProjektowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ZasobyController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImpersonationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\TestAuthController;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\ArchiwalneZasobyController;
use App\Http\Controllers\PolaSpisoweController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ModyfikacjeZasobowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// test ldap it.umg.edu.pl/test-auth
// Route::get('/test-auth', [App\Http\Controllers\TestAuthController::class, 'testAuth']);
// test ldap it.umg.edu.pl/test-ldap-connection
//Route::get('/test-ldap-connection', [App\Http\Controllers\TestAuthController::class, 'testLdapConnection']);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');


// Zasoby
Route::get('/zasoby', [ZasobyController::class, 'index'])->middleware(['auth'])->name('zasoby');
// Archiwalne Zasoby
Route::get('/archiwalne_zasoby', [ArchiwalneZasobyController::class, 'index'])->name('archiwalne_zasoby');
//Modyfikacje Zasobow
Route::get('/modyfikacje_zasobow', [ModyfikacjeZasobowController::class, 'index'])->name('modyfikacje_zasobow');
// Create
Route::get('/zasoby/create', [ZasobyController::class, 'create'])->middleware(['auth'])->name('createzasoby');
Route::post('/zasoby', [ZasobyController::class, 'store'])->name('storezasoby');
// Edit
//Route::get('/zasoby/{numer_inwentarzowy}/edit', [ZasobyController::class, 'edit'])->middleware(['auth'])->name('editzasoby');
Route::get('/zasoby/{id}/edit', [ZasobyController::class, 'edit'])->middleware(['auth'])->name('editzasoby');
//Route::get('/zasoby/{numer_pola_spisowego}/{numer_inwentarzowy}/edit', [ZasobyController::class, 'edit'])->middleware(['auth'])->name('editzasoby');


Route::put('/zasoby/{id}', [ZasobyController::class, 'update'])->middleware(['auth'])->name('updatezasoby');
// Route::put('/zasoby/{numer_pola_spisowego}/{numer_inwentarzowy}', [ZasobyController::class, 'update'])
//     ->name('updatezasoby');
// Delete
Route::delete('/zasoby/{id}', [ZasobyController::class, 'destroy'])->middleware(['auth'])->name('deletezasoby');

// Route::delete('/zasoby/{numer_pola_spisowego}/{numer_inwentarzowy}', [ZasobyController::class, 'destroy'])->name('deletezasoby');

// Export PDF/excel
Route::get('/zasoby/pdf', [ZasobyController::class, 'generatePDF'])->name('zasoby.pdf');
Route::get('/zasoby/excel', [ZasobyController::class, 'exportExcel'])->name('zasoby.excel');
Route::get('/zasoby/export/csv', [ZasobyController::class, 'exportCSV'])->name('zasoby.export.csv');
// zasady numeracji
Route::get('/zasoby/zasady', [ZasobyController::class, 'zasadyNumeracji'])->name('zasoby.zasady');
//
// Import CSV
Route::get('/import', [ImportController::class, 'showImportForm'])->name('import');
Route::post('/import', [ImportController::class, 'importData'])->name('import.data');
Route::get('/zasoby/csv', [ZasobyController::class, 'generateCSV'])->name('zasoby.csv');
// Searchbar
Route::get('/search', [SearchController::class, 'search'])->name('search');
// Zasoby Tabela
Route::get('/pola_spisowe', [PolaSpisoweController::class, 'index'])->name('pola_spisowe.index');
Route::get('/pola-spisowe', [PolaSpisoweController::class, 'index'])->name('pola_spisowe');
Route::get('/pola_spisowe/create', [PolaSpisoweController::class, 'create'])->middleware(['auth'])->name('pola_spisowe.create');
Route::get('/pola_spisowe/{id}/edit', [PolaSpisoweController::class, 'edit'])->middleware(['auth'])->name('pola_spisowe.edit');
Route::post('/pola_spisowe/{id}', [PolaSpisoweController::class, 'update'])->name('pola_spisowe.update');
Route::post('/pola_spisowe', [PolaSpisoweController::class, 'store'])->name('pola_spisowe.store');

//Pobierania poradnika
Route::get('docs/{filename}', function ($filename) {
    $path = public_path('docs/' . $filename);

    // Sprawdź, czy plik istnieje
    if (File::exists($path)) {
        // Zwróć plik do pobrania
        return Response::download($path);
    }

    // Jeśli plik nie istnieje, zwróć 404
    abort(404);
})->middleware(['auth']);

// Users
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('edit.user');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('update.user');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('delete.user');
    Route::put('/users/{user}/password', [UserController::class, 'updatePassword'])->name('update.password');
});

// Change Password
Route::middleware('auth')->group(function () {
    Route::get('change-password', [PasswordChangeController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('change-password', [PasswordChangeController::class, 'changePassword'])->name('password.update');
});



// Impersonation

Route::get('/impersonate/{userId}', [ImpersonationController::class, 'impersonate'])->name('impersonate');
Route::get('/stop-impersonating', [ImpersonationController::class, 'stopImpersonating'])->name('stop.impersonating');

// Tworzenie nowego użytkownika

Route::get('/users/create', [UserController::class, 'create'])->name('create'); // Trasa dla widoku formularza
Route::post('/users', [UserController::class, 'store'])->name('users.store');  // Trasa dla zapisu nowego użytkownika
// Instytut Morski

// 955
Route::get('/instytut/955', function () {
    return view('instytut.955');
})->middleware(['auth'])->name('instytut.955');
Route::get('/centrum_obslugi_projektow', [CentrumObslugiProjektowController::class, 'index']);

//954
Route::get('/instytut/954', function () {
    return view('instytut.954');
})->middleware(['auth'])->name('instytut.954');

//953
Route::get('/instytut/953', function () {
    return view('instytut.953');
})->middleware(['auth'])->name('instytut.953');

require __DIR__ . '/auth.php';
