<nav class="relative h-full">
    <ul id="menu" class="flex hidden flex-1 gap-x-8 justify-center items-center ml-0 w-full h-full bg-white border-t border-zinc-100 md:flex md:w-auto md:items-center md:border-t-0 md:flex-row">
        <li class="px-6 h-16 border-b border-zinc-100 md:px-0 md:border-b-0 md:h-full">
            <a href="/misiunea" class="flex items-center h-full text-base font-medium text-zinc-500 transition duration-300 hover:text-zinc-800">
                Misiunea Clubului
            </a>
        </li>
        <li class="px-6 h-16 border-b border-zinc-100 md:px-0 md:border-b-0 md:h-full">
            <a href="/despre-noi" class="flex items-center h-full text-base font-medium text-zinc-500 transition duration-300 hover:text-zinc-800">
                Despre Noi
            </a>
        </li>
        <li x-data="{ open: false }" @mouseenter="open=true" @mouseleave="open=false" class="flex relative z-30 flex-col items-start h-full border-b border-zinc-100 md:border-b-0 group md:flex-row md:items-center">
            <a href="#_" x-on:click="open=!open" class="flex gap-1 items-center px-6 w-full h-16 text-base font-medium text-zinc-500 transition duration-300 md:h-full md:px-0 md:w-auto hover:text-zinc-800">
                <span class="">Despre rasa</span>
                <svg :class="{ 'group-hover:-rotate-180' : !mobileMenuOpen, '-rotate-180' : open }" class="w-5 h-5 transition-all duration-300 ease-out" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" class=""></path></svg>
            </a>
            <div 
                :class="{ 'hidden opacity-0 invisible' : !open, 'block opacity-100 visible' : open }"
                class="hidden top-0 left-0 invisible space-y-3 w-full w-screen bg-white border-t border-b border-zinc-100 shadow-sm opacity-0 transition-all duration-300 ease-out -translate-y-2 md:block md:absolute md:mt-24 z-50"
                x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                x-cloak>
                <!-- Header identic cu cel din galeria foto -->
                <div class="bg-white/80 backdrop-blur-sm border-b border-gray-200/50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Secțiuni despre rasă</span>
                                </div>
                            </div>
                            <h1 class="text-2xl font-bold text-gray-900">Despre Rasa Ciobanesc Belgian</h1>
                            <div class="text-sm text-gray-500">
                                6 secțiuni disponibile
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="flex flex-col justify-between mx-auto max-w-7xl md:flex-row md:px-4">
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="/rescue" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <!-- Pictogramă pentru Rescue Dog -->
                            <svg class="mb-4 w-auto h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                            </svg>
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Rescue Dog</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Câini de salvare și activități specifice</span>
                        </a>
                    </li>
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="#_" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <!-- Pictogramă pentru istorie -->
                            <svg class="mb-4 w-auto h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Istoria Belgianului</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Precizări cronologice despre ciobanescul belgian</span>
                        </a>
                    </li>
                    
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="#_" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <!-- Pictogramă pentru confirmarea rasei -->
                            <svg class="mb-4 w-auto h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Confirmarea Rasei</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Când și cum se obține confirmarea rasei</span>
                        </a>
                    </li>
                    
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="#_" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <!-- Pictogramă pentru Groenendael -->
                            <svg class="mb-4 w-auto h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                            </svg>
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Groenendael</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Descrierea rasei Groenendael</span>
                        </a>
                    </li>
                    
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="#_" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <!-- Pictogramă pentru Laekenois -->
                            <svg class="mb-4 w-auto h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Laekenois</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Descrierea rasei Laekenois</span>
                        </a>
                    </li>
                    
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="#_" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <!-- Pictogramă pentru Malinois -->
                            <svg class="mb-4 w-auto h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Malinois</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Descrierea rasei Malinois</span>
                        </a>
                    </li>
                    
                    <li class="w-full border-r border-l border-zinc-100 md:w-1/6">
                        <a href="#_" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <!-- Pictogramă pentru Tervueren -->
                            <svg class="mb-4 w-auto h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Tervueren</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Descrierea rasei Tervueren</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="px-6 h-16 border-b border-zinc-100 md:px-0 md:border-b-0 md:h-full">
            <a href="/evenimente" class="flex items-center h-full text-base font-medium text-zinc-500 transition duration-300 hover:text-zinc-800">
                Evenimente
            </a>
        </li>
        <li class="px-6 h-16 border-b border-zinc-100 md:px-0 md:border-b-0 md:h-full">
            <a href="/misiunea" class="flex items-center h-full text-base font-medium text-zinc-500 transition duration-300 hover:text-zinc-800">
                Misiunea Clubului
            </a>
        </li>

        <a href="#_" class="block px-5 py-3 text-base font-medium text-center text-white bg-blue-600 md:hidden">Vezi Dashboard</a>
    </ul>
    
</nav>
   


@guest
    <div class="hidden relative z-30 flex-shrink-0 justify-center items-center space-x-3 h-full text-sm md:flex">
        <x-button href="{{ route('login') }}" tag="a" class="text-sm" color="secondary">Logare</x-button>
        <!-- <x-button href="{{ route('register') }}" tag="a" class="text-sm">Inregistrare</x-button> -->
    </div>
@else
    <x-button href="{{ route('login') }}" tag="a" class="text-sm" class="relative z-20 flex-shrink-0">Vezi Dashboard</x-button>
@endguest
