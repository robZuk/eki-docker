<div x-data="{ open: false }">
    <!-- Przycisk otwierający na mobilnych -->
    <button x-show="!open" @click="open = true"
        class="lg:hidden fixed top-4 left-4 z-50 p-2 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
        <x-css-menu class="block dark:hidden" /> <!-- Ikona dla trybu jasnego -->
        <x-css-menu class="hidden dark:block text-white" /> <!-- Ikona dla trybu ciemnego -->

    </button>

    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-40 w-64 bg-gray-100 dark:bg-gray-900 border-r border-gray-300 dark:border-gray-700 shadow-lg
               transition-transform transform lg:translate-x-0"
        :class="open ? 'translate-x-0' : '-translate-x-full'">
        <div class="flex flex-col h-full py-5 overflow-y-auto">
            <div class="px-4 sm:px-5 flex justify-between items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('zasoby') }}" wire:navigate>
                        <img src="{{ url('logo/umg-zolty.png') }}" alt="Logo" class="max-w-32 h-auto">
                    </a>
                </div>
                <button @click="open = false"
                    class="lg:hidden text-gray-800 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                    ✖
                </button>
            </div>
            <div class="relative flex-1 px-4 mt-5 sm:px-5">
                <nav class="space-y-2">
                    <a href="{{ route('zasoby') }}"
                        class="block px-4 py-2 rounded-md bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-200">Środki
                        Jednostki</a>
                    <a href="{{ route('pola_spisowe') }}"
                        class="block px-4 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-800 text-gray-900 dark:text-gray-200">Pola
                        Spisowe</a>

                    @if (Auth::user()->hasRole(999999))
                        <div x-data="{ activeAccordion: '', setActiveAccordion(id) { this.activeAccordion = (this.activeAccordion == id) ? '' : id } }" class="relative w-full max-w-md mx-auto text-xs">
                            <div x-data="{ id: $id('accordion') }"
                                :class="{
                                    'border-gray-300 text-gray-900 dark:border-gray-700 dark:text-gray-200': activeAccordion ==
                                        id,
                                    'border-transparent text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200': activeAccordion !=
                                        id
                                }"
                                class="duration-200 ease-out bg-gray-200 dark:bg-gray-800 border rounded-md cursor-pointer group"
                                x-cloak>
                                <button @click="setActiveAccordion(id)"
                                    class="flex items-center justify-between w-full text-base font-normal px-4 py-2 font-normal text-left select-none hover:bg-gray-300 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-200 rounded-md">


                                    <span>Admin</span>
                                    <div :class="{ 'rotate-90': activeAccordion == id }"
                                        class="relative flex items-center justify-center w-2.5 h-2.5 duration-300 ease-out">
                                        <div
                                            class="absolute w-0.5 h-full bg-gray-500 dark:bg-gray-400 group-hover:bg-gray-800 dark:group-hover:bg-gray-200 rounded-full">
                                        </div>
                                        <div :class="{ 'rotate-90': activeAccordion == id }"
                                            class="absolute w-full h-0.5 ease duration-500 bg-gray-500 dark:bg-gray-400 group-hover:bg-gray-800 dark:group-hover:bg-gray-200 rounded-full">
                                        </div>
                                    </div>
                                </button>
                                <div x-show="activeAccordion==id"
                                    class="bg-gray-200 dark:bg-gray-800 border-t border-gray-300 dark:border-gray-700"
                                    x-collapse x-cloak>
                                    <ul class="list text-base ml-4">
                                        <li>
                                            <a href="#"
                                                class="block py-2 rounded-md no-underline hover:underline text-gray-900 dark:text-gray-200">Archiwalne
                                                zasoby</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block py-2 rounded-md no-underline  hover:underline text-gray-900 dark:text-gray-200">Import</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('users.index') }}"
                                                class="block py-2 rounded-md no-underline hover:underline text-gray-900 dark:text-gray-200">Użytkownicy</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block py-2 rounded-md no-underline hover:underline text-gray-900 dark:text-gray-200">Modyfikacje
                                                zasobów</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                    @endif


                </nav>
            </div>
        </div>
    </div>

    <!-- Tło zaciemniające na mobilu -->
    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"
        x-transition.opacity></div>


</div>
