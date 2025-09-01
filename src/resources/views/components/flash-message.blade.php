@if (session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
        class="flex items-center gap-3 max-w-md mx-auto mt-4 p-4 rounded-lg shadow-lg bg-green-100 border border-green-300 text-green-800 animate-fade-in"
        role="alert">
        <!-- Ikona -->
        <svg class="w-6 h-6 flex-shrink-0 mt-1 text-green-400" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="currentColor"
                class="text-green-200" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01" class="text-green-500" />
        </svg>
        <div class="flex-1">
            <p class="font-semibold text-lg leading-tight">{{ session('success') }}</p>
        </div>
    </div>
@endif
