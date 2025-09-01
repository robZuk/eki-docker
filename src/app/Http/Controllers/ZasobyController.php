<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zasoby;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\ArchiwalneZasoby;
use Illuminate\Support\Facades\DB;


class ZasobyController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', session('per_page', 10));
        session(['per_page' => $perPage]);

        $user = Auth::user();
        $userRoles = $user->roles->pluck('id')->toArray();
        $isAdmin = in_array(999999, $userRoles) || in_array(999998, $userRoles);
        $hasMultipleRoles = count($userRoles) > 1;

        $query = Zasoby::query();

        if (!$isAdmin) {
            $query->whereIn('Numer_Pola_Spisowego', $userRoles);
        }

        $searchText = $request->input('searchText');
        $numerPolaSpisowego = $request->input('searchNumerPolaSpisowego');

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

        // Sorting
        $sort = $request->input('sort', 'Numer_Inwentarzowy');
        $direction = $request->input('direction', 'asc');
        $query->orderBy($sort, $direction);

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


        return view('zasoby.index', [
            'results' => $results,
            'perPage' => $perPage,
            'searchText' => $searchText,
            'numerPolaSpisowego' => $numerPolaSpisowego,
            'userRoles' => $userRoles,
            'isAdmin' => $isAdmin,
            'hasMultipleRoles' => $hasMultipleRoles,
            'inventory_fields' => $userRoles,
            'pola_spisowe' => $tab_pola_s
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $userRoles = $user->roles->pluck('id')->toArray();

        $pola_spisowe = DB::table('roles')->get();
        $tab_pola_s = array();
        foreach ($pola_spisowe as  $ps) {
            in_array($ps->id, $userRoles) ? $tab_pola_s[$ps->id] = $ps->name : $i = 0;
        }

        return view('zasoby.create', ['inventory_fields' => $userRoles, 'pola_spisowe' => $tab_pola_s]);
    }



    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'numer_inwentarzowy' => 'required|max:255',
            'nazwa' => 'required|max:255',
            'opis' => 'nullable|string',
            'numer_dok_zakupu' => 'required|max:255',
            'wartosc' => 'required|numeric|min:0',
            'data_zakupu' => 'required|date',
            'data_likwidacji' => 'nullable|date',
            'ilosc' => 'required|integer|min:0',
            'srodek' => 'required|string',
            'lokalizacja' => 'nullable|string',
            'numer_pola_spisowego' => 'required|string|max:255',
            'status' => 'nullable|string',
            'komentarz' => 'nullable|string',

        ]);

        $data = $validatedData + [
            'Numer_Inwentarzowy' => $validatedData['numer_inwentarzowy'],
            'Data_Zakupu' => $validatedData['data_zakupu'],
            'Nazwa' => $validatedData['nazwa'],
            'Wartosc' => $validatedData['wartosc'],
            'Ilosc' => $validatedData['ilosc'],
            'Srodek' => $validatedData['srodek'],
            'Numer_Pola_Spisowego' => $validatedData['numer_pola_spisowego'],
            'Opis' => $validatedData['opis'],
            'Numer_Dok_Zakupu' => $validatedData['numer_dok_zakupu'],
            'Data_Likwidacji' => $validatedData['data_likwidacji'],
            'Lokalizacja' => $validatedData['lokalizacja'],
            'Status' => $validatedData['status'],
            'Komentarz' => $validatedData['komentarz'],
            'updated_at' => null,
            'created_at' => null,
        ];

        Zasoby::create($data);

        return redirect()->route('zasoby')->with('success', 'Środek został dodany pomyślnie.');
    }


    public function edit($id, Request $request)
    {


        $zasob = Zasoby::findOrFail($id);


        $userRoles = Auth::user()->roles->pluck('id')->toArray();

        $pola_spisowe = DB::table('roles')->get();
        $tab_pola_s = array();
        $i = 0;
        foreach ($pola_spisowe as  $ps) {
            in_array($ps->id, $userRoles) ? $tab_pola_s[$ps->id] = $ps->name : $i = 0;
        }



        $prevZasob = Zasoby::where('Numer_Pola_Spisowego', $zasob->Numer_Pola_Spisowego)
            ->where('id', '<', $id)
            ->orderBy('id', 'desc')
            ->first();

        $nextZasob = Zasoby::where('Numer_Pola_Spisowego', $zasob->Numer_Pola_Spisowego)
            ->where('id', '>', $id)
            ->orderBy('id', 'asc')
            ->first();


        if (!(in_array(999998, $userRoles))) {
            return view('zasoby.edit', compact('zasob', 'prevZasob', 'nextZasob'), [
                'inventory_fields' => $userRoles,
                'pola_spisowe' => $tab_pola_s,
                'numer_pola_spisowego' => $zasob->Numer_Pola_Spisowego,


            ]);
        }
    }



    public function update(Request $request, $id)
    {

        $zasob = Zasoby::findOrFail($id);


        $validatedData = $request->validate([
            'nazwa' => 'required|max:255',
            'opis' => 'nullable|string',
            'numer_dok_zakupu' => 'required|max:255',
            'wartosc' => 'required|numeric|min:0',
            'data_zakupu' => 'required|date',
            'data_likwidacji' => 'nullable|date',
            'ilosc' => 'required|integer|min:0',
            'srodek' => 'required|string',
            'lokalizacja' => 'nullable|string',
            'numer_pola_spisowego' => 'required|string|max:255',
            'status' => 'nullable|string',
            'komentarz' => 'nullable|string',

        ]);

        $oldNumerPolaSpisowego = $zasob->Numer_Pola_Spisowego;

        // Update the Zasoby record
        $zasob->Nazwa = $validatedData['nazwa'];
        $zasob->Opis = $validatedData['opis'];
        $zasob->Numer_Dok_Zakupu = $validatedData['numer_dok_zakupu'];
        $zasob->Wartosc = $validatedData['wartosc'];
        $zasob->Data_Zakupu = $validatedData['data_zakupu'];
        $zasob->Data_Likwidacji = $validatedData['data_likwidacji'];
        $zasob->Ilosc = $validatedData['ilosc'];
        $zasob->Srodek = $validatedData['srodek'];
        $zasob->Lokalizacja = $validatedData['lokalizacja'];
        $zasob->Numer_Pola_Spisowego = $validatedData['numer_pola_spisowego'];
        $zasob->Status = $validatedData['status'];
        $zasob->Komentarz = $validatedData['komentarz'];



        $zasob->save();
        return redirect()->route('editzasoby', [

            'id' => $id
        ])->with('success', 'Środek został zaktualizowany pomyślnie.');
    }

    public function destroy($id)
    {

        $zasob = Zasoby::findOrFail($id);
        $zasob->delete();

        return redirect()->route('zasoby')->with('success', 'Środek  został usunięty pomyślnie.');
    }


    public function zasadyNumeracji()
    {

        return view('zasadynumeracji');
    }






    public function exportCSV(Request $request)
    {
        $perPage = $request->input('per_page', session('per_page', 10));

        $query = Zasoby::query();

        $user = Auth::user();
        $userRoles = $user->roles->pluck('id')->toArray();
        $isAdmin = in_array(999999, $userRoles) || in_array(999998, $userRoles);

        if (!$isAdmin) {
            $query->whereIn('Numer_Pola_Spisowego', $userRoles);
        }

        $searchText = $request->input('searchText');
        $numerPolaSpisowego = $request->input('searchNumerPolaSpisowego');

        if ($searchText) {
            $query->where(function ($query) use ($searchText) {
                $query->where('Nazwa', 'LIKE', "%{$searchText}%")
                    ->orWhere('Numer_Inwentarzowy', 'LIKE', "%{$searchText}%")
                    ->orWhere('Opis', 'LIKE', "%{$searchText}%")
                    ->orWhere('Srodek', 'LIKE', "%{$searchText}%")
                    ->orWhere('Lokalizacja', 'LIKE', "%{$searchText}%");
            });
        }

        if ($numerPolaSpisowego) {
            $query->where('Numer_Pola_Spisowego', $numerPolaSpisowego);
        }

        // Limit the query to the number of rows per page
        if ($perPage != 'All') {
            $query->limit($perPage);
        }

        $callback = function () use ($query) {
            $file = fopen('php://output', 'w');

            fputs($file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($file, [
                'Numer Inwentarzowy',
                'Nazwa',
                'Opis',
                'Numer Dokumentu Zakupu/Faktury',
                'Wartość',
                'Data Zakupu',
                'Data Likwidacji',
                'Ilość',
                'Środek',
                'Lokalizacja',
                'Numer Pola Spisowego',
                'Status',
                'Komentarz'
            ], ';');

            foreach ($query->get() as $row) {
                fputcsv($file, [
                    $row->Numer_Inwentarzowy,
                    $row->Nazwa,
                    $row->Opis,
                    $row->Numer_Dok_Zakupu,
                    $row->Wartosc,
                    $row->Data_Zakupu,
                    $row->Data_Likwidacji,
                    $row->Ilosc,
                    $row->Srodek,
                    $row->Lokalizacja,
                    $row->Numer_Pola_Spisowego,
                    $row->Status,
                    $row->Komentarz
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, [
            "Content-Type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=zasoby.csv"
        ]);
    }
}
