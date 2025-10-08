<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // Create Permissions
        $permissions = [
            'view-dashboard',
            'manage-users',
            'manage-tenants',
            'manage-billing',
            'view-crm',
            'manage-crm',
            'view-erp',
            'manage-erp',
            'view-reports',
            'manage-settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $superAdmin->syncPermissions($permissions);
        $admin->syncPermissions([
            'view-dashboard',
            'manage-users',
            'manage-billing',
            'view-crm',
            'manage-crm',
            'view-erp',
            'manage-erp',
            'view-reports',
            'manage-settings',
        ]);
        $manager->syncPermissions([
            'view-dashboard',
            'view-crm',
            'manage-crm',
            'view-erp',
            'manage-erp',
            'view-reports',
        ]);
        $user->syncPermissions([
            'view-dashboard',
            'view-crm',
            'view-erp',
        ]);

        // Create Demo Users
        $this->createDemoUsers($superAdmin, $admin, $manager, $user);

        $this->command->info('✅ Demo users and roles created successfully!');
        $this->command->info('');
        $this->command->info('📧 Demo Login Credentials:');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('');
        $this->command->info('🔑 Super Admin:');
        $this->command->info('   Email: admin@astracareportal.com');
        $this->command->info('   Password: admin123');
        $this->command->info('   Role: Super Administrator (Full Access)');
        $this->command->info('');
        $this->command->info('🔑 Admin User:');
        $this->command->info('   Email: john.admin@astracareportal.com');
        $this->command->info('   Password: admin123');
        $this->command->info('   Role: Administrator');
        $this->command->info('');
        $this->command->info('🔑 Manager User:');
        $this->command->info('   Email: sarah.manager@astracareportal.com');
        $this->command->info('   Password: manager123');
        $this->command->info('   Role: Manager');
        $this->command->info('');
        $this->command->info('🔑 Regular User:');
        $this->command->info('   Email: mike.user@astracareportal.com');
        $this->command->info('   Password: user123');
        $this->command->info('   Role: User');
        $this->command->info('');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    }

    private function createDemoUsers($superAdmin, $admin, $manager, $user): void
    {
        // Super Admin
        $superAdminUser = User::firstOrCreate(
            ['email' => 'admin@astracareportal.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
        $superAdminUser->assignRole($superAdmin);

        // Admin User
        $adminUser = User::firstOrCreate(
            ['email' => 'john.admin@astracareportal.com'],
            [
                'name' => 'John Anderson',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
        $adminUser->assignRole($admin);

        // Manager User
        $managerUser = User::firstOrCreate(
            ['email' => 'sarah.manager@astracareportal.com'],
            [
                'name' => 'Sarah Johnson',
                'password' => Hash::make('manager123'),
                'email_verified_at' => now(),
            ]
        );
        $managerUser->assignRole($manager);

        // Regular User
        $regularUser = User::firstOrCreate(
            ['email' => 'mike.user@astracareportal.com'],
            [
                'name' => 'Mike Davis',
                'password' => Hash::make('user123'),
                'email_verified_at' => now(),
            ]
        );
        $regularUser->assignRole($user);

        // Additional demo users
        $demoUsers = [
            [
                'name' => 'Emily Chen',
                'email' => 'emily.chen@astracareportal.com',
                'password' => Hash::make('demo123'),
                'role' => $manager,
            ],
            [
                'name' => 'Robert Wilson',
                'email' => 'robert.wilson@astracareportal.com',
                'password' => Hash::make('demo123'),
                'role' => $user,
            ],
            [
                'name' => 'Lisa Martinez',
                'email' => 'lisa.martinez@astracareportal.com',
                'password' => Hash::make('demo123'),
                'role' => $user,
            ],
        ];

        foreach ($demoUsers as $userData) {
            $demoUser = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $userData['password'],
                    'email_verified_at' => now(),
                ]
            );
            $demoUser->assignRole($userData['role']);
        }
    }
}
