<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Użytkownicy') }}

            </h2>

            {{-- <x-buttons url="{{ route('create') }}" class="bg-gray-800 hover:bg-gray-700 font-bold py-2 px-4 rounded"
                title="Dodaj Użytkownika">
            </x-buttons> --}}
            <a href="{{ route('create') }}" alt="Dodaj Użytkownika" title="Dodaj Użytkownika" class="">
                <x-iconpark-add class="h-8 w-8 bg-green-500 text-green-500 rounded-md" />
            </a>
        </div>
    </x-slot>

    @auth
        @if (Auth::user()->HasRole(999999))
            <div class="table-responsive" id="printable" class="px-4">
                <div class="p-8">
                    <table class="table border border-collapse w-full p-8" id="dataTable">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 border">ID</th>
                                <th class="px-4 py-2 border">Nazwa</th>
                                <th class="px-4 py-2 border">Pola spisowe</th>
                                <th class="px-4 py-2 border">Email</th>
                                <th class="px-4 py-2 border no-print">Edytuj</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('bonus.convert')

                            @forelse($users as $user)
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class="px-4 py-2 border">{{ $user->id }}</td>
                                    <td class="px-4 py-2 border">{{ $user->name }}</td>
                                    <td class="px-4 py-2 border">
                                        @php
                                            $myroles = [];
                                            $userroles = $user->roles->pluck('id')->toArray();
                                            foreach ($userroles as $role) {
                                                $myroles[] = konwersja($role);
                                            }
                                            $myuserroles = implode(',', $myroles);
                                            echo $myuserroles;
                                        @endphp
                                    </td>
                                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                                    <td class="px-4 py-2 border no-print">
                                        <a href="{{ route('edit.user', $user->id) }}"
                                            class="text-blue-500 hover:text-blue-700">Edytuj</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 border">No users found</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            </div>
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
</x-app-layout>
