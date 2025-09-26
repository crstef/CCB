<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== VERIFICARE ȘI ATRIBUIRE ROL ADMIN ===\n\n";

// Verific rolurile disponibile
echo "Roluri disponibile:\n";
$roles = Role::all();
foreach($roles as $role) {
    echo "ID: {$role->id} | Nume: {$role->name}\n";
}

// Caută utilizatorul cristian_stef
echo "\nCaut utilizatorul cristian_stef...\n";
$cristianStef = User::where('email', 'stef.cristian3@gmail.com')->first();

if (!$cristianStef) {
    echo "✗ Utilizatorul nu a fost găsit!\n";
    exit(1);
}

echo "✓ Găsit: {$cristianStef->name} (ID: {$cristianStef->id})\n";

// Verific rolurile actuale
$currentRoles = $cristianStef->getRoleNames();
echo "Roluri actuale: " . ($currentRoles->isEmpty() ? 'Niciunul' : $currentRoles->join(', ')) . "\n";

// Verific dacă există rolul de admin
$adminRole = Role::where('name', 'admin')->first();
if (!$adminRole) {
    echo "✗ Rolul 'admin' nu există! Creez rolul...\n";
    $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
    echo "✓ Rol 'admin' creat!\n";
} else {
    echo "✓ Rolul 'admin' există!\n";
}

// Atribui rolul de admin
if (!$cristianStef->hasRole('admin')) {
    $cristianStef->assignRole('admin');
    echo "✓ Rol admin atribuit lui Cristian Stef!\n";
} else {
    echo "✓ Cristian Stef are deja rol de admin!\n";
}

// Setez și parola corectă
$cristianStef->password = Hash::make('Qaz951@.1!');
$cristianStef->save();
echo "✓ Parolă actualizată pentru Cristian Stef!\n";

// Verific rezultatul final
echo "\n=== REZULTAT FINAL ===\n";
$cristianStef->refresh();
$finalRoles = $cristianStef->getRoleNames();
echo "Utilizator: {$cristianStef->name}\n";
echo "Email: {$cristianStef->email}\n";
echo "Username: {$cristianStef->username}\n";
echo "Roluri finale: " . $finalRoles->join(', ') . "\n";
echo "Are rol admin: " . ($cristianStef->hasRole('admin') ? 'DA' : 'NU') . "\n";

// Afișez toți utilizatorii cu rol de admin
echo "\n=== TOȚI ADMINISTRATORII ===\n";
$admins = User::role('admin')->get();
foreach($admins as $admin) {
    echo "- {$admin->name} ({$admin->email})\n";
}

echo "\n=== GATA! ===\n";
echo "Total utilizatori în sistem: " . User::count() . "\n";