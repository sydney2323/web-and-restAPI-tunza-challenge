<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
		    'username' => 'admin2023',
		    'role' => 'admin',
		    'password' => \Illuminate\Support\Facades\Hash::make('admin'),
	    ]);
    }
}
