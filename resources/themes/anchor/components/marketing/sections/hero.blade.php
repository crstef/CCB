<section class="relative top-0 flex flex-col items-center justify-center w-full min-h-screen -mt-24 bg-white lg:min-h-screen">
    
    <div class="flex flex-col items-center justify-between flex-1 w-full max-w-2xl gap-6 px-8 pt-32 mx-auto text-left md:px-12 xl:px-20 lg:pt-32 lg:pb-16 lg:max-w-7xl lg:flex-row">
        
        {{-- Left Column: Media Carousel from organized media components --}}
        <div class="w-full lg:w-1/2">
            <div class="w-full mb-8 lg:mb-0 max-w-md mx-auto lg:mx-0">
                {{-- Include the organized media carousel component --}}
                @livewire('media.media-carousel')
            </div>
        </div>
            <div class="flex items-center justify-center w-full mt-8 lg:mt-12">
                <img alt="CCB Character" class="relative w-full lg:scale-125 xl:translate-x-6" src="/wave/img/Logo_black.png" style="max-width:450px;">
            </div>
        </div>
    </div>
    
    {{-- Original Wave 3.0 Bottom Section --}}
    <div class="flex-shrink-0 lg:h-[150px] flex border-t border-zinc-200 items-center w-full bg-white">
        <div class="grid h-auto grid-cols-1 px-8 py-10 mx-auto space-y-5 divide-y max-w-7xl lg:space-y-0 lg:divide-y-0 divide-zinc-200 lg:py-0 lg:divide-x md:px-12 lg:px-20 lg:divide-zinc-200 lg:grid-cols-3">
            <div class="">
                <h3 class="flex items-center font-medium text-zinc-900">
                    Cum devii membru
                </h3>
                <p class="mt-2 text-sm font-medium text-zinc-500">
                    Modalitatea și beneficiile de a deveni membru. <span class="hidden lg:inline">Mai multe explicații</span>
                </p>
            </div>
            <div class="pt-5 lg:pt-0 lg:px-10">
                <h3 class="font-medium text-zinc-900">Misiunea Clubului</h3>
                <p class="mt-2 text-sm text-zinc-500">
                    Ce ne propunem să realizăm. <span class="hidden lg:inline">Explică aici.</span>
                </p>
            </div>
            <div class="pt-5 lg:pt-0 lg:px-10">
                <h3 class="font-medium text-zinc-900">Calendar Competițional</h3>
                <p class="mt-2 text-sm text-zinc-500">
                    Calendarul competițional pe anul în curs.
                </p>
            </div>
        </div>
    </div>
</section>