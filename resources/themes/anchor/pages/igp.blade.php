<?php
use function Laravel\Folio\{name};
name('page.igp');

$seo = (object) [
    'title' => 'IGP - International Working Dog',
    'description' => 'IGP (International Working Dog) este standardul internațional pentru antrenamentul și evaluarea câinilor de serviciu în tracking, obediență și protecție.',
    'keywords' => 'IGP, International Working Dog, câini de serviciu, tracking, obediență, protecție, antrenament canin, FCI'
];
?>

<x-layouts.marketing 
    :seo="$seo"
    :breadcrumbs="[
        ['name' => 'Acasă', 'url' => route('home')],
        ['name' => 'Discipline', 'url' => '#'],
        ['name' => 'IGP', 'url' => '']
    ]"
>

<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="bg-gradient-to-r from-green-600 to-teal-700 rounded-2xl p-8 mb-8 text-white">
        <h1 class="text-3xl font-bold mb-4">IGP - Internationale Gebrauchshunde Prüfungsordnung</h1>
        <p class="text-xl opacity-90">IGP-ul e considerat cel mai complex sport canin, fiind un sport al perfecționismului si al micro-detaliului. Câinii de IGP au nevoie pentru a concura la nivel de competiție de temperamente cu psihic și instincte puternice și de caractere comunicative și echilibrate. IGP-ul este, prin excelență, sportul echipei om – câine, care cere coordonare si armonie perfecte.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Istoria</h2>
            <p class="text-gray-700 mb-4">Sportul începe in 1901, la clubul de ciobănesc german din Germania cu Max von Stephanitz, fondatorul rasei, care a conceput programul Schutzhund ca sistem de selecție pentru ciobănescul german, si metodă de păstrare a caracteristicilor polivalente ale acestuia, prin cele 3 probe pe care le conținea: pază, disciplină și urmă de miros. A fost rapid adoptat de toate cluburile de rase utilitare din Germania (dobermann, rottweiler, boxer, schnauzer) și apoi de Federația Chinologică Internațională (FCI) – forul mondial pentru câini de rasă – și transformat in principalul sport utilitar chinologic FCI.</p>
            <p class="text-gray-700">A evoluat in timp, păstrîndu-și forma de triatlon, dar schimbând-și numele, pe rând, in IPO - Internationale Prüfungs-Ordnung (in 2012) și apoi, in 2019, în IGP - Internationale Gebrauchshunde Prüfungsordnung – care se traduce exact Examinări internaționale pentru câini de lucru - examinări, la plural, pentru că sub ,,umbrela" lui stau, pe lângă cele 3 nivele complete IGP, alte 5 sporturi derivate și adiacente, cu nivele diferite de dificultate (sporturi de disciplină si subordonare, anduranță, sau chetă de obiect, de exemplu).</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Nivelurile IGP</h2>
            <p class="text-gray-700 mb-4">Pentru a putea participa la competiții FCI-IGP complexe de nivele 1 – 3, câinii, indiferent de rasă, trebuie sa promoveze in prealabil, după ce au împlinit minim 12 luni, treapta premergătoare, FCI-BH, o examinare de subordonare si socializare, parte a regulamentului IGP.</p>
            <p class="text-gray-700 mb-3">Examinările complete FCI-IGP au 3 nivele de dificultate:</p>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start"><span class="text-green-600 mr-2">•</span><strong>FCI-IGP 1:</strong> la care pot participa câini de minim 18 luni</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">•</span><strong>FCI-IGP 2:</strong> la care pot participa câini de minim 19 luni</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">•</span><strong>FCI-IGP 3:</strong> la care pot participa câini de minim 20 luni</li>
            </ul>
            <p class="text-gray-700 mt-4">In cadrul sportului FCI-IGP, competițiile și campionatele se organizează exclusiv pe nivelul maxim de dificultate (3).</p>
        </div>
    </div>
    
    <div class="bg-gray-50 rounded-xl p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Examinările si competițiile FCI-IGP 1 - 3 conțin 3 probe:</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg p-6 shadow-md">
                <div class="bg-green-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">A</div>
                <h3 class="font-semibold mb-2 text-center">proba de URMA de miros</h3>
                <p class="text-gray-600 text-sm">unde câinele trebuie sa urmeze cu exactitate urma umană (de lungimi si vechimi variate) și să identifice și semnalizeze obiecte aparținând trasatorului</p>
            </div>
            <div class="bg-white rounded-lg p-6 shadow-md">
                <div class="bg-green-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">B</div>
                <h3 class="font-semibold mb-2 text-center">proba de DISCIPLINĂ</h3>
                <p class="text-gray-600 text-sm">unde câinele trebuie să execute exerciții variate de obediență, aport, coordonare și subordonare</p>
            </div>
            <div class="bg-white rounded-lg p-6 shadow-md">
                <div class="bg-green-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">C</div>
                <h3 class="font-semibold mb-2 text-center">proba de PAZĂ</h3>
                <p class="text-gray-600 text-sm">unde câinele trebuie să semnalizeze prezența unui ,,infractor", să îi oprească atacurile și tentativa de evadare prin mușcătură, sau să îl supravegheze</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Sistemul de punctaj</h2>
        <p class="text-gray-700 mb-4">Examinările si competițiile sportive FCI-IGP se notează cu calificative si puncte, de la 0, la 300, cu maxim 100 de puncte pentru fiecare probă; pentru a promova examinarea este necesar un punctaj de minim 70% per proba și examinare.</p>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold mb-3">Calificativele se acorda procentual:</h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start"><span class="text-yellow-500 mr-2">★</span>intre 70% si 79,5% pentru <em>suficient</em></li>
                    <li class="flex items-start"><span class="text-yellow-500 mr-2">★</span>intre 80% si 89,5% pentru <em>bine</em></li>
                    <li class="flex items-start"><span class="text-yellow-500 mr-2">★</span>intre 90% si 95,5% pentru <em>foarte bine</em></li>
                    <li class="flex items-start"><span class="text-yellow-500 mr-2">★</span>intre 96% si 100% pentru <em>excelent</em></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">IGP-ul se adresează tuturor raselor</h2>
            <p class="text-gray-700 mb-4">IGP-ul se adresează tuturor raselor cu abilități fizice și psihice, dar cele mai prezente sunt ciobănescul belgian malinois si german (care, de altfel, și excelează in cadrul sportului), dobermannul, rottweilerul, ciobănescul olandez și schnauzerul uriaș.</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Utilizări ți beneficii</h2>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>metodă de selecție a raselor utilitare (caracterul său polivalent, asigură păstrarea instinctelor puternice variate și a caracterului echilibrat)</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>dezvoltare completă fizică și psihică a câinelui</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>cunoașterea psihologiei canine</li>
            </ul>
        </div>
    </div>
    
    <div class="bg-teal-50 border-l-4 border-teal-400 p-6 mb-8">
        <h3 class="font-bold text-teal-800 mb-2">Alătură-te Programului IGP</h3>
        <p class="text-teal-700">Clubul CCB România oferă programe complete de antrenament IGP pentru toate nivelurile. De la evaluarea inițială până la pregătirea pentru competițiile internaționale, echipa noastră de antrenori certificați te va ghida în această călătorie extraordinară.</p>
        <div class="mt-4">
            <a href="{{ route('contact') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                Contactează-ne pentru IGP
            </a>
        </div>
    </div>
</div>

</x-layouts.marketing>
