<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Réinitialiser le cache des permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Liste des permissions à créer
        $permissions = [
            // Utilisateurs
            'user.view', 'user.create', 'user.edit', 'user.delete',
            'event.view', 'event.create', 'event.edit', 'event.delete',
            'blogpost.view', 'blogpost.create', 'blogpost.edit', 'blogpost.delete',
            'product.view', 'product.create', 'product.edit', 'product.delete',
            'contactmessage.view', 'contactmessage.create', 'contactmessage.edit', 'contactmessage.delete',
            'job.view', 'job.create', 'job.edit', 'job.delete',

        ];

        // Créer chaque permission si elle n'existe pas déjà
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
            $role =Role::findOrCreate('admin');
            $role->givePermissionTo($permissions);

    }
}
