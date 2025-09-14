<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('sections')->insert([
            ['name' => 'A', 'description' => 'Section A'],
            ['name' => 'B', 'description' => 'Section B'],
            ['name' => 'C', 'description' => 'Section C'],
            ['name' => 'D', 'description' => 'Section D'],
        ]);
    }
}
