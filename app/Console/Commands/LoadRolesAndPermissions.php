<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LoadRolesAndPermissions extends Command
{
    protected $signature = 'roles:load';


    protected $description = 'Load roles and permissions';


    public function handle()
    {
        $roles = app()->environment() === 'testing' ? config('roles_testing') : config('roles');
        $progressBar = $this->output->createProgressBar(count($roles));
        $progressBar->start();

        foreach ($roles as $role => $permissions) {
            DB::beginTransaction();
            collect($permissions)->each(function ($permission) {
                Permission::updateOrCreate(
                    ['name' => $permission],
                    ['guard_name' => 'api']
                );
            });

            $role = Role::updateOrCreate(
                ['name' => $role],
                [
                    'guard_name' => 'api',
                ]
            )
                ->syncPermissions(Permission::whereIn('name', $permissions)->get());
            DB::commit();
            $progressBar->advance();
        }
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
