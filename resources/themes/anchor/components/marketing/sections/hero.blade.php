<section class="relative top-0 flex flex-col items-center justify-center w-full min-h-screen -mt-24 bg-white lg:min-h-screen">
    
        <div class="flex flex-col items-center justify-between flex-1 w-full max-w-2xl gap-6 px-8 pt-32 mx-auto text-left md:px-12 xl:px-20 lg:pt-32 lg:pb-16 lg:max-w-7xl lg:flex-row">
            <div class="w-full lg:w-1/2">
                <h1 class="text-6xl font-bold tracking-tighter text-left sm:text-7xl md:text-8xl sm:text-center lg:text-left text-zinc-900 text-balance">
                    <span class="block origin-left lg:scale-90 text-nowrap">Video</span> <span class="pr-4 text-transparent text-neutral-600 bg-clip-text bg-gradient-to-b from-neutral-900 to-neutral-500">poze</span>
                </h1>
                <p class="mx-auto mt-5 text-2xl font-normal text-left sm:max-w-md lg:ml-0 lg:max-w-md sm:text-center lg:text-left text-zinc-500">
                    Descoperă momentele speciale din galeria noastră foto și video
                </p>
                <div class="flex flex-col items-center justify-center gap-3 mx-auto mt-8 md:gap-2 lg:justify-start md:ml-0 md:flex-row">
                    <a href="/galerie-foto" class="inline-flex items-center justify-center w-full lg:w-auto px-6 py-3 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Galerie foto
                    </a>
                    <a href="/galerie-video" class="inline-flex items-center justify-center w-full lg:w-auto px-6 py-3 text-base font-medium text-blue-600 bg-white border border-blue-600 rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Galerie video
                    </a>
                </div>
            </div>
            <div class="flex items-center justify-center w-full mt-12 lg:w-1/2 lg:mt-0">
                <!-- Media Carousel -->
                <div class="w-full max-w-lg">
                    @livewire('media-carousel')
                </div>
            </div>
        </div>
        <div class="flex-shrink-0 lg:h-[150px] flex border-t border-zinc-200 items-center w-full bg-white">
            <div class="grid h-auto grid-cols-1 px-8 py-10 mx-auto space-y-5 divide-y max-w-7xl lg:space-y-0 lg:divide-y-0 divide-zinc-200 lg:py-0 lg:divide-x md:px-12 lg:px-20 lg:divide-zinc-200 lg:grid-cols-3">
                <div class="">
                    <h3 class="flex items-center font-medium text-zinc-900">
                        Cum devii mebru
                    </h3>
                    <p class="mt-2 text-sm font-medium text-zinc-500">
                        Modalitatea si beneficiile de a deveni membru. <span class="hidden lg:inline">Mai multe explicatii</span>
                    </p>
                </div>
                <div class="pt-5 lg:pt-0 lg:px-10">
                    <h3 class="font-medium text-zinc-900">Misiunea Clubului</h3>
                    <p class="mt-2 text-sm text-zinc-500">
                        Ce ne propunem să realizăm. <span class="hidden lg:inline">Explică aici.</span>
                    </p>
                </div>
                <div class="pt-5 lg:pt-0 lg:px-10">
                    <h3 class="font-medium text-zinc-900">Calendar Competitional</h3>
                    <p class="mt-2 text-sm text-zinc-500">
                        Calendarul competitional pe anul in curs.
                    </p>
                </div>
            </div>
        </div>
</section>