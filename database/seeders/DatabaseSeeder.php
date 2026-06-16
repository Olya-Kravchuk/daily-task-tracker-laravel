<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // for ($i = 0; $i < 50; $i++) {
        //     DB::table('categories')->insert(
        //         [
        //             [
        //             'name' => 'Category' . ($i + 1),
        //             'uuid' => Str::uuid(),
        //             'user_id' => 1
        //         ],
        //         [
        //             'name' => 'Category' . ($i + 1),
        //             'uuid' => Str::uuid(),
        //             'user_id' => 2
        //         ]
        //         ]
        //     );

        // }
        // for ($i = 0; $i < 50; $i++) {
        //     Category::create(
        //         [
        //             'name' => 'Category' . ($i + 1),
        //             'user_id' => 1
        //         ]
        //     );
        // }
        $this->call(
            [
                UserSeeder::class,
                CategorySeeder::class,
                TaskSeeder::class,
                RecurringTaskSeeder::class,
            ]
        );
    }
}
