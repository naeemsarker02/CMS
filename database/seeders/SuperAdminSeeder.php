<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin User
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@configurator.com',
            'password' => Hash::make('SuperAdmin@123'),
            'phone' => '+1234567890',
            'company' => 'Product Configurator Inc.',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Assign Super Admin role
        $superAdmin->assignRole('Super Admin');

        $this->command->info('Super Admin created successfully!');
        $this->command->info('Email: superadmin@configurator.com');
        $this->command->info('Password: SuperAdmin@123');

        // Create additional test users for each role
        
        // Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@configurator.com',
            'password' => Hash::make('Admin@123'),
            'phone' => '+1234567891',
            'company' => 'Product Configurator Inc.',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('Admin');

        // Sales Officer
        $salesOfficer = User::create([
            'name' => 'Sales Officer',
            'email' => 'sales@configurator.com',
            'password' => Hash::make('Sales@123'),
            'phone' => '+1234567892',
            'company' => 'Product Configurator Inc.',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $salesOfficer->assignRole('Sales Officer');

        // Project Manager
        $projectManager = User::create([
            'name' => 'Project Manager',
            'email' => 'pm@configurator.com',
            'password' => Hash::make('PM@123'),
            'phone' => '+1234567893',
            'company' => 'Product Configurator Inc.',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $projectManager->assignRole('Project Manager');

        // Customer
        $customer = User::create([
            'name' => 'Customer User',
            'email' => 'customer@configurator.com',
            'password' => Hash::make('Customer@123'),
            'phone' => '+1234567894',
            'company' => 'ABC Corporation',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $customer->assignRole('Customer');

        $this->command->info('Test users created for all roles!');
    }
}