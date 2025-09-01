<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dodaj Pola Spisowe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Dodaj nowe Pole Spisowe
                    </div>
                    @auth
                        @if (Auth::user()->HasRole(999999) || Auth::user()->HasRole(999998))
                            <div class="mt-6">
                                <form method="POST" action="{{ route('pola_spisowe.store') }}">
                                    @csrf
                                    <!-- Pole do wpisania ID -->
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="id">
                                            Numer Pola Spisowego (ID)
                                        </label>
                                        <input type="number" name="id" id="id"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            required>
                                    </div>

                                    <!-- Pole do wpisania nazwy jednostki -->
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                            Nazwa Jednostki
                                        </label>
                                        <input type="text" name="name" id="name"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            required>
                                    </div>

                                    <div class="flex items-center gap-6">
                                        <button type="button" onclick="window.location.href = '/pola_spisowe';"
                                            class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white font-bold  rounded hover:bg-blue-700">
                                            Anuluj
                                        </button>
                                        <button
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                            type="submit">
                                            Dodaj
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="text-red-500 mb-4">Nie masz uprawnień do wyświetlania tej strony.</div>
                                <a href="{{ route('zasoby') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Powrót
                                </a>
                        @endif
                    @else
                        <div class="text-red-500 mb-4">Please log in to view this page.</div>
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>
