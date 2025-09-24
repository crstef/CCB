<nav class="relative h-full">
    <ul id="menu" class="flex hidden flex-1 gap-x-8 justify-center items-center ml-0 w-full h-full bg-white border-t border-zinc-100 md:flex md:w-auto md:items-center md:border-t-0 md:flex-row">
       <!--  <li class="px-6 h-16 border-b border-zinc-100 md:px-0 md:border-b-0 md:h-full">
            <a href="/misiunea" class="flex items-center h-full text-base font-medium text-zinc-500 transition duration-300 hover:text-zinc-800">
                Misiunea Clubului
            </a>
        </li> -->
        <li class="px-6 h-16 border-b border-zinc-100 md:px-0 md:border-b-0 md:h-full">
            <a href="/despre-noi" class="flex items-center h-full text-base font-medium text-zinc-500 transition duration-300 hover:text-zinc-800">
                Despre Noi
            </a>
        </li>
        <li x-data="{ open: false }" @mouseenter="open=true" @mouseleave="open=false" class="flex relative z-30 flex-col items-start h-full border-b border-zinc-100 md:border-b-0 group md:flex-row md:items-center">
            <a href="#_" x-on:click="open=!open" class="flex gap-1 items-center px-6 w-full h-16 text-base font-medium text-zinc-500 transition duration-300 md:h-full md:px-0 md:w-auto hover:text-zinc-800">
                <span class="">Discipline</span>
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
                <ul class="flex flex-col justify-between mx-auto max-w-7xl md:flex-row md:px-4">
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="/rescue" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Rescue Dog</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Câini de salvare și activități specifice</span>
                        </a>
                    </li>
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="/rescue" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Rescue Dog</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Câini de salvare și activități specifice</span>
                        </a>
                    </li>
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="{{ route('page.mondioring') }}" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Mondioring</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Mondioring</span>
                        </a>
                    </li>
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="{{ route('page.igp') }}" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">IGP</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">IGP</span>
                        </a>
                    </li>
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="{{ route('page.canicross-bikejoring') }}" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Canicross & Bikejoring</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Canicross & Bikejoring</span>
                        </a>
                    </li>
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="{{ route('page.agility') }}" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Agility</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Agility</span>
                        </a>
                    </li>
                    <li class="w-full border-l border-zinc-100 md:w-1/6">
                        <a href="{{ route('page.obedience') }}" class="block p-6 text-lg font-semibold rounded-lg transition duration-300 hover:bg-zinc-50 lg:p-7 lg:py-10">
                            <span class="block my-2 text-xs font-bold uppercase text-slate-800">Obedience</span>
                            <span class="block text-xs font-medium leading-5 text-slate-500">Obedience</span>
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
