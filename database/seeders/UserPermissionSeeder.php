<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Http\Controllers\Admin\ArticleCrudController;
=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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
<<<<<<< HEAD

        $permissions = config('app.crud_entities');
=======
        $permissions = ['report', 'article', 'tour', 'event',
            'tour', 'article-category', 'author', 'player', 'tag', 'image-theme',
            'page', 'menu-item', 'series',
        ];
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32

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
