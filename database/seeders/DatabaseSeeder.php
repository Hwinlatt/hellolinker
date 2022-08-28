<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'gender'=>'male',
            'password'=>'$2y$10$zSLi/UTwM3QMNeNFeM1sQu3V//FB8wWS24Glio7x0tQzlzR5F6yF.',
            'role'=>'admin'
        ]);
    }
}
