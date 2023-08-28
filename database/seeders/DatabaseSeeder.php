<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleAndPermissionSeeder::class,
        ]);
        //User::factory(10)->create();

        // \APP\MODELS\USER::FACTORY()->CREATE([
        //     'NAME' => 'TEST USER',
        //     'EMAIL' => 'TEST@EXAMPLE.COM',
        // ]);
    }
}
