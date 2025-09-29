<?php

use function Laravel\Folio\name;

name('laekenois');

$seo = (object) [
    'title' => 'Laekenois - Perla Rară a Belgiei | CCB România',
    'description' => 'Descoperiți Laekenois: cea mai rară și exclusivă varietate de ciobănesc belgian, cu blana distinctă și personalitatea unică.',
];

?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-2">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    Laekenois
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Comoara ascunsă a Belgiei - cea mai rară și exclusivistă varietate de ciobănesc belgian
                </p>
            </div>

            <!-- Content -->
            <div class="space-y-2">
                
                <!-- Prezentare Rarității -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-700 to-orange-700 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            Raritatea Supremă
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-center">
                            <div>
                                <p class="text-gray-700 leading-relaxed mb-2">
                                    <strong>Laekenois</strong> este varietatea cu păr dur de ciobănesc belgian, numită după 
                                    <strong>Château de Laeken</strong> - reședința regală belgiană. Dezvoltată în <strong>1885</strong>, 
                                    a fost inițial preferata Reginei Marie-Henriette a Belgiei.
                                </p>
                                <p class="text-gray-700 leading-relaxed mb-2">
                                    Cu mai puțin de <strong>2% din populația mondială</strong> de ciobănești belgieni, 
                                    Laekenois reprezintă o <strong>comoară genetică vivă</strong>. Fiecare exemplar este prețios, 
                                    iar proprietatea unui Laekenois este considerată un privilegiu special.
                                </p>
                                <div class="bg-amber-100 p-4 rounded-lg">
                                    <h3 class="font-semibold text-amber-900 mb-2">Statut Regal</h3>
                                    <p class="text-amber-800 text-sm">
                                        Singura varietate care a fost <strong>câinele oficial al Casei Regale Belgiene</strong>, 
                                        fiind iubită de Regina Marie-Henriette pentru temperamentul său rafinat.
                                    </p>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-amber-700 to-orange-700 p-3 rounded-lg text-black">
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span>Procent mondial:</span>
                                        <span><strong>< 2%</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Număr estimat global:</span>
                                        <span><strong>~3,000</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Țări cu programe:</span>
                                        <span><strong>~15</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Lista de așteptare:</span>
                                        <span><strong>2-5 ani</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Preț mediu:</span>
                                        <span><strong>3,000€+</strong></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Recunoaștere FCI:</span>
                                        <span><strong>1959</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blana Unică -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-teal-600 to-cyan-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            Blana Caracteristică - "Wire-haired"
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <!-- Textura Unică -->
                            <div class="bg-teal-50 p-3 rounded-lg border-2 border-teal-300">
                                <h3 class="font-semibold text-teal-900 mb-2">🧵 Textura Unică</h3>
                                <div class="space-y-2 text-sm text-teal-800">
                                    <div class="text-gray-700">
                                        <span class="w-2 h-2 bg-teal-600 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                        <div>
                                            <strong>Păr dur și aspru</strong> - textura ca sârma de oțel
                                        </div>
                                    </div>
                                    <div class="text-gray-700">
                                        <span class="w-2 h-2 bg-teal-600 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                        <div>
                                            <strong>Lungime neuniformă</strong> - ~6cm pe corp, mai lung pe cap
                                        </div>
                                    </div>
                                    <div class="text-gray-700">
                                        <span class="w-2 h-2 bg-teal-600 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                        <div>
                                            <strong>Sprâncene și mustață</strong> - conferă expresie distinctă
                                        </div>
                                    </div>
                                    <div class="text-gray-700">
                                        <span class="w-2 h-2 bg-teal-600 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                        <div>
                                            <strong>Barbă discretă</strong> - pe partea inferioară a botului
                                        </div>
                                    </div>
                                    <div class="text-gray-700">
                                        <span class="w-2 h-2 bg-teal-600 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                        <div>
                                            <strong>Rezistentă la intemperii</strong> - protecție naturală
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Îngrijirea Specială -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">Îngrijire Specializată</h3>
                                <div class="space-y-2">
                                    <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                                        <h4 class="font-medium text-blue-900">Hand-Stripping Obligatoriu</h4>
                                        <p class="text-blue-800 text-sm mt-1">
                                            Părul mort se îndepărtează manual, de 2-3 ori pe an. NU se tunde cu mașina.
                                        </p>
                                    </div>
                                    <div class="bg-green-50 border border-green-200 p-4 rounded-lg">
                                        <h4 class="font-medium text-green-900">Periaj Zilnic</h4>
                                        <p class="text-green-800 text-sm mt-1">
                                            Perie cu dinți metalici pentru a preveni formarea nodurilor.
                                        </p>
                                    </div>
                                    <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg">
                                        <h4 class="font-medium text-yellow-900">Îmbăiere Rară</h4>
                                        <p class="text-yellow-800 text-sm mt-1">
                                            Maximum 4 băi pe an - blana se auto-curăță natural.
                                        </p>
                                    </div>
                                    <div class="bg-purple-50 border border-purple-200 p-4 rounded-lg">
                                        <h4 class="font-medium text-purple-900">Groomer Specialist</h4>
                                        <p class="text-purple-800 text-sm mt-1">
                                            Necesită groomer cu experiență în rase wire-haired.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Paleta de Culori -->
                        <div class="mt-4 bg-gradient-to-r from-amber-200 to-orange-200 p-3 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2">🎨 Paleta de Culori Acceptate</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div class="bg-yellow-600 text-white p-3 rounded text-center">
                                    <strong>Fawn</strong><br>
                                    Galben-roșcat
                                </div>
                                <div class="bg-red-600 text-white p-3 rounded text-center">
                                    <strong>Mahon</strong><br>
                                    Roșcat intens
                                </div>
                                <div class="bg-orange-600 text-white p-3 rounded text-center">
                                    <strong>Red</strong><br>
                                    Roșu pur
                                </div>
                                <div class="bg-amber-700 text-white p-3 rounded text-center">
                                    <strong>Sable</strong><br>
                                    Cu carbonaj
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Temperament Rafinat -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            Personalitatea Rafinată
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <!-- Trăsături Distintive -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2 text-purple-700">✨ Trăsături Distintive</h3>
                                <div class="space-y-2">
                                    <div class="bg-purple-50 border-l-4 border-purple-500 p-4">
                                        <h4 class="font-medium text-purple-900">Inteligența Subtilă</h4>
                                        <p class="text-purple-800 text-sm mt-1">
                                            Înțelegere profundă a emoțiilor umane, capacitate de a anticipa dorințele.
                                        </p>
                                    </div>
                                    <div class="bg-indigo-50 border-l-4 border-indigo-500 p-4">
                                        <h4 class="font-medium text-indigo-900">Rezerva Aristocrată</h4>
                                        <p class="text-indigo-800 text-sm mt-1">
                                            Politețe cu străinii, dar fără supunere oarbă. Alege cu cine se împrietenește.
                                        </p>
                                    </div>
                                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                                        <h4 class="font-medium text-blue-900">Sensibilitate Emoțională</h4>
                                        <p class="text-blue-800 text-sm mt-1">
                                            Răspunde la ton și energie, necesită abordare calmă și pozitivă.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Relații Sociale -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2 text-indigo-700">👥 Relații Sociale</h3>
                                <div class="space-y-2">
                                    <div class="bg-green-100 p-4 rounded-lg">
                                        <h4 class="font-medium text-green-900">Cu Familia</h4>
                                        <p class="text-green-800 text-sm">
                                            Devotament total, leg speciale cu copii, protector dar gentle.
                                        </p>
                                    </div>
                                    <div class="bg-yellow-100 p-4 rounded-lg">
                                        <h4 class="font-medium text-yellow-900">Cu Alte Animale</h4>
                                        <p class="text-yellow-800 text-sm">
                                            Tolerant și prietenos dacă socializat timpuriu, lipsit de agresivitate.
                                        </p>
                                    </div>
                                    <div class="bg-blue-100 p-4 rounded-lg">
                                        <h4 class="font-medium text-blue-900">Cu Străinii</h4>
                                        <p class="text-blue-800 text-sm">
                                            Observator și precaut, dar nu agresiv. Așteaptă "permisiunea" familiei.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Activități Preferate -->
                        <div class="mt-4">
                            <h3 class="font-semibold text-gray-900 mb-2">Activități Ideale pentru Laekenois</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div class="bg-gradient-to-br from-green-500 to-teal-500 text-white p-3 rounded-lg text-center">
                                    <h4 class="font-semibold mb-2">Agility & Obedienta</h4>
                                    <p class="text-sm opacity-90">Excelează în competițiile de agilitate și obediență datorită inteligenței și cooperării.</p>
                                </div>
                                <div class="bg-gradient-to-br from-blue-500 to-indigo-500 text-white p-3 rounded-lg text-center">
                                    <h4 class="font-semibold mb-2">Terapie & Asistență</h4>
                                    <p class="text-sm opacity-90">Temperament calm și empatie fac din el un câine terapeutic excepțional.</p>
                                </div>
                                <div class="bg-gradient-to-br from-purple-500 to-pink-500 text-white p-3 rounded-lg text-center">
                                    <h4 class="font-semibold mb-2">Hiking & Aventură</h4>
                                    <p class="text-sm opacity-90">Companion perfect pentru drumeții lungi și explorarea naturii.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Proprietarul Ideal -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            Proprietarul Perfect pentru Laekenois
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <!-- Caracteristici Esențiale -->
                            <div>
                                <h3 class="font-semibold text-emerald-700 mb-2">✅ Proprietarul Ideal</h3>
                                <div class="space-y-2">
                                    <div class="text-gray-700 bg-emerald-50 p-3 rounded-lg">
                                        ✓
                                        <div>
                                            <strong class="text-emerald-900">Experiență cu rase de lucru</strong>
                                            <p class="text-emerald-800 text-sm">Înțelege nevoile mentale și fizice complexe</p>
                                        </div>
                                    </div>
                                    <div class="text-gray-700 bg-emerald-50 p-3 rounded-lg">
                                        ✓
                                        <div>
                                            <strong class="text-emerald-900">Lifestyle activ</strong>
                                            <p class="text-emerald-800 text-sm">Timpul și energia pentru 2+ ore de activitate zilnică</p>
                                        </div>
                                    </div>
                                    <div class="text-gray-700 bg-emerald-50 p-3 rounded-lg">
                                        ✓
                                        <div>
                                            <strong class="text-emerald-900">Răbdare și consistență</strong>
                                            <p class="text-emerald-800 text-sm">Abordare calmă, pozitivă în antrenament</p>
                                        </div>
                                    </div>
                                    <div class="text-gray-700 bg-emerald-50 p-3 rounded-lg">
                                        ✓
                                        <div>
                                            <strong class="text-emerald-900">Resurse financiare</strong>
                                            <p class="text-emerald-800 text-sm">Pentru îngrijire specializată și costuri medicale</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Situații Nepotrivite -->
                            <div>
                                <h3 class="font-semibold text-red-700 mb-2">❌ Nu Este Potrivit Pentru</h3>
                                <div class="space-y-2">
                                    <div class="text-gray-700 bg-red-50 p-3 rounded-lg">
                                        ✓
                                        <div>
                                            <strong class="text-red-900">Prima rasă de câine</strong>
                                            <p class="text-red-800 text-sm">Necesită experiență anterioară cu câini</p>
                                        </div>
                                    </div>
                                    <div class="text-gray-700 bg-red-50 p-3 rounded-lg">
                                        ✓
                                        <div>
                                            <strong class="text-red-900">Lifestyle sedentar</strong>
                                            <p class="text-red-800 text-sm">Apartament fără grădină, lipsă activitate</p>
                                        </div>
                                    </div>
                                    <div class="text-gray-700 bg-red-50 p-3 rounded-lg">
                                        ✓
                                        <div>
                                            <strong class="text-red-900">Copii foarte mici</strong>
                                            <p class="text-red-800 text-sm">Sub 6 ani - poate fi prea energic</p>
                                        </div>
                                    </div>
                                    <div class="text-gray-700 bg-red-50 p-3 rounded-lg">
                                        ✓
                                        <div>
                                            <strong class="text-red-900">Absențe lungi</strong>
                                            <p class="text-red-800 text-sm">Singur >6 ore/zi - poate dezvolta anxietate</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Procesul de Achiziție -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-rose-600 to-pink-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            Procesul de Achiziție
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="mb-3 bg-rose-50 border border-rose-200 p-4 rounded-lg">
                            <h3 class="font-semibold text-rose-900 mb-2 flex items-center">
                                Realitatea Rarității
                            </h3>
                            <p class="text-rose-800 text-sm">
                                Din cauza numărului extrem de mic de crescători autorizați și a standardelor înalte, 
                                <strong>achiziția unui Laekenois poate dura 2-5 ani</strong> și necesită o <strong>evaluare atentă</strong> a viitorilor proprietari.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Processul -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">📋 Pașii Achiziției</h3>
                                <div class="space-y-2">
                                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                                        <h4 class="font-medium text-blue-900">1. Cercetarea Crescătorilor</h4>
                                        <p class="text-blue-800 text-sm mt-1">
                                            Identificarea crescătorilor FCI autorizați, verificarea reputației și rezultatelor.
                                        </p>
                                    </div>
                                    <div class="bg-green-50 border-l-4 border-green-500 p-4">
                                        <h4 class="font-medium text-green-900">2. Aplicația și Interviul</h4>
                                        <p class="text-green-800 text-sm mt-1">
                                            Completarea aplicației detaliate, interviuri multiple, vizite la crescătorie.
                                        </p>
                                    </div>
                                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4">
                                        <h4 class="font-medium text-yellow-900">3. Lista de Așteptare</h4>
                                        <p class="text-yellow-800 text-sm mt-1">
                                            Înscrierea pe lista de așteptare, plata avansului pentru rezervarea unui cățel.
                                        </p>
                                    </div>
                                    <div class="bg-purple-50 border-l-4 border-purple-500 p-4">
                                        <h4 class="font-medium text-purple-900">4. Nașterea și Selecția</h4>
                                        <p class="text-purple-800 text-sm mt-1">
                                            Urmărirea gestației, evaluarea cățelilor, selecția pe bază de temperament.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Costuri -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">💰 Investiția Financiară</h3>
                                <div class="space-y-2">
                                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white p-4 rounded-lg">
                                        <h4 class="font-semibold mb-2">Cățel de Companie</h4>
                                        <div class="text-2xl font-bold">3,000€ - 4,500€</div>
                                        <p class="text-sm opacity-90 mt-1">Fără drepturi de reproducere</p>
                                    </div>
                                    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white p-4 rounded-lg">
                                        <h4 class="font-semibold mb-2">Exemplar de Breeding</h4>
                                        <div class="text-2xl font-bold">5,000€ - 7,500€</div>
                                        <p class="text-sm opacity-90 mt-1">Cu potențial reproductiv</p>
                                    </div>
                                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-lg">
                                        <h4 class="font-semibold mb-2">Campion Potențial</h4>
                                        <div class="text-2xl font-bold">8,000€+</div>
                                        <p class="text-sm opacity-90 mt-1">Din linii de campioni</p>
                                    </div>
                                </div>

                                <div class="mt-4 bg-amber-100 p-4 rounded-lg">
                                    <h4 class="font-medium text-amber-900">💡 Costuri Suplimentare</h4>
                                    <ul class="text-amber-800 text-sm mt-2 space-y-1">
                                        <li>• Transport internațional: 500€-1,500€</li>
                                        <li>• Hand-stripping profesional: 80€-120€/ședință</li>
                                        <li>• Hrană premium: 100€-150€/lună</li>
                                        <li>• Controale veterinare: 200€-400€/an</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Navigation Links -->
            <div class="flex flex-col md:flex-row justify-center items-center gap-4 mt-4 pt-8 border-t border-gray-200">
                <a href="{{ url('/malinois') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                    &larr; Malinois
                </a>
                
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors shadow-lg">
                    Pagina Principală
                </a>

                <a href="{{ url('/tervueren') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                    Tervueren &rarr;
                </a>
            </div>
        </div>
    </div>
</x-layouts.marketing>