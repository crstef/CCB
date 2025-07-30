<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    // Delete the migration record
    DB::table('migrations')->where('migration', '2024_03_29_225420_create_permission_roles_tables')->delete();
    echo "Migration record deleted successfully.\n";
    
    // Check if tables exist and drop them if they do
    $tables = ['role_has_permissions', 'model_has_roles', 'model_has_permissions', 'roles', 'permissions'];
    foreach ($tables as $table) {
        if (Schema::hasTable($table)) {
            Schema::drop($table);
            echo "Dropped table: $table\n";
        }
    }
    
    echo "Ready to re-run migration.\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
