<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportOldUsers extends Command
{
    protected $signature = 'users:import {file=users_export.sql} {--dry-run : Show what would be imported without making changes}';
    protected $description = 'Import users from old Wave 2.0 site to Wave 3.0 structure';

    private $roleMapping = [];
    private $oldRoles = [];
    private $oldUsers = [];
    private $oldUserRoles = [];

    public function handle()
    {
        $file = $this->argument('file');
        $isDryRun = $this->option('dry-run');

        if (!file_exists($file)) {
            $this->error("File {$file} not found!");
            return 1;
        }

        $this->info('Starting import of users from old site...');
        $this->line('');

        // Parse SQL file
        $this->info('Parsing SQL export file...');
        $this->parseSqlFile($file);

        // Show what we found
        $this->info("Found:");
        $this->line("- " . count($this->oldRoles) . " roles");
        $this->line("- " . count($this->oldUsers) . " users");
        $this->line("- " . count($this->oldUserRoles) . " user-role assignments");
        $this->line('');

        // Create role mapping
        $this->createRoleMapping($isDryRun);

        // Import users
        $this->importUsers($isDryRun);

        $this->line('');
        $this->info('Import completed!');

        return 0;
    }

    private function parseSqlFile($file)
    {
        $content = file_get_contents($file);
        
        // Parse roles table
        if (preg_match('/INSERT INTO.*?`roles`.*?VALUES\s*(.+?);/s', $content, $matches)) {
            $this->parseInsertValues($matches[1], function($values) {
                $this->oldRoles[] = [
                    'id' => $values[0],
                    'name' => trim($values[1], "'\""),
                    'display_name' => trim($values[2] ?? '', "'\""),
                ];
            });
        }

        // Parse users table
        if (preg_match('/INSERT INTO.*?`users`.*?VALUES\s*(.+?);/s', $content, $matches)) {
            $this->parseInsertValues($matches[1], function($values) {
                $this->oldUsers[] = [
                    'id' => $values[0],
                    'name' => trim($values[1], "'\""),
                    'email' => trim($values[2], "'\""),
                    'email_verified_at' => $values[3] !== 'NULL' ? trim($values[3], "'\"") : null,
                    'password' => trim($values[4], "'\""),
                    'remember_token' => $values[5] !== 'NULL' ? trim($values[5], "'\"") : null,
                    'created_at' => $values[6] !== 'NULL' ? trim($values[6], "'\"") : null,
                    'updated_at' => $values[7] !== 'NULL' ? trim($values[7], "'\"") : null,
                    'avatar' => isset($values[8]) && $values[8] !== 'NULL' ? trim($values[8], "'\"") : null,
                    'settings' => isset($values[9]) && $values[9] !== 'NULL' ? trim($values[9], "'\"") : null,
                ];
            });
        }

        // Parse user_roles table
        if (preg_match('/INSERT INTO.*?`user_roles`.*?VALUES\s*(.+?);/s', $content, $matches)) {
            $this->parseInsertValues($matches[1], function($values) {
                $this->oldUserRoles[] = [
                    'user_id' => $values[0],
                    'role_id' => $values[1],
                ];
            });
        }
    }

    private function parseInsertValues($valuesString, $callback)
    {
        // Split by "),(" to get individual rows
        $rows = preg_split('/\),\s*\(/', $valuesString);
        
        foreach ($rows as $row) {
            // Clean up the row
            $row = trim($row, '() ');
            
            // Parse values - handle quoted strings and NULLs
            $values = [];
            $current = '';
            $inQuotes = false;
            $quoteChar = '';
            
            for ($i = 0; $i < strlen($row); $i++) {
                $char = $row[$i];
                
                if (!$inQuotes && ($char === "'" || $char === '"')) {
                    $inQuotes = true;
                    $quoteChar = $char;
                    $current .= $char;
                } elseif ($inQuotes && $char === $quoteChar) {
                    // Check if it's escaped
                    if ($i + 1 < strlen($row) && $row[$i + 1] === $quoteChar) {
                        $current .= $char . $char;
                        $i++; // Skip next quote
                    } else {
                        $inQuotes = false;
                        $current .= $char;
                    }
                } elseif (!$inQuotes && $char === ',') {
                    $values[] = trim($current);
                    $current = '';
                } else {
                    $current .= $char;
                }
            }
            
            if ($current !== '') {
                $values[] = trim($current);
            }
            
            if (!empty($values)) {
                $callback($values);
            }
        }
    }

    private function createRoleMapping($isDryRun)
    {
        $this->info('Creating role mapping...');
        
        // Default mapping strategy
        $defaultMapping = [
            'admin' => 'admin',        // Admin → admin  
            'user' => 'registered',    // User → registered
            'moderator' => 'registered', // Moderator → registered
            'editor' => 'registered',   // Editor → registered
        ];

        foreach ($this->oldRoles as $oldRole) {
            $oldRoleName = strtolower($oldRole['name']);
            
            // Try to find matching role in Wave 3.0
            $newRoleName = $defaultMapping[$oldRoleName] ?? 'registered';
            
            // Check if the target role exists
            $newRole = Role::where('name', $newRoleName)->first();
            if (!$newRole) {
                $newRoleName = 'registered'; // Fallback
                $newRole = Role::where('name', $newRoleName)->first();
            }

            $this->roleMapping[$oldRole['id']] = [
                'old_name' => $oldRole['name'],
                'new_name' => $newRoleName,
                'new_id' => $newRole->id
            ];

            $this->line("  → {$oldRole['name']} (ID: {$oldRole['id']}) → {$newRoleName} (ID: {$newRole->id})");
        }
    }

    private function importUsers($isDryRun)
    {
        $this->info('Importing users...');
        $imported = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($this->oldUsers as $oldUser) {
            try {
                // Check if user already exists
                $existingUser = User::where('email', $oldUser['email'])->first();
                if ($existingUser) {
                    $this->line("  - Skipped: {$oldUser['email']} (already exists)");
                    $skipped++;
                    continue;
                }

                // Find user's role from user_roles table
                $userRole = collect($this->oldUserRoles)->firstWhere('user_id', $oldUser['id']);
                $roleId = $userRole ? ($this->roleMapping[$userRole['role_id']]['new_id'] ?? 2) : 2; // Default to 'registered'

                // Generate username
                $username = $this->generateUsername($oldUser['name']);

                if ($isDryRun) {
                    $roleName = $userRole ? $this->roleMapping[$userRole['role_id']]['new_name'] : 'registered';
                    $this->line("  → Would import: {$oldUser['name']} ({$oldUser['email']}) as {$roleName}");
                } else {
                    // Create user
                    $user = User::create([
                        'name' => $oldUser['name'],
                        'email' => $oldUser['email'],
                        'username' => $username,
                        'password' => $oldUser['password'], // Keep original hash
                        'role_id' => $roleId,
                        'email_verified_at' => $oldUser['email_verified_at'] ? Carbon::parse($oldUser['email_verified_at']) : null,
                        'avatar' => $oldUser['avatar'],
                        'created_at' => $oldUser['created_at'] ? Carbon::parse($oldUser['created_at']) : now(),
                        'updated_at' => $oldUser['updated_at'] ? Carbon::parse($oldUser['updated_at']) : now(),
                    ]);

                    $roleName = $this->roleMapping[$userRole['role_id'] ?? '']['new_name'] ?? 'registered';
                    $this->line("  ✓ Imported: {$oldUser['name']} ({$oldUser['email']}) as {$roleName}");
                }

                $imported++;
            } catch (\Exception $e) {
                $this->line("  ✗ Error importing {$oldUser['email']}: " . $e->getMessage());
                $errors++;
            }
        }

        // Summary table
        $this->line('');
        $headers = ['Status', 'Count'];
        $rows = [
            ['Imported', $imported],
            ['Skipped', $skipped], 
            ['Errors', $errors],
            ['Total', count($this->oldUsers)]
        ];

        $this->table($headers, $rows);

        if ($isDryRun) {
            $this->warn('This was a dry run. No changes were made.');
            $this->info('Run without --dry-run to apply changes.');
        }
    }

    private function generateUsername($name)
    {
        $username = \Illuminate\Support\Str::slug($name, '');
        $original = $username;
        $i = 1;
        
        while (User::where('username', $username)->exists()) {
            $username = $original . $i;
            $i++;
        }
        
        return $username;
    }
}
