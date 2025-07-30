<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    echo "Creating permission tables...\n";
    
    $teams = config('permission.teams');
    $tableNames = config('permission.table_names');
    $columnNames = config('permission.column_names');
    $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
    $pivotPermission = $columnNames['permission_pivot_key'] ?? 'permission_id';

    if (empty($tableNames)) {
        throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
    }
    if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
        throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
    }

    // Create permissions table
    Schema::create($tableNames['permissions'], function ($table) {
        $table->bigIncrements('id');
        $table->string('name');
        $table->string('guard_name');
        $table->timestamps();
        $table->unique(['name', 'guard_name']);
    });
    echo "Created permissions table\n";

    // Create roles table
    Schema::create($tableNames['roles'], function ($table) use ($teams, $columnNames) {
        $table->bigIncrements('id');
        if ($teams || config('permission.testing')) {
            $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
            $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
        }
        $table->string('name');
        $table->string('guard_name');
        $table->timestamps();
        if ($teams || config('permission.testing')) {
            $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
        } else {
            $table->unique(['name', 'guard_name']);
        }
    });
    echo "Created roles table\n";

    // Create model_has_permissions table
    Schema::create($tableNames['model_has_permissions'], function ($table) use ($tableNames, $columnNames, $pivotPermission, $teams) {
        $table->unsignedBigInteger($pivotPermission);
        $table->string('model_type');
        $table->unsignedBigInteger($columnNames['model_morph_key']);
        $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

        $table->foreign($pivotPermission)
            ->references('id')
            ->on($tableNames['permissions'])
            ->onDelete('cascade');
        if ($teams) {
            $table->unsignedBigInteger($columnNames['team_foreign_key']);
            $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');
            $table->primary([$columnNames['team_foreign_key'], $pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                'model_has_permissions_permission_model_type_primary');
        } else {
            $table->primary([$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                'model_has_permissions_permission_model_type_primary');
        }
    });
    echo "Created model_has_permissions table\n";

    // Create model_has_roles table
    Schema::create($tableNames['model_has_roles'], function ($table) use ($tableNames, $columnNames, $pivotRole, $teams) {
        $table->unsignedBigInteger($pivotRole);
        $table->string('model_type');
        $table->unsignedBigInteger($columnNames['model_morph_key']);
        $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

        $table->foreign($pivotRole)
            ->references('id')
            ->on($tableNames['roles'])
            ->onDelete('cascade');
        if ($teams) {
            $table->unsignedBigInteger($columnNames['team_foreign_key']);
            $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');
            $table->primary([$columnNames['team_foreign_key'], $pivotRole, $columnNames['model_morph_key'], 'model_type'],
                'model_has_roles_role_model_type_primary');
        } else {
            $table->primary([$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                'model_has_roles_role_model_type_primary');
        }
    });
    echo "Created model_has_roles table\n";

    // Create role_has_permissions table
    Schema::create($tableNames['role_has_permissions'], function ($table) use ($tableNames, $pivotRole, $pivotPermission) {
        $table->unsignedBigInteger($pivotPermission);
        $table->unsignedBigInteger($pivotRole);

        $table->foreign($pivotPermission)
            ->references('id')
            ->on($tableNames['permissions'])
            ->onDelete('cascade');

        $table->foreign($pivotRole)
            ->references('id')
            ->on($tableNames['roles'])
            ->onDelete('cascade');

        $table->primary([$pivotPermission, $pivotRole], 'role_has_permissions_permission_id_role_id_primary');
    });
    echo "Created role_has_permissions table\n";

    // Add migration record
    DB::table('migrations')->insert([
        'migration' => '2024_03_29_225420_create_permission_roles_tables',
        'batch' => 1
    ]);
    echo "Added migration record\n";

    echo "Permission tables created successfully!\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
