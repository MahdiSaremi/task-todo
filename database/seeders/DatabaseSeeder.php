<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'first_name' => "مهدی",
            'last_name' => "صارمی",
            'phone' => '09154913267',
        ]);
        User::create([
            'first_name' => "علیرضا",
            'last_name' => "احمدی",
            'phone' => '09154913260',
        ]);
        User::create([
            'first_name' => "محمد",
            'last_name' => "صادقی",
            'phone' => '09154913250',
        ]);
    }
}
