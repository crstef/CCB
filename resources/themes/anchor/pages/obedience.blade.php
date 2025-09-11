<?php
use function Laravel\Folio\{name};
name('page.show.obedience');

$seo = (object) [
    'title' => 'Obedience - Disciplina Clasică a Obedienței Canine',
    'description' => 'Obedience este disciplina care testează precizia și armonia în executarea exercițiilor de obediență între câine și conducător.',
    'keywords' => 'obedience, obediență canină, disciplina clasică, antrenament precizie, competiții obediență, exerciții canine'
];
?>

<x-layouts.marketing 
    :seo="$seo"
    :breadcrumbs="[
        ['name' => 'Acasă', 'url' => route('home')],
        ['name' => 'Discipline', 'url' => '#'],
        ['name' => 'Obedience', 'url' => '']
    ]"
    ]"
>

<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-2xl p-8 mb-8 text-white">
        <h1 class="text-3xl font-bold mb-4">Obedience - Disciplina Clasică a Obedienței Canine</h1>
        <p class="text-xl opacity-90">Obedience este disciplina care testează precizia, concentrarea și armonia perfectă în executarea exercițiilor de obediență între câine și conducător, reprezentând forma cea mai rafinată a colaborării canine.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Esența Obedience</h2>
            <p class="text-gray-700 mb-4">Obedience nu este doar despre ascultare - este despre comunicarea perfectă, sincronizarea și încrederea reciprocă între câine și conducător.</p>
            <p class="text-gray-700">Fiecare exercițiu este evaluat pentru precizie, viteză de execuție, dorința de a lucra și armonia generală.</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Istoric și Evoluție</h2>
            <p class="text-gray-700 mb-4">Dezvoltată inițial în Statele Unite și Marea Britanie, disciplina Obedience a evoluat către un standard internațional FCI recunoscut în toată lumea.</p>
            <p class="text-gray-700">În România, competițiile de Obedience se desfășoară conform regulamentelor FCI din 1990.</p>
        </div>
    </div>
    
    <div class="bg-gray-50 rounded-xl p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Clasele de Competiție</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg p-6 shadow-md">
                <div class="bg-indigo-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                <h3 class="font-semibold mb-2 text-center">Clasa 1 (Beginner)</h3>
                <p class="text-gray-600 text-sm">Exerciții de bază: poziții statice, mers la picior, rechemare simplă</p>
                <p class="text-indigo-600 text-sm font-medium mt-2">Punctaj maxim: 200</p>
            </div>
            <div class="bg-white rounded-lg p-6 shadow-md">
                <div class="bg-indigo-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                <h3 class="font-semibold mb-2 text-center">Clasa 2 (Novice)</h3>
                <p class="text-gray-600 text-sm">Exerciții intermediare: aport, trimițți în față, poziții la distanță</p>
                <p class="text-indigo-600 text-sm font-medium mt-2">Punctaj maxim: 200</p>
            </div>
            <div class="bg-white rounded-lg p-6 shadow-md">
                <div class="bg-indigo-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                <h3 class="font-semibold mb-2 text-center">Clasa 3 (Open)</h3>
                <p class="text-gray-600 text-sm">Exerciții avansate: aport cu direcționare, control de miros, precizie maximă</p>
                <p class="text-indigo-600 text-sm font-medium mt-2">Punctaj maxim: 200</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Exercițiile Principale</h2>
        
        <div class="space-y-6">
            <div class="border-l-4 border-indigo-600 pl-4">
                <h3 class="font-semibold text-gray-800 mb-2">Mersul la picior fără lesă</h3>
                <p class="text-gray-600">Câinele menține poziția perfectă lângă conducător în toate alurile și schimbările de direcție</p>
                <div class="flex items-center mt-2">
                    <span class="text-indigo-600 text-sm font-medium">Clasa 1-3 | 15-20 puncte</span>
                </div>
            </div>
            
            <div class="border-l-4 border-indigo-600 pl-4">
                <h3 class="font-semibold text-gray-800 mb-2">Poziții în mișcare</h3>
                <p class="text-gray-600">Câinele execută poziții (șezi, culcat, stai) în timp ce conducătorul continuă să meargă</p>
                <div class="flex items-center mt-2">
                    <span class="text-indigo-600 text-sm font-medium">Clasa 2-3 | 10-15 puncte</span>
                </div>
            </div>
            
            <div class="border-l-4 border-indigo-600 pl-4">
                <h3 class="font-semibold text-gray-800 mb-2">Rechemarea cu oprire</h3>
                <p class="text-gray-600">Câinele este chemat din poziție și se oprește în șezi în fața conducătorului la comandă</p>
                <div class="flex items-center mt-2">
                    <span class="text-indigo-600 text-sm font-medium">Clasa 1-3 | 10-20 puncte</span>
                </div>
            </div>
            
            <div class="border-l-4 border-indigo-600 pl-4">
                <h3 class="font-semibold text-gray-800 mb-2">Aportul</h3>
                <p class="text-gray-600">De la simplu (Clasa 1) la aport cu direcționare și selectare din mai multe obiecte (Clasa 3)</p>
                <div class="flex items-center mt-2">
                    <span class="text-indigo-600 text-sm font-medium">Clasa 1-3 | 10-25 puncte</span>
                </div>
            </div>
            
            <div class="border-l-4 border-indigo-600 pl-4">
                <h3 class="font-semibold text-gray-800 mb-2">Trimișți în față</h3>
                <p class="text-gray-600">Câinele aleargă în linie dreaptă într-o direcție indicată și se așază la comandă</p>
                <div class="flex items-center mt-2">
                    <span class="text-indigo-600 text-sm font-medium">Clasa 2-3 | 10-15 puncte</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Rase Potrivite</h2>
            <p class="text-gray-700 mb-3">Orice rasă poate excela în Obedience cu antrenament adecvat:</p>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Golden Retriever</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Border Collie</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Ciobănesc German</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Poodle (toate mărimile)</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Labrador Retriever</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Și multe altele!</li>
            </ul>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Calitățile Necesare</h2>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span><strong>Concentrarea:</strong> Atenție focalizată pe conducător</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span><strong>Precizia:</strong> Execuție exactă a comenzilor</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span><strong>Răbdarea:</strong> Menținerea poziției pentru perioade îndelungate</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span><strong>Motivația:</strong> Dorința de a lucra și de a face pe plac</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span><strong>Adaptabilitatea:</strong> Lucrul în medii diferite</li>
            </ul>
        </div>
    </div>
    
    <div class="bg-gray-50 rounded-xl p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Sistemul de Evaluare</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Criterii de Evaluare</h3>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start"><span class="text-purple-600 mr-2">•</span><strong>Precizia execuției:</strong> 40%</li>
                    <li class="flex items-start"><span class="text-purple-600 mr-2">•</span><strong>Viteza de reacție:</strong> 25%</li>
                    <li class="flex items-start"><span class="text-purple-600 mr-2">•</span><strong>Dorința de a lucra:</strong> 20%</li>
                    <li class="flex items-start"><span class="text-purple-600 mr-2">•</span><strong>Armonia generală:</strong> 15%</li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Calificativele</h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start"><span class="text-yellow-500 mr-2">★</span>96-100: Excelent</li>
                    <li class="flex items-start"><span class="text-yellow-500 mr-2">★</span>90-95: Foarte Bun</li>
                    <li class="flex items-start"><span class="text-yellow-500 mr-2">★</span>80-89: Bun</li>
                    <li class="flex items-start"><span class="text-yellow-500 mr-2">★</span>70-79: Satisfăcător</li>
                    <li class="text-sm text-gray-600 mt-2">*Minimum 70 pentru calificare</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Antrenamentul pas cu pas</h2>
        <div class="space-y-4">
            <div class="bg-indigo-50 p-4 rounded-lg">
                <h3 class="font-semibold text-indigo-800 mb-2">1. Fundamentele (1-3 luni)</h3>
                <p class="text-indigo-700 text-sm">Comenzile de bază, poziții statice, concentrarea și recompensarea</p>
            </div>
            <div class="bg-indigo-50 p-4 rounded-lg">
                <h3 class="font-semibold text-indigo-800 mb-2">2. Precizia (3-6 luni)</h3>
                <p class="text-indigo-700 text-sm">Rafinarea poziției, timing perfect, eliminarea erorilor minore</p>
            </div>
            <div class="bg-indigo-50 p-4 rounded-lg">
                <h3 class="font-semibold text-indigo-800 mb-2">3. Distanța și Complexitatea (6-12 luni)</h3>
                <p class="text-indigo-700 text-sm">Lucrul la distanță, aport, exerciții combinate</p>
            </div>
            <div class="bg-indigo-50 p-4 rounded-lg">
                <h3 class="font-semibold text-indigo-800 mb-2">4. Perfecționarea (12+ luni)</h3>
                <p class="text-indigo-700 text-sm">Pregătirea pentru competiții, consistency, armonie perfectă</p>
            </div>
        </div>
    </div>
    
    <div class="bg-purple-50 border-l-4 border-purple-400 p-6 mb-8">
        <h3 class="font-bold text-purple-800 mb-2">Descopera Armonia Perfectă</h3>
        <p class="text-purple-700">Obedience este mai mult decât un sport - este o artă care celebrează comunicarea perfectă între om și câine. Fiecare exercițiu executat cu precizie întărește legătura și înțelegerea reciprocă.</p>
        <p class="text-purple-700 mt-2">Clubul CCB România oferă programe structurate de Obedience pentru toate nivelurile, de la începători până la pregătirea pentru competițiile naționale și internaționale.</p>
        <div class="mt-4">
            <a href="{{ route('page.show', 'contact') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                Începe Călătoria în Obedience
            </a>
        </div>
    </div>
</div>

</x-layouts.marketing>
