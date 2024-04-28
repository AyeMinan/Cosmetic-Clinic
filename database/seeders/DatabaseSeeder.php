<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Day;
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
        User::factory(10)->create();
        Clinic::factory()->create(['name' => '医院1']);
        Clinic::factory()->create(['name' => '病院2']);
        Clinic::factory()->create(['name' => '病院3']);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $japaneseDays = ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'];

        for ($i = 0; $i < 7; $i++) {
            Day::factory()->create([
                'name' => $japaneseDays[$i]
            ]);
        }

    }

}
