<?php

use function Laravel\Folio\name;

name('groenendael');

$seo = (object) [
    'title' => 'Groenendael - Varietatea cu Blana Neagră Lungă | CCB România',
    'description' => 'Totul despre Groenendael: istorie, standard, temperament și îngrijire. Prima varietate de ciobănesc belgian cu blana lungă neagră.',
];

?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    Groenendael
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Prima și cea mai elegantă varietate de ciobănesc belgian, cu blana lungă neagră ca noaptea și temperamentul echilibrat
                </p>
            </div>

            <!-- Content -->
            <div class="space-y-8">
                
                <!-- Prezentare Generală -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-800 to-black text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                            Eleganța în Negru
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                            <div>
                                <p class="text-gray-700 leading-relaxed mb-4">
                                    <strong>Groenendael</strong> este prima varietate de ciobănesc belgian stabilizată oficial, 
                                    fiind recunoscută în <strong>1893</strong>. Numele provine de la comuna <strong>Groenendael</strong>, 
                                    unde a fost dezvoltată această magnifică varietate.
                                </p>
                                <p class="text-gray-700 leading-relaxed mb-4">
                                    Cu blana sa lungă, neagră și lucioasă, Groenendael este considerată cea mai elegantă 
                                    dintre varietățile de ciobănesc belgian. Temperamentul echilibrat și inteligența 
                                    excepțională o fac perfectă atât pentru familie, cât și pentru servicii profesionale.
                                </p>
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <h3 class="font-semibold text-gray-900 mb-2">🏆 Fondatorul Rasei</h3>
                                    <p class="text-gray-700 text-sm">
                                        <strong>Piccard d'Uccle</strong> - primul Groenendael oficial, născut în 1893, 
                                        care a stabilit bazele genetice pentru întreaga varietate.
                                    </p>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-gray-800 to-black p-6 rounded-lg text-white">
                                <h3 class="font-semibold mb-4">📊 Date Esențiale</h3>
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between">
                                        <span>Înălțime masculin:</span>
                                        <span><strong>60-66 cm</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Înălțime feminin:</span>
                                        <span><strong>56-62 cm</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Greutate masculin:</span>
                                        <span><strong>25-30 kg</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Greutate feminin:</span>
                                        <span><strong>20-25 kg</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Speranța de viață:</span>
                                        <span><strong>12-14 ani</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Grupa FCI:</span>
                                        <span><strong>1 - Ciobănești</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aspectul Fizic -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Standard și Aspectul Fizic
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Cap și Ochi -->
                            <div class="bg-purple-50 p-6 rounded-lg">
                                <h3 class="font-semibold text-purple-900 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs mr-2">👁️</span>
                                    Cap și Expresie
                                </h3>
                                <ul class="text-purple-800 text-sm space-y-2">
                                    <li>• <strong>Cap:</strong> Lung, subțire, dar nu exagerat</li>
                                    <li>• <strong>Ochi:</strong> Migdalați, cafenii, expresivi</li>
                                    <li>• <strong>Urechi:</strong> Triunghiulare, drepte, mobile</li>
                                    <li>• <strong>Trufa:</strong> Neagră, bine dezvoltată</li>
                                    <li>• <strong>Mușchime:</strong> Completă, foarfece</li>
                                </ul>
                            </div>

                            <!-- Corp -->
                            <div class="bg-indigo-50 p-6 rounded-lg">
                                <h3 class="font-semibold text-indigo-900 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xs mr-2">🏗️</span>
                                    Structura Corporală
                                </h3>
                                <ul class="text-indigo-800 text-sm space-y-2">
                                    <li>• <strong>Corp:</strong> Pătrat, compact și puternic</li>
                                    <li>• <strong>Piept:</strong> Coborât, nu prea lat</li>
                                    <li>• <strong>Spate:</strong> Drept, ferm, musculos</li>
                                    <li>• <strong>Membre:</strong> Drepte, puternice, bine angulate</li>
                                    <li>• <strong>Coadă:</strong> Puternic implantată, purtată jos</li>
                                </ul>
                            </div>

                            <!-- Blana -->
                            <div class="bg-gray-900 text-white p-6 rounded-lg">
                                <h3 class="font-semibold mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-gray-700 text-white rounded-full flex items-center justify-center text-xs mr-2">✨</span>
                                    Blana Caracteristică
                                </h3>
                                <ul class="text-gray-200 text-sm space-y-2">
                                    <li>• <strong>Lungime:</strong> Lungă pe tot corpul</li>
                                    <li>• <strong>Culoare:</strong> Negru unicolor</li>
                                    <li>• <strong>Textură:</strong> Dreaptă, groasă, nu ondulată</li>
                                    <li>• <strong>Subblana:</strong> Densă și moale</li>
                                    <li>• <strong>Tolerată:</strong> Mici pete albe pe piept</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Temperamentul și Caracterul -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            Temperament și Caracter
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Trăsături Pozitive -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-4 flex items-center text-green-700">
                                    ✅ Calități Remarcabile
                                </h3>
                                <div class="space-y-4">
                                    <div class="bg-green-50 p-4 rounded-lg">
                                        <h4 class="font-medium text-green-900 mb-2">🧠 Inteligență Superioară</h4>
                                        <p class="text-green-800 text-sm">
                                            Capacitate de învățare excepțională, rezolvă probleme complexe și își amintește 
                                            comenzile cu precizie.
                                        </p>
                                    </div>
                                    <div class="bg-green-50 p-4 rounded-lg">
                                        <h4 class="font-medium text-green-900 mb-2">❤️ Loialitate Absolută</h4>
                                        <p class="text-green-800 text-sm">
                                            Atașament profund de familie, devotament total față de stăpân și protecție naturală.
                                        </p>
                                    </div>
                                    <div class="bg-green-50 p-4 rounded-lg">
                                        <h4 class="font-medium text-green-900 mb-2">⚡ Versatilitate</h4>
                                        <p class="text-green-800 text-sm">
                                            Excelent în sporturi canine, servicii de pază, terapie și activități familiale.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Provocări -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-4 flex items-center text-amber-700">
                                    ⚠️ Aspecte de Luat în Seamă
                                </h3>
                                <div class="space-y-4">
                                    <div class="bg-amber-50 p-4 rounded-lg">
                                        <h4 class="font-medium text-amber-900 mb-2">🏃 Nevoi de Activitate</h4>
                                        <p class="text-amber-800 text-sm">
                                            Necesită exerciții zilnice consistente și stimulare mentală pentru a-și menține echilibrul.
                                        </p>
                                    </div>
                                    <div class="bg-amber-50 p-4 rounded-lg">
                                        <h4 class="font-medium text-amber-900 mb-2">👥 Socializare Timpurie</h4>
                                        <p class="text-amber-800 text-sm">
                                            Important să fie socializat din timp cu persoane și animale pentru a evita timiditatea.
                                        </p>
                                    </div>
                                    <div class="bg-amber-50 p-4 rounded-lg">
                                        <h4 class="font-medium text-amber-900 mb-2">🧘 Sensibilitate</h4>
                                        <p class="text-amber-800 text-sm">
                                            Răspunde mai bine la metode de antrenament pozitive decât la corecții dure.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Îngrijire și Sănătate -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            Îngrijire și Sănătate
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Îngrijirea Blănii -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-4">✂️ Îngrijirea Blănii</h3>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-1">1</span>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Perierea Zilnică</h4>
                                            <p class="text-gray-600 text-sm">15-20 minute pentru prevenirea încurcăturilor</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-1">2</span>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Băi Regulate</h4>
                                            <p class="text-gray-600 text-sm">O dată la 4-6 săptămâni sau când este necesar</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-1">3</span>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Năpârlire Sezonieră</h4>
                                            <p class="text-gray-600 text-sm">2 perioade pe an cu pierdere intensă de păr</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sănătatea -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-4">🏥 Aspecte de Sănătate</h3>
                                <div class="space-y-3">
                                    <div class="bg-red-50 p-3 rounded-lg">
                                        <h4 class="font-medium text-red-900">Dysplazia de șold</h4>
                                        <p class="text-red-800 text-sm">Control radiologic la reproducători</p>
                                    </div>
                                    <div class="bg-yellow-50 p-3 rounded-lg">
                                        <h4 class="font-medium text-yellow-900">Epilepsia</h4>
                                        <p class="text-yellow-800 text-sm">Posibilă predispoziție genetică</p>
                                    </div>
                                    <div class="bg-blue-50 p-3 rounded-lg">
                                        <h4 class="font-medium text-blue-900">Probleme oculare</h4>
                                        <p class="text-blue-800 text-sm">Controale oftalmologice regulate</p>
                                    </div>
                                    <div class="bg-green-50 p-3 rounded-lg">
                                        <h4 class="font-medium text-green-900">Longevitate</h4>
                                        <p class="text-green-800 text-sm">Rasă relativ sănătoasă, 12-14 ani</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pentru Cine Este Potrivit -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Pentru Cine Este Potrivit Groenendael?
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Ideal pentru -->
                            <div class="bg-green-50 p-6 rounded-lg">
                                <h3 class="font-semibold text-green-900 mb-4 flex items-center">
                                    ✨ Ideal Pentru:
                                </h3>
                                <ul class="text-green-800 space-y-2 text-sm">
                                    <li class="flex items-start">
                                        <span class="text-green-600 font-bold mr-2">•</span>
                                        <span><strong>Familii active</strong> cu experiență canină</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-green-600 font-bold mr-2">•</span>
                                        <span><strong>Iubitori de sporturi canine</strong> (agility, obedience)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-green-600 font-bold mr-2">•</span>
                                        <span><strong>Case cu grădină</strong> și spațiu pentru mișcare</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-green-600 font-bold mr-2">•</span>
                                        <span><strong>Persoane dedicat</strong> îngrijirii blănii</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-green-600 font-bold mr-2">•</span>
                                        <span><strong>Activități de serviciu</strong> (terapie, căutare)</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Nu este recomandat -->
                            <div class="bg-red-50 p-6 rounded-lg">
                                <h3 class="font-semibold text-red-900 mb-4 flex items-center">
                                    ❌ Nu Este Recomandat Pentru:
                                </h3>
                                <ul class="text-red-800 space-y-2 text-sm">
                                    <li class="flex items-start">
                                        <span class="text-red-600 font-bold mr-2">•</span>
                                        <span><strong>Proprietari începători</strong> fără experiență</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-red-600 font-bold mr-2">•</span>
                                        <span><strong>Persoane sedentare</strong> cu stil de viață pasiv</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-red-600 font-bold mr-2">•</span>
                                        <span><strong>Apartamente mici</strong> fără acces la exterior</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-red-600 font-bold mr-2">•</span>
                                        <span><strong>Persoane alergice</strong> la părul de câine</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-red-600 font-bold mr-2">•</span>
                                        <span><strong>Timp limitat</strong> pentru antrenament și socializare</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Navigation Links -->
            <div class="flex justify-between items-center mt-12">
                <a href="{{ url('/istoria-ciobanescului-belgian') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Istoria Rasei
                </a>
                
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-md">
                    🏠 Pagina Principală
                </a>

                <a href="{{ url('/malinois') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors shadow-md">
                    Malinois
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>