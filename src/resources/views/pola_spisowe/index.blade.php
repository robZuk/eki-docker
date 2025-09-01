<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pola Spisowe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-xl">
                        @if (Auth::user() &&
                                (in_array(999999, Auth::user()->roles->pluck('id')->toArray()) ||
                                    in_array(999998, Auth::user()->roles->pluck('id')->toArray())))
                            <a href="{{ route('pola_spisowe.create') }}"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Dodaj Pola Spisowe
                            </a>
                        @endif
                        @include('bonus.convert')
                    </div>

                    <div class="mt-6">
                        <div class="overflow-x-auto w-full" id="printable">
                            <table class="table border border-collapse w-full" id="dataTable">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="px-2 py-2 border whitespace-nowrap">Numer Pola Spisowego</th>
                                        <th class="px-2 py-2 border">Nazwa Jednostki</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pola_spisowe as $pole)
                                        @if ($pole->id < 999990)
                                            <tr class="bg-gray-100">
                                                <td class="px-2 py-2 border" style="text-align: center;">
                                                    {{ konwersja($pole->id) }}</td>
                                                <td class="px-2 py-2 border" style="text-align: center;">
                                                    {{ $pole->name }}</td>
                                                @if (Auth::user() &&
                                                        (in_array(999999, Auth::user()->roles->pluck('id')->toArray()) ||
                                                            in_array(999998, Auth::user()->roles->pluck('id')->toArray())))
                                                    <td class="px-2 py-2 border no-print">
                                                        <a href="{{ route('pola_spisowe.edit', $pole->id) }}"
                                                            class="text-black hover:text-gray-700">
                                                            Edytuj
                                                        </a>
                                                    </td>

                                            </tr>
                                        @endif

                                        </tr>
                                    @else
                                        @if (Auth::user() &&
                                                (in_array(999999, Auth::user()->roles->pluck('id')->toArray()) ||
                                                    in_array(999998, Auth::user()->roles->pluck('id')->toArray())))
                                            <tr class="bg-gray-100">
                                                <td class="px-2 py-2 border" style="text-align: center;">
                                                    {{ $pole->id }}</td>
                                                <td class="px-2 py-2 border" style="text-align: center;">
                                                    {{ $pole->name }}</td>
                                                <td class="px-2 py-2 border no-print">
                                                    <a href="{{ route('pola_spisowe.edit', $pole->id) }}"
                                                        class="text-black hover:text-gray-700">
                                                        Edytuj
                                                    </a>
                                                </td>

                                            </tr>
                                        @endif
                                    @endif


                                @empty
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 border">Nie znaleziono wierszy</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
