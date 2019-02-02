<?php

use Illuminate\Database\Seeder;
use App\Models\Auth\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        // name, display_name, description, [permission1, permission2, ...]
        $roles = [
            [ 'root', 'root', 'This role gives you all permissions', ['*'] ],
            [ 'api-user', 'Api user', '', ['query-temperature'] ],
        ];

        foreach ($roles as $role) {
            $roleEntry = \App\Models\Auth\Role::firstOrNew([
                'name' => $role[0],
            ]);

            $roleEntry->display_name = $role[1];
            $roleEntry->description = $role[2];
            $roleEntry->save();

            if (array_key_exists(3, $role)) {
                foreach ($role[3] as $permission) {
                    if ($permission == '*') {
                        $roleEntry->syncPermissions(Permission::all());
                        break;
                    }

                    $permission = Permission::where(['name' => $permission])->first();
                    if ($permission) {
                        $roleEntry->syncPermissions([$permission]);
                        break;
                    }

                    $message = "Unknown permission: " . $permission;
                    Log::error($message);
                    echo $message . PHP_EOL;
                }
            }
        }

        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
