<@php
    $user = Auth::user();
    $userRoles = $user->roles->pluck('id')->toArray();
    $isAdmin = in_array(999999, $userRoles) || in_array(999998, $userRoles);
    $hasMultipleRoles = count($userRoles) > 1;
@endphp <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Środki Jednostki') }}
        </h2>
        {{-- <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-x-4"> --}}

        {{-- <div class="flex items-center gap-2"> --}}
        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box"
                    viewBox="0 0 16 16">
                    <path
                        d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                </svg>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Środki Jednostki') }}
                </h2> --}}
        {{-- </div> --}}
        <!-- Searchbar -->
        <div class="flex justify-end">
            <x-searchbar :searchText="$searchText" :numerPolaSpisowego="$numerPolaSpisowego" :userRoles="$userRoles" :isAdmin="$isAdmin" :hasMultipleRoles="$hasMultipleRoles"
                :perPage="$perPage" :inventoryFields="$pola_spisowe" />
        </div>
        {{-- </div> --}}
    </x-slot>


    <div class="px-4">
        @include('components.footer', [
            'results' => $results,
            'searchText' => $searchText,
            'numerPolaSpisowego' => $numerPolaSpisowego,
            'perPage' => $perPage,
            'userRoles' => $userRoles,
        ])

        <div class="overflow-x-auto w-full" id="printable">
            <table class="table table-auto border border-collapse w-full rounded-md" id="dataTable">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-2 py-2 border nazwa-column">
                            <div class="flex items-center justify-between">
                                <span>Nazwa</span>
                                <div class="flex flex-col gap-0 ml-2 leading-tight gap-0">
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Nazwa', 'direction' => 'asc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:text-gray-800 my-[-3px]">▲</a>
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Nazwa', 'direction' => 'desc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:text-gray-800 my-[-3px]">▼</a>
                                </div>
                            </div>
                        </th>
                        <th class="px-2 py-2 border whitespace-nowrap">
                            <div class="flex items-center">
                                <span>Numer Inwentarzowy</span>
                                <div class="flex flex-col ml-2 leading-tight gap-0">
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Numer_Inwentarzowy', 'direction' => 'asc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:text-gray-800  my-[-3px]">▲</a>
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Numer_Inwentarzowy', 'direction' => 'desc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:text-gray-800  my-[-3px]">▼</a>
                                </div>
                            </div>
                        </th>
                        <th class="px-2 py-2 border">
                            <div class="flex items-center">
                                <span>Opis</span>
                            </div>
                        </th>
                        <th class="px-2 py-2 border">
                            <div class="flex items-center">
                                <span>Numer faktury</span>
                                <div class="flex flex-col ml-2 leading-tight gap-0">
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Numer_Inwentarzowy', 'direction' => 'asc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:text-gray-800  my-[-3px]">▲</a>
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Numer_Inwentarzowy', 'direction' => 'desc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:text-gray-800  my-[-3px]">▼</a>
                                </div>

                            </div>
                        </th>

                        <th class="px-2 py-2 border whitespace-nowrap">
                            <div class="flex items-center">
                                <span>Wartość</span>
                                <div class="flex flex-col ml-2 leading-tight gap-0">
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Wartosc', 'direction' => 'asc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:text-gray-800  my-[-3px]">▲</a>
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Wartosc', 'direction' => 'desc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:text-gray-800  my-[-3px]">▼</a>
                                </div>
                            </div>
                        </th>
                        <th class="px-2 py-2 border whitespace-nowrap">
                            <div class="flex items-center">
                                <span>Data Zakupu</span>
                                <div class="flex flex-col ml-2 leading-tight gap-0">
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Data_Zakupu', 'direction' => 'asc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:text-gray-800  my-[-3px]">▲</a>
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Data_Zakupu', 'direction' => 'desc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:text-gray-800  my-[-3px]">▼</a>
                                </div>
                            </div>
                        </th>
                        <th class="px-2 py-2 border whitespace-nowrap">
                            <div class="flex items-center">
                                <span>Data Likwidacji</span>
                                <div class="flex flex-col ml-2 leading-tight gap-0">
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Data_Likwidacji', 'direction' => 'asc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:text-gray-800  my-[-3px] active">▲</a>
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Data_Likwidacji', 'direction' => 'desc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:text-gray-800  my-[-3px]">▼</a>
                                </div>
                            </div>

                        </th>
                        <th class="px-2 py-2 border whitespace-nowrap">
                            <div class="flex items-center">
                                <span>Ilość</span>

                            </div>

                        </th>
                        <th class="px-2 py-2 border whitespace-nowrap">
                            <div class="flex items-center">
                                <span>Lokalizacja</span>
                                <div class="flex flex-col ml-2 leading-tight gap-0">
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Lokalizacja', 'direction' => 'asc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:xt0gray-800  my-[-3px]">▲</a>
                                    <a href="{{ route('zasoby', array_merge(request()->query(), ['sort' => 'Lokalizacja', 'direction' => 'desc'])) }}"
                                        class="sort-link no-underline text-gray-500 hover:xt0gray-800  my-[-3px]">▼</a>


                                </div>
                            </div>

                        </th>
                        <th class="px-2 py-2 border whitespace-nowrap">
                            <div class="flex items-center">
                                <span>Status</span>


                            </div>

                        </th>
                        <th class="px-2 py-2 border whitespace-nowrap">
                            <div class="flex items-center">
                                <span>Środek</span>


                            </div>

                        </th>
                        <th class="px-2 py-2 border hidden">Numer Pola Spisowego</th>
                        <th class="px-2 py-2 border no-print whitespace-nowrap">Edytuj</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $rekord)
                        <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-2 py-2 border nazwa-column break-words">{{ $rekord->Nazwa }}
                            </td>
                            <td class="px-2 py-2 border">{{ $rekord->Numer_Inwentarzowy }}</td>
                            <td class="px-2 py-2 border nazwa-column break-words" style="max-width: 350px;">
                                {{ $rekord->Opis }}</td>
                            <td class="px-2 py-2 border">{{ $rekord->Numer_Dok_Zakupu }}</td>
                            <td class="px-2 py-2 border">{{ $rekord->Wartosc }}</td>
                            <td class="px-2 py-2 border">{{ $rekord->Data_Zakupu }}</td>
                            <td class="px-2 py-2 border">{{ $rekord->Data_Likwidacji }}</td>
                            <td class="px-2 py-2 border">{{ $rekord->Ilosc }}</td>
                            <td class="px-2 py-2 border">{{ $rekord->Lokalizacja }}</td>
                            <td class="px-2 py-2 border">{{ $rekord->Status }}</td>
                            <td class="px-2 py-2 border">{{ $rekord->Srodek }}</td>
                            <td class="px-2 py-2 border hidden">{{ $rekord->Numer_Pola_Spisowego }}</td>
                            <td class="px-2 py-2 border no-print">
                                <a href="{{ route('editzasoby', $rekord->id) }}"
                                    class="text-black hover:text-gray-700">


                                    Edytuj
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="px-2 py-2 border">Nie znaleziono wierszy</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>

        @include('components.footer', [
            'results' => $results,
            'searchText' => $searchText,
            'numerPolaSpisowego' => $numerPolaSpisowego,
            'perPage' => $perPage,
            'userRoles' => $userRoles,
        ])


        </x-app-layout>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const truncateText = (text, length) => text.length > length ? text.slice(0, length) + '...' : text;

                document.querySelectorAll('.toggle-description').forEach(element => {
                    const fullText = element.dataset.fullText;
                    const truncatedText = truncateText(fullText, 75);
                    element.innerText = truncatedText;

                    element.addEventListener('click', function() {
                        if (element.innerText.includes('...')) {
                            element.innerText = fullText;
                        } else {
                            element.innerText = truncatedText;
                        }
                    });
                });

                // Highlight active sort
                const urlParams = new URLSearchParams(window.location.search);
                const sort = urlParams.get('sort');
                const direction = urlParams.get('direction');
                if (sort && direction) {
                    const activeLink = document.querySelector(
                        `a[href*="sort=${sort}"][href*="direction=${direction}"]`);
                    if (activeLink) {
                        activeLink.classList.add('active');
                    }
                }
            });
        </script>
