@php
    $results = $results ?? null;
    $searchText = $searchText ?? null;
    $numerPolaSpisowego = $numerPolaSpisowego ?? null;
    $perPage = $perPage ?? 10;
    $userRoles = $userRoles ?? [];
@endphp

<div class="mt-4 flex items-center justify-between mb-4">
    <div class="flex items-center">
        <form action="{{ route('zasoby') }}" method="GET">
            <input type="hidden" name="searchText" value="{{ $searchText }}">
            <input type="hidden" name="searchNumerPolaSpisowego" value="{{ $numerPolaSpisowego }}" class="rounded-md">
            <select name="per_page" onchange="this.form.submit()" class="form-select rounded-md">
                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                <option value="250" {{ $perPage == 250 ? 'selected' : '' }}>250</option>
                <option value="500" {{ $perPage == 500 ? 'selected' : '' }}>500</option>
                <option value="1000" {{ $perPage == 1000 ? 'selected' : '' }}>1000</option>
                <option value="All" {{ $perPage == 'All' ? 'selected' : '' }}>Wszystkie</option>
            </select>
        </form>
    </div>

    @if ($results instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <p>Wiersze od {{ $results->firstItem() }} do {{ $results->lastItem() }} z {{ $results->total() }}</p>
    @endif

    <div>
        @if ($results instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="flex items-center">
                @if ($results->onFirstPage())
                    <span class="mr-2 text-gray-500">&laquo;&laquo;</span>
                    <span class="mr-2 text-gray-500">&laquo;</span>
                @else
                    <a href="{{ $results->appends(['per_page' => $results->perPage()])->url(1) }}"
                        class="mr-2 text-blue-500 hover:text-blue-700">&laquo;&laquo;</a>
                    <a href="{{ $results->appends(['per_page' => $results->perPage()])->previousPageUrl() }}"
                        class="mr-2 text-blue-500 hover:text-blue-700">&laquo;</a>
                @endif

                @if ($results->currentPage() > 3)
                    <a href="{{ $results->appends(['per_page' => $results->perPage()])->url($results->currentPage() - 2) }}"
                        class="mr-2 text-blue-500 hover:text-blue-700">{{ $results->currentPage() - 2 }}</a>
                @endif

                @if ($results->currentPage() > 2)
                    <a href="{{ $results->appends(['per_page' => $results->perPage()])->url($results->currentPage() - 1) }}"
                        class="mr-2 text-blue-500 hover:text-blue-700">{{ $results->currentPage() - 1 }}</a>
                @endif

                <span class="mx-2 text-gray-700">{{ $results->currentPage() }}</span>

                @if ($results->hasMorePages())
                    <a href="{{ $results->appends(['per_page' => $results->perPage()])->nextPageUrl() }}"
                        class="ml-2 text-blue-500 hover:text-blue-700">{{ $results->currentPage() + 1 }}</a>
                @else
                    <span class="ml-2 text-gray-500">{{ $results->currentPage() + 1 }}</span>
                @endif

                @if ($results->currentPage() < $results->lastPage() - 1)
                    <a href="{{ $results->appends(['per_page' => $results->perPage()])->url($results->currentPage() + 2) }}"
                        class="ml-2 text-blue-500 hover:text-blue-700">{{ $results->currentPage() + 2 }}</a>
                @endif

                @if ($results->hasMorePages())
                    <a href="{{ $results->appends(['per_page' => $results->perPage()])->nextPageUrl() }}"
                        class="ml-2 text-blue-500 hover:text-blue-700">&raquo;</a>
                    <a href="{{ $results->appends(['per_page' => $results->perPage()])->url($results->lastPage()) }}"
                        class="ml-2 text-blue-500 hover:text-blue-700">&raquo;&raquo;</a>
                @else
                    <span class="ml-2 text-gray-500">&raquo;</span>
                    <span class="ml-2 text-gray-500">&raquo;&raquo;</span>
                @endif
            </div>
        @endif
    </div>
</div>
