<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        // name, display_name, description
        $permissions = [
            [ 'query-temperature', 'Query the temperature', 'User can query the temperature from the database' ],
        ];
        foreach ($permissions as $permission) {
            $permissionInstance = \App\Models\Auth\Permission::firstOrNew([
                'name' => $permission[0],
            ]);
            $permissionInstance->display_name = $permission[1];
            $permissionInstance->description = $permission[2];
            $permissionInstance->save();
        }

        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
