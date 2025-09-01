<x-guest-layout>
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            @auth
                @if (Auth::user()->HasRole(999999))
                    <div class="grid gap-6">
                        <!-- Name -->
                        <div class="space-y-2">
                            <x-label for="name" :value="__('Name')" />
                            <x-input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                                </x-slot>
                                <x-input withicon id="name" class="block w-full" type="text" name="name"
                                    :value="old('name')" required autofocus placeholder="{{ __('Name') }}" />
                            </x-input-with-icon-wrapper>
                        </div>

                        <!-- Email Address -->
                        <div class="space-y-2">
                            <x-label for="email" :value="__('Email')" />
                            <x-input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                                </x-slot>
                                <x-input withicon id="email" class="block w-full" type="email" name="email"
                                    :value="old('email')" required placeholder="{{ __('Email') }}" />
                            </x-input-with-icon-wrapper>
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <x-label for="password" :value="__('Password')" />
                            <x-input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                                </x-slot>
                                <x-input withicon id="password" class="block w-full" type="password" name="password"
                                    required autocomplete="new-password" placeholder="{{ __('Password') }}" />
                            </x-input-with-icon-wrapper>
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-2">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                                </x-slot>
                                <x-input withicon id="password_confirmation" class="block w-full" type="password"
                                    name="password_confirmation" required placeholder="{{ __('Confirm Password') }}" />
                            </x-input-with-icon-wrapper>
                        </div>

                        <div>
                            <x-button class="justify-center w-full gap-2">
                                <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />
                                <span>{{ __('Create User') }}</span>
                            </x-button>
                        </div>
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
                class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                Login
            </a>
        @endauth
    </x-auth-card>
    <button type="button" onclick="window.location.href = '/users';"
        class="mx-auto w-24 px-4 py-2 mb-4 bg-red-500 text-white rounded font-semibold">
        Anuluj
    </button>
</x-guest-layout>
