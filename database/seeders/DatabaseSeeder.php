<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Admin\Entities\Permission;
use Modules\Admin\Entities\Role;
use Modules\Admin\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        //create admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Administrator', 'password' => 'admin@123', 'phone' => '0123456789', 'status' => 1]
        );

        $user = User::where('email', 'admin@gmail.com')->first();
    }
}
