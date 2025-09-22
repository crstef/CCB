<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all resources and their permissions
        $resources = [
            'users' => 'Utilizatori',
            'roles' => 'Roluri', 
            'permissions' => 'Permisiuni',
            'features' => 'Funcționalități',
            'feature-goals' => 'Obiective',
            'testimonials' => 'Testimoniale',
            'documents' => 'Documente',
            'document-categories' => 'Categorii Documente',
            'media' => 'Media',
            'events' => 'Evenimente',
            'competitions' => 'Competiții',
            'competition-categories' => 'Categorii Competiții',
            'contacts' => 'Mesaje Contact',
            'changelogs' => 'Jurnal Modificări',
            'settings' => 'Setări',
            'plans' => 'Planuri',
        ];

        $actions = [
            'view' => 'Vezi',
            'view-any' => 'Vezi toate',
            'create' => 'Creează',
            'update' => 'Actualizează', 
            'delete' => 'Șterge',
            'delete-any' => 'Șterge orice',
            'force-delete' => 'Șterge permanent',
            'force-delete-any' => 'Șterge permanent orice',
            'restore' => 'Restaurează',
            'restore-any' => 'Restaurează orice',
            'replicate' => 'Dublează',
        ];

        // Create permissions for each resource
        foreach ($resources as $resource => $resourceLabel) {
            foreach ($actions as $action => $actionLabel) {
                Permission::firstOrCreate([
                    'name' => "{$action}_{$resource}",
                    'guard_name' => 'web'
                ]);
            }
        }

        // Create special admin permissions
        $specialPermissions = [
            'access_admin' => 'Acces în Admin',
            'impersonate_users' => 'Impersonează Utilizatori',
            'view_analytics' => 'Vezi Analytics',
            'manage_system' => 'Gestionează Sistemul',
        ];

        foreach ($specialPermissions as $permission => $label) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // Create or update roles with permissions
        $this->createRoles();

        $this->command->info('Permisiuni și roluri create cu succes!');
    }

    private function createRoles(): void
    {
        // Admin Role - all permissions
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        $adminRole->update(['description' => 'Administrator cu acces complet']);
        $adminRole->syncPermissions(Permission::all());

        // Editor Role - content management
        $editorRole = Role::firstOrCreate([
            'name' => 'editor',
            'guard_name' => 'web'
        ]);
        $editorRole->update(['description' => 'Editor cu acces la conținut']);
        
        $editorPermissions = [
            'access_admin',
            'view_any_documents', 'create_documents', 'update_documents', 'delete_documents',
            'view_any_document-categories', 'create_document-categories', 'update_document-categories',
            'view_any_media', 'create_media', 'update_media', 'delete_media',
            'view_any_events', 'create_events', 'update_events', 'delete_events',
            'view_any_competitions', 'create_competitions', 'update_competitions', 'delete_competitions',
            'view_any_competition-categories', 'create_competition-categories', 'update_competition-categories',
            'view_any_features', 'update_features',
            'view_any_feature-goals', 'update_feature-goals',
            'view_any_testimonials', 'create_testimonials', 'update_testimonials', 'delete_testimonials',
            'view_any_contacts',
        ];
        $editorRole->syncPermissions($editorPermissions);

        // Moderator Role - limited access
        $moderatorRole = Role::firstOrCreate([
            'name' => 'moderator',
            'guard_name' => 'web'
        ]);
        $moderatorRole->update(['description' => 'Moderator cu acces limitat']);
        
        $moderatorPermissions = [
            'access_admin',
            'view_any_documents', 'update_documents',
            'view_any_media', 'create_media',
            'view_any_events', 'create_events', 'update_events',
            'view_any_contacts',
            'view_any_users',
        ];
        $moderatorRole->syncPermissions($moderatorPermissions);

        // Subscriber Role - basic access
        $subscriberRole = Role::firstOrCreate([
            'name' => 'subscriber',
            'guard_name' => 'web'
        ]);
        $subscriberRole->update(['description' => 'Abonat cu acces de bază']);
        // No admin permissions for subscribers
    }
}