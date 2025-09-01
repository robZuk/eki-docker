<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class PolaSpisoweController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $userRoles = $user->roles->pluck('id')->toArray();


        if ((in_array(999999, $userRoles) || in_array(999998, $userRoles))) {
            $pola_spisowe = DB::table('roles')->get();
        } else {
            $pola_spisowe = DB::table('roles')->whereIn('id', $userRoles)->get();
        }


        return view('pola_spisowe.index', compact('pola_spisowe'));
    }

    // Metoda do wyświetlania formularza
    public function create()
    {
        $user = Auth::user();
        $userRoles = $user->roles->pluck('id')->toArray();


        if ((in_array(999999, $userRoles) || in_array(999998, $userRoles))) {
            return view('pola_spisowe.create');
        } else {
            return redirect()->route('zasoby');
        }
    }
    public function edit($id)
    {

        $user = Auth::user();
        $userRoles = $user->roles->pluck('id')->toArray();

        $role = Role::findOrFail($id);

        if ((in_array(999999, $userRoles) || in_array(999998, $userRoles))) {
            return view('pola_spisowe.edit', compact('role'));
        }

        return redirect()->route('pola_spisowe.index');
    }

    public function update(Request $request, $id)
    {

        echo "OK";
        $user = Auth::user();
        $userRoles = $user->roles->pluck('id')->toArray();

        $role = Role::findOrFail($id);
        //		var_dump($role);
        //      	exit;

        $validatedData = $request->validate([
            'id' => 'required|integer',  // Sprawdzenie unikalności ID
            'name' => 'required|string|max:255',
        ]);


        if ((in_array(999999, $userRoles) || in_array(999998, $userRoles))) {


            // Update the role / pola spisowe record
            $role->id = $validatedData['id'];
            $role->name = $validatedData['name'];
            $role->save();
        }
        // Przekierowanie z powrotem do strony głównej z komunikatem sukcesu
        return redirect()->route('pola_spisowe.index')->with('success', 'Pole spisowe zostało zaktualizaowane pomyślnie.');
    }


    // Metoda do zapisywania nowego pola spisowego
    public function store(Request $request)
    {
        // Walidacja formularza, sprawdza czy ID jest liczbą i czy nazwa jednostki jest wypełniona
        $request->validate([
            'id' => 'required|integer|unique:roles,id',  // Sprawdzenie unikalności ID
            'name' => 'required|string|max:255',
        ]);

        // Wstawianie nowego pola spisowego do bazy danych
        DB::table('roles')->insert([
            'id' => $request->input('id'),  // ID wprowadzone przez użytkownika
            'name' => $request->input('name'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Przekierowanie z powrotem do strony głównej z komunikatem sukcesu
        return redirect()->route('pola_spisowe.index')->with('success', 'Pole spisowe zostało dodane.');
    }
}
