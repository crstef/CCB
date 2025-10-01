<x-filament-widgets::widget class="fi-filament-info-widget">
    <x-filament::section>
        <div class="flex gap-x-3 items-center">
            <div class="flex-1">
                <a
                    href="/"
                    rel="noopener noreferrer"
                    target="_blank"
                >
                   <x-logo class="w-auto h-6"></x-logo>
                </a>

                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                    CCB Admin Panel - {{ wave_version() }}
                </p>
            </div>

            <!-- Spațiu rezervat pentru eventuale link-uri/butoane viitoare -->
            <div class="flex flex-col gap-y-1 items-end">
                <!-- Aici poți adăuga link-uri sau butoane personalizate în viitor -->
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>