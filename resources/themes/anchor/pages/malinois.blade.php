<?php

use function Laravel\Folio\name;

name('malinois');

$seo = (object) [
    'title' => 'Malinois - Elita Câinilor de Serviciu | CCB România',
    'description' => 'Descoperiți Malinois: cea mai versatilă varietate de ciobănesc belgian, preferată de forțele militare și de poliție din întreaga lume.',
];

?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-2">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    Malinois
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Elita câinilor de serviciu - cea mai versatilă și căutată varietate de ciobănesc belgian la nivel mondial
                </p>
            </div>

            <!-- Content -->
            <div class="space-y-2">
                
                <!-- Prezentare Generală -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-600 to-red-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            Puterea în Acțiune
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-center">
                            <div>
                                <p class="text-gray-700 leading-relaxed mb-2">
                                    <strong>Malinois</strong> este varietatea cu păr scurt de ciobănesc belgian, dezvoltată în 
                                    zona orașului <strong>Mechelen (Malines)</strong> din Belgia. Recunoscută oficial în <strong>1898</strong>, 
                                    a devenit rapid varietatea preferată pentru servicii specializate.
                                </p>
                                <p class="text-gray-700 leading-relaxed mb-2">
                                    Astăzi, Malinois este <strong>standardul de aur</strong> pentru forțele militare, poliție, 
                                    unități antidrog și servicii de securitate din întreaga lume. Combinația între inteligența superioară, 
                                    rezistența fizică și loialitatea absolută îl face de neînlocuit.
                                </p>
                                <div class="bg-orange-100 p-4 rounded-lg">
                                    <h3 class="font-semibold text-orange-900 mb-2">🏆 Fondatorii Rasei</h3>
                                    <p class="text-orange-800 text-sm">
                                        <strong>Dewet</strong> și <strong>Cora van't Optewel</strong> - primii Malinois oficiali 
                                        care au stabilit standardul genetic pentru varietate.
                                    </p>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-orange-600 to-red-600 p-3 rounded-lg text-white">
                                <h3 class="font-semibold mb-2">🎯 Elite Performance</h3>
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between">
                                        <span>Viteza maximă:</span>
                                        <span><strong>60+ km/h</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Înălțime săritură:</span>
                                        <span><strong>2+ metri</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Rezistența:</span>
                                        <span><strong>Excepțională</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Timp reacție:</span>
                                        <span><strong>0.1 secunde</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Forța mușcării:</span>
                                        <span><strong>195 PSI</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>IQ canin:</span>
                                        <span><strong>Top 3 mondial</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Utilizări Profesionale -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-800 to-indigo-800 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🏆 Servicii de Elită Mondiale
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            <!-- Militar -->
                            <div class="bg-green-50 border border-green-200 p-3 rounded-lg">
                                <div class="w-12 h-12 bg-green-600 text-white rounded-lg flex items-center justify-center mb-2">
                                    🛡️
                                </div>
                                <h3 class="font-semibold text-green-900 mb-3">Servicii Militare</h3>
                                <ul class="text-green-800 text-sm space-y-2">
                                    <li>• <strong>US Navy SEALs</strong> - Misiuni speciale</li>
                                    <li>• <strong>Forțe Speciale</strong> - Protecție și atac</li>
                                    <li>• <strong>Detectare explozivi</strong> - Zone de conflict</li>
                                    <li>• <strong>Patrulare perimetru</strong> - Baze militare</li>
                                    <li>• <strong>Parașutism canin</strong> - Operațiuni aeriene</li>
                                </ul>
                            </div>

                            <!-- Poliție -->
                            <div class="bg-blue-50 border border-blue-200 p-3 rounded-lg">
                                <div class="w-12 h-12 bg-blue-600 text-white rounded-lg flex items-center justify-center mb-2">
                                    🚔
                                </div>
                                <h3 class="font-semibold text-blue-900 mb-3">Forțe de Poliție</h3>
                                <ul class="text-blue-800 text-sm space-y-2">
                                    <li>• <strong>K-9 Units</strong> - Patrulare urbană</li>
                                    <li>• <strong>Antidrog</strong> - Detectare narcotice</li>
                                    <li>• <strong>Căutare persoane</strong> - Dispărute/Răpite</li>
                                    <li>• <strong>Crowd control</strong> - Manifestații</li>
                                    <li>• <strong>Protecție VIP</strong> - Personalități</li>
                                </ul>
                            </div>

                            <!-- Securitate -->
                            <div class="bg-purple-50 border border-purple-200 p-3 rounded-lg">
                                <div class="w-12 h-12 bg-purple-600 text-white rounded-lg flex items-center justify-center mb-2">
                                    🔒
                                </div>
                                <h3 class="font-semibold text-purple-900 mb-3">Securitate Privată</h3>
                                <ul class="text-purple-800 text-sm space-y-2">
                                    <li>• <strong>Aeroporturi</strong> - Scanare bagaje</li>
                                    <li>• <strong>Frontiere</strong> - Control vamale</li>
                                    <li>• <strong>Corporații</strong> - Pază și protecție</li>
                                    <li>• <strong>Evenimente</strong> - Securitate VIP</li>
                                    <li>• <strong>Transport valori</strong> - Escorte blindate</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Succes Stories -->
                        <div class="mt-4 bg-gradient-to-r from-yellow-400 to-orange-400 p-3 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2 flex items-center">
                                🌟 Povești de Succes Mondiale
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-800">
                                <div>
                                    <p><strong>"Cairo"</strong> - Malinois care a participat la operațiunea împotriva lui Osama bin Laden (2011)</p>
                                </div>
                                <div>
                                    <p><strong>Malinois francezi</strong> - Eroi în atacurile teroriste de la Paris, salvând sute de vieți</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Standard Fizic -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-600 to-yellow-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Standardul Perfect pentru Acțiune
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Dimensiuni -->
                            <div class="bg-amber-50 p-3 rounded-lg">
                                <h3 class="font-semibold text-amber-900 mb-2">📏 Dimensiuni Standard</h3>
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between">
                                        <span>Masculin înălțime:</span>
                                        <span class="font-semibold">60-66 cm</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Feminin înălțime:</span>
                                        <span class="font-semibold">56-62 cm</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Greutate masculin:</span>
                                        <span class="font-semibold">25-30 kg</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Greutate feminin:</span>
                                        <span class="font-semibold">20-25 kg</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Construcție:</span>
                                        <span class="font-semibold">Pătrată, atletică</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Blana și Culoarea -->
                            <div class="bg-yellow-100 p-3 rounded-lg border-2 border-yellow-400">
                                <h3 class="font-semibold text-yellow-900 mb-2">🎨 Blana Caracteristică</h3>
                                <ul class="text-yellow-800 text-sm space-y-2">
                                    <li><strong>Lungime:</strong> Scurtă pe tot corpul</li>
                                    <li><strong>Culoare de bază:</strong> Galben-roșcat (fawn)</li>
                                    <li><strong>Carbonaj:</strong> Vârfuri negre ale părului</li>
                                    <li><strong>Masca:</strong> Neagră pe față și urechi</li>
                                    <li><strong>Textură:</strong> Densă, strâns lipită de corp</li>
                                    <li><strong>Subblana:</strong> Lanosă, de culoare deschisă</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Temperament și Antrenament -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-pink-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Mental de Campion
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <!-- Drive și Motivație -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2 text-red-700">🔥 Drive și Motivație Supremă</h3>
                                <div class="space-y-2">
                                    <div class="bg-red-50 border-l-4 border-red-500 p-4">
                                        <h4 class="font-medium text-red-900">Drive de Pradă</h4>
                                        <p class="text-red-800 text-sm mt-1">
                                            Instinct de vânătoare extrem de dezvoltat, perfect pentru tracking și detectare.
                                        </p>
                                    </div>
                                    <div class="bg-orange-50 border-l-4 border-orange-500 p-4">
                                        <h4 class="font-medium text-orange-900">Drive de Protecție</h4>
                                        <p class="text-orange-800 text-sm mt-1">
                                            Dorința naturală de a-și proteja familia și teritoriul, ideală pentru pază.
                                        </p>
                                    </div>
                                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4">
                                        <h4 class="font-medium text-yellow-900">Drive de Joc</h4>
                                        <p class="text-yellow-800 text-sm mt-1">
                                            Pasiune pentru activitate și joc, făcând antrenamentul o plăcere.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Metode de Antrenament -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2 text-blue-700">🎯 Antrenament Specializat</h3>
                                <div class="space-y-2">
                                    <div class="bg-blue-50 p-4 rounded-lg">
                                        <h4 class="font-medium text-blue-900">Pozitivă Prin Recompense</h4>
                                        <p class="text-blue-800 text-sm mt-1">
                                            Răspunde excelent la recompense: mâncare, jucării, laude.
                                        </p>
                                    </div>
                                    <div class="bg-indigo-50 p-4 rounded-lg">
                                        <h4 class="font-medium text-indigo-900">Provocări Mentale</h4>
                                        <p class="text-indigo-800 text-sm mt-1">
                                            Necesită puzzle-uri complexe și sarcini variate pentru stimulare.
                                        </p>
                                    </div>
                                    <div class="bg-purple-50 p-4 rounded-lg">
                                        <h4 class="font-medium text-purple-900">Consistență Absolută</h4>
                                        <p class="text-purple-800 text-sm mt-1">
                                            Răspunde la lideri fermi dar corecți, cu reguli clare și consistente.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Provocări și Responsabilități -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-700 to-gray-900 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Responsabilitatea Unui Malinois
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="bg-amber-50 border-l-4 border-amber-500 p-3 mb-3">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    ⭐
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-amber-700">
                                        <strong>ATENȚIE IMPORTANTĂ:</strong> Malinois nu este o rasă pentru oricine. Necesită proprietari experimentați, 
                                        cu timp și resurse pentru a satisface nevoile sale complexe.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nevoi Zilnice -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">⚡ Nevoi Zilnice Obligatorii</h3>
                                <ul class="space-y-3 text-sm">
                                    <li class="text-gray-700">
                                        <span class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-1">!</span>
                                        <div>
                                            <strong>3-4 ore exerciții intense</strong><br>
                                            <span class="text-gray-600">Alergare, agility, tracking, jocuri complexe</span>
                                        </div>
                                    </li>
                                    <li class="text-gray-700">
                                        <span class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-1">!</span>
                                        <div>
                                            <strong>Stimulare mentală constantă</strong><br>
                                            <span class="text-gray-600">Comenzi noi, puzzle-uri, sarcini variate</span>
                                        </div>
                                    </li>
                                    <li class="text-gray-700">
                                        <span class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-1">!</span>
                                        <div>
                                            <strong>Socializare continuă</strong><br>
                                            <span class="text-gray-600">Contact cu persoane, animale, situații noi</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Consecințe Neglijării -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2 text-red-700">💥 Riscuri Neglijării</h3>
                                <div class="space-y-3">
                                    <div class="bg-red-100 p-3 rounded-lg">
                                        <h4 class="font-medium text-red-900">Comportament Distructiv</h4>
                                        <p class="text-red-800 text-sm">Distrugerea mobilierului, grădinii, caselor</p>
                                    </div>
                                    <div class="bg-orange-100 p-3 rounded-lg">
                                        <h4 class="font-medium text-orange-900">Agresivitate</h4>
                                        <p class="text-orange-800 text-sm">Către străini, copii sau alte animale</p>
                                    </div>
                                    <div class="bg-yellow-100 p-3 rounded-lg">
                                        <h4 class="font-medium text-yellow-900">Anxietate Severă</h4>
                                        <p class="text-yellow-800 text-sm">Stres chronic și tulburări comportamentale</p>
                                    </div>
                                    <div class="bg-gray-100 p-3 rounded-lg">
                                        <h4 class="font-medium text-gray-900">Abandon</h4>
                                        <p class="text-gray-800 text-sm">Mulți Malinois ajung în adăposturi din această cauză</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Navigation Links -->
            <div class="flex justify-between items-center mt-4">
                <a href="{{ url('/groenendael') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors shadow-md">
                    ← Groenendael
                </a>
                
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-md">
                    🏠 Pagina Principală
                </a>

                <a href="{{ url('/tervueren') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors shadow-md">
                    Tervueren →
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>