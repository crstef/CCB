<?php

use function Laravel\Folio\name;

name('cum-sa-devii-membru');

$seo = (object) [
    'title' => 'Cum să devii membru CCB - Clubul Ciobanescilor Belgieni',
    'description' => 'Află cum poți deveni membru al Clubului Ciobanescilor Belgieni și Olandezi România. Condiții, proceduri și beneficii.',
];

?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    Cum să devii membru CCB
                </h1>
                <p class="text-xl text-gray-600">
                    Alătură-te comunității pasionaților de ciobănești belgieni și olandezi
                </p>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-8">
                    
                    <!-- Introducere -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Cum poți deveni membru CCB?</h2>
                        
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Procedura de aderare</h3>
                        <p class="text-gray-700 leading-relaxed mb-6">
                            Cererile de aderare la CCB pot fi depuse pe tot parcursul anului. Pentru a deveni membru, te rugăm să urmezi pașii de mai jos:
                        </p>
                    </div>

                    <!-- Pasul 1 -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">1</span>
                            Depunerea cererii de aderare
                        </h2>
                        
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Pentru a aplica, trimite o cerere care să conțină următoarele informații:
                        </p>
                        
                        <ul class="list-disc list-inside text-gray-700 space-y-2 mb-6">
                            <li>Numele și prenumele</li>
                            <li>Localitatea de domiciliu</li>
                            <li>O scurtă prezentare personală în ceea ce privește activitatea chinologică</li>
                            <li>Mențiunea dacă ești membru unui club afiliat AChR sau FCI</li>
                            <li>Informații despre deținerea unui câine cu pedigree</li>
                            <li>Dacă ai practicat, sau nu, în trecut sporturi canine</li>
                            <li>Scrie câteva motive pentru care dorești să devii membru al CCB</li>
                            <li>Comunică-ne modalitatea în care vrei să fii contactat</li>
                        </ul>
                        
                        <div class="bg-amber-100 border-l-4 border-amber-500 p-4 rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-amber-700">
                                        <strong>Notă:</strong> Cererile sunt analizate o singură dată pe an, în luna mai, în cadrul ședinței Consiliului Director, având ca unic punct pe ordinea de zi adoptarea noilor membri.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pasul 2 -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">2</span>
                            Confirmarea și finalizarea aderării
                        </h2>
                        
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Dacă cererea ta este aprobată, vei fi contactat de către un membru al Consiliului Director. Vei primi informații cu privire la:
                        </p>
                        
                        <ul class="list-disc list-inside text-gray-700 space-y-2 mb-6">
                            <li>Confirmarea acceptării în club</li>
                            <li>Adresa de e-mail sau adresa fizică unde va trebui să trimiți documentele necesare pentru finalizarea procesului de aderare:
                                <ul class="list-disc list-inside ml-6 mt-2 space-y-1 text-sm">
                                    <li>Copie CI</li>
                                    <li>Cerere-tip de aderare (poate fi descărcată de pe site-ul AChR)</li>
                                    <li>Informarea privind drepturile legale de prelucrare a datelor cu caracter personal</li>
                                    <li>Copia chitanței în valoare de <strong>240 RON</strong>, reprezentând cotizația anuală (sumă ce trebuie plătită în contul CCB, afișat pe site)</li>
                                </ul>
                            </li>
                        </ul>
                        
                        <div class="bg-red-100 border-l-4 border-red-500 p-4 rounded-r-lg mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">
                                        <strong>Important:</strong> Documentele trebuie trimise în termen de 10 zile de la primirea e-mailului de confirmare.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-gray-700 leading-relaxed">
                            După recepționarea documentelor, vei deveni membru CCB cu drepturi depline, cu excepția dreptului de vot în Adunarea Generală, pe care îl vei dobândi imediat ce vei fi înscris oficial în Registrul Asociațiilor la judecătorie.
                        </p>
                    </div>

                    <!-- Contact pentru inscriere -->
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 p-6 rounded-lg text-white">
                        <h2 class="text-xl font-semibold mb-4">📧 Contact pentru aderare</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="font-semibold">Pentru informații și cereri:</p>
                                <p>contact@ccb-romania.ro</p>
                            </div>
                            <div>
                                <p class="font-semibold">Cotizația anuală:</p>
                                <p><strong>240 RON</strong></p>
                                <p><small>Detalii cont în e-mailul de confirmare</small></p>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-indigo-400">
                            <p class="text-sm opacity-90">
                                <strong>Atenție:</strong> Cererile sunt analizate o singură dată pe an, în luna mai. 
                                Documentele de finalizare trebuie trimise în termen de 10 zile de la confirmarea acceptării.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-8">
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                    &larr; Înapoi la pagina principală
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>