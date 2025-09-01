<x-app-layout>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet"> --}}
    @if (Auth::user()->HasRole(999999))
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ __('Edit User') }}</h2>
            <div class="py-6">
                <a href="{{ route('impersonate', $user->id) }}"
                    class="text-blue-500 text-decoration-none hover:underline py-6">Przejmij sesje użytkownika</a>
            </div>
        </x-slot>


        @include('bonus.convert')
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form action="{{ route('update.user', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4 mt-4">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nazwa:</label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                <input type="email" id="email" name="email" value="{{ $user->email }}"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            </div>

                            <div class="mb-4">
                                <label for="id" class="block text-gray-700 text-sm font-bold mb-2">ID:</label>
                                <input type="text" id="id" name="id" value="{{ $user->id }}"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full" readonly />
                            </div>

                            {{-- <div class="mb-4">
                                <label for="roles" class="block text-gray-700 text-sm font-bold mb-2">Przydzielone
                                    numery spisowe:</label>
                                <div>
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ konwersja($role->id) }}</span>
                                    @endforeach
                                </div>
                            </div> --}}

                            <div class="mb-4">
                                <label for="roles" class="block text-gray-700 text-sm font-bold mb-2">Przydzielone
                                    Numery Pól Spisowych:</label>
                                {{-- <select name="roles[]" id="roles"
                                    class="form-select rounded-md shadow-sm mt-1 block w-full border-none" multiple
                                    style="outline: none; box-shadow: none; border: 1px solid #64748b !important; height: 300px;">
                                    @foreach ($pola_spisowe as $pole)
                                        <option value="{{ $pole->id }}"
                                            @if (in_array($pole->id, $user->roles->pluck('id')->toArray())) selected @endif>
                                            {{ konwersja($pole->id) }} - {{ $pole->name }}
                                        </option>
                                    @endforeach
                                </select> --}}
                                <x-aui::select name="roles[]" id="roles"
                                    class="w-full p-0 border border-none rounded-md " multiple>
                                    @foreach ($pola_spisowe as $pole)
                                        <option value="{{ $pole->id }}"
                                            {{ in_array($pole->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ konwersja($pole->id) }} - {{ $pole->name }}
                                        </option>
                                    @endforeach
                                </x-aui::select>




                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Nowe
                                    Hasło:</label>
                                <input type="password" id="password" name="password"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation"
                                    class="block text-gray-700 text-sm font-bold mb-2">Potwierdź Nowe Hasło:</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            </div>

                            <div class="flex items-center space-x-4">

                                <!-- Update button in its own form -->
                                <div class="flex justify-end space-x-4 mt-4">
                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                        Aktualizuj
                                    </button>
                                </div>
                        </form>

                        <!-- Separate form for deleting the user -->
                        <div class="flex justify-end space-x-4 mt-4">
                            <form action="{{ route('delete.user', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold mx-3 py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');">
                                    Usuń użytkownika
                                </button>

                                <button type="button" onclick="window.location.href = '/users';"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4  mx-4 rounded focus:outline-none focus:shadow-outline">
                                    Anuluj
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-red-500 mb-4">Nie masz uprawnień do wyświetlania tej strony.</div>
        <a href="{{ route('zasoby') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            Powrót
        </a>
    @endif
</x-app-layout>
