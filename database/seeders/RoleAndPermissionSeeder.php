<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // creating different access
        Permission::create(["name" => "discover drivers"]);
        Permission::create(["name" => "create trip"]);
        Permission::create(["name" => "edit trip"]);
        Permission::create(["name" => "create alert"]);
        Permission::create(["name" => "create review"]);
        Permission::create(["name" => "start trip"]);
        Permission::create(["name" => "end trip"]);
        Permission::create(["name" => "trip history"]);
        Permission::create(["name" => "buy points"]);
        Permission::create(["name" => "create car"]);
        Permission::create(["name" => "edit car"]);
        Permission::create(["name" => "delete car"]);
        Permission::create(["name" => "create user"]);
        Permission::create(["name" => "edit user"]);
        Permission::create(["name" => "delete user"]);
        Permission::create(["name" => "restore user"]);
        Permission::create(["name" => "create car type"]);
        Permission::create(["name" => "edit car type"]);
        Permission::create(["name" => "delete car type"]);
        Permission::create(["name" => "list car type"]);
        Permission::create(["name" => "restore car type"]);

        // create role and assign created permissions
        Role::create(["name" => "client"])
            ->givePermissionTo(
                [
                    "discover drivers",
                    "edit trip",
                    "create alert",
                    "create review",
                    "trip history",
                    "edit user",
                ]
            );

        Role::create(["name" => "driver"])
            ->givePermissionTo(
                [
                    "discover drivers",
                    "edit trip",
                    "create alert",
                    "create review",
                    "trip history",
                    "edit user",
                    "start trip",
                    "end trip",
                    "create car",
                ]
            );

        Role::create(["name" => "admin"])
            ->givePermissionTo(
                [
                    "discover drivers",
                    "edit trip",
                    "create alert",
                    "create review",
                    "trip history",
                    "edit user",
                    "start trip",
                    "end trip",
                    "buy points",
                    "create car",
                    "edit car",
                    "create user",
                    "edit user",
                    "create car type",
                    "edit car type",
                    "list car type",
                ]
            );

        Role::create(["name" => "super_admin"])
            ->givePermissionTo(Permission::all());
    }
}
