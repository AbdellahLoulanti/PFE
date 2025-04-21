<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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

            // Articles de blog
            'blog.view', 'blog.create', 'blog.edit', 'blog.delete', 'blog.publish', 'blog.unpublish',

            // Événements
            'event.view', 'event.create', 'event.edit', 'event.delete', 'event.publish', 'event.unpublish',

            // Produits
            'product.view', 'product.create', 'product.edit', 'product.delete',

            // Paiements
            'payment.view', 'payment.create', 'payment.process',
        ];

        // Créer chaque permission si elle n'existe pas déjà
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
