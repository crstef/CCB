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

            {{-- Legitimația - EXACT ca în imaginea de referință --}}
            <div id="member-card" class="max-w-sm mx-auto bg-white border-2 border-gray-800 rounded-lg p-6" style="width: 340px; height: 220px;">
                {{-- Header cu steagul României și textul ROMÂNIA --}}
                <div class="flex items-start justify-between mb-3">
                    {{-- Stânga: Steagul României în colț cu ROMÂNIA dedesubt --}}
                    <div class="relative">
                        <div class="w-16 h-12 bg-gradient-to-b from-blue-600 via-yellow-400 to-red-600 rounded transform -rotate-12 border border-gray-600"></div>
                        <div class="absolute -bottom-1 left-3 text-xs font-bold">
                            <div class="bg-blue-600 text-white px-1 rounded text-center">UNCO.R</div>
                            <div class="text-center text-xs font-bold mt-1">1997</div>
                        </div>
                    </div>
                    
                    {{-- Centru: ROMÂNIA --}}
                    <div class="text-center flex-1">
                        <h2 class="text-lg font-bold text-gray-900">ROMÂNIA</h2>
                        <p class="text-xs text-gray-700">CLUBUL DE CIOBĂNEȘTI BELGIENI</p>
                        <p class="text-xs text-gray-700">DIN ROMÂNIA</p>
                    </div>

                    {{-- Dreapta: Logo CCB --}}
                    <div class="w-16 h-16 flex-shrink-0">
                        <img src="/storage/gallery/photos/ccb-evenimente-speciale.png" alt="Logo CCB" class="w-full h-full object-contain rounded-full border border-gray-400">
                    </div>
                </div>

                {{-- Titlul LEGITIMAȚIE --}}
                <div class="text-center mb-4">
                    <h1 class="text-xl font-bold text-gray-900 tracking-wider">LEGITIMAȚIE</h1>
                </div>

                {{-- Corpul legitimației cu poza și datele --}}
                <div class="flex space-x-4 mb-4">
                    {{-- Poza utilizatorului --}}
                    <div class="w-20 h-24 bg-gray-200 border border-gray-600 flex items-center justify-center flex-shrink-0">
                        <template x-if="userPhoto">
                            <img :src="userPhoto" alt="Poza membru" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!userPhoto">
                            <div class="text-center">
                                <svg class="w-8 h-8 mx-auto text-gray-400 mb-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <label for="photo-upload" class="cursor-pointer text-xs text-blue-600 hover:underline">
                                    Adaugă poză
                                </label>
                                <input type="file" id="photo-upload" accept="image/*" class="hidden" @change="handlePhotoUpload($event)">
                            </div>
                        </template>
                    </div>

                    {{-- Datele membrului --}}
                    <div class="flex-1 text-xs space-y-1">
                        <div class="flex">
                            <span class="font-semibold w-20">Prenumele:</span>
                            <div class="flex-1 border-b border-dotted border-gray-600 pb-1">
                                {{ auth()->user()->name ?? '' }}
                            </div>
                        </div>
                        <div class="flex">
                            <span class="font-semibold w-20">NUMELE:</span>
                            <div class="flex-1 border-b border-dotted border-gray-600 pb-1">
                                {{ strtoupper(auth()->user()->last_name ?? '') }}
                            </div>
                        </div>
                        <div class="flex">
                            <span class="font-semibold w-20">Funcția:</span>
                            <div class="flex-1 border-b border-dotted border-gray-600 pb-1">
                                Membru CCB
                            </div>
                        </div>
                        <div class="flex">
                            <span class="font-semibold text-xs">Perioada de valabilitate:</span>
                            <div class="ml-2 font-bold">
                                {{ date('Y') }} - {{ date('Y') + 1 }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer cu semnătura --}}
                <div class="text-right text-xs">
                    <div class="space-y-0">
                        <div>Prenume NUME,</div>
                        <div>Președintele Filialei Județene</div>
                        <div>a Clubului de Ciobănești Belgieni din România</div>
                    </div>
                </div>

                {{-- Data emisă --}}
                <div class="absolute bottom-2 left-6 text-xs text-gray-600">
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
                        margin: [10, 10, 10, 10],
                        filename: 'legitimatie_membru_ccb.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { 
                            scale: 3, 
                            useCORS: true,
                            backgroundColor: '#ffffff',
                            width: 340,
                            height: 220
                        },
                        jsPDF: { 
                            unit: 'mm', 
                            format: [85, 54], // Format standard ID card
                            orientation: 'landscape'
                        }
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
                    
                    printWindow.document.write(`
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>Legitimație Membru CCB</title>
                            <meta charset="UTF-8">
                            <style>
                                @page {
                                    size: 85.6mm 54mm;
                                    margin: 0;
                                }
                                
                                body { 
                                    font-family: Arial, sans-serif; 
                                    margin: 0; 
                                    padding: 10mm;
                                    background: white;
                                }
                                
                                /* Layout și pozitionare */
                                .max-w-sm { max-width: 340px; width: 340px; }
                                .mx-auto { margin: 0 auto; }
                                .bg-white { background-color: white; }
                                .border-2 { border: 2px solid; }
                                .border-gray-800 { border-color: #1f2937; }
                                .rounded-lg { border-radius: 8px; }
                                .p-6 { padding: 24px; }
                                
                                /* Flexbox */
                                .flex { display: flex; }
                                .items-start { align-items: flex-start; }
                                .items-center { align-items: center; }
                                .justify-between { justify-content: space-between; }
                                .space-x-4 > * + * { margin-left: 16px; }
                                .space-y-1 > * + * { margin-top: 4px; }
                                .flex-1 { flex: 1; }
                                .flex-shrink-0 { flex-shrink: 0; }
                                
                                /* Spacing */
                                .mb-3 { margin-bottom: 12px; }
                                .mb-4 { margin-bottom: 16px; }
                                .mt-1 { margin-top: 4px; }
                                .ml-2 { margin-left: 8px; }
                                .pb-1 { padding-bottom: 4px; }
                                
                                /* Typography */
                                .text-xs { font-size: 12px; line-height: 16px; }
                                .text-lg { font-size: 18px; line-height: 28px; }
                                .text-xl { font-size: 20px; line-height: 28px; }
                                .font-bold { font-weight: 700; }
                                .font-semibold { font-weight: 600; }
                                .text-center { text-align: center; }
                                .text-right { text-align: right; }
                                .tracking-wider { letter-spacing: 0.05em; }
                                
                                /* Colors */
                                .text-gray-900 { color: #111827; }
                                .text-gray-700 { color: #374151; }
                                .text-gray-600 { color: #4b5563; }
                                .text-gray-400 { color: #9ca3af; }
                                .bg-gray-200 { background-color: #e5e7eb; }
                                .border-gray-600 { border-color: #4b5563; }
                                .border-gray-400 { border-color: #9ca3af; }
                                
                                /* Gradients */
                                .bg-gradient-to-b { 
                                    background: linear-gradient(to bottom, #2563eb, #facc15, #dc2626); 
                                }
                                .bg-blue-600 { background-color: #2563eb; }
                                .text-white { color: white; }
                                
                                /* Borders */
                                .border { border-width: 1px; }
                                .border-b { border-bottom-width: 1px; }
                                .border-dotted { border-style: dotted; }
                                .rounded { border-radius: 4px; }
                                .rounded-full { border-radius: 50%; }
                                
                                /* Sizing */
                                .w-16 { width: 64px; }
                                .h-12 { height: 48px; }
                                .h-16 { height: 64px; }
                                .w-20 { width: 80px; }
                                .h-24 { height: 96px; }
                                
                                /* Positioning */
                                .relative { position: relative; }
                                .absolute { position: absolute; }
                                .transform { transform: rotate(-12deg); }
                                .-bottom-1 { bottom: -4px; }
                                .left-3 { left: 12px; }
                                .bottom-2 { bottom: 8px; }
                                .left-6 { left: 24px; }
                                
                                /* Object fit */
                                .object-contain { object-fit: contain; }
                                .object-cover { object-fit: cover; }
                                
                                /* Display */
                                .space-y-0 > * + * { margin-top: 0; }
                                
                                /* Custom pentru steag */
                                .romania-flag {
                                    width: 64px;
                                    height: 48px;
                                    background: linear-gradient(to bottom, 
                                        #2563eb 0%, #2563eb 33.33%, 
                                        #facc15 33.33%, #facc15 66.66%, 
                                        #dc2626 66.66%, #dc2626 100%);
                                    transform: rotate(-12deg);
                                    border: 1px solid #4b5563;
                                    border-radius: 4px;
                                }
                                
                                /* Print specific */
                                @media print {
                                    body { 
                                        padding: 5mm;
                                        transform: scale(0.9);
                                        transform-origin: top left;
                                    }
                                    .no-print { display: none; }
                                }
                            </style>
                        </head>
                        <body>
                            <div style="text-align: center; margin-bottom: 10px;">
                                <h1 style="margin: 0; font-size: 16px; font-weight: bold;">LEGITIMAȚIE DE MEMBRU CCB</h1>
                                <p style="margin: 5px 0 0 0; font-size: 12px; color: #666;">Clubul de Ciobănești Belgieni din România</p>
                            </div>
                            ${cardHtml}
                        </body>
                        </html>
                    `);
                    
                    printWindow.document.close();
                    setTimeout(() => {
                        printWindow.print();
                        printWindow.close();
                    }, 1000);
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
