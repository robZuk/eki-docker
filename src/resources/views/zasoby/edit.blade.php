<x-app-layout>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet"> --}}
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edytuj środek') }}
            </h2>
            <div class="">
                <h3 class="text-lg font-semibold text-gray-800">
                    Pole spisowe: <span class="text-blue-600">{{ $pola_spisowe[$zasob->Numer_Pola_Spisowego] }}</span>
                </h3>
            </div>
            @include('bonus.convert')
            <div class="flex gap-2">
                <a href="{{ $prevZasob ? route('editzasoby', ['id' => $prevZasob->id]) : '#' }}"
                    class="h-10 px-4 py-2 rounded bg-gray-200 text-gray-700 font-semibold border border-gray-300 transition-colors duration-150 {{ $prevZasob ? 'hover:bg-gray-300 hover:text-gray-900' : 'opacity-50 cursor-not-allowed' }}"
                    aria-disabled="{{ $prevZasob ? 'false' : 'true' }}">
                    ← Poprzedni
                </a>

                <a href="{{ $nextZasob ? route('editzasoby', ['id' => $nextZasob->id]) : '#' }}"
                    class="h-10 px-4 py-2 rounded bg-gray-200 text-gray-700 font-semibold border border-gray-300 transition-colors duration-150 {{ $nextZasob ? 'hover:bg-gray-300 hover:text-gray-900' : 'opacity-50 cursor-not-allowed' }}"
                    aria-disabled="{{ $nextZasob ? 'false' : 'true' }}">
                    Następny →
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-100 rounded-lg shadow-md mx-auto ">
        <form id="update-form" action="{{ route('updatezasoby', $zasob->id) }}" method="POST" class="px-6 pb-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <input type="hidden" id="original-data" value="{{ json_encode($zasob) }}">
                <div>
                    <label for="numer_inwentarzowy" class="block mb-2 text-gray-700">Numer inwentarzowy:</label>
                    <div class="flex gap-2">
                        <input type="text" id="numer_inwentarzowy" name="numer_inwentarzowy"
                            value="{{ old('numer_inwentarzowy', $zasob->Numer_Inwentarzowy) }}"
                            class="form-input w-3/4 rounded-md border border-gray-300 px-3 py-2 bg-gray-100" readonly>
                        <button
                            onclick="window.open('{{ route('zasoby.zasady') }}', 'popup', 'location=0,width=750,height=650,left=500,top=55'); return false;"
                            class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded  font-semibold "
                            title="Wyświetl pomoc na temat numeracji środków w UMG">Pomoc?</button>
                    </div>
                    @error('numer_inwentarzowy')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="nazwa" class="block mb-2 text-gray-700">Nazwa:</label>
                    <input type="text" id="nazwa" name="nazwa" value="{{ old('nazwa', $zasob->Nazwa) }}"
                        class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('nazwa')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="opis" class="block mb-2 text-gray-700">Opis:</label>
                    <textarea id="opis" name="opis"
                        class="form-textarea rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        style="height: 120px; width: 100%;">{{ old('opis', $zasob->Opis) }}</textarea>
                    @error('opis')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <div>
                        <label for="numer_dok_zakupu" class="block mb-2 text-gray-700">Numer dokumentu zakupu
                            (faktury):</label>
                        <input type="text" id="numer_dok_zakupu" name="numer_dok_zakupu"
                            value="{{ old('numer_dok_zakupu', $zasob->Numer_Dok_Zakupu) }}"
                            class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('numer_dok_zakupu')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="blok mb-1"></div>
                    <div>
                        <label for="wartosc" class="block mb-2 text-gray-700">Wartość:</label>
                        <input type="number" id="wartosc" step="0.01" name="wartosc"
                            value="{{ old('wartosc', $zasob->Wartosc) }}"
                            class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('wartosc')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="lokalizacja" class="block mb-2 text-gray-700">Lokalizacja:</label>
                    <input type="text" id="lokalizacja" name="lokalizacja"
                        value="{{ old('lokalizacja', $zasob->Lokalizacja) }}"
                        class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('lokalizacja')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="ilosc" class="block mb-2 text-gray-700">Ilość:</label>
                    <input type="number" id="ilosc" name="ilosc" value="{{ old('ilosc', $zasob->Ilosc) }}"
                        class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('ilosc')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="data_zakupu" class="block mb-2 text-gray-700">Data zakupu:</label>
                    <input type="date" id="data_zakupu" name="data_zakupu"
                        value="{{ old('data_zakupu', $zasob->Data_Zakupu) }}"
                        class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        style="cursor:pointer">
                    @error('data_zakupu')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="data_likwidacji" class="block mb-2 text-gray-700">Data likwidacji lub ZMU (zmiany
                        miejsca użytkownia):</label>
                    <input type="date" id="data_likwidacji" name="data_likwidacji"
                        value="{{ old('data_likwidacji', $zasob->Data_Likwidacji) }}"
                        class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        style="cursor:pointer">
                    @error('data_likwidacji')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block mb-2 text-gray-700">Status:</label>
                    <select id="status" name="status"
                        class="form-select w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        style="cursor:pointer">
                        <option value="">-- Wybierz status --</option>
                        <option value="Dostępny" {{ old('status', $zasob->Status) == 'Dostępny' ? 'selected' : '' }}>
                            Dostępny</option>
                        <option value="Wypożyczony"
                            {{ old('status', $zasob->Status) == 'Wypożyczony' ? 'selected' : '' }}>Wypożyczony</option>
                        <option value="ZMU" {{ old('status', $zasob->Status) == 'ZMU' ? 'selected' : '' }}>Zmiana
                            miejsca użytkowania (ZMU)</option>
                        <option value="Zlikwidowany"
                            {{ old('status', $zasob->Status) == 'Zlikwidowany' ? 'selected' : '' }}>Zlikwidowany
                        </option>
                    </select>
                    @error('status')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="srodek" class="block mb-2 text-gray-700">Typ Środka:</label>
                    <select id="srodek" name="srodek"
                        class="form-select w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        style="cursor:pointer">
                        <option value="ST_WYS" {{ $zasob->Srodek == 'ST_WYS' ? 'selected' : '' }}>Środek trwały
                            wysokocenny</option>
                        <option value="ST_NIS" {{ $zasob->Srodek == 'ST_NIS' ? 'selected' : '' }}>Środek trwały
                            niskocenny</option>
                    </select>
                    @error('srodek')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="numer_pola_spisowego" class="block mb-2 text-gray-700">Numer pola spisowego:</label>
                    <select id="numer_pola_spisowego" name="numer_pola_spisowego"
                        class="form-select w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        style="cursor:pointer">
                        @foreach ($inventory_fields as $inv_f)
                            @php
                                $temp = $inv_f;
                            @endphp
                            <option value={{ $temp }}
                                {{ $zasob->Numer_Pola_Spisowego == $temp ? 'selected' : '' }}>
                                {{ $pola_spisowe[$inv_f] }} ({{ konwersja($inv_f) }})</option>
                        @endforeach
                    </select>
                    @error('numer_pola_spisowego')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="komentarz" class="block mb-2 text-gray-700">Komentarz/Historia:</label>
                    <textarea id="komentarz" name="komentarz"
                        class="form-textarea rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        style="height: 120px; width: 100%;">{{ old('komentarz', $zasob->Komentarz) }}</textarea>
                    @error('komentarz')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

            </div>


        </form>

        <form action="{{ route('deletezasoby', $zasob->id) }}" id="delete-form" method="POST"
            onsubmit="return confirm('Czy na pewno chcesz usunąć ten środek?');" class="flex-shrink-0">
            @csrf
            @method('DELETE')


        </form>

        <div class="flex justify-end gap-4 mt-4">
            <button type="submit" form="update-form" id="submit-button" disabled
                class="px-4 py-2 h-10 bg-green-500 text-white rounded font-semibold">
                Zapisz zmiany
            </button>

            <button type="submit" form="delete-form"
                class="px-4 py-2 h-10 bg-red-500 text-white rounded font-semibold">
                Usuń środek
            </button>

            <button type="button" class="px-2  bg-yellow-500 text-white rounded font-semibold">

                <a href="{{ session('search_url', route('zasoby')) }}"
                    class="px-4 py-2 bg-yellow-500 text-white font-semibold" style="text-decoration: none">Anuluj</a>



            </button>
            {{-- <form action="{{ route('zasoby.cancel') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-secondary">Anuluj</button>
</form> --}}
            <div class="flex gap-2 ml-16 mr-4">
                <a href="{{ $prevZasob ? route('editzasoby', ['id' => $prevZasob->id]) : '#' }}"
                    class="h-10 px-4 py-2 rounded bg-gray-200 text-gray-700 font-semibold border border-gray-300 transition-colors duration-150 {{ $prevZasob ? 'hover:bg-gray-300 hover:text-gray-900' : 'opacity-50 cursor-not-allowed' }}"
                    aria-disabled="{{ $prevZasob ? 'false' : 'true' }}">
                    ← Poprzedni
                </a>

                <a href="{{ $nextZasob ? route('editzasoby', ['id' => $nextZasob->id]) : '#' }}"
                    class="h-10 px-4 py-2 rounded bg-gray-200 text-gray-700 font-semibold border border-gray-300 transition-colors duration-150 {{ $nextZasob ? 'hover:bg-gray-300 hover:text-gray-900' : 'opacity-50 cursor-not-allowed' }}"
                    aria-disabled="{{ $nextZasob ? 'false' : 'true' }}">
                    Następny →
                </a>
            </div>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('update-form');
            const submitButton = document.getElementById('submit-button');
            const numerPolaSpisowego = document.getElementById('numer_pola_spisowego');

            const originalFormData = new FormData(form);
            const originalNumerPolaSpisowego = numerPolaSpisowego.value;


            const formIsDirty = () => {
                const currentFormData = new FormData(form);
                for (let [key, value] of originalFormData.entries()) {
                    if (currentFormData.get(key) !== value) {
                        return true;
                    }
                }
                return false;
            }

            const numerPolaSplisowegoChanged = () => {
                return numerPolaSpisowego.value !== originalNumerPolaSpisowego;
            }

            submitButton.addEventListener('click', function(e) {
                e.preventDefault();
                if (!formIsDirty()) {
                    alert('Nie wprowadzono żadnych zmian.');
                    return;
                }

                form.submit();
            });
        });
    </script>


    {{-- Wyłączenie "Zapisz zmiany gdy nie ma zmian w formularzu" --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("update-form");
            const submitButton = document.getElementById("submit-button");

            // Zapisujemy początkowe wartości formularza
            const initialData = new FormData(form);

            function checkForChanges() {
                const currentData = new FormData(form);
                let hasChanges = false;

                for (let [key, value] of currentData.entries()) {
                    if (initialData.get(key) !== value) {
                        hasChanges = true;
                        break;
                    }
                }

                // Włącz lub wyłącz przycisk w zależności od zmian
                submitButton.disabled = !hasChanges;
                submitButton.classList.toggle("bg-green-500", hasChanges);
                submitButton.classList.toggle("hover:bg-green-700", hasChanges);
                submitButton.classList.toggle("bg-gray-400", !hasChanges);
                submitButton.classList.toggle("cursor-not-allowed", !hasChanges);
            }

            // Nasłuchiwanie zmian we wszystkich polach formularza
            form.addEventListener("input", checkForChanges);
        });
    </script>
</x-app-layout>
