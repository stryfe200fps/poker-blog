<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\ArticleCrudController;
use Backpack\PermissionManager\app\Models\Permission;
use Exception;
use Illuminate\Database\Seeder;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = config('app.crud_entities');

        foreach ($permissions as $permission) {
            try {
                Permission::create(['name' => $permission.'.create',
                    'guard_name' => 'web', ]);
            } catch (Exception $e) {
            }

            try {
                Permission::create(['name' => $permission.'.update',
                    'guard_name' => 'web', ]);
            } catch (Exception $e) {
            }

            try {
                Permission::create(['name' => $permission.'.list',
                    'guard_name' => 'web', ]);
            } catch (Exception $e) {
            }

            try {
                Permission::create(['name' => $permission.'.show',
                    'guard_name' => 'web', ]);
            } catch (Exception $e) {
            }

            try {
                Permission::create(['name' => $permission.'.delete',
                    'guard_name' => 'web', ]);
            } catch (Exception $e) {
            }
        }
    }
}
