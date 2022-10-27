<?php

namespace Database\Seeders;

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
        $permissions = ['report', 'article', 'tour', 'event',
            'tour', 'article-category', 'author', 'player', 'tag', 'image-theme',
            'page', 'menu-item', 'series',
        ];

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
