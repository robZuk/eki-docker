<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.users', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Walidacja danych
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',  // Hasło z potwierdzeniem
        ]);

        // Tworzenie nowego użytkownika
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Szyfrowanie hasła
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    public function edit(User $user)
    {
        // Pobieramy pełne obiekty pól spisowych, a nie tylko ich ID
        $pola_spisowe = DB::table('roles')->get();

        // Zwracamy pełne obiekty pól spisowych do widoku
        return view('users.edit', compact('user', 'pola_spisowe'));
    }

    // Metoda aktualizująca dane użytkownika
    public function update(Request $request, User $user)
    {
        // Walidacja danych
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // Hasło opcjonalne
            'roles' => 'array',  // Upewnij się, że 'roles' to tablica
        ]);

        // Aktualizacja danych użytkownika
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Aktualizacja hasła, jeśli zostało podane nowe
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        } // Synchronizacja ról użytkownika (usuwa stare role i dodaje nowe)
        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        } else {
            // Jeśli nie wybrano żadnych ról, usuń wszystkie istniejące role
            $user->roles()->sync([]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.edit', $user->id)->with('success', 'Password updated successfully.');
    }
}
