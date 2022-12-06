<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesStructure = [
            'Admin' => [
                'dashboard' => 'r',
                'customers' => 'c,r,u,d',
                'staff' => 'c,r,u,d',
                'promotional-email' => 'c,r',
                'supports' => 'c,r,u,d',
                'reports' => 'r',
                'transactions' => 'r',
                'payments' => 'r',
                'invoices' => 'r',
                'merchants' => 'r',
                'category' => 'r',
                'products' => 'r',
                'deposits' => 'r',
                'stores' => 'r',
                'transfers' => 'r',
                'money-requests' => 'r',
                'payment-plans' => 'r',
                'payouts' => 'r',
                'banks' => 'c,r,u,d',
                'orders' => 'r,u,d',
                'currencies' => 'c,r,u,d',
                'users' => 'c,r,u,d',
                'kyc-methods' => 'c,r,u,d',
                'kyc-requests' => 'c,r,u,d',

                'media' => 'c,r,u,d',
                'reviews' => 'c,r,u,d',
                'blog' => 'c,r,u,d',
                'pages' => 'c,r,u,d',
                'website' => 'r,u',

                // Settings
                'settings' => 'r',
                'languages' => 'c,r,u,d',
                'menus' => 'c,r,u,d',
                'seo' => 'c,r,u,d',
                'system-settings' => 'r,u',
                'cron-settings' => 'r,u',
                'taxes' => 'c,r,u,d',
                'gateways' => 'c,r,u,d',
                'roles' => 'c,r,u,d',
                'roles-assign' => 'r,c',
            ],
            'Manager' => [
                'dashboard' => 'r',
                'customers' => 'c,r,u,d',
                'staff' => 'c,r,u,d',
                'promotional-email' => 'c,r',
                'supports' => 'c,r,u,d',
                'reports' => 'r',
                'transactions' => 'r',
                'payments' => 'r',
                'invoices' => 'r',
                'merchants' => 'r',
                'products' => 'r',
                'deposits' => 'r',
                'stores' => 'r',
                'money-requests' => 'r',
                'payment-plans' => 'r',
                'payouts' => 'r',
                'banks' => 'c,r,u,d',
                'orders' => 'r,u,d',
                'currencies' => 'c,r,u,d',
                'users' => 'c,r,u,d',
                'kyc-methods' => 'c,r,u,d',
                'kyc-requests' => 'r,u,d',
            ]
        ];

        foreach ($rolesStructure as $key => $modules) {
            // Create a new role
            $role = Role::firstOrCreate([
                'name' => $key,
                'guard_name' => 'web'
            ]);
            $permissions = [];

            $this->command->info('Creating Role '. strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {

                foreach (explode(',', $value) as $p => $perm) {

                    $permissionValue = $this->permissionMap()->get($perm);

                    $permissions[] = Permission::firstOrCreate([
                        'name' => $module . '-' . $permissionValue,
                        'guard_name' => 'web'
                    ])->id;

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                }
            }

            // Attach all permissions to the role
            $role->permissions()->sync($permissions);

            if (true) {
                $this->command->info("Creating '{$key}' user");
                // Create default user for each role
                $user = User::create([
                    'name' => ucwords(str_replace('_', ' ', $key)),
                    'email' => str($key)->remove(' ')->lower().'@'.str($key)->remove(' ')->lower().'.com',
                    'username' => str($key)->remove(' ')->lower(),
                    'password' => bcrypt('rootadmin'),
                    'avatar' => 'https://avatars.dicebear.com/api/adventurer/'.str($key)->slug().'.svg',
                    'email_verified_at' => now(),
                    'kyc_verified_at' => now(),
                    'role' => 'admin'
                ]);
                $user->assignRole($role);
            }
        }
    }

    private function permissionMap(){
        return collect([
            'c' => 'create',
            'r' => 'read',
            'u' => 'update',
            'd' => 'delete'
        ]);
    }
}
