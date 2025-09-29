<?php

use function Laravel\Folio\name;

name('istoria-ciobanescului-belgian');

$seo = (object) [
    'title' => 'Istoria Ciobanescului Belgian - Originea și Dezvoltarea Rasei CCB',
    'description' => 'Descoperă fascinanta istorie a ciobănescului belgian, de la originile din secolul XIX la dezvoltarea în patru varietăți distincte.',
];

?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    Istoria Ciobanescului Belgian
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    O călătorie prin timp pentru a descoperi originea și evoluția unei dintre cele mai versatile și inteligente rase canine din lume
                </p>
            </div>

            <!-- Content -->
            <div class="space-y-8">
                
                <!-- Originile -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-600 to-orange-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Originile Rasei (Secolul XIX)
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                            <div>
                                <p class="text-gray-700 leading-relaxed mb-4">
                                    Istoria ciobanescului belgian începe în <strong>1891</strong> când profesorul <strong>Adolphe Reul</strong> 
                                    de la Școala Medicină Veterinară din Cureghem a inițiat primul studiu sistematic asupra câinilor 
                                    ciobănești din Belgia.
                                </p>
                                <p class="text-gray-700 leading-relaxed mb-4">
                                    La <strong>15 septembrie 1891</strong>, la Cureghem, s-au adunat 117 câini ciobănești pentru evaluare. 
                                    Din această selecție inițială, doar câțiva au fost considerați demni să devină fondatorii rasei moderne.
                                </p>
                                <p class="text-gray-700 leading-relaxed">
                                    Primul club rasial, <strong>"Club du Chien de Berger Belge"</strong>, a fost fondat pe 
                                    <strong>29 septembrie 1891</strong>, marcând începutul oficial al dezvoltării rasei.
                                </p>
                            </div>
                            <div class="bg-amber-50 p-6 rounded-lg">
                                <h3 class="font-semibold text-amber-900 mb-3">📊 Date Cheie - 1891</h3>
                                <ul class="text-amber-800 space-y-2 text-sm">
                                    <li>• <strong>117 câini</strong> evaluați inițial</li>
                                    <li>• <strong>Prof. Adolphe Reul</strong> - pionierul rasei</li>
                                    <li>• <strong>15 septembrie</strong> - prima evaluare</li>
                                    <li>• <strong>29 septembrie</strong> - primul club rasial</li>
                                    <li>• <strong>Cureghem</strong> - locul de naștere al rasei</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dezvoltarea Varietăților -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Formarea Celor Patru Varietăți
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Groenendael -->
                            <div class="bg-gray-900 text-white p-6 rounded-lg">
                                <h3 class="font-bold text-lg mb-3 flex items-center">
                                    <div class="w-4 h-4 bg-black rounded-full mr-2"></div>
                                    Groenendael (1893)
                                </h3>
                                <p class="text-gray-300 text-sm">
                                    Prima varietate stabilită, numită după comuna Groenendael. Caracterizată prin blana lungă și neagră. 
                                    Fondatorul: <strong>Piccard d'Uccle</strong>.
                                </p>
                            </div>

                            <!-- Tervueren -->
                            <div class="bg-amber-600 text-white p-6 rounded-lg">
                                <h3 class="font-bold text-lg mb-3 flex items-center">
                                    <div class="w-4 h-4 bg-amber-400 rounded-full mr-2"></div>
                                    Tervueren (1907)
                                </h3>
                                <p class="text-amber-100 text-sm">
                                    Varietatea cu blană lungă carbonată (gălbui-roșcată cu vârfuri negre). 
                                    Numită după orașul Tervueren. Fondatorul: <strong>Tom</strong>.
                                </p>
                            </div>

                            <!-- Malinois -->
                            <div class="bg-orange-600 text-white p-6 rounded-lg">
                                <h3 class="font-bold text-lg mb-3 flex items-center">
                                    <div class="w-4 h-4 bg-orange-400 rounded-full mr-2"></div>
                                    Malinois (1898)
                                </h3>
                                <p class="text-orange-100 text-sm">
                                    Varietatea cu păr scurt, carbonată. Cea mai răspândită astăzi. 
                                    Numită după Mechelen (Malines). Fondatori: <strong>Dewet</strong> și <strong>Cora van't Optewel</strong>.
                                </p>
                            </div>

                            <!-- Laekenois -->
                            <div class="bg-yellow-600 text-white p-6 rounded-lg">
                                <h3 class="font-bold text-lg mb-3 flex items-center">
                                    <div class="w-4 h-4 bg-yellow-400 rounded-full mr-2"></div>
                                    Laekenois (1897)
                                </h3>
                                <p class="text-yellow-100 text-sm">
                                    Varietatea cu păr dur, carbonată. Cea mai rară varietate. 
                                    Numită după domeniul regal Laeken. Fondatorul: <strong>Vos I des Polders</strong>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Evoluția Modernă -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                            Recunoașterea Internațională și Dezvoltarea Modernă
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="space-y-6">
                            <div class="timeline-item">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">1901</div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-900">Primul Standard Rasial</h3>
                                        <p class="text-gray-600">A fost adoptat primul standard oficial pentru ciobănescul belgian, unificând criteriile de selecție.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-sm">1956</div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-900">Recunoașterea FCI</h3>
                                        <p class="text-gray-600">Fédération Cynologique Internationale recunoaște oficial rasa cu standardul nr. 15.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold text-sm">1960</div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-900">Expansiunea Globală</h3>
                                        <p class="text-gray-600">Rasa se răspândește în toată lumea, devenind populară pentru abilitățile de lucru și companionaj.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center font-bold text-sm">1990</div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-900">Specializarea în Servicii</h3>
                                        <p class="text-gray-600">Malinois devine preferatul forțelor militare și de poliție din întreaga lume pentru abilităților excepționale.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Caracteristici Genetice -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                            Moștenirea Genetică Comună
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-4">🧬 Caracteristici Comune</h3>
                                <ul class="space-y-2 text-gray-700">
                                    <li class="flex items-start">
                                        <span class="text-purple-600 font-bold mr-2">•</span>
                                        <span><strong>Temperament:</strong> Alert, activ, loial și protector</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-purple-600 font-bold mr-2">•</span>
                                        <span><strong>Inteligență:</strong> Capacitate de învățare excepțională</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-purple-600 font-bold mr-2">•</span>
                                        <span><strong>Fizic:</strong> Structură pătrată, echilibrată și atletică</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-purple-600 font-bold mr-2">•</span>
                                        <span><strong>Culoare:</strong> Toate varietățile pot avea aceeași genetică de bază</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-4">🔬 Fapte Științifice</h3>
                                <div class="bg-purple-50 p-4 rounded-lg text-sm">
                                    <p class="mb-3">
                                        <strong>Observație importantă:</strong> Toate cele patru varietăți sunt 
                                        considerați de FCI ca fiind <em>o singură rasă</em> cu diferențieri doar în ceea ce privește blana.
                                    </p>
                                    <p class="mb-3">
                                        Pot fi încrucișate între ele și pot apărea puii de varietăți diferite în aceeași descindență, 
                                        în funcție de genele moștenite.
                                    </p>
                                    <p class="text-purple-700 font-medium">
                                        Aceasta demonstrează unitatea genetică a rasei și originea comună din secolul XIX.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Back Button -->
            <div class="text-center mt-12">
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-medium rounded-lg hover:from-gray-700 hover:to-gray-800 transition-all shadow-lg transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Înapoi la pagina principală
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>