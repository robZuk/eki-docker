<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModyfikacjeZasobow extends Model
{
    use HasFactory;

    // Jeśli nazwa tabeli różni się od domyślnej (liczba mnoga od nazwy modelu)
    protected $table = 'modyfikacje_system';


    protected $fillable = [
        'Nazwa_Tabeli',
        'Id',
        'Akcja',
        'Nazwa_Kolumny',
        'Numer_Inwentarzowy',
        'Poprzednia_Wartosc',
        'Aktualna_Wartosc',
        'UzytkownikId',
        'Uzytkownik',
    ];

    // Relacja z modelu Zasoby
    // public function zasoby()
    // {
    //     return $this->belongsTo(Zasoby::class, 'Numer_inwentarzowy', 'Numer_Inwentarzowy');
    // }
}
