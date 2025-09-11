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
        <h1 class="text-3xl font-bold mb-4">IGP - Proba Internațională pentru Câini de Utilitate</h1>
        <p class="text-xl opacity-90">IGP (Internationale Gebrauchshund-Prüfungsordnung) reprezintă standardul internațional pentru evaluarea câinilor de serviciu și utilitate, o disciplină care testează în mod echilibrat abilitățile naturale ale câinelui în trei domenii esențiale.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">De la Schutzhund la IGP</h2>
            <p class="text-gray-700 mb-4">Dezvoltată inițial în Germania la începutul secolului XX sub numele "Schutzhund", disciplina a fost redenumită IGP în 2012 pentru a reflecta caracterul internațional.</p>
            <p class="text-gray-700">În România, IGP-ul a fost introdus în anii 1990 și a crescut constant în popularitate.</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Nivelurile IGP</h2>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start"><span class="text-green-600 mr-2">•</span><strong>IGP 1:</strong> Nivel de bază (18+ luni)</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">•</span><strong>IGP 2:</strong> Nivel intermediar (19+ luni)</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">•</span><strong>IGP 3:</strong> Nivel expert (20+ luni)</li>
            </ul>
        </div>
    </div>
    
    <div class="bg-gray-50 rounded-xl p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Cele Trei Secțiuni IGP</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg p-6 shadow-md">
                <div class="bg-green-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">A</div>
                <h3 class="font-semibold mb-2 text-center">Urmărirea</h3>
                <p class="text-gray-600 text-sm">Evaluează capacitatea de a urmări o pistă și găsi obiecte (300-800 pași, 20-60 min vechime)</p>
            </div>
            <div class="bg-white rounded-lg p-6 shadow-md">
                <div class="bg-green-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">B</div>
                <h3 class="font-semibold mb-2 text-center">Obediența</h3>
                <p class="text-gray-600 text-sm">Demonstrează controlul și colaborarea: mers la picior, aport, trimișți în față (9 exerciții)</p>
            </div>
            <div class="bg-white rounded-lg p-6 shadow-md">
                <div class="bg-green-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">C</div>
                <h3 class="font-semibold mb-2 text-center">Protecția</h3>
                <p class="text-gray-600 text-sm">Evaluează instinctul de protecție, curaj și controlabilitate (6 exerciții)</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Sistemul de Punctaj</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold mb-3">Calificative</h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start"><span class="text-yellow-500 mr-2">★</span>95-100p: Excelent (V)</li>
                    <li class="flex items-start"><span class="text-yellow-500 mr-2">★</span>90-94p: Foarte Bun (SG)</li>
                    <li class="flex items-start"><span class="text-yellow-500 mr-2">★</span>80-89p: Bun (G)</li>
                    <li class="flex items-start"><span class="text-yellow-500 mr-2">★</span>70-79p: Satisfăcător (B)</li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold mb-3">Cerințe</h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Min. 70p în fiecare secțiune</li>
                    <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Comportament echilibrat</li>
                    <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Toate exercițiile obligatorii</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Rase Tradiționale</h2>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Ciobănesc German</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Ciobănesc Belgian (toate varietățile)</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Ciobănesc Olandez</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Rottweiler</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Doberman</li>
            </ul>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Beneficiile IGP</h2>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Dezvoltarea completă fizică și mentală</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Echilibrul psihic</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Menținerea instinctelor naturale</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Cunoașterea psihologiei canine</li>
            </ul>
        </div>
    </div>
    
    <div class="bg-teal-50 border-l-4 border-teal-400 p-6 mb-8">
        <h3 class="font-bold text-teal-800 mb-2">Alătură-te Programului IGP</h3>
        <p class="text-teal-700">Clubul CCB România oferă programe complete de antrenament IGP pentru toate nivelurile. De la evaluarea inițială până la pregătirea pentru competițiile internaționale, echipa noastră de antrenori certificați te va ghida în această călătorie extraordinară.</p>
        <div class="mt-4">
            <a href="{{ route('page.show', 'contact') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                Contactează-ne pentru IGP
            </a>
        </div>
    </div>
</div>

</x-layouts.marketing>
