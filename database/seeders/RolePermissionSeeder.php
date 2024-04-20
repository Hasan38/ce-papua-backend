<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'add-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);
        Permission::create(['name' => 'view-user']);
     
        Permission::create(['name' => 'add-region']);
        Permission::create(['name' => 'edit-region']);
        Permission::create(['name' => 'delete-region']);
        Permission::create(['name' => 'view-region']);

        Permission::create(['name' => 'add-machine']);
        Permission::create(['name' => 'edit-machine']);
        Permission::create(['name' => 'delete-machine']);
        Permission::create(['name' => 'view-machine']);

        Permission::create(['name' => 'add-area-group']);
        Permission::create(['name' => 'edit-area-group']);
        Permission::create(['name' => 'delete-area-group']);
        Permission::create(['name' => 'view-area-group']);

        Permission::create(['name' => 'add-customer']);
        Permission::create(['name' => 'edit-customer']);
        Permission::create(['name' => 'delete-customer']);
        Permission::create(['name' => 'view-customer']);

        Permission::create(['name' => 'add-error-code-ce']);
        Permission::create(['name' => 'edit-error-code-ce']);
        Permission::create(['name' => 'delete-error-code-ce']);
        Permission::create(['name' => 'view-error-code-ce']);

        Permission::create(['name' => 'add-rating']);
        Permission::create(['name' => 'edit-rating']);
        Permission::create(['name' => 'delete-rating']);
        Permission::create(['name' => 'view-rating']);

        Role::create(['name'=>'admin']);
        Role::create(['name'=>'ce']);
        Role::create(['name'=>'guest']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('add-user');
        $roleAdmin->givePermissionTo('edit-user');
        $roleAdmin->givePermissionTo('delete-user');
        $roleAdmin->givePermissionTo('view-user');

        $roleAdmin->givePermissionTo('add-region');
        $roleAdmin->givePermissionTo('edit-region');
        $roleAdmin->givePermissionTo('delete-region');
        $roleAdmin->givePermissionTo('view-region');

        $roleAdmin->givePermissionTo('add-machine');
        $roleAdmin->givePermissionTo('edit-machine');
        $roleAdmin->givePermissionTo('delete-machine');
        $roleAdmin->givePermissionTo( 'view-machine');

        $roleAdmin->givePermissionTo('add-area-group');
        $roleAdmin->givePermissionTo('edit-area-group');
        $roleAdmin->givePermissionTo('delete-area-group');
        $roleAdmin->givePermissionTo('view-area-group');

        $roleAdmin->givePermissionTo('add-customer');
        $roleAdmin->givePermissionTo('edit-customer');
        $roleAdmin->givePermissionTo('delete-customer');
        $roleAdmin->givePermissionTo('view-customer');

        $roleAdmin->givePermissionTo('add-error-code-ce');
        $roleAdmin->givePermissionTo('edit-error-code-ce');
        $roleAdmin->givePermissionTo('delete-error-code-ce');
        $roleAdmin->givePermissionTo('view-error-code-ce');

        $roleAdmin->givePermissionTo('add-rating');
        $roleAdmin->givePermissionTo('edit-rating');
        $roleAdmin->givePermissionTo('delete-rating');
        $roleAdmin->givePermissionTo('view-rating');

        $roleCe = Role::findByName('ce');
        $roleCe->givePermissionTo('view-user');
        $roleCe->givePermissionTo('view-region');
        $roleCe->givePermissionTo('add-machine');
        $roleCe->givePermissionTo('edit-machine');
        $roleCe->givePermissionTo('delete-machine');
        $roleCe->givePermissionTo( 'view-machine');
        $roleCe->givePermissionTo('view-area-group');
        $roleCe->givePermissionTo('view-customer');
        $roleCe->givePermissionTo('add-error-code-ce');
        $roleCe->givePermissionTo('edit-error-code-ce');
        $roleCe->givePermissionTo('delete-error-code-ce');
        $roleCe->givePermissionTo('view-error-code-ce');
        $roleCe->givePermissionTo('add-rating');
        $roleCe->givePermissionTo('edit-rating');
        $roleCe->givePermissionTo('delete-rating');
        $roleCe->givePermissionTo('view-rating');

        $roleGuest = Role::findByName('guest');
        $roleGuest->givePermissionTo('view-user');
        $roleGuest->givePermissionTo('view-region');
        $roleGuest->givePermissionTo( 'view-machine');
        $roleGuest->givePermissionTo('view-area-group');
        $roleGuest->givePermissionTo('view-customer');
        $roleGuest->givePermissionTo('view-error-code-ce');
        $roleGuest->givePermissionTo('view-rating');

    }
}
