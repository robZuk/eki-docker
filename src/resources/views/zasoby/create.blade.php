<x-app-layout>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet"> -->
    <x-slot name="header">
        <div class="md-64  flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight ">
                {{ __('Dodaj nowy środek') }}
            </h2>

        </div>
    </x-slot>
    <div class="bg-gray-100 rounded-lg border border-gray-200  mx-auto  my-8">
        <form action="{{ route('storezasoby') }}" method="POST" class="bg-gray-100 px-6 py-6 justify-center">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="numer_inwentarzowy" class="block mb-2 text-gray-700">Numer inwentarzowy:</label>
                    <div class="flex gap-2">
                        <input type="text" id="numer_inwentarzowy" name="numer_inwentarzowy"
                            value="{{ old('numer_inwentarzowy') }}"
                            class="form-input w-3/4 rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 required">
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
                    <input type="text" id="nazwa" name="nazwa" value="{{ old('nazwa') }}"
                        class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('nazwa')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="opis" class="block mb-2 text-gray-700">Opis:</label>
                    <textarea id="opis" name="opis"
                        class="form-textarea rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        style="height: 120px; width: 100%;">{{ old('opis') }}</textarea>
                    @error('opis')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <div>
                        <label for="numer_dok_zakupu" class="block mb-2 text-gray-700">Numer dokumentu zakupu
                            (faktury):</label>
                        <input type="text" id="numer_dok_zakupu" name="numer_dok_zakupu"
                            value="{{ old('numer_dok_zakupu') }}"
                            class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('numer_dok_zakupu')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="blok mb-1"></div>
                    <div>
                        <label for="wartosc" class="block mb-2 text-gray-700">Wartość:</label>
                        <input type="number" id="wartosc" name="wartosc" value="{{ old('wartosc') }}" step="0.01"
                            class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('wartosc')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="lokalizacja" class="block mb-2 text-gray-700">Lokalizacja:</label>
                    <input type="text" id="lokalizacja" name="lokalizacja" value="{{ old('lokalizacja') }}"
                        class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('lokalizacja')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="ilosc" class="block mb-2 text-gray-700">Ilość:</label>
                    <input type="number" id="ilosc" name="ilosc" value="{{ old('ilosc') }}"
                        class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('ilosc')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="data_zakupu" class="block mb-2 text-gray-700">Data zakupu:</label>
                    <input type="date" id="data_zakupu" name="data_zakupu" value="{{ old('data_zakupu') }}"
                        class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('data_zakupu')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="data_likwidacji" class="block mb-2 text-gray-700">Data likwidacji lub ZMU (zmiany
                        miejsca użytkownia):</label>
                    <input type="date" id="data_likwidacji" name="data_likwidacji"
                        value="{{ old('data_likwidacji') }}"
                        class="form-input w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('data_likwidacji')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block mb-2 text-gray-700">Status:</label>
                    <select id="status" name="status"
                        class="form-select w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">Wybierz...</option>
                        <option value="Dostępny" selected {{ old('status') == 'Dostępny' ? 'selected' : '' }}>Dostępny
                        </option>
                        <option value="Zlikwidowany" {{ old('status') == 'Zlikwidowany' ? 'selected' : '' }}>
                            Zlikwidowany</option>
                        <option value="ZMU" {{ old('status') == 'ZMU' ? 'selected' : '' }}>Zmiana miejsca
                            użytkowania (ZMU)</option>
                        <option value="Wypożyczony" {{ old('status') == 'Wypożyczony' ? 'selected' : '' }}>Wypożyczony
                        </option>
                    </select>
                    @error('status')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="srodek" class="block mb-2 text-gray-700">Typ Środka:</label>
                    <select id="srodek" name="srodek"
                        class="form-select w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">Wybierz...</option>
                        <option value="ST_WYS" {{ old('srodek') == 'ST_WYS' ? 'selected' : '' }}>Środek trwały
                            wysokocenny</option>
                        <option value="ST_NIS" {{ old('srodek') == 'ST_NIS' ? 'selected' : '' }}>Środek trwały
                            niskocenny</option>
                    </select>
                    @error('srodek')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="numer_pola_spisowego" class="block mb-2 text-gray-700">Numer pola spisowego:</label>
                    <select id="numer_pola_spisowego" name="numer_pola_spisowego"
                        class="form-select w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @foreach ($inventory_fields as $inv_f)
                            @php
                                $temp = $inv_f;
                            @endphp
                            <option value={{ $temp }}
                                {{ old('numer_pola_spisowego') == $temp ? 'selected' : '' }}>
                                {{ $pola_spisowe[$inv_f] }} ({{ $inv_f }})</option>
                        @endforeach
                    </select>



                    @error('numer_pola_spisowego')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="komentarz" class="block mb-2 text-gray-700">Komentarz/Historia:</label>
                    <textarea id="komentarz" name="komentarz"
                        class="form-textarea rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1focus:ring-blue-500"
                        style="height: 42px; width: 100%;">{{ old('komentarz') }}</textarea>
                    @error('komentarz')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>


            </div>
            <div class="flex justify-center mt-4 gap-6">

                <button type="button" onclick="window.location.href = '/zasoby';"
                    class="px-4 py-2 bg-yellow-500 text-white rounded font-semibold">
                    Anuluj
                </button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded  font-semibold">Dodaj</button>

            </div>

        </form>


    </div>
</x-app-layout>
<style>
    .w-full {
        width: 100%;
    }
</style>
