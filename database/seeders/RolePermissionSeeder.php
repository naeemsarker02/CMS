<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            // User Management
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Role Management
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            
            // Product Management
            'view products',
            'create products',
            'edit products',
            'delete products',
            
            // Configuration Management
            'view configurations',
            'create configurations',
            'edit configurations',
            'delete configurations',
            
            // Order Management
            'view orders',
            'create orders',
            'edit orders',
            'delete orders',
            'approve orders',
            
            // Project Management
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',
            'manage projects',
            
            // Reports
            'view reports',
            'export reports',
            
            // Settings
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'sanctum']);
        }

        // Create Roles and Assign Permissions

        // 1. Super Admin - Has all permissions
        $superAdmin = Role::create(['name' => 'Super Admin', 'guard_name' => 'sanctum']);
        $superAdmin->givePermissionTo(Permission::all());

        // 2. Admin - Has most permissions except critical system settings
        $admin = Role::create(['name' => 'Admin', 'guard_name' => 'sanctum']);
        $admin->givePermissionTo([
            'view users', 'create users', 'edit users',
            'view roles',
            'view products', 'create products', 'edit products', 'delete products',
            'view configurations', 'create configurations', 'edit configurations', 'delete configurations',
            'view orders', 'create orders', 'edit orders', 'delete orders', 'approve orders',
            'view projects', 'create projects', 'edit projects', 'delete projects',
            'view reports', 'export reports',
        ]);

        // 3. Sales Officer - Can manage products, configurations, and orders
        $salesOfficer = Role::create(['name' => 'Sales Officer', 'guard_name' => 'sanctum']);
        $salesOfficer->givePermissionTo([
            'view products', 'create products', 'edit products',
            'view configurations', 'create configurations', 'edit configurations',
            'view orders', 'create orders', 'edit orders',
            'view reports',
        ]);

        // 4. Project Manager - Can manage projects and view orders
        $projectManager = Role::create(['name' => 'Project Manager', 'guard_name' => 'sanctum']);
        $projectManager->givePermissionTo([
            'view products',
            'view configurations',
            'view orders', 'edit orders',
            'view projects', 'create projects', 'edit projects', 'delete projects', 'manage projects',
            'view reports',
        ]);

        // 5. Customer - Limited permissions for viewing and creating configurations/orders
        $customer = Role::create(['name' => 'Customer', 'guard_name' => 'sanctum']);
        $customer->givePermissionTo([
            'view products',
            'view configurations', 'create configurations',
            'view orders', 'create orders',
        ]);

        $this->command->info('Roles and Permissions created successfully!');
    }
}