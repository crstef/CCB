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

            {{-- Legitimația --}}
            <div id="member-card" class="max-w-md mx-auto bg-gradient-to-r from-blue-600 via-yellow-500 to-red-600 p-1 rounded-lg">
                <div class="bg-white rounded-lg p-6">
                    {{-- Header cu steagul României și logo CCB --}}
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-6 bg-gradient-to-r from-blue-600 via-yellow-500 to-red-600 rounded"></div>
                            <span class="text-xs font-bold">ROMÂNIA</span>
                        </div>
                        <div class="text-right">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                CCB
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-4">
                        <h2 class="text-sm font-bold text-gray-800">CLUBUL DE CIOBĂNEȘTI BELGIENI</h2>
                        <h1 class="text-lg font-bold text-gray-900 mt-1">LEGITIMAȚIE</h1>
                    </div>

                    <div class="flex space-x-4">
                        {{-- Poza utilizatorului --}}
                        <div class="w-20 h-24 bg-gray-200 border-2 border-gray-400 flex items-center justify-center">
                            <template x-if="userPhoto">
                                <img :src="userPhoto" alt="Poza membru" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!userPhoto">
                                <div class="text-center">
                                    <svg class="w-8 h-8 mx-auto text-gray-400" fill="currentColor" viewBox="0 0 24 24">
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
                            <div>
                                <span class="font-semibold">Prenumele:</span>
                                <div class="border-b border-dotted border-gray-400 pb-1">
                                    {{ auth()->user()->name ?? '________________________' }}
                                </div>
                            </div>
                            <div>
                                <span class="font-semibold">NUMELE:</span>
                                <div class="border-b border-dotted border-gray-400 pb-1">
                                    {{ strtoupper(auth()->user()->last_name ?? '________________________') }}
                                </div>
                            </div>
                            <div>
                                <span class="font-semibold">Calitatea:</span>
                                <div class="border-b border-dotted border-gray-400 pb-1">
                                    Membru CCB
                                </div>
                            </div>
                            <div>
                                <span class="font-semibold">Perioada de valabilitate:</span>
                                <div class="border-b border-dotted border-gray-400 pb-1">
                                    {{ date('Y') }} - {{ date('Y') + 1 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="mt-4 text-right">
                        <div class="text-xs">
                            <div>Prenume NUME,</div>
                            <div>Președintele Filialei Județene</div>
                            <div>a Clubului de Ciobănești Belgieni din România</div>
                        </div>
                    </div>

                    <div class="mt-2 text-xs text-gray-500 text-center">
                        Emisă la: {{ date('d.m.Y') }}
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
                        margin: 10,
                        filename: 'legitimatie_membru_ccb.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2, useCORS: true },
                        jsPDF: { unit: 'mm', format: [85.6, 54], orientation: 'landscape' } // Format ID card
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
                    const cardHtml = document.getElementById('member-card').outerHTML;
                    
                    printWindow.document.write(`
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>Legitimație Membru CCB</title>
                            <style>
                                body { font-family: Arial, sans-serif; margin: 20px; }
                                .max-w-md { max-width: 350px; }
                                .mx-auto { margin: 0 auto; }
                                .bg-gradient-to-r { background: linear-gradient(to right, #2563eb, #eab308, #dc2626); }
                                .from-blue-600 { background-color: #2563eb; }
                                .via-yellow-500 { background-color: #eab308; }
                                .to-red-600 { background-color: #dc2626; }
                                .p-1 { padding: 4px; }
                                .p-6 { padding: 24px; }
                                .rounded-lg { border-radius: 8px; }
                                .bg-white { background-color: white; }
                                .flex { display: flex; }
                                .items-center { align-items: center; }
                                .justify-between { justify-content: space-between; }
                                .space-x-2 > * + * { margin-left: 8px; }
                                .space-x-4 > * + * { margin-left: 16px; }
                                .space-y-1 > * + * { margin-top: 4px; }
                                .mb-4 { margin-bottom: 16px; }
                                .mt-1 { margin-top: 4px; }
                                .mt-2 { margin-top: 8px; }
                                .mt-4 { margin-top: 16px; }
                                .w-8 { width: 32px; }
                                .h-6 { height: 24px; }
                                .w-12 { width: 48px; }
                                .h-12 { height: 48px; }
                                .w-20 { width: 80px; }
                                .h-24 { height: 96px; }
                                .text-xs { font-size: 12px; }
                                .text-sm { font-size: 14px; }
                                .text-lg { font-size: 18px; }
                                .font-bold { font-weight: bold; }
                                .font-semibold { font-weight: 600; }
                                .text-center { text-align: center; }
                                .text-right { text-align: right; }
                                .text-gray-800 { color: #1f2937; }
                                .text-gray-900 { color: #111827; }
                                .text-gray-500 { color: #6b7280; }
                                .text-white { color: white; }
                                .bg-gray-200 { background-color: #e5e7eb; }
                                .bg-blue-600 { background-color: #2563eb; }
                                .border-2 { border-width: 2px; }
                                .border-gray-400 { border-color: #9ca3af; }
                                .border-b { border-bottom-width: 1px; }
                                .border-dotted { border-style: dotted; }
                                .pb-1 { padding-bottom: 4px; }
                                .rounded { border-radius: 4px; }
                                .rounded-full { border-radius: 50%; }
                                .flex-1 { flex: 1; }
                                .object-cover { object-fit: cover; }
                                @media print {
                                    body { margin: 0; }
                                    .max-w-md { max-width: none; width: 100%; }
                                }
                            </style>
                        </head>
                        <body>
                            <div style="text-align: center; margin-bottom: 20px;">
                                <h1>Legitimație de Membru CCB</h1>
                            </div>
                            ${cardHtml}
                        </body>
                        </html>
                    `);
                    
                    printWindow.document.close();
                    setTimeout(() => {
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
