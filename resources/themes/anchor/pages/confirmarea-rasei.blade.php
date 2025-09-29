<?php

use function Laravel\Folio\name;

name('confirmarea-rasei');

$seo = (object) [
    'title' => 'Confirmarea Rasei - Ciobănescul Belgian | Procesul Oficial CCB',
    'description' => 'Totul despre confirmarea rasei la ciobănescul belgian: procedură, criterii, vârstă, costuri și pregătire pentru examenul oficial.',
];

?>

<x-layouts.marketing :seo="$seo">
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="text-center mb-2">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    Confirmarea Rasei
                </h1>
                <p class="text-xl text-gray-600">
                    Procesul oficial de confirmare a rasei pentru Ciobanescul Belgian
                </p>
            </div>

            <!-- Content -->
            <div class="space-y-4">
                
                <!-- Ce este Confirmarea -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Ce Înseamnă Confirmarea Rasei?
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-700 leading-relaxed mb-2">
                                    <strong>Confirmarea rasei</strong> este un examen oficial efectuat de un judecător FCI calificat, 
                                    prin care se evaluează dacă un câine respectă <strong>standardul rasei</strong> și poate fi considerat 
                                    apt pentru reproducere.
                                </p>
                                <p class="text-gray-700 leading-relaxed mb-2">
                                    Acest proces este <strong>obligatoriu</strong> pentru orice câine care va fi folosit în reproducere 
                                    și oferă o garanție oficială că exemplarul este reprezentativ pentru rasa sa.
                                </p>
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <h3 class="font-semibold text-blue-900 mb-2">🎯 Scopul Confirmării</h3>
                                    <ul class="text-blue-800 text-sm space-y-1">
                                        <li>• Păstrarea purității rasei</li>
                                        <li>• Eliminarea defectelor grave din reproducere</li>
                                        <li>• Menținerea standardului FCI</li>
                                        <li>• Certificarea calității reproducătorilor</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-100 to-indigo-100 p-3 rounded-lg">
                                <h3 class="font-semibold text-indigo-900 mb-2">📋 Rezultate Posibile</h3>
                                <div class="space-y-3">
                                    <div class="bg-green-500 text-white p-3 rounded-md">
                                        <strong>CONFIRMAT</strong><br>
                                        <small>Câinele respectă standardul și poate fi folosit în reproducere</small>
                                    </div>
                                    <div class="bg-yellow-500 text-white p-3 rounded-md">
                                        <strong>CONFIRMABIL</strong><br>
                                        <small>Cu mici rezerve, dar acceptat pentru reproducere</small>
                                    </div>
                                    <div class="bg-red-500 text-white p-3 rounded-md">
                                        <strong>NECONFIRMAT</strong><br>
                                        <small>Nu respectă standardul, nu poate fi folosit în reproducere</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Criterii și Vârsta -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Criterii și Condiții
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Vârsta și Documentele -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2 flex items-center">
                                    <span class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm mr-3">1</span>
                                    Vârsta și Documentația
                                </h3>
                                <div class="space-y-3">
                                    <div class="bg-green-50 p-4 rounded-lg">
                                        <h4 class="font-medium text-green-900">📅 Vârstă Minimă</h4>
                                        <p class="text-green-800 text-sm mt-1">
                                            <strong>15 luni</strong> pentru toate varietățile de ciobănesc belgian
                                        </p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="font-medium text-gray-900">📄 Documente Necesare</h4>
                                        <ul class="text-gray-700 text-sm mt-1 space-y-1">
                                            <li>• Pedigree original FCI</li>
                                            <li>• Certificat de vaccinare la zi</li>
                                            <li>• Carnet de sănătate</li>
                                            <li>• Dovada plății taxei de confirmare</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Criteriile de evaluare -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2 flex items-center">
                                    <span class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm mr-3">2</span>
                                    Criteriile de Evaluare
                                </h3>
                                <div class="space-y-3">
                                    <div class="border border-gray-200 p-3 rounded-lg">
                                        <h4 class="font-medium text-gray-900">🏗️ Construcție Generală</h4>
                                        <p class="text-gray-600 text-sm">Proporții, linia superioară, echilibru</p>
                                    </div>
                                    <div class="border border-gray-200 p-3 rounded-lg">
                                        <h4 class="font-medium text-gray-900">🦴 Structura Osoasă</h4>
                                        <p class="text-gray-600 text-sm">Conformația membrelor, articulații</p>
                                    </div>
                                    <div class="border border-gray-200 p-3 rounded-lg">
                                        <h4 class="font-medium text-gray-900">🧬 Caracterul Rasial</h4>
                                        <p class="text-gray-600 text-sm">Cap, urechi, ochi, expresie specifică</p>
                                    </div>
                                    <div class="border border-gray-200 p-3 rounded-lg">
                                        <h4 class="font-medium text-gray-900">🏃 Mișcarea</h4>
                                        <p class="text-gray-600 text-sm">Alura, echilibrul, puterea de propulsie</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Procesul de Evaluare -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Procesul de Evaluare
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
                            <!-- Examinarea Statică -->
                            <div class="bg-purple-50 p-3 rounded-lg">
                                <div class="w-12 h-12 bg-purple-600 text-white rounded-lg flex items-center justify-center mb-2">
                                    <span class="font-bold">1</span>
                                </div>
                                <h3 class="font-semibold text-purple-900 mb-3">Examinarea în Statică</h3>
                                <ul class="text-purple-800 text-sm space-y-2">
                                    <li>• Evaluarea construcției generale</li>
                                    <li>• Examinarea capului și expresiei</li>
                                    <li>• Verificarea muşchimii și danturii</li>
                                    <li>• Controlul dimensiunilor și proporțiilor</li>
                                    <li>• Evaluarea calității și culorii blănii</li>
                                </ul>
                            </div>

                            <!-- Examinarea în Mișcare -->
                            <div class="bg-indigo-50 p-3 rounded-lg">
                                <div class="w-12 h-12 bg-indigo-600 text-white rounded-lg flex items-center justify-center mb-2">
                                    <span class="font-bold">2</span>
                                </div>
                                <h3 class="font-semibold text-indigo-900 mb-3">Examinarea în Mișcare</h3>
                                <ul class="text-indigo-800 text-sm space-y-2">
                                    <li>• Alură pas la pas</li>
                                    <li>• Alură în trapez</li>
                                    <li>• Evaluarea din profil</li>
                                    <li>• Mișcarea frontală și posterioară</li>
                                    <li>• Coordinarea și echilibrul</li>
                                </ul>
                            </div>

                            <!-- Evaluarea Temperamentului -->
                            <div class="bg-pink-50 p-3 rounded-lg">
                                <div class="w-12 h-12 bg-pink-600 text-white rounded-lg flex items-center justify-center mb-2">
                                    <span class="font-bold">3</span>
                                </div>
                                <h3 class="font-semibold text-pink-900 mb-3">Evaluarea Temperamentului</h3>
                                <ul class="text-pink-800 text-sm space-y-2">
                                    <li>• Comportamentul cu judecătorul</li>
                                    <li>• Reacția la manipulare</li>
                                    <li>• Încrederea și echilibrul</li>
                                    <li>• Atenția și vigilența</li>
                                    <li>• Caracterul rasial specific</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Defecte și Descalificări -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-rose-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Defecte și Cauze de Descalificare
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Defecte Minore -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2 text-yellow-700 flex items-center">
                                    ⚠️ Defecte Minore (se pot tolera)
                                </h3>
                                <div class="bg-yellow-50 p-4 rounded-lg">
                                    <ul class="text-yellow-800 text-sm space-y-2">
                                        <li>• Ușoare abateri de la dimensiunile ideale</li>
                                        <li>• Mici defecte de pigmentare</li>
                                        <li>• Ușoară timiditate sau excitabilitate</li>
                                        <li>• Mici imperfecțiuni în mișcare</li>
                                        <li>• Calitatea blănii ușor sub standard</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Defecte Grave -->
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2 text-red-700 flex items-center">
                                    ❌ Cauze de Descalificare
                                </h3>
                                <div class="bg-red-50 p-4 rounded-lg">
                                    <ul class="text-red-800 text-sm space-y-2">
                                        <li>• <strong>Agresivitate</strong> sau <strong>timiditate extremă</strong></li>
                                        <li>• <strong>Monorchidism</strong> sau <strong>criptorchidism</strong></li>
                                        <li>• <strong>Prognatism</strong> superior sau inferior evident</li>
                                        <li>• <strong>Culori</strong> interzise de standard</li>
                                        <li>• <strong>Defecte anatomice</strong> grave</li>
                                        <li>• <strong>Dimensiuni</strong> foarte depărtate de standard</li>
                                        <li>• <strong>Lipsuri de dinți</strong> importante</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informații Praktice -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white p-3">
                        <h2 class="text-2xl font-semibold">
                            🔹
                            Informații Praktice
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <!-- Costuri -->
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <h3 class="font-semibold text-blue-900 mb-3">💰 Costuri (2025)</h3>
                                <ul class="text-blue-800 text-sm space-y-2">
                                    <li>• <strong>Taxa de confirmare:</strong> 150 RON</li>
                                    <li>• <strong>Certificat:</strong> 50 RON</li>
                                    <li>• <strong>Transport judecător:</strong> variabil</li>
                                    <li>• <strong>Total aproximativ:</strong> 200-300 RON</li>
                                </ul>
                            </div>

                            <!-- Pregătire -->
                            <div class="bg-green-50 p-3 rounded-lg">
                                <h3 class="font-semibold text-green-900 mb-3">🎯 Pregătirea Câinelui</h3>
                                <ul class="text-green-800 text-sm space-y-2">
                                    <li>• <strong>Socializare</strong> cu persoane străine</li>
                                    <li>• <strong>Obișnuirea</strong> cu manipularea</li>
                                    <li>• <strong>Antrenament</strong> pentru mișcare</li>
                                    <li>• <strong>Condiție fizică</strong> optimă</li>
                                </ul>
                            </div>

                            <!-- Calendar -->
                            <div class="bg-purple-50 p-3 rounded-lg">
                                <h3 class="font-semibold text-purple-900 mb-3">📅 Când se Organizează</h3>
                                <ul class="text-purple-800 text-sm space-y-2">
                                    <li>• <strong>La expozițiile</strong> canine oficiale</li>
                                    <li>• <strong>Confirmare speciale</strong> organizate de club</li>
                                    <li>• <strong>Frecvența:</strong> lunar sau bi-lunar</li>
                                    <li>• <strong>Înscriere:</strong> cu 2 săptămâni înainte</li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Contact pentru înscriere -->
                        <div class="mt-4 bg-gradient-to-r from-indigo-600 to-blue-600 p-3 rounded-lg text-white">
                            <h3 class="text-xl font-semibold mb-2">📧 Contact pentru Confirmări</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="font-semibold">Pentru informații și înscrieri:</p>
                                    <p>confirmare@ccb-romania.ro</p>
                                    <p>Telefon: +40 XXX XXX XXX</p>
                                </div>
                                <div>
                                    <p class="font-semibold">Coordinator confirmări:</p>
                                    <p>Disponibil pentru consultanță</p>
                                    <p>Program: L-V, 10:00-18:00</p>
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