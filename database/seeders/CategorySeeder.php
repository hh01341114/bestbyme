<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => '車', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ファッション', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'インドア', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
