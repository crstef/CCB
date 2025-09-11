<?php
use function Laravel\Folio\{name};

name('page.mondioring');

$seo = (object) [
    'title' => 'Mondioring - Disciplina de Elită pentru Câinii de Serviciu',
    'description' => 'Mondioring este o disciplină complexă și prestigioasă care testează abilitățile de lucru ale câinilor și stăpânilor într-un mediu controlat.',
    'keywords' => 'mondioring, disciplina canină, câini de serviciu, antrenament câini, competiții canine, ciobănești belgieni'
];
?>

<x-layouts.marketing 
    :seo="$seo"
    :breadcrumbs="[
        ['name' => 'Acasă', 'url' => route('wave.home')],
        ['name' => 'Discipline', 'url' => '#'],
        ['name' => 'Mondioring', 'url' => '']
    ]"
>

<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="bg-gradient-to-r from-red-600 to-orange-700 rounded-2xl p-8 mb-8 text-white">
        <h1 class="text-3xl font-bold mb-4">Mondioring</h1>
        <p class="text-xl opacity-90">Mondioring-ul reprezintă una dintre cele mai complexe și prestigioase discipline canine din lume, combinând elemente de obediență, agilitate și protecție într-un test complet al abilităților câinelui și stăpânului.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Istoric și Origini</h2>
            <p class="text-gray-700 mb-4">Dezvoltată în Franța în anii 1980, disciplina Mondioring a evoluat din sporturile canine de protecție, unind cele mai bune practici din diferite țări europene.</p>
            <p class="text-gray-700">În România, primul campionat național a fost organizat în 2010, iar Clubul de Ciobănești Belgieni și Olandezi România este unul dintre pionieri.</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Niveluri de Competiție</h2>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span><strong>MR1:</strong> Nivel inițiere (15+ luni)</li>
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span><strong>MR2:</strong> Nivel intermediar</li>
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span><strong>MR3:</strong> Nivel expert</li>
            </ul>
        </div>
    </div>
    
    <div class="bg-gray-50 rounded-xl p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Categoriile de Exerciții</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="bg-red-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-lg font-bold">100p</div>
                <h3 class="font-semibold mb-2">Obediența</h3>
                <p class="text-gray-600">Poziții de bază, mers la picior, rechemare, aport</p>
            </div>
            <div class="text-center">
                <div class="bg-red-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-lg font-bold">50p</div>
                <h3 class="font-semibold mb-2">Agilitatea</h3>
                <p class="text-gray-600">Sărituri, pod suspendat, escaladare</p>
            </div>
            <div class="text-center">
                <div class="bg-red-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-lg font-bold">200p</div>
                <h3 class="font-semibold mb-2">Protecția</h3>
                <p class="text-gray-600">Căutare figurant, păzire, apărare</p>
            </div>
        </div>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Rase Recomandate</h2>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Ciobănesc Belgian Malinois</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Ciobănesc German</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Ciobănesc Olandez</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Rottweiler</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Doberman</li>
            </ul>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Antrenamentul de Bază</h2>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Obediența fundamentală</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Mersul la picior</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Jocurile de aport</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Habituarea la echipamente</li>
            </ul>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Exercițiile Principale</h2>
        
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">1. Exerciții de Obediență (100 puncte)</h3>
            <ul class="grid md:grid-cols-2 gap-2 text-gray-700">
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span>Poziții de bază și menținere</li>
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span>Mers la picior cu și fără lesă</li>
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span>Rechemare și oprire la distanță</li>
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span>Aportul de obiecte</li>
            </ul>
        </div>
        
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">2. Exerciții de Agilitate (50 puncte)</h3>
            <ul class="grid md:grid-cols-2 gap-2 text-gray-700">
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span>Sărituri peste obstacole înalte</li>
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span>Traversarea unui pod suspendat</li>
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span>Escaladarea unei palete verticale</li>
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span>Navigarea prin diferite suprafețe</li>
            </ul>
        </div>
        
        <div>
            <h3 class="text-xl font-semibold text-gray-800 mb-3">3. Exerciții de Protecție (200 puncte)</h3>
            <ul class="grid md:grid-cols-2 gap-2 text-gray-700">
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span>Căutarea și găsirea figurantului</li>
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span>Păzirea în absența stăpânului</li>
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span>Apărarea stăpânului</li>
                <li class="flex items-start"><span class="text-red-600 mr-2">•</span>Atacul și oprirea la comandă</li>
            </ul>
        </div>
    </div>
    
    <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-8">
        <h3 class="font-bold text-blue-800 mb-2">Începe Călătoria în Mondioring</h3>
        <p class="text-blue-700">Contactează clubul nostru pentru o evaluare inițială și participă la antrenamente pentru a vedea dacă disciplina ți se potrivește. Siguranța și progresul gradual sunt prioritățile noastre.</p>
        <div class="mt-4">
            <a href="{{ route('page.show', 'contact') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                Contactează-ne pentru Mondioring
            </a>
        </div>
    </div>
</div>

</x-layouts.marketing>
