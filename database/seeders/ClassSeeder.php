<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           DB::table('classes')->insert([
            ['name' => 'Play', 'order_number' => 1, 'description' => 'Play group class for beginners'],
            ['name' => 'Nursery', 'order_number' => 2, 'description' => 'Nursery class for early learners'],
            ['name' => 'KG-01', 'order_number' => 3, 'description' => 'Kindergarten level 1'],
            ['name' => 'KG-02', 'order_number' => 4, 'description' => 'Kindergarten level 2'],
            ['name' => 'Class-01', 'order_number' => 5, 'description' => 'Primary Class 1'],
            ['name' => 'Class-02', 'order_number' => 6, 'description' => 'Primary Class 2'],
            ['name' => 'Class-03', 'order_number' => 7, 'description' => 'Primary Class 3'],
            ['name' => 'Class-04', 'order_number' => 8, 'description' => 'Primary Class 4'],
            ['name' => 'Class-05', 'order_number' => 9, 'description' => 'Primary Class 5'],
        ]);
    }
}
