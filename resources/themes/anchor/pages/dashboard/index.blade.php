<?php
    use function Laravel\Folio\{middleware, name};
	middleware('auth');
    name('dashboard');
?>

<x-layouts.app>
	<x-app.container x-data class="lg:space-y-6" x-cloak>

		<x-app.alert id="dashboard_alert" class="hidden lg:flex">Acesta este panoul de utilizator unde utilizatorii pot gestiona setările și accesa funcționalitățile. <a href="https://devdojo.com/wave/docs" target="_blank" class="mx-1 underline">Vezi documentația</a> pentru a afla mai multe.</x-app.alert>

        <x-app.heading
                title="Pagina de Control"
                description="Bine ai venit pe panoul de control al aplicației. Găsește mai multe resurse mai jos."
                :border="false"
            />

        {{-- Legitimație de membru CCB --}}
        <div class="mt-6 bg-white rounded-lg shadow-lg p-6" x-data="memberCard()">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Legitimația de Membru CCB</h3>
                <div class="flex space-x-2">
                    <button @click="downloadPDF()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        PDF
                    </button>
                    <button @click="printCard()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print
                    </button>
                </div>
            </div>

            {{-- Legitimația - Ajustări fine conform imaginii de referință --}}
            <div id="member-card" class="max-w-lg mx-auto bg-white border-2 border-gray-800" style="width: 450px; height: 280px; position: relative; font-family: 'Times New Roman', Times, serif;">
                
                {{-- Steagul României SVG în colțul stâng sus --}}
                <div class="absolute" style="top: 12px; left: 12px;">
                    <svg width="48" height="32" viewBox="0 0 48 32" style="transform: rotate(-15deg); border: 1px solid #4b5563; box-shadow: 2px 2px 5px rgba(0,0,0,0.2);">
                        <rect x="0" y="0" width="16" height="32" fill="#0066cc"/>
                        <rect x="16" y="0" width="16" height="32" fill="#ffcc00"/>
                        <rect x="32" y="0" width="16" height="32" fill="#cc0000"/>
                    </svg>
                </div>

                {{-- Header centrat --}}
                <div class="text-center" style="position: absolute; top: 16px; left: 0; right: 0;">
                    <h1 class="text-xl font-bold">ROMÂNIA</h1>
                    <p class="text-xs mt-1">CLUBUL DE CIOBĂNEȘTI BELGIENI</p>
                    <p class="text-xs">DIN ROMÂNIA</p>
                </div>

                {{-- Logo CCB în colțul drept sus --}}
                <div class="absolute" style="top: 12px; right: 12px; width: 64px; height: 64px;">
                    <img src="{{ asset('storage/wave-logo.png') }}" alt="Logo CCB" class="w-full h-full object-contain">
                </div>

                {{-- Titlu LEGITIMAȚIE --}}
                <div class="text-center" style="position: absolute; top: 80px; left: 0; right: 0;">
                    <h2 class="text-xl font-bold tracking-wider">LEGITIMAȚIE</h2>
                </div>

                {{-- Poza --}}
                <div class="absolute" style="top: 120px; left: 24px;">
                    <div class="w-24 bg-gray-200 border border-black flex items-center justify-center overflow-hidden" style="height: 100px;">
                        <template x-if="userPhoto">
                            <img :src="userPhoto" alt="Poza membru" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!userPhoto">
                            <div class="text-center p-2">
                                <svg class="w-6 h-6 mx-auto text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <label for="photo-upload" class="cursor-pointer text-xs text-blue-600 underline mt-1 inline-block">Adaugă</label>
                                <input type="file" id="photo-upload" accept="image/*" class="hidden" @change="handlePhotoUpload($event)">
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Datele și Semnătura --}}
                <div class="absolute flex flex-col text-sm" style="top: 120px; left: 140px; right: 24px; bottom: 40px;">
                    {{-- Date --}}
                    <div class="flex-grow">
                        <div class="flex items-baseline">
                            <span class="font-semibold" style="width: 70px;">Prenumele</span>
                            <span class="ml-2 border-b border-dotted border-black flex-grow pb-1">{{ auth()->user()->name ?? 'Cristian' }}</span>
                        </div>
                        <div class="flex items-baseline mt-2">
                            <span class="font-semibold" style="width: 70px;">NUMELE</span>
                            <span class="ml-2 border-b border-dotted border-black flex-grow pb-1">{{ strtoupper(auth()->user()->last_name ?? 'ȘTEFAN') }}</span>
                        </div>
                        <div class="flex items-baseline mt-2">
                            <span class="font-semibold" style="width: 70px;">Funcția</span>
                            <span class="ml-2 border-b border-dotted border-black flex-grow pb-1">Membru CCB</span>
                        </div>
                        <div class="mt-3">
                            <span class="font-semibold text-sm">Perioada de valabilitate</span>
                            <span class="ml-4 font-bold">{{ date('Y') }} - {{ date('Y') + 1 }}</span>
                        </div>
                    </div>
                    {{-- Semnătura --}}
                    <div class="text-xs text-right">
                        <div class="font-semibold">Președinte CCB</div>
                        <div class="mt-1">Gabriel Panoiu</div>
                    </div>
                </div>

                {{-- Data emisă --}}
                <div class="absolute text-xs" style="bottom: 12px; left: 24px;">
                    Emisă la: {{ date('d.m.Y') }}
                </div>
            </div>
        </div>

        <!-- <div class="flex flex-col w-full mt-6 space-y-5 md:flex-row lg:mt-0 md:space-y-0 md:space-x-5">
            <x-app.dashboard-card
				href="https://devdojo.com/wave/docs"
				target="_blank"
				title="Documentation"
				description="Learn how to customize your app and make it shine!"
				link_text="View The Docs"
				image="/wave/img/docs.png"
			/>
			<x-app.dashboard-card
				href="https://devdojo.com/questions"
				target="_blank"
				title="Ask The Community"
				description="Share your progress and get help from other builders."
				link_text="Ask a Question"
				image="/wave/img/community.png"
			/>
        </div>

		<div class="flex flex-col w-full mt-5 space-y-5 md:flex-row md:space-y-0 md:mb-0 md:space-x-5">
			<x-app.dashboard-card
				href="https://github.com/thedevdojo/wave"
				target="_blank"
				title="Github Repo"
				description="View the source code and submit a Pull Request"
				link_text="View on Github"
				image="/wave/img/laptop.png"
			/>
			<x-app.dashboard-card
				href="https://devdojo.com"
				target="_blank"
				title="Resources"
				description="View resources that will help you build your SaaS"
				link_text="View Resources"
				image="/wave/img/globe.png"
			/>
		</div>
 -->
		<div class="mt-5 space-y-5">
			@subscriber
				<p>Esti un utilizator abonat cu rolul <strong>{{ auth()->user()->roles()->first()->name }}</strong>. Află <a href="https://devdojo.com/wave/docs/features/roles-permissions" target="_blank" class="underline">mai multe despre roluri</a> aici.</p>
				<x-app.message-for-subscriber />
			@else
				<p>Acest utilizator conectat are rolul <strong>{{ auth()->user()->roles()->first()->name }}</strong>. Pentru a face upgrade, <a href="{{ route('settings.subscription') }}" class="underline">abonează-te la un plan</a>. Află <a href="https://devdojo.com/wave/docs/features/roles-permissions" target="_blank" class="underline">mai multe despre roluri</a> aici.</p>
			@endsubscriber
			
			@admin
				<x-app.message-for-admin />
			@endadmin
		</div>
    </x-app.container>

    {{-- Scripts pentru legitimația de membru --}}
    <script>
        function memberCard() {
            return {
                userPhoto: null,
                
                handlePhotoUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.userPhoto = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },
                
                async downloadPDF() {
                    // Încarcă html2pdf din CDN dacă nu e disponibil
                    if (typeof html2pdf === 'undefined') {
                        await this.loadScript('https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js');
                    }
                    
                    const element = document.getElementById('member-card');
                    const opt = {
                        margin: [0, 0, 0, 0],
                        filename: 'legitimatie_membru_ccb.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { 
                            scale: 2.2, 
                            useCORS: true,
                            backgroundColor: '#ffffff',
                            width: 450,
                            height: 280
                        },
                        jsPDF: { 
                            unit: 'mm', 
                            format: [85, 54], // Format ID card standard
                            orientation: 'landscape'
                        },
                        pagebreak: { mode: ['avoid-all'] }
                    };
                    
                    try {
                        await html2pdf().set(opt).from(element).save();
                    } catch (error) {
                        console.error('Eroare la generarea PDF:', error);
                        alert('Nu s-a putut genera PDF-ul. Vă rugăm să încercați din nou.');
                    }
                },
                
                printCard() {
                    const printWindow = window.open('', '', 'width=800,height=600');
                    const cardElement = document.getElementById('member-card');
                    const cardHtml = cardElement.outerHTML;

                    // Collect current stylesheets and inline styles
                    const styleTags = Array.from(document.querySelectorAll('style'))
                        .map(tag => tag.outerHTML)
                        .join('\n');
                    const linkTags = Array.from(document.querySelectorAll('link[rel="stylesheet"]'))
                        .map(link => link.outerHTML)
                        .join('\n');

                    printWindow.document.write(`
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>Legitimație Membru CCB</title>
                            <meta charset="UTF-8">
                            ${linkTags}
                            ${styleTags}
                            <style>
                                @page { size: 85mm 54mm; margin: 0; }
                                html, body { height: 100%; }
                                body { 
                                    margin: 0; 
                                    padding: 0; 
                                    background: #ffffff; 
                                    display: flex; 
                                    justify-content: center; 
                                    align-items: center; 
                                }
                                /* Ensure print colors are preserved */
                                * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
                                /* Fallback minimal utilities if Tailwind is unavailable */
                                .absolute { position: absolute; }
                                .text-center { text-align: center; }
                                .text-right { text-align: right; }
                                .font-bold { font-weight: 700; }
                                .font-semibold { font-weight: 600; }
                                .border-2 { border-width: 2px; border-style: solid; }
                                .border-gray-800 { border-color: #1f2937; }
                                .w-16 { width: 64px; }
                                .h-16 { height: 64px; }
                                .object-contain { object-fit: contain; }
                                .object-cover { object-fit: cover; }
                            </style>
                        </head>
                        <body>
                            ${cardHtml}
                            <script>
                                // Hide upload controls in print
                                document.querySelectorAll('input[type=file], label[for=photo-upload]').forEach(el => el && (el.style.display = 'none'));
                            <\/script>
                        </body>
                        </html>
                    `);

                    printWindow.document.close();
                    setTimeout(() => {
                        printWindow.focus();
                        printWindow.print();
                        printWindow.close();
                    }, 500);
                },
                
                loadScript(src) {
                    return new Promise((resolve, reject) => {
                        const script = document.createElement('script');
                        script.src = src;
                        script.onload = resolve;
                        script.onerror = reject;
                        document.head.appendChild(script);
                    });
                }
            };
        }
    </script>
</x-layouts.app>
