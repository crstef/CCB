<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Hash;
use App\Models\User;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Lista completă cu utilizatorii CCB
$users = [
    ['name' => 'Dan Zloteanu', 'username' => 'danzlot11'],
    ['name' => 'Adrian Tigla', 'username' => 'tiglaad12'],
    ['name' => 'Gabriel Panoiu', 'username' => 'pangab22'],
    ['name' => 'Cosmin Pop Moldovan', 'username' => 'cpmold66'],
    ['name' => 'Flavius Bajan', 'username' => 'flaviusbaj69'],
    ['name' => 'Attila Toth', 'username' => 'attilat66'],
    ['name' => 'Adrian Mihalache', 'username' => 'adimih101'],
    ['name' => 'Alexandru Bondar', 'username' => 'bondal235'],
    ['name' => 'Alexandru Davidescu', 'username' => 'davidal68'],
    ['name' => 'Ana Parvu', 'username' => 'anapar808'],
    ['name' => 'Andrei Butuman', 'username' => 'butuman902'],
    ['name' => 'Antonia Pop Moldovan', 'username' => 'apmold66'],
    ['name' => 'Maria Berbecaru', 'username' => 'berbemar11'],
    ['name' => 'Ovidiu Berbecaru', 'username' => 'berbeovi22'],
    ['name' => 'Bogdan Ivanescu', 'username' => 'bogivan300'],
    ['name' => 'Ioana Calinoiu', 'username' => 'calio899'],
    ['name' => 'Mircea Calota', 'username' => 'calomir456'],
    ['name' => 'Florin Calusaru', 'username' => 'florincal800'],
    ['name' => 'Ionut Chirovan', 'username' => 'chiroion800'],
    ['name' => 'Ciprian Cordos', 'username' => 'cipcordos800'],
    ['name' => 'Ciprian Duca', 'username' => 'cipduca802'],
    ['name' => 'Ciprian Nechita', 'username' => 'cipnec999'],
    ['name' => 'Alexandru Costachescu', 'username' => 'costalex33'],
    ['name' => 'Cristina Trifu', 'username' => 'cristrf525'],
    ['name' => 'Sorin Dragomir', 'username' => 'sorindrg156'],
    ['name' => 'Gabriela Denisov', 'username' => 'gabdsv1124'],
    ['name' => 'Ioana Gaciu', 'username' => 'ioagac901'],
    ['name' => 'Marius Groza', 'username' => 'margrz125'],
    ['name' => 'Ionela Mos', 'username' => 'ionem569'],
    ['name' => 'Tudor Ionescu', 'username' => 'tudion901'],
    ['name' => 'Iulia Moldovan', 'username' => 'iulmold404'],
    ['name' => 'Ion Mot Tudor', 'username' => 'ionmot234'],
    ['name' => 'Oleksandr Kyurchev', 'username' => 'sasha405'],
    ['name' => 'Leonard Sumlea', 'username' => 'leos3033'],
    ['name' => 'Petru Manea', 'username' => 'petmn2027'],
    ['name' => 'Maria Rogoz', 'username' => 'margoz69'],
    ['name' => 'Maria Tudor', 'username' => 'martdr100'],
    ['name' => 'Razvan Mircea', 'username' => 'razvmrc202'],
    ['name' => 'Cristea Oprisan', 'username' => 'crsopr900'],
    ['name' => 'Dragos Pasculescu', 'username' => 'drapasc600'],
    ['name' => 'Mihai Pasculescu', 'username' => 'mihpasc505'],
    ['name' => 'Vasile Pravdencu', 'username' => 'vasprvd7001'],
    ['name' => 'Adela Predescu', 'username' => 'adelaprd699'],
    ['name' => 'Florin Predescu', 'username' => 'flopred899'],
    ['name' => 'Raluca Gutiu', 'username' => 'ralgut401'],
    ['name' => 'Raluca Marcu', 'username' => 'ralmrc602'],
    ['name' => 'Rares Rusu', 'username' => 'rarrsu3999'],
    ['name' => 'Robert Caraman', 'username' => 'robcar999'],
    ['name' => 'Roxana Bajan', 'username' => 'roxbaj2006'],
    ['name' => 'Roxana Zamfir', 'username' => 'roxzmf895'],
    ['name' => 'Rusu Georgiana', 'username' => 'rsugrg400'],
    ['name' => 'Silviu Nedelcu', 'username' => 'silvned222'],
    ['name' => 'Livia Stan', 'username' => 'stanli999'],
    ['name' => 'Stefan Ciobanu', 'username' => 'stefc600'],
    ['name' => 'Stefan Wrabeli Tarziu', 'username' => 'stefwtz1011'],
    ['name' => 'Traian Ciordas', 'username' => 'traciord2090']
];

echo "Șterg utilizatorii existenți (păstrez adminii)...\n";
// Păstrez doar utilizatorii cu email-uri de admin
User::whereNotIn('email', ['admin@example.com', 'admin@ccbor.ro', 'stef.cristian3@gmail.com'])->delete();

echo "Creez cei 56 de utilizatori CCB...\n";

$created = 0;
foreach($users as $userData) {
    try {
        $user = User::create([
            'name' => $userData['name'],
            'username' => $userData['username'],
            'email' => $userData['username'] . '@ccbor.ro',
            'password' => Hash::make('password123'), // Parolă temporară
            'email_verified_at' => now(),
            'avatar' => 'users/default.png'
        ]);
        
        echo "✓ Creat: {$user->name} ({$user->username})\n";
        $created++;
    } catch (Exception $e) {
        echo "✗ Eroare la {$userData['name']}: " . $e->getMessage() . "\n";
    }
}

// Creez și utilizatorul cristian_stef
try {
    $cristianStef = User::firstOrCreate(
        ['email' => 'stef.cristian3@gmail.com'],
        [
            'name' => 'Cristian Stef',
            'username' => 'cristian_stef',
            'password' => Hash::make('Qaz951@.1!'),
            'email_verified_at' => now(),
            'avatar' => 'users/default.png'
        ]
    );
    
    if ($cristianStef->wasRecentlyCreated) {
        echo "✓ Creat utilizator admin: Cristian Stef (cristian_stef)\n";
    } else {
        echo "✓ Utilizator admin existent: Cristian Stef (cristian_stef)\n";
    }
} catch (Exception $e) {
    echo "✗ Eroare la crearea admin-ului Cristian Stef: " . $e->getMessage() . "\n";
}

echo "\n=== SUMAR ===\n";
echo "Utilizatori creați: {$created}\n";
echo "Total utilizatori în sistem: " . User::count() . "\n";
echo "Utilizatori cu username: " . User::whereNotNull('username')->count() . "\n";
echo "\nGata!\n";