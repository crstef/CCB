<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Lista corectă cu utilizatorii și parolele lor specifice
$users = [
    ['name' => 'Dan Zloteanu', 'username' => 'dan_zloteanu', 'password' => 'danzlot11'],
    ['name' => 'Adrian Tigla', 'username' => 'adrian_tigla', 'password' => 'tiglaad12'],
    ['name' => 'Gabriel Panoiu', 'username' => 'gabriel_panoiu', 'password' => 'pangab22'],
    ['name' => 'Cosmin Pop Moldovan', 'username' => 'cosmin_pop_moldovan', 'password' => 'cpmold66'],
    ['name' => 'Flavius Bajan', 'username' => 'flavius_bajan', 'password' => 'flaviusbaj69'],
    ['name' => 'Attila Toth', 'username' => 'attila_toth', 'password' => 'attilat66'],
    ['name' => 'Adrian Mihalache', 'username' => 'adrian_mihalache', 'password' => 'adimih101'],
    ['name' => 'Alexandru Bondar', 'username' => 'alexandru_bondar', 'password' => 'bondal235'],
    ['name' => 'Alexandru Davidescu', 'username' => 'alexandru_davidescu', 'password' => 'davidal68'],
    ['name' => 'Ana Parvu', 'username' => 'ana_parvu', 'password' => 'anapar808'],
    ['name' => 'Andrei Butuman', 'username' => 'andrei_butuman', 'password' => 'butuman902'],
    ['name' => 'Antonia Pop Moldovan', 'username' => 'antonia_pop_moldovan', 'password' => 'apmold66'],
    ['name' => 'Maria Berbecaru', 'username' => 'maria_berbecaru', 'password' => 'berbemar11'],
    ['name' => 'Ovidiu Berbecaru', 'username' => 'ovidiu_berbecaru', 'password' => 'berbeovi22'],
    ['name' => 'Bogdan Ivanescu', 'username' => 'bogdan_ivanescu', 'password' => 'bogivan300'],
    ['name' => 'Ioana Calinoiu', 'username' => 'ioana_calinoiu', 'password' => 'calio899'],
    ['name' => 'Mircea Calota', 'username' => 'mircea_calota', 'password' => 'calomir456'],
    ['name' => 'Florin Calusaru', 'username' => 'florin_calusaru', 'password' => 'florincal800'],
    ['name' => 'Ionut Chirovan', 'username' => 'ionut_chirovan', 'password' => 'chiroion800'],
    ['name' => 'Ciprian Cordos', 'username' => 'ciprian_cordos', 'password' => 'cipcordos800'],
    ['name' => 'Ciprian Duca', 'username' => 'ciprian_duca', 'password' => 'cipduca802'],
    ['name' => 'Ciprian Nechita', 'username' => 'ciprian_nechita', 'password' => 'cipnec999'],
    ['name' => 'Alexandru Costachescu', 'username' => 'alexandru_costachescu', 'password' => 'costalex33'],
    ['name' => 'Cristina Trifu', 'username' => 'cristina_trifu', 'password' => 'cristrf525'],
    ['name' => 'Sorin Dragomir', 'username' => 'sorin_dragomir', 'password' => 'sorindrg156'],
    ['name' => 'Gabriela Denisov', 'username' => 'gabriela_denisov', 'password' => 'gabdsv1124'],
    ['name' => 'Ioana Gaciu', 'username' => 'ioana_gaciu', 'password' => 'ioagac901'],
    ['name' => 'Marius Groza', 'username' => 'marius_groza', 'password' => 'margrz125'],
    ['name' => 'Ionela Mos', 'username' => 'ionela_mos', 'password' => 'ionem569'],
    ['name' => 'Tudor Ionescu', 'username' => 'tudor_ionescu', 'password' => 'tudion901'],
    ['name' => 'Iulia Moldovan', 'username' => 'iulia_moldovan', 'password' => 'iulmold404'],
    ['name' => 'Ion Mot Tudor', 'username' => 'ion_mot_tudor', 'password' => 'ionmot234'],
    ['name' => 'Oleksandr Kyurchev', 'username' => 'oleksandr_kyurchev', 'password' => 'sasha405'],
    ['name' => 'Leonard Sumlea', 'username' => 'leonard_sumlea', 'password' => 'leos3033'],
    ['name' => 'Petru Manea', 'username' => 'petru_manea', 'password' => 'petmn2027'],
    ['name' => 'Maria Rogoz', 'username' => 'maria_rogoz', 'password' => 'margoz69'],
    ['name' => 'Maria Tudor', 'username' => 'maria_tudor', 'password' => 'martdr100'],
    ['name' => 'Razvan Mircea', 'username' => 'razvan_mircea', 'password' => 'razvmrc202'],
    ['name' => 'Cristea Oprisan', 'username' => 'cristea_oprisan', 'password' => 'crsopr900'],
    ['name' => 'Dragos Pasculescu', 'username' => 'dragos_pasculescu', 'password' => 'drapasc600'],
    ['name' => 'Mihai Pasculescu', 'username' => 'mihai_pasculescu', 'password' => 'mihpasc505'],
    ['name' => 'Vasile Pravdencu', 'username' => 'vasile_pravdencu', 'password' => 'vasprvd7001'],
    ['name' => 'Adela Predescu', 'username' => 'adela_predescu', 'password' => 'adelaprd699'],
    ['name' => 'Florin Predescu', 'username' => 'florin_predescu', 'password' => 'flopred899'],
    ['name' => 'Raluca Gutiu', 'username' => 'raluca_gutiu', 'password' => 'ralgut401'],
    ['name' => 'Raluca Marcu', 'username' => 'raluca_marcu', 'password' => 'ralmrc602'],
    ['name' => 'Rares Rusu', 'username' => 'rares_rusu', 'password' => 'rarrsu3999'],
    ['name' => 'Robert Caraman', 'username' => 'robert_caraman', 'password' => 'robcar999'],
    ['name' => 'Roxana Bajan', 'username' => 'roxana_bajan', 'password' => 'roxbaj2006'],
    ['name' => 'Roxana Zamfir', 'username' => 'roxana_zamfir', 'password' => 'roxzmf895'],
    ['name' => 'Rusu Georgiana', 'username' => 'rusu_georgiana', 'password' => 'rsugrg400'],
    ['name' => 'Silviu Nedelcu', 'username' => 'silviu_nedelcu', 'password' => 'silvned222'],
    ['name' => 'Livia Stan', 'username' => 'livia_stan', 'password' => 'stanli999'],
    ['name' => 'Stefan Ciobanu', 'username' => 'stefan_ciobanu', 'password' => 'stefc600'],
    ['name' => 'Stefan Wrabeli Tarziu', 'username' => 'stefan_wrabeli_tarziu', 'password' => 'stefwtz1011'],
    ['name' => 'Traian Ciordas', 'username' => 'traian_ciordas', 'password' => 'traciord2090']
];

echo "=== ȘTERG TOȚI UTILIZATORII ÎN AFARĂ DE CRISTIAN_STEF ===\n\n";

// Păstrez DOAR cristian_stef
echo "Șterg toți utilizatorii în afară de cristian_stef...\n";
User::where('email', '!=', 'stef.cristian3@gmail.com')->delete();

echo "Creez cei 56 de utilizatori CCB cu parolele corecte...\n\n";

$created = 0;
foreach($users as $userData) {
    try {
        $user = User::create([
            'name' => $userData['name'],
            'username' => $userData['username'],
            'email' => $userData['username'] . '@ccbor.ro',
            'password' => Hash::make($userData['password']), // PAROLA CORECTĂ!
            'email_verified_at' => now(),
            'avatar' => 'users/default.png'
        ]);
        
        echo "✓ {$user->name} | Username: {$user->username} | Parola: {$userData['password']}\n";
        $created++;
    } catch (Exception $e) {
        echo "✗ Eroare la {$userData['name']}: " . $e->getMessage() . "\n";
    }
}

// Mă asigur că Cristian Stef există și are rolul de admin
echo "\n=== CRISTIAN STEF ADMIN ===\n";
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

// Verific și atribui rolul de admin
$adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
if (!$cristianStef->hasRole('admin')) {
    $cristianStef->assignRole('admin');
    echo "✓ Rol admin atribuit lui Cristian Stef!\n";
} else {
    echo "✓ Cristian Stef are deja rol de admin!\n";
}

echo "\n=== SUMAR FINAL ===\n";
echo "Utilizatori CCB creați: {$created}\n";
echo "Total utilizatori în sistem: " . User::count() . "\n";
echo "Administratori: " . User::role('admin')->count() . "\n";

echo "\n=== GATA! Acum toți utilizatorii au parolele corecte! ===\n";