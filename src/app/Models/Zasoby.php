<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModyfikacjeZasobow;
use Illuminate\Support\Facades\Auth;

class Zasoby extends Model
{
    use HasFactory;

    protected $table = 'zasoby';
    public $incrementing = false;



    protected $keyType = 'string';

    protected $fillable = [
        // "Id",
        'Numer_Inwentarzowy',
        'Nazwa',
        'Opis',
        'Numer_Dok_Zakupu',
        'Wartosc',
        'Data_Zakupu',
        'Data_Likwidacji',
        'Ilosc',
        'Srodek',
        'Lokalizacja',
        'Numer_Pola_Spisowego',
        'Status',
        'Komentarz'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($zasob) {
            // Generowanie unikalnego ID
            // $zasob->id = $zasob->Numer_Inwentarzowy . '-' . $zasob->Numer_Pola_Spisowego;
            $zasob->id = $zasob->Numer_Inwentarzowy . '-' . str_pad($zasob->Numer_Pola_Spisowego, 3, '0', STR_PAD_LEFT);
        });

        static::updating(function ($zasob) {
            $original = $zasob->getOriginal();

            foreach ($zasob->getDirty() as $column => $newValue) {
                $oldValue = $original[$column] ?? null;

                // Sprawdzenie, czy wartości są rzeczywiście różne
                if (!is_null($oldValue) && trim((string)$oldValue) === trim((string)$newValue)) {
                    continue; // Pomijamy rejestrację zmiany, jeśli wartości są identyczne
                }

                ModyfikacjeZasobow::create([
                    'Nazwa_Tabeli' => 'zasoby',
                    "Id" => $zasob->id,
                    'Akcja' => 'UPDATE',
                    'Nazwa_Kolumny' => $column,
                    'Numer_Inwentarzowy' => $zasob->Numer_Inwentarzowy,
                    'Poprzednia_Wartosc' => $oldValue,
                    'Aktualna_Wartosc' => $newValue,
                    'UzytkownikId' => Auth::id(),
                    'Uzytkownik' => Auth::user()->name,
                ]);
            }
        });

        static::creating(function ($zasob) {
            ModyfikacjeZasobow::create([
                'Nazwa_Tabeli' => 'zasoby',
                "Id" => $zasob->id,
                'Akcja' => 'INSERT',
                'Nazwa_Kolumny' => 'NULL',
                'Poprzednia_Wartosc' => 'NULL',
                'Aktualna_Wartosc' => 'NULL',
                'Numer_Inwentarzowy' => $zasob->Numer_Inwentarzowy,
                'UzytkownikId' => Auth::id(),
                'Uzytkownik' => Auth::user()->name,
            ]);
        });

        static::deleting(function ($zasob) {
            ModyfikacjeZasobow::create([
                'Nazwa_Tabeli' => 'zasoby',
                "Id" => $zasob->id,
                'Akcja' => 'DELETE',
                'Nazwa_Kolumny' => 'NULL',
                'Numer_Inwentarzowy' => $zasob->Numer_Inwentarzowy,
                'Poprzednia_Wartosc' => 'NULL',
                'Aktualna_Wartosc' => 'NULL',
                'UzytkownikId' => Auth::id(),
                'Uzytkownik' => Auth::user()->name,
            ]);
        });
    }
}
