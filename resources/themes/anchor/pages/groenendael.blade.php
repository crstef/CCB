<?php

use function Laravel\Folio\name;

name('groenendael');

$seo = (object) [
    'title' => 'Groenendael - Ciobanescul Belgian CCB',
    'description' => 'Descoperă varietatea Groenendael a ciobănescului belgian - temperament, caracteristici fizice și sfaturi de îngrijire.',
];

?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-2">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    Groenendael
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Eleganța neagră a Belgiei - varietatea cu păr lung și culoare neagră, simbolul distincției și noblețea
                </p>
            </div>

            <!-- Content -->
            <div class="space-y-4">
                
                <!-- Navigation varietăți -->
                <div class="flex flex-wrap justify-center gap-2 mb-2">
                    <a href="{{ url('/malinois') }}" 
                       class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Malinois
                    </a>
                    <a href="{{ url('/tervueren') }}" 
                       class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Tervueren
                    </a>
                    <a href="{{ url('/laekenois') }}" 
                       class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Laekenois
                    </a>
                    <span class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                        Groenendael
                    </span>
                </div>

                <!-- Prezentare Generală -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-800 to-black text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            ⭐ Eleganța în Stare Pură
                        </h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-700 leading-relaxed mb-3">
                            <strong>Groenendael</strong> este considerat cea mai elegantă varietate de ciobănesc belgian, 
                            fiind caracterizat prin blana sa lungă, lucioasă și de culoare neagră profundă. 
                            Această varietate îmbină armonios frumusețea cu funcționalitatea, fiind la fel de capabilă în muncă ca și în expoziții.
                        </p>
                        <div class="grid md:grid-cols-2 gap-3">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Caracteristici Principale:</h4>
                                <ul class="text-gray-700 space-y-1">
                                    <li>• Blană dublă, lungă și neagră</li>
                                    <li>• Temperament echilibrat și elegant</li>
                                    <li>• Excelent câine de familie</li>
                                    <li>• Foarte adaptabil la antrenament</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Perfect Pentru:</h4>
                                <ul class="text-gray-700 space-y-1">
                                    <li>• Familii cu experiență</li>
                                    <li>• Activități de dresaj</li>
                                    <li>• Competiții de frumusețe</li>
                                    <li>• Câine de companie loial</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Standard de Rasă -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-3">
                                                <h2 class="text-2xl font-semibold">
                            ⭐ Eleganța în Stare Pură
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Dimensiuni și Proporții</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                        <span class="font-medium">Înălțime Masculi:</span>
                                        <span class="text-blue-600 font-semibold">62-66 cm</span>
                                    </div>
                                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                        <span class="font-medium">Înălțime Femele:</span>
                                        <span class="text-pink-600 font-semibold">58-62 cm</span>
                                    </div>
                                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                        <span class="font-medium">Greutate:</span>
                                        <span class="text-green-600 font-semibold">25-30 kg</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Aspectul General</h3>
                                <ul class="text-gray-700 space-y-2">
                                    <li class="text-gray-700">
                                        ✓
                                        Câine mediu-mare, elegant și proportional
                                    </li>
                                    <li class="text-gray-700">
                                        ✓
                                        Siluetă armonioasă și echilibrată
                                    </li>
                                    <li class="text-gray-700">
                                        ✓
                                        Port de cap nobil și expresie inteligentă
                                    </li>
                                    <li class="text-gray-700">
                                        ✓
                                        Mișcare fluidă și elegantă
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blana și Culoarea -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Blana Caracteristică
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Caracteristici Blană</h3>
                                <div class="space-y-4">
                                    <div class="p-4 bg-gray-50 rounded-lg">
                                        <h4 class="font-semibold text-gray-800 mb-2">Textura</h4>
                                        <p class="text-gray-700">Păr lung, drept și abundent, cu o textură fină și mătăsoasă. Subpărul este dens și moale, oferind protecție excelentă.</p>
                                    </div>
                                    <div class="p-4 bg-gray-50 rounded-lg">
                                        <h4 class="font-semibold text-gray-800 mb-2">Lungime</h4>
                                        <p class="text-gray-700">Păr mai scurt pe cap și partea inferioară a picioarelor, mai lung pe corp, coadă și partea posterioară a picioarelor.</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Culoarea</h3>
                                <div class="space-y-4">
                                    <div class="p-4 bg-black text-white rounded-lg">
                                        <h4 class="font-semibold mb-2">Negru Pur</h4>
                                        <p>Culoarea trebuie să fie uniform neagră, fără nuanțe cafenii sau decolorări. Se admit mici pete albe pe piept.</p>
                                    </div>
                                    <div class="p-4 bg-gray-100 rounded-lg border">
                                        <h4 class="font-semibold text-gray-800 mb-2">Acceptabil</h4>
                                        <ul class="text-gray-700 space-y-1">
                                            <li>• Mică pată albă pe piept</li>
                                            <li>• Pete albe foarte mici pe vârfurile degetelor</li>
                                            <li>• Câțiva peri albi pe bărbă (la vârsta înaintată)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Temperament -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            ❤️ Temperament și Caracter
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid md:grid-cols-3 gap-3">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    🎯
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Inteligent</h3>
                                <p class="text-gray-600">Foarte receptiv la dresaj, cu capacitate excelentă de învățare și memorie de lungă durată.</p>
                            </div>
                            <div class="text-center">
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    🎯
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Afectuos</h3>
                                <p class="text-gray-600">Foarte atașat de familie, loial și protector, excelent cu copiii când este socializat corespunzător.</p>
                            </div>
                            <div class="text-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    🎯
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Energic</h3>
                                <p class="text-gray-600">Necesită exerciții zilnice și stimulare mentală pentru a-și menține echilibrul psihic.</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 p-3 bg-blue-50 rounded-xl">
                            <h3 class="text-lg font-semibold text-blue-900 mb-3">Particularități de Temperament</h3>
                            <div class="grid md:grid-cols-2 gap-4">
                                <ul class="text-blue-800 space-y-2">
                                    <li class="flex items-center">
                                        •
                                        Mai calm decât Malinois
                                    </li>
                                    <li class="flex items-center">
                                        •
                                        Echilibrat și stabil
                                    </li>
                                    <li class="flex items-center">
                                        •
                                        Excelent câine de familie
                                    </li>
                                </ul>
                                <ul class="text-blue-800 space-y-2">
                                    <li class="flex items-center">
                                        •
                                        Bun gardian, dar nu agresiv
                                    </li>
                                    <li class="flex items-center">
                                        •
                                        Se adaptează la mediul urban
                                    </li>
                                    <li class="flex items-center">
                                        •
                                        Loial și devotat stăpânului
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Îngrijire -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🧤 Îngrijire și Întreținere
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Îngrijirea Blanii</h3>
                                <div class="space-y-4">
                                    <div class="text-gray-700 space-x-3">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                                            <span class="text-blue-600 font-semibold text-sm">1</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Perii Zilnic</h4>
                                            <p class="text-gray-600">Perii zilnic pentru a evita încâlcirea și a elimina părul mort, mai ales în perioadele de năpârlire.</p>
                                        </div>
                                    </div>
                                    <div class="text-gray-700 space-x-3">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                                            <span class="text-blue-600 font-semibold text-sm">2</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Baie Ocazională</h4>
                                            <p class="text-gray-600">Baie doar când este necesar, folosind șampon specific pentru câini cu blană lungă.</p>
                                        </div>
                                    </div>
                                    <div class="text-gray-700 space-x-3">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                                            <span class="text-blue-600 font-semibold text-sm">3</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Atenție la Noduri</h4>
                                            <p class="text-gray-600">Verifică zilnic zonele predispuse la încâlcire: spatele urechilor, axila, zona inghinală.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Exerciții și Activități</h3>
                                <div class="space-y-4">
                                    <div class="p-4 bg-green-50 rounded-lg">
                                        <h4 class="font-semibold text-green-800 mb-2">📅 Zilnic</h4>
                                        <ul class="text-green-700 space-y-1">
                                            <li>• 60-90 minute exercițiu</li>
                                            <li>• Plimbări lungi sau alergare</li>
                                            <li>• Jocuri interactive în curte</li>
                                        </ul>
                                    </div>
                                    <div class="p-4 bg-blue-50 rounded-lg">
                                        <h4 class="font-semibold text-blue-800 mb-2">🧠 Mental</h4>
                                        <ul class="text-blue-700 space-y-1">
                                            <li>• Sesiuni de dresaj (10-15 min)</li>
                                            <li>• Jocuri de inteligență</li>
                                            <li>• Explorarea mediului înconjurător</li>
                                        </ul>
                                    </div>
                                    <div class="p-4 bg-purple-50 rounded-lg">
                                        <h4 class="font-semibold text-purple-800 mb-2">🏆 Competiții</h4>
                                        <ul class="text-purple-700 space-y-1">
                                            <li>• Expoziții canine de frumusețe</li>
                                            <li>• Agility și obedience</li>
                                            <li>• Tracking și căutare</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pentru Cine Este Potrivit -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-600 to-red-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            👥 Pentru Cine Este Potrivit
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-xl font-semibold text-green-800 mb-2 flex items-center">
                                    ✓
                                    Ideal Pentru:
                                </h3>
                                <ul class="space-y-3">
                                    <li class="text-gray-700 space-x-3">
                                        ✓
                                        <div>
                                            <strong class="text-gray-800">Familii cu experiență</strong>
                                            <p class="text-gray-600 text-sm">Care înțeleg nevoile unui câine de lucru și au timp pentru dresaj.</p>
                                        </div>
                                    </li>
                                    <li class="text-gray-700 space-x-3">
                                        ✓
                                        <div>
                                            <strong class="text-gray-800">Persoane active</strong>
                                            <p class="text-gray-600 text-sm">Care pot oferi exerciții zilnice și activități variate.</p>
                                        </div>
                                    </li>
                                    <li class="text-gray-700 space-x-3">
                                        ✓
                                        <div>
                                            <strong class="text-gray-800">Iubitori de frumusețe</strong>
                                            <p class="text-gray-600 text-sm">Care apreciază eleganța și sunt dispuși să investească în îngrijire.</p>
                                        </div>
                                    </li>
                                    <li class="text-gray-700 space-x-3">
                                        ✓
                                        <div>
                                            <strong class="text-gray-800">Proprietari cu curte</strong>
                                            <p class="text-gray-600 text-sm">Cu spațiu suficient pentru exerciții și joacă liberă.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-red-800 mb-2 flex items-center">
                                    ✓
                                    Nu Este Potrivit Pentru:
                                </h3>
                                <ul class="space-y-3">
                                    <li class="text-gray-700 space-x-3">
                                        ✓
                                        <div>
                                            <strong class="text-gray-800">Proprietari fără experiență</strong>
                                            <p class="text-gray-600 text-sm">Care nu au avut câini de lucru sau de talie mare anterior.</p>
                                        </div>
                                    </li>
                                    <li class="text-gray-700 space-x-3">
                                        ✓
                                        <div>
                                            <strong class="text-gray-800">Persoane foarte ocupate</strong>
                                            <p class="text-gray-600 text-sm">Care nu pot dedica timp zilnic pentru exerciții și îngrijire.</p>
                                        </div>
                                    </li>
                                    <li class="text-gray-700 space-x-3">
                                        ✓
                                        <div>
                                            <strong class="text-gray-800">Apartamente mici</strong>
                                            <p class="text-gray-600 text-sm">Fără acces la spații deschise pentru exercițiu.</p>
                                        </div>
                                    </li>
                                    <li class="text-gray-700 space-x-3">
                                        ✓
                                        <div>
                                            <strong class="text-gray-800">Persoane alergice</strong>
                                            <p class="text-gray-600 text-sm">La părul de câine - Groenendael năpârlește moderat.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Footer -->
                <div class="flex flex-col md:flex-row justify-center items-center gap-4 mt-4 pt-8 border-t border-gray-200">
                    <a href="{{ url('/istoria-ciobanescului-belgian') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors shadow-md">
                        •
                        Istoria Rasei
                    </a>
                    
                    <a href="{{ url('/') }}" 
                       class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-md">
                        🏠 Pagina Principală
                    </a>

                    <a href="{{ url('/malinois') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors shadow-md">
                        Malinois
                        •
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-layouts.marketing>