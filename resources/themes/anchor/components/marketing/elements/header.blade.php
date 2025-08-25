<header 
    x-data="{ 
        mobileMenuOpen: false, 
        scrolled: false, 
        showOverlay: false,
        topOffset: '5',
        evaluateScrollPosition(){
            if(window.pageYOffset > this.topOffset){
                this.scrolled = true;
            } else {
                this.scrolled = false;
            }
        } 
    }"
    x-init="
        window.addEventListener('resize', function() {
            if(window.innerWidth > 768) {
                mobileMenuOpen = false;
            }
        });
        $watch('mobileMenuOpen', function(value){
            if(value){ document.body.classList.add('overflow-hidden'); } else { document.body.classList.remove('overflow-hidden'); }
        });
        evaluateScrollPosition();
        window.addEventListener('scroll', function() {
            evaluateScrollPosition(); 
        })
    " 
    :class="{ 'border-gray-200/60 bg-white/90 border-b backdrop-blur-lg' : scrolled, 'border-transparent border-b bg-transparent translate-y-0' : !scrolled }" 
    class="box-content sticky top-0 z-50 w-full h-24" 
>
    <div 
        x-show="showOverlay"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        class="absolute inset-0 w-full h-screen pt-24" x-cloak>
        <div class="w-screen h-full bg-black/50"></div>
    </div>
    <x-container>
        <div class="z-30 flex items-center justify-between h-24 md:space-x-8">
            <div class="z-20 flex items-center justify-between w-full md:w-auto">
                <div class="relative z-20 inline-flex">
                    <a href="{{ route('home') }}" class="flex items-center justify-center space-x-3 font-bold text-zinc-900">
                    <x-logo class="w-auto h-8 md:h-9"></x-logo>
                    </a>
                </div>
                <div class="flex justify-end flex-grow md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 transition duration-150 ease-in-out rounded-full text-zinc-400 hover:text-zinc-500 hover:bg-zinc-100">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                        <svg x-show="mobileMenuOpen" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>

            <nav :class="{ 'hidden' : !mobileMenuOpen, 'block md:relative absolute top-0 left-0 md:w-auto w-screen md:h-auto h-screen pointer-events-none md:z-10 z-10' : mobileMenuOpen }" class="h-full md:flex">
                <ul :class="{ 'hidden md:flex' : !mobileMenuOpen, 'flex flex-col absolute md:relative md:w-auto w-screen h-full md:h-full md:overflow-auto overflow-scroll md:pt-0 mt-24 md:pb-0 pb-48 bg-white md:bg-transparent' : mobileMenuOpen }" id="menu" class="flex items-stretch justify-start flex-1 w-full h-full ml-0 border-t border-gray-100 pointer-events-auto md:items-center md:justify-center gap-x-8 md:w-auto md:border-t-0 md:flex-row">
                    <li x-data="{ open: false }" @mouseenter="showOverlay=true" @mouseleave="showOverlay=false" class="z-30 flex flex-col items-start h-auto border-b border-gray-100 md:h-full md:border-b-0 group md:flex-row md:items-center">
                        <a href="#_" x-on:click="open=!open" class="flex items-center w-full h-16 gap-1 text-sm font-semibold text-gray-700 transition duration-300 hover:bg-gray-100 md:hover:bg-transparent px-7 md:h-full md:px-0 md:w-auto hover:text-gray-900">
                            <span class="">Despre noi</span>
                            <svg :class="{ 'group-hover:-rotate-180' : !mobileMenuOpen, '-rotate-180' : mobileMenuOpen && open }" class="w-5 h-5 transition-all duration-300 ease-out" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" class=""></path></svg>
                        </a>
                        <div 
                            :class="{ 'hidden md:block opacity-0 invisible md:absolute' : !open, 'md:invisible md:opacity-0 md:hidden md:absolute' : open }"
                            class="top-0 left-0 w-screen space-y-3 transition-transform duration-300 ease-out bg-white border-t border-b border-gray-100 md:shadow-md md:-translate-y-2 md:mt-24 md:block md:group-hover:block md:group-hover:visible md:group-hover:opacity-100 md:group-hover:translate-y-0" x-cloak>
                            <ul class="flex flex-col justify-between mx-auto max-w-7xl md:px-16 md:flex-row">
                                <li class="w-full border-l border-gray-100 md:w-1/5">
                                    <a href="{{ route('page.show', 'istoria-clubului') }}" class="block h-full p-6 text-lg font-semibold hover:bg-gray-50 lg:p-7 lg:py-10">
                                        <img src="/wave/img/icons/history.png" class="w-12 h-auto" alt="feature 1 icon" />
                                        <span class="block my-2 text-xs font-bold uppercase text-slate-800">Istoria Clubului</span>
                                        <span class="block text-xs font-medium leading-5 text-slate-500">Câteva relatări cronologice despre Club</span>
                                    </a>
                                </li>
                                <li class="w-full border-l border-gray-100 md:w-1/5">
                                    <a href="{{ route('page.show', 'echipa') }}" class="block h-full p-6 text-lg font-semibold hover:bg-gray-50 lg:p-7 lg:py-10">
                                        <img src="/wave/img/icons/team.png" class="w-12 h-auto" alt="feature 2 icon" />
                                        <span class="block my-2 text-xs font-bold uppercase text-slate-800">Echipa</span>
                                        <span class="block text-xs font-medium leading-5 text-slate-500">Membrii echipei</span>
                                    </a>
                                </li>
                                <li class="w-full border-l border-gray-100 md:w-1/5">
                                    <a href="{{ route('page.show', 'cum-sa-devii-membru') }}" class="block h-full p-6 text-lg font-semibold hover:bg-gray-50 lg:p-7 lg:py-10">
                                        <img src="/wave/img/icons/member-card.png" class="w-12 h-auto" alt="Membru icon" />
                                        <span class="block my-2 text-xs font-bold uppercase text-slate-800">Cum sa devii membru</span>
                                        <span class="block text-xs font-medium leading-5 text-slate-500">Descrierea modului de a deveni membru</span>
                                    </a>
                                </li>
                                <li class="w-full border-l border-gray-100 md:w-1/5">
                                    <a href="{{ route('page.show', 'servicii') }}" class="block h-full p-6 text-lg font-semibold hover:bg-gray-50 lg:p-7 lg:py-10">
                                        <img src="/wave/img/icons/Services.png" class="w-12 h-auto" alt="feature 4 icon" />
                                        <span class="block my-2 text-xs font-bold uppercase text-slate-800">Servicii</span>
                                        <span class="block text-xs font-medium leading-5 text-slate-500">Servicii si evenimente oferite de club</span>
                                    </a>
                                </li>
                                {{-- <li class="w-full border-l border-r border-gray-100 md:w-1/5">
                                    <a href="{{ route('contact') }}" class="block h-full p-6 text-lg font-semibold hover:bg-gray-50 lg:p-7 lg:py-10">
                                        <img src="/wave/img/icons/Contact.png" class="w-12 h-auto" alt="contact icon" />
                                        <span class="block my-2 text-xs font-bold uppercase text-slate-800">Contact</span>
                                        <span class="block text-xs font-medium leading-5 text-slate-500">Trimite-ne un mesaj și te vom contacta în curând</span>
                                    </a>
                                </li> --}}
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li x-data="{ open: false }" @mouseenter="showOverlay=true" @mouseleave="showOverlay=false" class="z-30 flex flex-col items-start h-auto border-b border-gray-100 md:h-full md:border-b-0 group md:flex-row md:items-center">
                        <a href="#_" x-on:click="open=!open" class="flex items-center w-full h-16 gap-1 text-sm font-semibold text-gray-700 transition duration-300 hover:bg-gray-100 md:hover:bg-transparent px-7 md:h-full md:px-0 md:w-auto hover:text-gray-900">
                            <span class="">Despre rasa</span>
                            <svg :class="{ 'group-hover:-rotate-180' : !mobileMenuOpen, '-rotate-180' : mobileMenuOpen && open }" class="w-5 h-5 transition-all duration-300 ease-out" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" class=""></path></svg>
                        </a>
                        <div 
                            :class="{ 'hidden md:block opacity-0 invisible md:absolute' : !open, 'md:invisible md:opacity-0 md:hidden md:absolute' : open }"
                            class="top-0 left-0 w-screen space-y-3 transition-transform duration-300 ease-out bg-white border-t border-b border-gray-100 md:shadow-md md:-translate-y-2 md:mt-24 md:block md:group-hover:block md:group-hover:visible md:group-hover:opacity-100 md:group-hover:translate-y-0" x-cloak>
                            <ul class="flex flex-col justify-between mx-auto max-w-7xl md:flex-row md:px-12">
                                <div class="flex flex-col w-full border-l border-r divide-x md:flex-row divide-zinc-100 border-zinc-100">
                                    <div class="w-auto divide-y divide-zinc-100">
                                        <a href="{{ route('page.show', 'istoria-ciobanescului-belgian') }}" class="block text-sm p-7 hover:bg-neutral-100 group">
                                            <span class="block mb-1 font-medium text-black">Istoria Ciobanescului belgian</span>
                                            <span class="block font-light leading-5 opacity-50">Cateva detalii despre istoria ciobănescului belgian</span>
                                        </a>
                                        <a href="{{ route('page.show', 'confirmarea-rasei') }}" class="block text-sm p-7 hover:bg-neutral-100 group">
                                            <span class="block mb-1 font-medium text-black">Confirmarea rasei</span>
                                            <span class="block leading-5 opacity-50">Cand si cum se face confirmarea rasei</span>
                                        </a>
                                    </div>
                                    <div class="w-auto divide-y divide-zinc-100">
                                        <a href="{{ route('page.show', 'groenendael') }}" class="block text-sm p-7 hover:bg-neutral-100">
                                            <span class="block mb-1 font-medium text-black">Groenendael</span>
                                            <span class="block font-light leading-5 opacity-50">Descriere generala a rasei Groenendael</span>
                                        </a>
                                        <a href="{{ route('page.show', 'laekenois') }}" class="block text-sm p-7 hover:bg-neutral-100">
                                            <span class="block mb-1 font-medium text-black">Laekenois</span>
                                            <span class="block leading-5 opacity-50">Descriere generala a rasei Laekenois</span>
                                        </a>
                                    </div>
                                    <div class="w-auto divide-y divide-zinc-100">
                                        <a href="{{ route('page.show', 'malinois') }}" class="block text-sm p-7 hover:bg-neutral-100">
                                            <span class="block mb-1 font-medium text-black">Malinois</span>
                                            <span class="block leading-5 opacity-50">Descriere generala a rasei Malinois</span>
                                        </a>
                                        <a href="{{ route('page.show', 'tervueren') }}" class="block text-sm p-7 hover:bg-neutral-100">
                                            <span class="block mb-1 font-medium text-black">Tervueren</span>
                                            <span class="block leading-5 opacity-50">Descriere generala a rasei Tervueren</span>
                                        </a>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </li>
                    <li class="flex-shrink-0 h-16 border-b border-gray-100 md:border-b-0 md:h-full">
                        <a href="{{ route('documents.index') }}" class="flex items-center h-full text-sm font-semibold text-gray-700 transition duration-300 md:px-0 px-7 hover:bg-gray-100 md:hover:bg-transparent hover:text-gray-900">
                            Documente
                        </a>
                    </li>
                    <li x-data="{ open: false }" @mouseenter="showOverlay=true; open=true" @mouseleave="showOverlay=false; open=false" class="z-30 flex flex-col items-start h-auto border-b border-gray-100 md:h-full md:border-b-0 group md:flex-row md:items-center">
                        <a href="#_" x-on:click="open=!open" class="flex items-center w-full h-16 gap-1 text-sm font-semibold text-gray-700 transition duration-300 hover:bg-gray-100 md:hover:bg-transparent px-7 md:h-full md:px-0 md:w-auto hover:text-gray-900">
                            <span class="">Galerie</span>
                            <svg :class="{ 'rotate-180' : open }" class="w-5 h-5 transition-all duration-300 ease-out" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" class=""></path></svg>
                        </a>
                        <div 
                            :class="{ 'hidden opacity-0 invisible' : !open, 'block opacity-100 visible' : open }"
                            class="absolute top-0 left-0 w-screen space-y-3 transition-all duration-300 ease-out bg-white border-t border-b border-gray-100 shadow-xl mt-24 z-50" 
                            x-show="open"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            x-cloak>
                            <div class="mx-auto max-w-7xl py-8 px-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    {{-- Galerie Foto --}}
                                    <div class="group">
                                        <a href="{{ route('galerie-foto') }}" class="block bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl p-6 h-full hover:shadow-lg transition-all duration-300 hover:scale-105">
                                            <div class="flex items-center mb-4">
                                                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="text-lg font-bold text-gray-900">Galerie Foto</h3>
                                                    <span class="text-xs font-medium text-blue-600 uppercase tracking-wide">Competiții & Evenimente</span>
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-600 leading-relaxed">
                                                Fotografii din competițiile canine, campionate naționale și internaționale, demonstrații și evenimente speciale ale clubului.
                                            </p>
                                            <div class="mt-4 flex items-center text-blue-600 font-medium text-sm group-hover:text-blue-700">
                                                <span>Explorează galeria</span>
                                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>

                                    {{-- Galerie Video --}}
                                    <div class="group">
                                        <a href="{{ route('galerie-video') }}" class="block bg-gradient-to-br from-red-50 to-pink-100 rounded-xl p-6 h-full hover:shadow-lg transition-all duration-300 hover:scale-105">
                                            <div class="flex items-center mb-4">
                                                <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center mr-4">
                                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="text-lg font-bold text-gray-900">Galerie Video</h3>
                                                    <span class="text-xs font-medium text-red-600 uppercase tracking-wide">Înregistrări Live</span>
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-600 leading-relaxed">
                                                Videoclipuri din competiții, antrenamente, demonstrații de dresaj și momente speciale cu câinii noștri campioni.
                                            </p>
                                            <div class="mt-4 flex items-center text-red-600 font-medium text-sm group-hover:text-red-700">
                                                <span>Vizionează videoclipurile</span>
                                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>

                                    {{-- Live Stream / Competiții Actuale --}}
                                    <div class="group">
                                        <a href="#" class="block bg-gradient-to-br from-green-50 to-emerald-100 rounded-xl p-6 h-full hover:shadow-lg transition-all duration-300 hover:scale-105">
                                            <div class="flex items-center mb-4">
                                                <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="text-lg font-bold text-gray-900">Live & Rezultate</h3>
                                                    <span class="text-xs font-medium text-green-600 uppercase tracking-wide">În Timp Real</span>
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-600 leading-relaxed">
                                                Urmărește competițiile live, vezi rezultatele în timp real și găsește informații despre competițiile viitoare.
                                            </p>
                                            <div class="mt-4 flex items-center text-green-600 font-medium text-sm group-hover:text-green-700">
                                                <span>Vezi competițiile actuale</span>
                                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    </li>
                    <li class="flex-shrink-0 h-16 border-b border-gray-100 md:border-b-0 md:h-full">
                        <a href="{{ route('blog') }}" class="flex items-center h-full text-sm font-semibold text-gray-700 transition duration-300 md:px-0 px-7 hover:bg-gray-100 md:hover:bg-transparent hover:text-gray-900">Evenimente</a>
                    </li>
                    <li x-data="{ open: false }" @mouseenter="showOverlay=true; open=true" @mouseleave="showOverlay=false; open=false" class="z-30 flex flex-col items-start h-auto border-b border-gray-100 md:h-full md:border-b-0 group md:flex-row md:items-center">
                        <a href="#" x-on:click="open=!open" class="flex items-center w-full h-16 gap-1 text-sm font-semibold text-gray-700 transition duration-300 hover:bg-gray-100 md:hover:bg-transparent px-7 md:h-full md:px-0 md:w-auto hover:text-gray-900">
                            <span class="">Contact</span>
                            <svg :class="{ 'rotate-180' : open }" class="w-5 h-5 transition-all duration-300 ease-out" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" class=""></path></svg>
                        </a>
                        <div 
                            :class="{ 'hidden opacity-0 invisible' : !open, 'block opacity-100 visible' : open }"
                            class="absolute top-0 left-0 w-screen space-y-3 transition-all duration-300 ease-out bg-white border-t border-b border-gray-100 shadow-lg mt-24 z-50" 
                            x-show="open"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            x-cloak>
                            <div class="mx-auto max-w-6xl p-6">
                                <div class="flex flex-col lg:flex-row gap-6 items-stretch">
                                    {{-- Left Side - Contact Information --}}
                                    <div class="w-full lg:w-1/2 bg-white rounded-lg shadow-lg p-6">
                                        <div class="text-center mb-4">
                                            <h2 class="text-xl font-bold text-blue-700 mb-2">Intră în legătură cu noi</h2>
                                            <p class="text-gray-600 text-sm leading-relaxed">
                                                Ai întrebări despre serviciile noastre sau ai nevoie de asistență? Suntem aici să te ajutăm!
                                            </p>
                                        </div>

                                        <div class="space-y-4">
                                            {{-- Phone Contact --}}
                                            <div class="flex items-start space-x-3">
                                                <div class="flex-shrink-0">
                                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h3 class="text-sm font-semibold text-gray-900 mb-1">Sună-ne</h3>
                                                    <p class="text-gray-600 text-sm">
                                                        <a href="tel:0723644822" class="text-blue-600 font-semibold hover:text-blue-800">0723 644 822</a>
                                                    </p>
                                                    <p class="text-gray-500 text-xs mt-1">Luni - Vineri: 9:00 - 17:00</p>
                                                </div>
                                            </div>

                                            {{-- Email Contact --}}
                                            <div class="flex items-start space-x-3">
                                                <div class="flex-shrink-0">
                                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h3 class="text-sm font-semibold text-gray-900 mb-1">Trimite-ne un email</h3>
                                                    <p class="text-gray-600 text-sm">
                                                        <a href="mailto:office@ccbor.ro" class="text-blue-600 font-semibold hover:text-blue-800">office@ccbor.ro</a>
                                                    </p>
                                                    <p class="text-gray-500 text-xs mt-1">Răspuns în maxim 24 de ore</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Right Side - Contact Form --}}
                                    <div class="w-full lg:w-1/2 bg-white rounded-lg shadow-lg p-6">
                                        <div class="text-center mb-4">
                                            <h3 class="text-xl font-bold text-blue-700 mb-2">Trimite-ne un mesaj</h3>
                                            <p class="text-gray-600 text-sm">
                                                Completează formularul de mai jos și îți vom răspunde cât mai curând posibil.
                                            </p>
                                        </div>
                                        
                                        <form id="headerContactForm" @submit.prevent="submitContactForm" class="space-y-3">
                                            @csrf
                                            {{-- First and Last Name --}}
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                <div>
                                                    <label for="header_first_name" class="block text-xs font-medium text-gray-700 mb-1">Prenume <span class="text-red-500">*</span></label>
                                                    <input type="text" 
                                                           id="header_first_name" 
                                                           name="first_name" 
                                                           required
                                                           class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                           placeholder="Prenumele">
                                                </div>
                                                <div>
                                                    <label for="header_last_name" class="block text-xs font-medium text-gray-700 mb-1">Nume <span class="text-red-500">*</span></label>
                                                    <input type="text" 
                                                           id="header_last_name" 
                                                           name="last_name" 
                                                           required
                                                           class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                           placeholder="Numele">
                                                </div>
                                            </div>

                                            {{-- Email --}}
                                            <div>
                                                <label for="header_email" class="block text-xs font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                                <input type="email" 
                                                       id="header_email" 
                                                       name="email" 
                                                       required
                                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                       placeholder="your@email.com">
                                            </div>

                                            {{-- Phone (optional) --}}
                                            <div>
                                                <label for="header_phone" class="block text-xs font-medium text-gray-700 mb-1">Telefon <span class="text-gray-400">(opțional)</span></label>
                                                <input type="tel" 
                                                       id="header_phone" 
                                                       name="phone"
                                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                       placeholder="+40 123 456 789">
                                            </div>

                                            {{-- Subject --}}
                                            <div>
                                                <label for="header_subject" class="block text-xs font-medium text-gray-700 mb-1">Subiect <span class="text-red-500">*</span></label>
                                                <input type="text" 
                                                       id="header_subject" 
                                                       name="subject" 
                                                       required
                                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                       placeholder="Subiectul mesajului">
                                            </div>

                                            {{-- Message --}}
                                            <div>
                                                <label for="header_message" class="block text-xs font-medium text-gray-700 mb-1">Mesaj <span class="text-red-500">*</span></label>
                                                <textarea id="header_message" 
                                                          name="message" 
                                                          rows="3" 
                                                          required
                                                          class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                          placeholder="Mesajul dumneavoastră..."></textarea>
                                            </div>

                                            {{-- Submit Button --}}
                                            <div>
                                                <button type="submit" 
                                                        id="headerSubmitBtn"
                                                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                                                    Trimite mesajul
                                                </button>
                                            </div>
                                        </form>

                                        {{-- Success/Error Messages --}}
                                        <div id="headerFormMessages" class="mt-3 hidden">
                                            <div id="headerSuccessMessage" class="hidden bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded text-sm">
                                                Mesajul a fost trimis cu succes! Vă vom contacta în curând.
                                            </div>
                                            <div id="headerErrorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded text-sm">
                                                A apărut o eroare la trimiterea mesajului. Vă rugăm să încercați din nou.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    @guest
                        <li class="relative z-30 flex flex-col items-center justify-center flex-shrink-0 w-full h-auto pt-3 space-y-3 text-sm md:hidden px-7">
                            <x-button href="{{ route('login') }}" tag="a" class="w-full text-sm" color="secondary">Logare</x-button>
                            <x-button href="{{ route('register') }}" tag="a" class="w-full text-sm">Inregistrare</x-button>
                        </li>
                    @else
                        <li class="flex items-center justify-center w-full pt-3 md:hidden px-7">
                            <x-button href="{{ route('login') }}" tag="a" class="w-full text-sm">Vezi Dashboard</x-button>
                        </li>
                    @endguest

                </ul>
            </nav>
            
            @guest
                <div class="relative z-30 items-center justify-center flex-shrink-0 hidden h-full space-x-3 text-sm md:flex">
                    <x-button href="{{ route('login') }}" tag="a" class="text-sm" color="secondary">Logare</x-button>
                    <x-button href="{{ route('register') }}" tag="a" class="text-sm">Inregistrare</x-button>
                </div>
            @else
                <x-button href="{{ route('login') }}" tag="a" class="text-sm" class="relative z-20 flex-shrink-0 hidden ml-2 md:block">Vezi Dashboard</x-button>
            @endguest

        </div>
    </x-container>

    <!-- Success/Error Toast Notifications -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <script>
                // Contact form submission
        function submitContactForm(event) {
            event.preventDefault();
            
            const form = document.getElementById('headerContactForm');
            const submitBtn = document.getElementById('headerSubmitBtn');
            const formMessages = document.getElementById('headerFormMessages');
            const successMessage = document.getElementById('headerSuccessMessage');
            const errorMessage = document.getElementById('headerErrorMessage');

            // Disable submit button and show loading state
            submitBtn.disabled = true;
            submitBtn.textContent = 'Se trimite...';

            // Hide previous messages
            formMessages.classList.add('hidden');
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');

            const formData = new FormData(form);
            
            fetch('{{ route("contact.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    successMessage.classList.remove('hidden');
                    formMessages.classList.remove('hidden');
                    showToast('Mesajul a fost trimis cu succes! Vă vom contacta în curând.', 'success');
                    
                    // Reset form
                    form.reset();
                    
                    // Close dropdown after a delay
                    setTimeout(() => {
                        const dropdown = form.closest('[x-data]');
                        if (dropdown && dropdown.__x) {
                            dropdown.__x.$data.open = false;
                        }
                    }, 2000);
                } else {
                    // Show error message
                    errorMessage.textContent = data.message || 'A apărut o eroare la trimiterea mesajului.';
                    errorMessage.classList.remove('hidden');
                    formMessages.classList.remove('hidden');
                    showToast('A apărut o eroare la trimiterea mesajului. Vă rugăm să încercați din nou.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorMessage.textContent = 'A apărut o eroare de conexiune. Vă rugăm să încercați din nou.';
                errorMessage.classList.remove('hidden');
                formMessages.classList.remove('hidden');
                showToast('A apărut o eroare de conexiune. Vă rugăm să încercați din nou.', 'error');
            })
            .finally(() => {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'Trimite mesajul';
            });
        }
        
        // Toast notification function
        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            const icon = type === 'success' ? 
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' :
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
            
            toast.className = `${bgColor} text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3 transform transition-all duration-300 translate-x-full opacity-0`;
            toast.innerHTML = `
                ${icon}
                <span>${message}</span>
                <button onclick="this.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            
            toastContainer.appendChild(toast);
            
            // Trigger animation
            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
            }, 100);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }
        
        // Attach form submission handler
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('headerContactForm');
            if (form) {
                form.addEventListener('submit', submitContactForm);
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close any open dropdowns
                const dropdowns = document.querySelectorAll('[x-data]');
                dropdowns.forEach(dropdown => {
                    if (dropdown.__x && dropdown.__x.$data.open) {
                        dropdown.__x.$data.open = false;
                    }
                });
            }
        });
    </script>

</header>
