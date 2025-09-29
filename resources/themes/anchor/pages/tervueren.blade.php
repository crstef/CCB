<?php

use function Laravel\Folio\name;

name('tervueren');

$seo = (object) [
    'title' => 'Tervueren - Eleganța Belgiană în Mișcare | CCB România',
    'description' => 'Descoperiți Tervueren: varietatea de ciobănesc belgian cu păr lung și culoare fawn, simbolul eleganței și performanței canine.',
];

?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    Tervueren
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Eleganța în mișcare - varietatea care îmbină frumusețea aristocrată cu performanța excepțională
                </p>
            </div>

            <!-- Content -->
            <div class="space-y-8">
                
                <!-- Prezentare Elegantă -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-600 to-orange-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                            Magnificența Naturală
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                            <div>
                                <p class="text-gray-700 leading-relaxed mb-4">
                                    <strong>Tervueren</strong> este varietatea cu păr lung și culoare fawn a ciobanescului belgian, 
                                    numită după orașul <strong>Tervuren</strong> din Belgia. Dezvoltată la sfârșitul secolului al XIX-lea, 
                                    a devenit rapid <strong>simbolul eleganței</strong> în lumea canină.
                                </p>
                                <p class="text-gray-700 leading-relaxed mb-4">
                                    Considerat de mulți ca <strong>"cea mai frumoasă"</strong> dintre varietăți, Tervueren combină 
                                    blana luxuriantă cu mișcarea fluidă și grația naturală. Este varietatea preferată pentru 
                                    <strong>expoziții canine</strong> și <strong>filmări</strong>, fiind vedeta nenumăratelor producții.
                                </p>
                                <div class="bg-amber-100 p-4 rounded-lg">
                                    <h3 class="font-semibold text-amber-900 mb-2">🎭 Vedeta de Cinema</h3>
                                    <p class="text-amber-800 text-sm">
                                        <strong>Prima alegere</strong> pentru industria cinematografică și publicitară datorită 
                                        aspectului spectaculos și capacității de antrenament.
                                    </p>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-amber-600 to-orange-600 p-6 rounded-lg text-white">
                                <h3 class="font-semibold mb-4">✨ Caracteristici de Excepție</h3>
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between">
                                        <span>Frumusețe:</span>
                                        <span><strong>★★★★★</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Eleganță mișcare:</span>
                                        <span><strong>Superioară</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Blană luxuriantă:</span>
                                        <span><strong>Remarcabilă</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Prezență scenă:</span>
                                        <span><strong>Magnetică</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Fotogenie:</span>
                                        <span><strong>Excepțională</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Popularitate:</span>
                                        <span><strong>Top 3 mondiale</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blana de Vis -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-rose-600 to-pink-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Coroana de Blană Luxuriantă
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Caracteristici Blană -->
                            <div class="bg-rose-50 p-6 rounded-lg border-2 border-rose-300">
                                <h3 class="font-semibold text-rose-900 mb-4">🌟 Blana de Excepție</h3>
                                <div class="space-y-3 text-sm text-rose-800">
                                    <div class="flex items-start">
                                        <span class="w-2 h-2 bg-rose-600 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                        <div>
                                            <strong>Lungă și abundentă</strong> - cu stratul exterior lustros
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="w-2 h-2 bg-rose-600 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                        <div>
                                            <strong>Textura mătăsoasă</strong> - moale la atingere, nu aspră
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="w-2 h-2 bg-rose-600 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                        <div>
                                            <strong>Guler magnific</strong> - "colierette" în jurul gâtului
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="w-2 h-2 bg-rose-600 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                        <div>
                                            <strong>Franjuri elegante</strong> - la urechi, picioare și coadă
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="w-2 h-2 bg-rose-600 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                        <div>
                                            <strong>Subblană densă</strong> - protecție termică excelentă
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Paleta de Culori -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-4">🎨 Spectrul Culorilor Fawn</h3>
                                <div class="space-y-4">
                                    <div class="bg-gradient-to-r from-yellow-300 to-yellow-500 p-4 rounded-lg text-gray-900">
                                        <h4 class="font-semibold">Fawn Deschis</h4>
                                        <p class="text-sm">Galben deschis cu nuanțe de miere</p>
                                    </div>
                                    <div class="bg-gradient-to-r from-orange-400 to-red-500 p-4 rounded-lg text-white">
                                        <h4 class="font-semibold">Fawn Standard</h4>
                                        <p class="text-sm">Galben-roșcat clasic, cel mai răspândit</p>
                                    </div>
                                    <div class="bg-gradient-to-r from-red-600 to-red-800 p-4 rounded-lg text-white">
                                        <h4 class="font-semibold">Mahon</h4>
                                        <p class="text-sm">Roșcat intens cu carbonaj pronunțat</p>
                                    </div>
                                </div>

                                <!-- Carbonaj -->
                                <div class="mt-6 bg-gray-800 p-4 rounded-lg text-white">
                                    <h4 class="font-semibold mb-2">🖤 Carbonajul Perfect</h4>
                                    <ul class="text-sm space-y-1">
                                        <li>• <strong>Mască neagră:</strong> Acoperă fața și urechile</li>
                                        <li>• <strong>Vârfuri negre:</strong> Pe părul de garde</li>
                                        <li>• <strong>Contur subtil:</strong> Subliniază trăsăturile</li>
                                        <li>• <strong>Intensitate:</strong> Variabilă cu vârsta</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Îngrijirea Blănii -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            Îngrijirea de Lux
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="mb-6 bg-purple-50 border border-purple-200 p-4 rounded-lg">
                            <h3 class="font-semibold text-purple-900 mb-2 flex items-center">
                                ⏰ Timpul Investit în Frumusețe
                            </h3>
                            <p class="text-purple-800 text-sm">
                                Blana magnifică a Tervueren necesită <strong>1-2 ore de îngrijire zilnică</strong> și 
                                <strong>grooming profesional lunar</strong>. Este prețul frumuseții excepționale.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Zilnic -->
                            <div class="bg-blue-50 border border-blue-200 p-6 rounded-lg">
                                <div class="w-12 h-12 bg-blue-600 text-white rounded-lg flex items-center justify-center mb-4 text-xl">
                                    📅
                                </div>
                                <h3 class="font-semibold text-blue-900 mb-3">Îngrijire Zilnică</h3>
                                <ul class="text-blue-800 text-sm space-y-2">
                                    <li>• <strong>Periaj complet</strong> - 30-45 minute</li>
                                    <li>• <strong>Perie cu ace</strong> - pentru subblană</li>
                                    <li>• <strong>Pieptăn metalic</strong> - pentru noduri</li>
                                    <li>• <strong>Spray antistatic</strong> - pentru lustre</li>
                                    <li>• <strong>Verificare urechi</strong> - și curățare</li>
                                </ul>
                            </div>

                            <!-- Săptămânal -->
                            <div class="bg-green-50 border border-green-200 p-6 rounded-lg">
                                <div class="w-12 h-12 bg-green-600 text-white rounded-lg flex items-center justify-center mb-4 text-xl">
                                    📊
                                </div>
                                <h3 class="font-semibold text-green-900 mb-3">Rutina Săptămânală</h3>
                                <ul class="text-green-800 text-sm space-y-2">
                                    <li>• <strong>Baie cu șampon</strong> - pentru câini cu păr lung</li>
                                    <li>• <strong>Uscare cu phön</strong> - pentru volum maxim</li>
                                    <li>• <strong>Tunderea unghiilor</strong> - și pernuțelor</li>
                                    <li>• <strong>Curățarea dentară</strong> - periaj și spray</li>
                                    <li>• <strong>Masaj cu uleiuri</strong> - pentru hidratare</li>
                                </ul>
                            </div>

                            <!-- Profesional -->
                            <div class="bg-yellow-50 border border-yellow-200 p-6 rounded-lg">
                                <div class="w-12 h-12 bg-yellow-600 text-white rounded-lg flex items-center justify-center mb-4 text-xl">
                                    ✂️
                                </div>
                                <h3 class="font-semibold text-yellow-900 mb-3">Grooming Profesional</h3>
                                <ul class="text-yellow-800 text-sm space-y-2">
                                    <li>• <strong>La 4-6 săptămâni</strong> - întreținere completă</li>
                                    <li>• <strong>Tundere higiena</strong> - zone sensibile</li>
                                    <li>• <strong>Echilibrarea siluetei</strong> - pentru concursuri</li>
                                    <li>• <strong>Tratamente speciale</strong> - hidratare profundă</li>
                                    <li>• <strong>Cost:</strong> 150-250 RON/ședință</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Sezoanele -->
                        <div class="mt-8 bg-gradient-to-r from-orange-400 to-red-400 p-6 rounded-lg text-white">
                            <h3 class="font-semibold mb-4 flex items-center">
                                🍂 Îngrijirea Sezonieră
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <h4 class="font-semibold mb-2">🌸 Primăvara & Toamna (Năpârlire)</h4>
                                    <ul class="space-y-1 opacity-90">
                                        <li>• Periaj intensiv - 2x pe zi</li>
                                        <li>• FURminator sau rake pentru subblană</li>
                                        <li>• Aspirator zilnic în casă</li>
                                        <li>• Suplimente Omega-3</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-2">❄️ Iarna & Vara</h4>
                                    <ul class="space-y-1 opacity-90">
                                        <li>• Protecție solară pentru nas</li>
                                        <li>• Hidratare extra a blănii</li>
                                        <li>• Evitarea tunderii drastice</li>
                                        <li>• Băi mai rare - o dată la 2 săptămâni</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Temperament și Personalitate -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-teal-600 to-cyan-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1a3 3 0 010 6h-1m4-6h1a3 3 0 010 6h-1m3-6h.01M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
                            </svg>
                            Personalitatea Echilibrată
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Trăsături Pozitive -->
                            <div>
                                <h3 class="font-semibold text-teal-700 mb-4">🌟 Calități Excepționale</h3>
                                <div class="space-y-4">
                                    <div class="bg-teal-50 border-l-4 border-teal-500 p-4">
                                        <h4 class="font-medium text-teal-900">Echilibru Emoțional</h4>
                                        <p class="text-teal-800 text-sm mt-1">
                                            Cel mai echilibrat temperament dintre varietăți - nici prea intens, nici prea calm.
                                        </p>
                                    </div>
                                    <div class="bg-cyan-50 border-l-4 border-cyan-500 p-4">
                                        <h4 class="font-medium text-cyan-900">Adaptabilitate Superioară</h4>
                                        <p class="text-cyan-800 text-sm mt-1">
                                            Se adaptează ușor la schimbări: mutări, membrii noi în familie, rutine diferite.
                                        </p>
                                    </div>
                                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                                        <h4 class="font-medium text-blue-900">Sociabilitate Naturală</h4>
                                        <p class="text-blue-800 text-sm mt-1">
                                            Prietenos cu copii, adulți și alte animale când socializat corespunzător.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Nivel de Energie -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-4">⚡ Nivelul de Energie Perfect</h3>
                                <div class="space-y-4">
                                    <div class="bg-green-100 p-4 rounded-lg">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="font-medium text-green-900">Dimineața</span>
                                            <div class="flex space-x-1">
                                                <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                                <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                                <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                                <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                                <span class="w-3 h-3 bg-gray-300 rounded-full"></span>
                                            </div>
                                        </div>
                                        <p class="text-green-800 text-sm">Energic și dornic de activitate</p>
                                    </div>
                                    <div class="bg-blue-100 p-4 rounded-lg">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="font-medium text-blue-900">După-amiaza</span>
                                            <div class="flex space-x-1">
                                                <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                                <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                                <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                                <span class="w-3 h-3 bg-gray-300 rounded-full"></span>
                                                <span class="w-3 h-3 bg-gray-300 rounded-full"></span>
                                            </div>
                                        </div>
                                        <p class="text-blue-800 text-sm">Moderat activ, disponibil pentru joc</p>
                                    </div>
                                    <div class="bg-purple-100 p-4 rounded-lg">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="font-medium text-purple-900">Seara</span>
                                            <div class="flex space-x-1">
                                                <span class="w-3 h-3 bg-purple-500 rounded-full"></span>
                                                <span class="w-3 h-3 bg-purple-500 rounded-full"></span>
                                                <span class="w-3 h-3 bg-gray-300 rounded-full"></span>
                                                <span class="w-3 h-3 bg-gray-300 rounded-full"></span>
                                                <span class="w-3 h-3 bg-gray-300 rounded-full"></span>
                                            </div>
                                        </div>
                                        <p class="text-purple-800 text-sm">Liniștit, perfect pentru relaxare</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activități și Sport -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Activități de Excepție
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Show Ring -->
                            <div class="bg-gradient-to-br from-yellow-500 to-orange-500 text-white p-6 rounded-lg text-center">
                                <div class="text-3xl mb-3">🏆</div>
                                <h4 class="font-semibold mb-2">Expoziții Canine</h4>
                                <p class="text-sm opacity-90">
                                    Vedeta ringurilor de expoziție datorită aspectului spectaculos și prezentării naturale.
                                </p>
                            </div>

                            <!-- Agility -->
                            <div class="bg-gradient-to-br from-green-500 to-teal-500 text-white p-6 rounded-lg text-center">
                                <div class="text-3xl mb-3">🏃</div>
                                <h4 class="font-semibold mb-2">Agility & Rally</h4>
                                <p class="text-sm opacity-90">
                                    Mișcare fluidă și inteligența fac din el un competitor natural în agility.
                                </p>
                            </div>

                            <!-- Herding -->
                            <div class="bg-gradient-to-br from-blue-500 to-indigo-500 text-white p-6 rounded-lg text-center">
                                <div class="text-3xl mb-3">🐑</div>
                                <h4 class="font-semibold mb-2">Herding Trials</h4>
                                <p class="text-sm opacity-90">
                                    Instinctul de ciobănesc authentic îl face să exceleze în concursurile de păstorie.
                                </p>
                            </div>

                            <!-- Therapy -->
                            <div class="bg-gradient-to-br from-purple-500 to-pink-500 text-white p-6 rounded-lg text-center">
                                <div class="text-3xl mb-3">❤️</div>
                                <h4 class="font-semibold mb-2">Terapie Animală</h4>
                                <p class="text-sm opacity-90">
                                    Temperament blând și aspectul prietenos îl fac ideal pentru terapie asistată.
                                </p>
                            </div>

                            <!-- Tracking -->
                            <div class="bg-gradient-to-br from-red-500 to-rose-500 text-white p-6 rounded-lg text-center">
                                <div class="text-3xl mb-3">👃</div>
                                <h4 class="font-semibold mb-2">Tracking & Scent Work</h4>
                                <p class="text-sm opacity-90">
                                    Nas excelent și concentrare pentru urmărirea urmelor și detectarea mirosurilor.
                                </p>
                            </div>

                            <!-- Family Sport -->
                            <div class="bg-gradient-to-br from-teal-500 to-cyan-500 text-white p-6 rounded-lg text-center">
                                <div class="text-3xl mb-3">👨‍👩‍👧‍👦</div>
                                <h4 class="font-semibold mb-2">Sport în Familie</h4>
                                <p class="text-sm opacity-90">
                                    Perfect pentru jogging, hiking, ciclism și activități recreative cu toată familia.
                                </p>
                            </div>
                        </div>

                        <!-- Programul Zilnic Ideal -->
                        <div class="mt-8 bg-indigo-50 p-6 rounded-lg">
                            <h3 class="font-semibold text-indigo-900 mb-4">📅 Programul Zilnic Ideal</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 bg-indigo-500 rounded-full mr-3"></span>
                                        <span><strong>7:00-8:00</strong> - Plimbare energică (45 min)</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 bg-indigo-500 rounded-full mr-3"></span>
                                        <span><strong>12:00-13:00</strong> - Joc în grădină (30 min)</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 bg-indigo-500 rounded-full mr-3"></span>
                                        <span><strong>17:00-18:30</strong> - Exerciții intensive (1.5h)</span>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 bg-blue-500 rounded-full mr-3"></span>
                                        <span><strong>20:00-20:30</strong> - Antrenament mental</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 bg-blue-500 rounded-full mr-3"></span>
                                        <span><strong>21:00-22:00</strong> - Grooming și relaxare</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 bg-blue-500 rounded-full mr-3"></span>
                                        <span><strong>Total:</strong> 3-4 ore activitate zilnică</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pentru Cine Este Ideal -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-600 to-green-600 text-white p-6">
                        <h2 class="text-2xl font-semibold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            Familiile Ideale pentru Tervueren
                        </h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Perfect Pentru -->
                            <div>
                                <h3 class="font-semibold text-emerald-700 mb-4">✅ Perfect Pentru</h3>
                                <div class="space-y-4">
                                    <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-lg">
                                        <h4 class="font-medium text-emerald-900 flex items-center mb-2">
                                            👨‍👩‍👧‍👦 Familii Active cu Copii
                                        </h4>
                                        <p class="text-emerald-800 text-sm">
                                            Temperament echilibrat și răbdător cu copii de toate vârstele. Excelent companion de joacă.
                                        </p>
                                    </div>
                                    <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-lg">
                                        <h4 class="font-medium text-emerald-900 flex items-center mb-2">
                                            🏆 Pasionați de Expoziții
                                        </h4>
                                        <p class="text-emerald-800 text-sm">
                                            Cel mai spectaculos în ring, cu prezență naturală și handling ușor.
                                        </p>
                                    </div>
                                    <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-lg">
                                        <h4 class="font-medium text-emerald-900 flex items-center mb-2">
                                            🎬 Profesioniști din Industria Filmului
                                        </h4>
                                        <p class="text-emerald-800 text-sm">
                                            Prima alegere pentru producții datorită aspectului și capacității de antrenament.
                                        </p>
                                    </div>
                                    <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-lg">
                                        <h4 class="font-medium text-emerald-900 flex items-center mb-2">
                                            🏡 Proprietari cu Experiență
                                        </h4>
                                        <p class="text-emerald-800 text-sm">
                                            Pentru cei care înțeleg importanța groomingului și a exercițiilor regulate.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Provocări -->
                            <div>
                                <h3 class="font-semibold text-orange-700 mb-4">⚠️ Considerați Aceste Provocări</h3>
                                <div class="space-y-4">
                                    <div class="bg-orange-50 border border-orange-200 p-4 rounded-lg">
                                        <h4 class="font-medium text-orange-900">Îngrijirea Intensivă</h4>
                                        <p class="text-orange-800 text-sm">
                                            1-2 ore zilnic pentru grooming + costuri profesionale lunare.
                                        </p>
                                    </div>
                                    <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg">
                                        <h4 class="font-medium text-yellow-900">Năpârlire Sezonieră</h4>
                                        <p class="text-yellow-800 text-sm">
                                            Pierderea masivă de păr de 2 ori pe an necesită aspirare zilnică.
                                        </p>
                                    </div>
                                    <div class="bg-red-50 border border-red-200 p-4 rounded-lg">
                                        <h4 class="font-medium text-red-900">Costuri Mari</h4>
                                        <p class="text-red-800 text-sm">
                                            Grooming, hrană premium, produse speciale - ~400€/lună.
                                        </p>
                                    </div>
                                    <div class="bg-purple-50 border border-purple-200 p-4 rounded-lg">
                                        <h4 class="font-medium text-purple-900">Timpul Pentru Exerciții</h4>
                                        <p class="text-purple-800 text-sm">
                                            Minimum 3 ore activitate zilnică, indiferent de vreme.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Verdict Final -->
                        <div class="mt-8 bg-gradient-to-r from-green-500 to-teal-500 p-6 rounded-lg text-white">
                            <h3 class="font-semibold mb-4 flex items-center">
                                🎯 Verdictul Final
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                                <div>
                                    <h4 class="font-semibold mb-2">🌟 Alegerea Perfectă Dacă:</h4>
                                    <ul class="space-y-1 opacity-90">
                                        <li>• Iubești groomingul și îngrijirea</li>
                                        <li>• Vrei un câine spectaculos</li>
                                        <li>• Ai timp pentru exerciții zilnice</li>
                                        <li>• Dorești un companion echilibrat</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-2">⚡ Alternativa Dacă:</h4>
                                    <ul class="space-y-1 opacity-90">
                                        <li>• Vrei mai puțin grooming → <strong>Malinois</strong></li>
                                        <li>• Dorești maximă raritate → <strong>Laekenois</strong></li>
                                        <li>• Preferi simplitate → <strong>Groenendael</strong></li>
                                        <li>• Prima rasă de câine → <strong>Altă rasă</strong></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Navigation Links -->
            <div class="flex justify-between items-center mt-12">
                <a href="{{ url('/laekenois') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Laekenois
                </a>
                
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-md">
                    🏠 Pagina Principală
                </a>

                <a href="{{ url('/groenendael') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors shadow-md">
                    Groenendael
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>