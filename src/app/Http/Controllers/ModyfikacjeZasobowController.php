<?php

namespace App\Http\Controllers;

use App\Models\ModyfikacjeZasobow;

class ModyfikacjeZasobowController extends Controller
{

    public function index()

    {
        // Pobieramy wszystkie rekordy z tabeli modyfikacje_zasoby
        $modyfikacjeZasoby = ModyfikacjeZasobow::all();
        return view('modyfikacje_zasobow.index', compact('modyfikacjeZasoby'));
    }
}
