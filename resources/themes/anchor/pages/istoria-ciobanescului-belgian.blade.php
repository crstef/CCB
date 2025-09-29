<?php

use function Laravel\Folio\name;

name('istoria-ciobanescului-belgian');

$seo = (object) [
    'title' => 'Istoria Ciobanescului Belgian - Originea și Dezvoltarea Rasei CCB',
    'description' => 'Descoperă fascinanta istorie a ciobănescului belgian, de la originile din secolul XIX la dezvoltarea în patru varietăți distincte.',
];

?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-2">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    Istoria Ciobanescului Belgian
                </h1>
                <p class="text-xl text-gray-600">
                    De la păstorul belgian de la sfârșitul secolului XIX la campionul mondial de astăzi
                </p>
            </div>

            <!-- Content -->
            <div class="space-y-4">
                
                <!-- Originile -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-600 to-orange-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Originile Rasei (Secolul XIX)
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-center">
                            <div>
                                <p class="text-gray-700 leading-relaxed mb-2">
                                    Istoria ciobanescului belgian începe în <strong>1891</strong> când profesorul <strong>Adolphe Reul</strong> 
                                    de la Școala Medicină Veterinară din Cureghem a inițiat primul studiu sistematic asupra câinilor 
                                    ciobănești din Belgia.
                                </p>
                                <p class="text-gray-700 leading-relaxed mb-2">
                                    La <strong>15 septembrie 1891</strong>, la Cureghem, s-au adunat 117 câini ciobănești pentru evaluare. 
                                    Din această selecție inițială, doar câțiva au fost considerați demni să devină fondatorii rasei moderne.
                                </p>
                                <p class="text-gray-700 leading-relaxed">
                                    Primul club rasial, <strong>"Club du Chien de Berger Belge"</strong>, a fost fondat pe 
                                    <strong>29 septembrie 1891</strong>, marcând începutul oficial al dezvoltării rasei.
                                </p>
                            </div>
                            <div class="bg-amber-50 p-3 rounded-lg">
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
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Formarea Celor Patru Varietăți
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <!-- Groenendael -->
                            <div class="bg-gray-900 text-white p-3 rounded-lg">
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
                            <div class="bg-amber-600 text-white p-3 rounded-lg">
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
                            <div class="bg-orange-600 text-white p-3 rounded-lg">
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
                            <div class="bg-yellow-600 text-white p-3 rounded-lg">
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
                    <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Recunoașterea Internațională și Dezvoltarea Modernă
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="space-y-4">
                            <div class="timeline-item">
                                <div class="text-gray-700">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">1901</div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-900">Primul Standard Rasial</h3>
                                        <p class="text-gray-600">A fost adoptat primul standard oficial pentru ciobănescul belgian, unificând criteriile de selecție.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="text-gray-700">
                                    <div class="flex-shrink-0 w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-sm">1956</div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-900">Recunoașterea FCI</h3>
                                        <p class="text-gray-600">Fédération Cynologique Internationale recunoaște oficial rasa cu standardul nr. 15.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="text-gray-700">
                                    <div class="flex-shrink-0 w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold text-sm">1960</div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-900">Expansiunea Globală</h3>
                                        <p class="text-gray-600">Rasa se răspândește în toată lumea, devenind populară pentru abilitățile de lucru și companionaj.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="text-gray-700">
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
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Moștenirea Genetică Comună
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">🧬 Caracteristici Comune</h3>
                                <ul class="space-y-2 text-gray-700">
                                    <li class="text-gray-700">
                                        <span class="text-purple-600 font-bold mr-2">•</span>
                                        <span><strong>Temperament:</strong> Alert, activ, loial și protector</span>
                                    </li>
                                    <li class="text-gray-700">
                                        <span class="text-purple-600 font-bold mr-2">•</span>
                                        <span><strong>Inteligență:</strong> Capacitate de învățare excepțională</span>
                                    </li>
                                    <li class="text-gray-700">
                                        <span class="text-purple-600 font-bold mr-2">•</span>
                                        <span><strong>Fizic:</strong> Structură pătrată, echilibrată și atletică</span>
                                    </li>
                                    <li class="text-gray-700">
                                        <span class="text-purple-600 font-bold mr-2">•</span>
                                        <span><strong>Culoare:</strong> Toate varietățile pot avea aceeași genetică de bază</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">🔬 Fapte Științifice</h3>
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
                    ✓
                    Înapoi la pagina principală
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>