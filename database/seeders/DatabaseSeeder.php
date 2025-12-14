<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        if (!User::where('email', 'artist@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Artist',
                'email' => 'artist@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            ArtworkSeeder::class,
            PostSeeder::class,
            ExhibitionSeeder::class,
            ContactSubmissionSeeder::class,
            MediaSeeder::class,
        ]);
    }
}
