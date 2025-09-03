#!/usr/bin/env php
<?php

// Extract clean SQL from users_analysis.sql
$inputFile = __DIR__ . '/users_analysis.sql';
$outputFile = __DIR__ . '/users_full_export.sql';

if (!file_exists($inputFile)) {
    echo "Input file not found: $inputFile\n";
    exit(1);
}

$content = file_get_contents($inputFile);
$lines = explode("\n", $content);

$roles = [];
$users = [];
$userRoles = [];

echo "Extracting data from wrapped SQL export...\n";

foreach ($lines as $lineNum => $line) {
    $line = trim($line);
    
    // Skip empty lines and comments
    if (empty($line) || strpos($line, '--') === 0) {
        continue;
    }
    
    // Extract INSERT statements from the wrapped format
    if (preg_match('/\(\'(INSERT INTO `[^`]+` VALUES \([^)]+\)[^\']*)\';?\'\s*,\s*\d+\)/', $line, $matches)) {
        $insertStatement = $matches[1];
        
        // Fix double quotes in the extracted statement
        $insertStatement = str_replace('\'\'', "'", $insertStatement);
        
        // Categorize the statements
        if (strpos($insertStatement, 'INSERT INTO `roles`') !== false) {
            $roles[] = $insertStatement . ';';
        } elseif (strpos($insertStatement, 'INSERT INTO `users`') !== false) {
            $users[] = $insertStatement . ';';
        } elseif (strpos($insertStatement, 'INSERT INTO `user_roles`') !== false) {
            $userRoles[] = $insertStatement . ';';
        }
    }
}

echo "Found:\n";
echo "- " . count($roles) . " roles\n";
echo "- " . count($users) . " users\n";
echo "- " . count($userRoles) . " user-role assignments\n";

// Write the clean export
$output = "-- Clean export for Wave 2.0 → Wave 3.0 import\n";
$output .= "-- Extracted from users_analysis.sql\n\n";

$output .= "-- ROLES\n";
foreach ($roles as $role) {
    $output .= $role . "\n";
}

$output .= "\n-- USERS\n";
foreach ($users as $user) {
    $output .= $user . "\n";
}

$output .= "\n-- USER ROLES\n";
foreach ($userRoles as $userRole) {
    $output .= $userRole . "\n";
}

file_put_contents($outputFile, $output);

echo "\nClean export written to: $outputFile\n";
echo "Run: php artisan users:import users_full_export.sql --dry-run\n";
