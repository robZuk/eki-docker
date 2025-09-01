<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zasoby;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchText = $request->input('searchText');
        $numerPolaSpisowego = $request->input('searchNumerPolaSpisowego');
        $perPage = $request->input('per_page', session('per_page', 10));
        session(['per_page' => $perPage]);




        $user = Auth::user();
        $userRoles = $user->roles->pluck('id')->toArray();
        $isAdmin = in_array(999999, $userRoles) || in_array(999998, $userRoles);
        $hasMultipleRoles = count($userRoles) > 1;

        $query = Zasoby::query();

        // filtering by role
        if (!$isAdmin) {
            $query->whereIn('Numer_Pola_Spisowego', $userRoles);
        }

        if ($searchText) {
            $query->where(function ($query) use ($searchText) {
                $query->where('Nazwa', 'LIKE', "%{$searchText}%")
                    ->orWhere('Numer_Inwentarzowy', 'LIKE', "%{$searchText}%")
                    ->orWhere('Opis', 'LIKE', "%{$searchText}%")
                    ->orWhere('Numer_Dok_Zakupu', 'LIKE', "%{$searchText}%")
                    ->orWhere('Srodek', 'LIKE', "%{$searchText}%")
                    ->orWhere('Lokalizacja', 'LIKE', "%{$searchText}%");
            });
        }

        if ($numerPolaSpisowego) {
            $query->where('Numer_Pola_Spisowego', $numerPolaSpisowego);
        }

        if ($perPage == 'All') {
            $results = $query->get();
        } else {
            $results = $query->paginate($perPage)->appends($request->except('page'));
        }

        $pola_spisowe = DB::table('roles')->get();
        $tab_pola_s = array();
        $i = 0;

        foreach ($pola_spisowe as  $ps) {
            if ($isAdmin) {
                if ($ps->id < 5000)
                    $tab_pola_s[$ps->id] = $ps->name;
            } else {
                in_array($ps->id, $userRoles) ? $tab_pola_s[$ps->id] = $ps->name : $i = 0;
            }
        }


        if (!$request->ajax()) { // Tylko dla pełnych żądań, nie AJAX
            session(['search_url' => $request->fullUrl()]); // Zapisujemy URL wyszukiwania
        }



        return view('zasoby.index', compact('results', 'perPage', 'searchText', 'numerPolaSpisowego', 'userRoles', 'isAdmin', 'hasMultipleRoles'), ['pola_spisowe' => $tab_pola_s]);
    }
}
