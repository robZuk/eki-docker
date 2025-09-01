@props([
    'searchText',
    'numerPolaSpisowego',
    'userRoles',
    'isAdmin',
    'hasMultipleRoles',
    'perPage',
    'inventoryFields',
])

@include('bonus.convert')

@php
    $list = [];
@endphp
@foreach ($inventoryFields as $key => $value)
    @php
        $list[$key] = $value . ' (' . konwersja($key) . ')';

    @endphp
@endforeach
@php
    $options = $list;
@endphp


<div class="flex flex-col">

    {{-- Searchbar --}}
    <form action="{{ route('search') }}" method="GET"
        class="flex flex-col justify-end gap-4 border rounded-md border-gray-200 p-3">
        <div class="flex gap-4 items-center">
            <div>
                <input type="hidden" name="per_page" value="{{ $perPage }}">
                <div class="relative w-72">
                    <x-aui::input type="text" name="searchText" id="searchInput" class="w-72 pr-8"
                        placeholder="Wyszukaj..." value="{{ $searchText }}" />

                </div>
            </div>

            @if ($isAdmin || $hasMultipleRoles)
                <div class="relative">
                    <x-aui::select name="searchNumerPolaSpisowego" id="searchNumerPolaSpisowego"
                        class="w-[550px] border-none" required>
                        <option value="">Wybierz Numer Pola Spisowego</option>
                        @if ($isAdmin)
                            @foreach ($options as $key => $value)
                                <option value="{{ $key }}" {{ $numerPolaSpisowego == $key ? 'selected' : '' }}
                                    class="m-0">
                                    {{ $value }}</option>
                            @endforeach
                        @else
                            @foreach ($userRoles as $role)
                                @if (isset($options[$role]))
                                    <option value="{{ $role }}"
                                        {{ $numerPolaSpisowego == $role ? 'selected' : '' }}>{{ $options[$role] }}
                                    </option>
                                @endif
                            @endforeach
                        @endif
                    </x-aui::select>

                </div>
            @endif
        </div>
        <x-aui::button type="submit"
            class="btn btn rounded-md w-28 text-gray-500 flex justify-center items-center gap-4 border rounded-md border-gray-200 p-2"
            variant="secondary">
            Filtruj <x-iconpark-search-o class="h-4 w-4 text-gray-500 " />
        </x-aui::button>
    </form>

    {{-- Nawigacja --}}

    <div class="flex justify-end items-center gap-x-2 ">

        <a href="{{ route('createzasoby') }}" alt="Dodaj Środek" title="Dodaj Zasób">
            <x-iconpark-add class="h-8 w-8 mx-1 bg-green-500 text-green-500 rounded-md" />
        </a>
        <button onclick="window.print()" class=" font-bold py-2 rounded" title="Drukuj">
            <x-iconpark-printertwo-o class="h-8 w-8 text-gray-500" />
        </button>

        <a href="{{ route('zasoby.export.csv', request()->query()) }}" class="font-bold py-2 rounded"
            title="Eksportuj do CSV">
            <x-iconpark-fileadditionone class="h-8 w-8 text-gray-500 font-bold" />
        </a>
    </div>
    @if (!empty($numerPolaSpisowego))
        <h3 class="flex  text-lg font-semibold text-gray-800">
            Pole spisowe: <span class="text-blue-600 ml-2">{{ $options[$numerPolaSpisowego] }}</span>
        </h3>
    @endif
</div>
