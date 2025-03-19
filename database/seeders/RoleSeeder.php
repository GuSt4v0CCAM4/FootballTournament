<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creacion de roles para el sistema para el torneo de PES
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $player = Role::firstOrCreate(['name' => 'player']);

        //Creacion de permisos
        Permission::firstOrCreate(['name' => 'create']);
        Permission::firstOrCreate(['name' => 'read']);

        //Asignacion de permisos a los roles
        $admin->givePermissionTo('create');
        $admin->givePermissionTo('read');


        //Creacion de una cuenta admin por defecto
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
            ]);
            $admin->assignRole('admin');
        }
    }
}
