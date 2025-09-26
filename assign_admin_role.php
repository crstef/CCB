<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Role;

echo "Verific rolurile disponibile...\n";

$roles = Role::all();
foreach($roles as $role) {
    echo "ID: {$role->id} | Nume: {$role->name} | Display: {$role->display_name}\n";
}

echo "\nCaut utilizatorul cristian_stef...\n";

$cristianStef = User::where('email', 'stef.cristian3@gmail.com')->first();

if (!$cristianStef) {
    echo "✗ Utilizatorul cristian_stef nu a fost găsit!\n";
    exit(1);
}

echo "✓ Utilizator găsit: {$cristianStef->name} (ID: {$cristianStef->id})\n";

// Verific dacă rolul admin există
$adminRole = Role::where('name', 'admin')->first();

if (!$adminRole) {
    echo "Rolul 'admin' nu există. Creez rolul...\n";
    $adminRole = Role::create([
        'name' => 'admin',
        'display_name' => 'Administrator'
    ]);
    echo "✓ Rol admin creat cu ID: {$adminRole->id}\n";
} else {
    echo "✓ Rol admin găsit cu ID: {$adminRole->id}\n";
}

// Verific dacă utilizatorul are deja rolul admin
if ($cristianStef->roles()->where('name', 'admin')->exists()) {
    echo "✓ Utilizatorul cristian_stef are deja rolul de admin!\n";
} else {
    echo "Atribui rolul de admin utilizatorului cristian_stef...\n";
    $cristianStef->roles()->attach($adminRole->id);
    echo "✓ Rolul de admin a fost atribuit cu succes!\n";
}

// Verific rezultatul final
echo "\n=== VERIFICARE FINALĂ ===\n";
$cristianStef->refresh();
$userRoles = $cristianStef->roles()->pluck('name')->toArray();
echo "Utilizator: {$cristianStef->name} ({$cristianStef->email})\n";
echo "Roluri: " . implode(', ', $userRoles) . "\n";
echo "Este admin: " . ($cristianStef->hasRole('admin') ? 'DA' : 'NU') . "\n";

echo "\nGata!\n";