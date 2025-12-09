<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
        @if(app()->getLocale() == 'id')
            <span class="text-lg">🇮🇩</span>
            <span class="text-sm font-medium text-gray-700">ID</span>
        @else
            <span class="text-lg">🇬🇧</span>
            <span class="text-sm font-medium text-gray-700">EN</span>
        @endif
        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div x-show="open" @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-50"
         style="display: none;">

        <a href="{{ route('language.switch', 'id') }}"
           class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 transition {{ app()->getLocale() == 'id' ? 'bg-gray-50' : '' }}">
            <span class="text-lg">🇮🇩</span>
            <span class="text-sm font-medium text-gray-700">Indonesia</span>
        </a>

        <a href="{{ route('language.switch', 'en') }}"
           class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 transition {{ app()->getLocale() == 'en' ? 'bg-gray-50' : '' }}">
            <span class="text-lg">🇬🇧</span>
            <span class="text-sm font-medium text-gray-700">English</span>
        </a>
    </div>
</div>
