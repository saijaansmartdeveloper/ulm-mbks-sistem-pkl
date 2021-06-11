<?php

namespace App\Providers;

use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Role;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Begin : UUID Adjustment */
        Permission::retrieved(function (Permission $permission) {
            $permission->incrementing = false;
        });

        Permission::creating(function (Permission $permission) {
            $permission->incrementing = false;
            $permission->id = Uuid::uuid4()->toString();
        });

        Role::retrieved(function (Role $role) {
            $role->incrementing = false;
        });

        Role::creating(function (Role $role) {
            $role->incrementing = false;
            $role->id = Uuid::uuid4()->toString();
        });
        /* End : UUID Adjustment */

        Paginator::useBootstrap();
    }
}
