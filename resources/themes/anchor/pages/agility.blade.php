<?php
use function Laravel\Folio\{name};
name('page.show.agility');

$seo = (object) [
    'title' => 'Agility - Sportul Vitezei și Preciziei Canine',
    'description' => 'Agility este o disciplină spectaculoasă care combină viteza, agilitatea și comunicarea perfectă între câine și stăpân pe parcursuri cu obstacole.',
    'keywords' => 'agility, sport canin, obstacole câini, viteză, precizie, competiții agility, antrenament agilitate'
];
?>

<x-layouts.marketing 
    :seo="$seo"
    :breadcrumbs="[
        ['name' => 'Acasă', 'url' => route('wave.home')],
        ['name' => 'Discipline', 'url' => '#'],
        ['name' => 'Agility', 'url' => '']
    ]"
>

<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="bg-gradient-to-r from-orange-600 to-yellow-600 rounded-2xl p-8 mb-8 text-white">
        <h1 class="text-3xl font-bold mb-4">Agility - Sportul Spectaculos al Vitezei și Preciziei</h1>
        <p class="text-xl opacity-90">Agility este una dintre cele mai spectaculoase și captivante discipline canine, transformând antrenamentul într-un joc dinamic unde câinele și conducătorul formează o echipă perfectă, navigând cu viteză și precizie prin parcursuri complexe.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Începuturile în Marea Britanie</h2>
            <p class="text-gray-700 mb-4">Agility-ul a luat naștere în 1978 în Marea Britanie, când Peter Meanwell a fost rugat să creeze o activitate de divertisment pentru publicul de la Crufts Dog Show.</p>
            <p class="text-gray-700">Succesul a fost instantaneu, iar în doar câțiva ani agility-ul s-a răspândit în toată lumea, devenind unul dintre cele mai populare sporturi canine.</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Agility în România</h2>
            <p class="text-gray-700 mb-4">În România, agility-ul a fost introdus în anii 1990 și a crescut exponențial în popularitate.</p>
            <p class="text-gray-700">Astăzi, România are reprezentanți de top la competițiile internaționale, demonstrând calitatea antrenamentelor și dedicarea comunității agility românești.</p>
        </div>
    </div>
    
    <div class="bg-gray-50 rounded-xl p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Echipamentele de Agility</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Săriturile</h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start"><span class="text-orange-600 mr-2">•</span>Sărițura simplă (20-65 cm)</li>
                    <li class="flex items-start"><span class="text-orange-600 mr-2">•</span>Sărițura dublă</li>
                    <li class="flex items-start"><span class="text-orange-600 mr-2">•</span>Sărițura triplă</li>
                    <li class="flex items-start"><span class="text-orange-600 mr-2">•</span>Pneu/Cerc</li>
                    <li class="flex items-start"><span class="text-orange-600 mr-2">•</span>Peretele</li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Obstacolele de Contact</h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start"><span class="text-orange-600 mr-2">•</span>Pasarela</li>
                    <li class="flex items-start"><span class="text-orange-600 mr-2">•</span>Balanța</li>
                    <li class="flex items-start"><span class="text-orange-600 mr-2">•</span>Paleta</li>
                </ul>
                <p class="text-sm text-gray-600 mt-2">* Toate au zone de contact obligatorii</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Categorii pe Mărime</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="bg-orange-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 text-lg font-bold">S</div>
                <h3 class="font-semibold mb-2">Small</h3>
                <p class="text-gray-600 text-sm">Câini sub 35 cm<br>Sărituri: 25-35 cm</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="bg-orange-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 text-lg font-bold">M</div>
                <h3 class="font-semibold mb-2">Medium</h3>
                <p class="text-gray-600 text-sm">Câini 35-43 cm<br>Sărituri: 35-45 cm</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="bg-orange-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 text-lg font-bold">L</div>
                <h3 class="font-semibold mb-2">Large</h3>
                <p class="text-gray-600 text-sm">Câini peste 43 cm<br>Sărituri: 55-65 cm</p>
            </div>
        </div>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Rase de Excelență</h2>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Border Collie</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Australian Shepherd</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Ciobănesc Belgian Malinois</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Jack Russell Terrier</li>
                <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Golden Retriever</li>
            </ul>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Beneficiile Agility</h2>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Exercițiu fizic complet</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Stimulare mentală</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Încredere în sine</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Legătura om-câine</li>
                <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Socializarea</li>
            </ul>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Tipurile de Competiții</h2>
        <div class="space-y-4">
            <div class="border-l-4 border-orange-600 pl-4">
                <h3 class="font-semibold text-gray-800">Agility Standard</h3>
                <p class="text-gray-600">Parcursul clasic cu toate tipurile de obstacole. 15-20 obstacole, 150-200 metri.</p>
            </div>
            <div class="border-l-4 border-orange-600 pl-4">
                <h3 class="font-semibold text-gray-800">Jumping</h3>
                <p class="text-gray-600">Doar sărituri, tuneluri și slalom - fără obstacole de contact. Accent pe viteză.</p>
            </div>
            <div class="border-l-4 border-orange-600 pl-4">
                <h3 class="font-semibold text-gray-800">Gambler's Choice</h3>
                <p class="text-gray-600">Conducătorul alege ordinea obstacolelor pentru puncte maxime.</p>
            </div>
        </div>
    </div>
    
    <div class="bg-orange-50 border-l-4 border-orange-400 p-6 mb-8">
        <h3 class="font-bold text-orange-800 mb-2">Descoperă Agility-ul cu Noi</h3>
        <p class="text-orange-700">Clubul de Ciobănești Belgieni și Olandezi România organizează cursuri de agility pentru toate nivelurile, de la începători absoluti până la pregătirea pentru competițiile internaționale.</p>
        <p class="text-orange-700 mt-2">Vino să descoperi de ce agility-ul este numit "cel mai distractiv sport canin din lume"!</p>
        <div class="mt-4">
            <a href="{{ route('page.show', 'contact') }}" class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                Contactează-ne pentru Agility
            </a>
        </div>
    </div>
</div>

</x-layouts.marketing>
