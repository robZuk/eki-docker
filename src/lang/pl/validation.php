<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Linie językowe walidacji
    |--------------------------------------------------------------------------
    |
    | Poniższe linie językowe zawierają domyślne komunikaty błędów używane przez
    | klasę walidatora. Niektóre z tych zasad mają wiele wersji, np. zasady dotyczące rozmiaru.
    | Możesz dowolnie edytować te wiadomości zgodnie z wymaganiami aplikacji.
    |
    */

    'accepted' => 'Pole :attribute musi zostać zaakceptowane.',
    'accepted_if' => 'Pole :attribute musi zostać zaakceptowane, gdy :other jest :value.',
    'active_url' => 'Pole :attribute musi być prawidłowym adresem URL.',
    'after' => 'Pole :attribute musi być datą późniejszą niż :date.',
    'after_or_equal' => 'Pole :attribute musi być datą późniejszą lub równą :date.',
    'alpha' => 'Pole :attribute może zawierać tylko litery.',
    'alpha_dash' => 'Pole :attribute może zawierać tylko litery, cyfry, myślniki i podkreślenia.',
    'alpha_num' => 'Pole :attribute może zawierać tylko litery i cyfry.',
    'array' => 'Pole :attribute musi być tablicą.',
    'ascii' => 'Pole :attribute może zawierać tylko jednobajtowe znaki alfanumeryczne i symbole.',
    'before' => 'Pole :attribute musi być datą wcześniejszą niż :date.',
    'before_or_equal' => 'Pole :attribute musi być datą wcześniejszą lub równą :date.',
    'between' => [
        'array' => 'Pole :attribute musi zawierać od :min do :max elementów.',
        'file' => 'Pole :attribute musi mieć rozmiar od :min do :max kilobajtów.',
        'numeric' => 'Pole :attribute musi mieć wartość od :min do :max.',
        'string' => 'Pole :attribute musi zawierać od :min do :max znaków.',
    ],
    'boolean' => 'Pole :attribute musi być prawdą lub fałszem.',
    'confirmed' => 'Potwierdzenie pola :attribute nie pasuje.',
    'current_password' => 'Podane hasło jest nieprawidłowe.',
    'date' => 'Pole :attribute musi być prawidłową datą.',
    'date_equals' => 'Pole :attribute musi być datą równą :date.',
    'date_format' => 'Pole :attribute musi mieć format :format.',
    'email' => 'Pole :attribute musi być prawidłowym adresem e-mail.',
    'exists' => 'Wybrana wartość dla :attribute jest nieprawidłowa.',
    'file' => 'Pole :attribute musi być plikiem.',
    'image' => 'Pole :attribute musi być obrazem.',
    'integer' => 'Pole :attribute musi być liczbą całkowitą.',
    'max' => [
        'array' => 'Pole :attribute nie może mieć więcej niż :max elementów.',
        'file' => 'Pole :attribute nie może być większe niż :max kilobajtów.',
        'numeric' => 'Pole :attribute nie może być większe niż :max.',
        'string' => 'Pole :attribute nie może mieć więcej niż :max znaków.',
    ],
    'min' => [
        'array' => 'Pole :attribute musi mieć co najmniej :min elementów.',
        'file' => 'Pole :attribute musi mieć co najmniej :min kilobajtów.',
        'numeric' => 'Pole :attribute musi wynosić co najmniej :min.',
        'string' => 'Pole :attribute musi mieć co najmniej :min znaków.',
    ],
    'numeric' => 'Pole :attribute musi być liczbą.',
    'required' => 'Pole :attribute jest wymagane.',
    'same' => 'Pole :attribute musi być takie samo jak :other.',
    'size' => [
        'array' => 'Pole :attribute musi zawierać :size elementów.',
        'file' => 'Pole :attribute musi mieć :size kilobajtów.',
        'numeric' => 'Pole :attribute musi wynosić :size.',
        'string' => 'Pole :attribute musi mieć :size znaków.',
    ],
    'string' => 'Pole :attribute musi być ciągiem znaków.',
    'unique' => 'Pole :attribute jest już zajęte.',
    'url' => 'Pole :attribute musi być prawidłowym adresem URL.',

    /*
    |--------------------------------------------------------------------------
    | Niestandardowe komunikaty walidacji
    |--------------------------------------------------------------------------
    |
    | Tutaj możesz określić niestandardowe komunikaty walidacyjne dla atrybutów,
    | używając konwencji "attribute.rule" do nazwania linii.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Niestandardowe atrybuty walidacji
    |--------------------------------------------------------------------------
    |
    | Poniższe linie językowe służą do zastąpienia atrybutów bardziej czytelnymi
    | nazwami, np. "Adres e-mail" zamiast "email".
    |
    */

    'attributes' => [
        'name' => 'nazwa',
        'username' => 'nazwa użytkownika',
        'email' => 'adres e-mail',
        'first_name' => 'imię',
        'last_name' => 'nazwisko',
        'password' => 'hasło',
        'password_confirmation' => 'potwierdzenie hasła',
        'current_password' => 'aktualne hasło',
        'new_password' => 'nowe hasło',
        'new_password_confirmation' => 'potwierdzenie nowego hasła',
        'city' => 'miasto',
        'country' => 'kraj',
        'address' => 'adres',
        'phone' => 'telefon',
        'mobile' => 'telefon komórkowy',
        'age' => 'wiek',
        'sex' => 'płeć',
        'gender' => 'płeć',
        'day' => 'dzień',
        'month' => 'miesiąc',
        'year' => 'rok',
        'hour' => 'godzina',
        'minute' => 'minuta',
        'second' => 'sekunda',
        'title' => 'tytuł',
        'content' => 'treść',
        'body' => 'treść',
        'description' => 'opis',
        'excerpt' => 'wyciąg',
        'date' => 'data',
        'time' => 'czas',
        'available' => 'dostępny',
        'size' => 'rozmiar',
        'price' => 'cena',
        'quantity' => 'ilość',
        'terms' => 'warunki',
        'category' => 'kategoria',
        'message' => 'wiadomość',
        'comment' => 'komentarz',
        'avatar' => 'awatar',
        'file' => 'plik',
        'image' => 'obraz',
        'photos' => 'zdjęcia',
        'role' => 'rola',
        'slug' => 'slug',
        'status' => 'status',
        'code' => 'kod',
        'vat' => 'NIP',
        'company' => 'firma',
        'region' => 'region',
        'province' => 'województwo',
        'postal_code' => 'kod pocztowy',
        'street' => 'ulica',
        'house_number' => 'numer domu',
        'apartment_number' => 'numer mieszkania',
        'iban' => 'IBAN',
        'bic' => 'BIC/SWIFT',
        'tax_number' => 'numer podatkowy',
        'delivery_address' => 'adres dostawy',
        'billing_address' => 'adres rozliczeniowy',
        'shipping_method' => 'sposób wysyłki',
        'payment_method' => 'metoda płatności',
        'card_number' => 'numer karty',
        'cvv' => 'CVV',
        'expiration_date' => 'data ważności',
        'notes' => 'notatki',
    ],

];
