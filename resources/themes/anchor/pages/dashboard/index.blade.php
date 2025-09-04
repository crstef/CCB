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

            {{-- Legitimația - Design modern și organizat --}}
            <div id="member-card" class="max-w-lg mx-auto bg-white shadow-xl rounded-xl overflow-hidden" style="width: 400px; height: 250px;">
                {{-- Header cu bordură tricolor --}}
                <div class="h-3 bg-gradient-to-r from-blue-600 via-yellow-400 to-red-600"></div>
                
                <div class="p-6 h-full">
                    {{-- Header cu logo și text --}}
                    <div class="flex items-center justify-between mb-4">
                        {{-- Stânga: ROMÂNIA + descriere --}}
                        <div class="flex-1">
                            <h1 class="text-xl font-bold text-gray-900 mb-1">ROMÂNIA</h1>
                            <p class="text-xs text-gray-600 leading-tight">CLUBUL DE CIOBĂNEȘTI BELGIENI<br>DIN ROMÂNIA</p>
                        </div>
                        
                        {{-- Dreapta: Logo CCB --}}
                        <div class="w-16 h-16 ml-4">
                            <img src="/storage/wave-logo.png" alt="Logo CCB" class="w-full h-full object-contain">
                        </div>
                    </div>

                    {{-- Titlul LEGITIMAȚIE --}}
                    <div class="text-center mb-4">
                        <h2 class="text-2xl font-bold text-gray-900 tracking-widest">LEGITIMAȚIE</h2>
                    </div>

                    {{-- Corpul legitimației --}}
                    <div class="flex gap-4">
                        {{-- Poza utilizatorului --}}
                        <div class="w-20 h-24 bg-gray-100 border-2 border-gray-300 rounded flex items-center justify-center overflow-hidden">
                            <template x-if="userPhoto">
                                <img :src="userPhoto" alt="Poza membru" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!userPhoto">
                                <div class="text-center p-2">
                                    <svg class="w-8 h-8 mx-auto text-gray-400 mb-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <label for="photo-upload" class="cursor-pointer text-xs text-blue-600 hover:text-blue-800 underline">
                                        Adaugă
                                    </label>
                                    <input type="file" id="photo-upload" accept="image/*" class="hidden" @change="handlePhotoUpload($event)">
                                </div>
                            </template>
                        </div>

                        {{-- Datele membrului --}}
                        <div class="flex-1 space-y-2">
                            {{-- Prenumele --}}
                            <div class="flex items-center">
                                <span class="text-sm font-semibold text-gray-700 w-24">Prenumele:</span>
                                <div class="flex-1 border-b border-dotted border-gray-400 pb-1 ml-2">
                                    <span class="text-sm text-gray-900">{{ auth()->user()->name ?? 'Cristian Ștefan' }}</span>
                                </div>
                            </div>
                            
                            {{-- Numele --}}
                            <div class="flex items-center">
                                <span class="text-sm font-semibold text-gray-700 w-24">NUMELE:</span>
                                <div class="flex-1 border-b border-dotted border-gray-400 pb-1 ml-2">
                                    <span class="text-sm text-gray-900 uppercase">{{ auth()->user()->last_name ?? 'ȘTEFAN' }}</span>
                                </div>
                            </div>
                            
                            {{-- Funcția --}}
                            <div class="flex items-center">
                                <span class="text-sm font-semibold text-gray-700 w-24">Funcția:</span>
                                <div class="flex-1 border-b border-dotted border-gray-400 pb-1 ml-2">
                                    <span class="text-sm text-gray-900">Membru CCB</span>
                                </div>
                            </div>
                            
                            {{-- Perioada --}}
                            <div class="flex items-center mt-3">
                                <span class="text-sm font-semibold text-gray-700">Perioada de valabilitate:</span>
                                <span class="ml-2 text-sm font-bold text-gray-900">{{ date('Y') }} - {{ date('Y') + 1 }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="flex justify-between items-end mt-4">
                        {{-- Data emisă --}}
                        <div class="text-xs text-gray-500">
                            Emisă la: {{ date('d.m.Y') }}
                        </div>
                        
                        {{-- Semnătura --}}
                        <div class="text-right text-xs text-gray-600 leading-tight">
                            <div>Prenume NUME,</div>
                            <div>Președintele Filialei Județene</div>
                            <div>a Clubului de Ciobănești Belgieni din România</div>
                        </div>
                    </div>
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
                        margin: [5, 5, 5, 5],
                        filename: 'legitimatie_membru_ccb.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { 
                            scale: 2.5, 
                            useCORS: true,
                            backgroundColor: '#ffffff',
                            width: 400,
                            height: 250
                        },
                        jsPDF: { 
                            unit: 'mm', 
                            format: [85, 54], // Format ID card standard
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
                                    size: 85mm 54mm;
                                    margin: 0;
                                }
                                
                                body { 
                                    font-family: Arial, sans-serif; 
                                    margin: 0; 
                                    padding: 2mm;
                                    background: white;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    min-height: 54mm;
                                }
                                
                                /* Container principal */
                                .max-w-lg { 
                                    width: 81mm !important; 
                                    height: 50mm !important; 
                                    max-width: none !important;
                                }
                                .mx-auto { margin: 0 auto; }
                                .bg-white { background-color: white; }
                                .shadow-xl { box-shadow: 0 0 5px rgba(0,0,0,0.1); }
                                .rounded-xl { border-radius: 3mm; }
                                .overflow-hidden { overflow: hidden; }
                                
                                /* Header tricolor */
                                .h-3 { height: 2mm; }
                                .bg-gradient-to-r { 
                                    background: linear-gradient(to right, #2563eb 33.33%, #facc15 33.33%, #facc15 66.66%, #dc2626 66.66%);
                                }
                                
                                /* Padding */
                                .p-6 { padding: 3mm; }
                                .h-full { height: calc(50mm - 2mm); }
                                
                                /* Layout flex */
                                .flex { display: flex; }
                                .items-center { align-items: center; }
                                .items-end { align-items: flex-end; }
                                .justify-between { justify-content: space-between; }
                                .gap-4 { gap: 2mm; }
                                .flex-1 { flex: 1; }
                                .ml-4 { margin-left: 2mm; }
                                .ml-2 { margin-left: 1mm; }
                                .mt-3 { margin-top: 1.5mm; }
                                .mt-4 { margin-top: 2mm; }
                                .mb-1 { margin-bottom: 0.5mm; }
                                .mb-4 { margin-bottom: 2mm; }
                                .space-y-2 > * + * { margin-top: 1mm; }
                                
                                /* Typography */
                                .text-xl { font-size: 4mm; line-height: 5mm; }
                                .text-2xl { font-size: 5mm; line-height: 6mm; }
                                .text-sm { font-size: 2.5mm; line-height: 3mm; }
                                .text-xs { font-size: 2mm; line-height: 2.5mm; }
                                .font-bold { font-weight: 700; }
                                .font-semibold { font-weight: 600; }
                                .text-center { text-align: center; }
                                .text-right { text-align: right; }
                                .leading-tight { line-height: 1.1; }
                                .tracking-widest { letter-spacing: 0.3mm; }
                                .uppercase { text-transform: uppercase; }
                                
                                /* Colors */
                                .text-gray-900 { color: #111827; }
                                .text-gray-700 { color: #374151; }
                                .text-gray-600 { color: #4b5563; }
                                .text-gray-500 { color: #6b7280; }
                                .text-gray-400 { color: #9ca3af; }
                                .text-blue-600 { color: #2563eb; }
                                .text-blue-800 { color: #1e40af; }
                                .bg-gray-100 { background-color: #f3f4f6; }
                                .border-gray-300 { border-color: #d1d5db; }
                                .border-gray-400 { border-color: #9ca3af; }
                                
                                /* Borders */
                                .border-2 { border-width: 0.2mm; }
                                .border-b { border-bottom-width: 0.1mm; }
                                .border-dotted { border-style: dotted; }
                                .rounded { border-radius: 1mm; }
                                .pb-1 { padding-bottom: 0.5mm; }
                                
                                /* Sizing */
                                .w-16 { width: 8mm; }
                                .h-16 { height: 8mm; }
                                .w-20 { width: 10mm; }
                                .h-24 { height: 12mm; }
                                .w-24 { width: 12mm; }
                                
                                /* Object fit */
                                .object-contain { object-fit: contain; }
                                .object-cover { object-fit: cover; }
                                
                                /* Hide upload for print */
                                .hidden { display: none !important; }
                                input, label { display: none !important; }
                                
                                /* Print adjustments */
                                @media print {
                                    body { 
                                        transform: scale(0.95);
                                        transform-origin: center;
                                    }
                                    * { -webkit-print-color-adjust: exact !important; color-adjust: exact !important; }
                                }
                            </style>
                        </head>
                        <body>
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
