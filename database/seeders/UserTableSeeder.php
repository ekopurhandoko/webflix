<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use PhpParser\Node\Expr\Assign;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() /*: void*/
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@webflix.text',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');
    }
}
