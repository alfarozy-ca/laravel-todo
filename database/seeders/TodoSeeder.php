<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(): void
    {
        Todo::factory()->count(20)->create();
        /*
        DB::table('todos')->insert([
            ['description' => 'Learn Laravel 11', 'completed' => false],
            ['description' => 'Build an API', 'completed' => true],
        ]);*/
    }
}
