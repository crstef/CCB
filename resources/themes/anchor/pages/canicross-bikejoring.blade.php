<?php
$seo = (object) [
    'title' => 'Canicross și Bikejoring - Alergarea cu Câinele',
    'description' => 'Canicross și Bikejoring sunt disciplinele care combină sportul uman cu puterea și rezistența câinilor. Descoperă aceste sporturi dinamice de alergare și ciclism.',
    'keywords' => 'canicross, bikejoring, alergare câini, sport canin, antrenament rezistență, echipament canicross, competiții alergare'
];
?>

<x-layouts.marketing 
    :seo="$seo"
    :breadcrumbs="[
        ['name' => 'Acasă', 'url' => route('wave.home')],
        ['name' => 'Discipline', 'url' => '#'],
        ['name' => 'Canicross-Bikejoring', 'url' => '']
    ]"
>

<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="bg-gradient-to-r from-emerald-600 to-cyan-600 rounded-2xl p-8 mb-8 text-white">
        <h1 class="text-3xl font-bold mb-4">Canicross și Bikejoring - Alergarea cu Câinele</h1>
        <p class="text-xl opacity-90">Canicross și Bikejoring sunt disciplinele care combină sportul uman cu puterea și rezistența câinilor, creând o experiență unică de colaborare și performanță în natură.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 mb-12">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Ce este Canicross?</h2>
            <p class="text-gray-700 mb-4">Canicross este sportul de alergare în care omul și câinele aleargă împreună, conectați printr-un sistem de lesă și ham special conceput.</p>
            <p class="text-gray-700">Câinele aleargă în față, ajutând la tracțiune, iar alergătorul urmează într-un ritm sincronizat.</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Ce este Bikejoring?</h2>
            <p class="text-gray-700 mb-4">Bikejoring combină ciclismul cu puterea de tracțiune a câinilor. Câinele este conectat la bicicletă prin sisteme speciale de siguranță.</p>
            <p class="text-gray-700">Poate fi practicat cu unul sau mai mulți câini, oferind o experiență dinamică pe diverse terenuri.</p>
        </div>
    </div>
    
    <div class="bg-gray-50 rounded-xl p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Echipamentul Necesar</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-xl font-semibold text-emerald-800 mb-4">Pentru Canicross</h3>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start"><span class="text-emerald-600 mr-2">•</span><strong>Ham X-Back pentru câine:</strong> Distribuie forța uniform</li>
                    <li class="flex items-start"><span class="text-emerald-600 mr-2">•</span><strong>Centura pentru alergător:</strong> Cu atașament pentru lesă</li>
                    <li class="flex items-start"><span class="text-emerald-600 mr-2">•</span><strong>Lesă elastică:</strong> Absoarbe șocurile și impactul</li>
                    <li class="flex items-start"><span class="text-emerald-600 mr-2">•</span><strong>Încălțăminte trail:</strong> Aderentă pe teren variat</li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-cyan-800 mb-4">Pentru Bikejoring</h3>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start"><span class="text-cyan-600 mr-2">•</span><strong>Sistem antenne bikejoring:</strong> Ține lesa departe de roți</li>
                    <li class="flex items-start"><span class="text-cyan-600 mr-2">•</span><strong>Ham de tracțiune:</strong> Specializat pentru bikejoring</li>
                    <li class="flex items-start"><span class="text-cyan-600 mr-2">•</span><strong>Lesă cu amortizor:</strong> Reduce șocurile bruște</li>
                    <li class="flex items-start"><span class="text-cyan-600 mr-2">•</span><strong>Echipament de protecție:</strong> Cască, genunchiere</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Rase Potrivite</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Rase de Excelență</h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Husky Siberian</li>
                    <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Alaskan Malamute</li>
                    <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Border Collie</li>
                    <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Pointer German</li>
                    <li class="flex items-start"><span class="text-green-600 mr-2">✓</span>Weimaraner</li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Caracteristici Ideale</h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Rezistență cardio-vasculară</li>
                    <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Motivație pentru alergare</li>
                    <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Obediență de bază</li>
                    <li class="flex items-start"><span class="text-blue-600 mr-2">•</span>Vârsta: 12-18 luni minimum</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 mb-8">
        <div class="bg-emerald-50 rounded-xl p-6">
            <h2 class="text-2xl font-bold text-emerald-800 mb-4">Antrenamentul Canicross</h2>
            <div class="space-y-4">
                <div>
                    <h3 class="font-semibold text-emerald-700">Etapa 1: Habituarea (2-4 săptămâni)</h3>
                    <p class="text-emerald-600 text-sm">Obișnuirea cu echipamentul și comenzile de bază</p>
                </div>
                <div>
                    <h3 class="font-semibold text-emerald-700">Etapa 2: Distanțe Scurte (1-2 km)</h3>
                    <p class="text-emerald-600 text-sm">Construirea condiției fizice gradual</p>
                </div>
                <div>
                    <h3 class="font-semibold text-emerald-700">Etapa 3: Competiție (5-10 km)</h3>
                    <p class="text-emerald-600 text-sm">Antrenament specific pentru curse</p>
                </div>
            </div>
        </div>
        <div class="bg-cyan-50 rounded-xl p-6">
            <h2 class="text-2xl font-bold text-cyan-800 mb-4">Antrenamentul Bikejoring</h2>
            <div class="space-y-4">
                <div>
                    <h3 class="font-semibold text-cyan-700">Siguranța Primul</h3>
                    <p class="text-cyan-600 text-sm">Învățarea comenzilor: stânga, dreapta, stop</p>
                </div>
                <div>
                    <h3 class="font-semibold text-cyan-700">Viteze Controlate</h3>
                    <p class="text-cyan-600 text-sm">Începere cu viteze mici pe teren plat</p>
                </div>
                <div>
                    <h3 class="font-semibold text-cyan-700">Teren Variat</h3>
                    <p class="text-cyan-600 text-sm">Progresiv: pădure, deal, trail tehnic</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Comenzile Esențiale</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <h3 class="font-semibold mb-2 text-gray-800">Direcție</h3>
                <p class="text-gray-600 text-sm">"Gee" (dreapta)<br>"Haw" (stânga)<br>"Straight" (drept)</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <h3 class="font-semibold mb-2 text-gray-800">Viteză</h3>
                <p class="text-gray-600 text-sm">"Go" (accelerează)<br>"Easy" (încetinește)<br>"Woah" (oprește)</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <h3 class="font-semibold mb-2 text-gray-800">Poziție</h3>
                <p class="text-gray-600 text-sm">"Line out" (întinde lesa)<br>"Stay" (stai în poziție)</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Competițiile în România</h2>
        <div class="space-y-4">
            <div class="border-l-4 border-emerald-600 pl-4">
                <h3 class="font-semibold text-gray-800">Campionatul Național de Canicross</h3>
                <p class="text-gray-600">Anual, toamna, cu categorii pe distanțe și vârste</p>
            </div>
            <div class="border-l-4 border-cyan-600 pl-4">
                <h3 class="font-semibold text-gray-800">Cupa României la Bikejoring</h3>
                <p class="text-gray-600">Serie de curse pe parcursul anului în diverse locații</p>
            </div>
            <div class="border-l-4 border-purple-600 pl-4">
                <h3 class="font-semibold text-gray-800">Curse Locale și Regionale</h3>
                <p class="text-gray-600">Evenimente lunare pentru începători și avansați</p>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-r from-emerald-50 to-cyan-50 border-l-4 border-emerald-400 p-6 mb-8">
        <h3 class="font-bold text-emerald-800 mb-2">Începe Aventura în Natură</h3>
        <p class="text-emerald-700">Canicross și Bikejoring oferă o modalitate unică de a explora natura alături de câinele tău, dezvoltând simultan condiția fizică și legătura specială dintre voi.</p>
        <p class="text-emerald-700 mt-2">Clubul CCB România organizează ieșiri de grup și antrenamente pentru începători în ambele discipline.</p>
        <div class="mt-4">
            <a href="{{ route('page.show', 'contact') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                Alătură-te Echipei de Alergare
            </a>
        </div>
    </div>
</div>

</x-layouts.marketing>
