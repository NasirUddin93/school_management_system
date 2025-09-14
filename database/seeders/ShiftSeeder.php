<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shifts')->insert([
            [
                'name' => 'Morning',
                'start_time' => '07:30:00',
                'end_time' => '12:30:00',
                'description' => 'Morning shift for younger classes'
            ],
            [
                'name' => 'Day',
                'start_time' => '13:00:00',
                'end_time' => '17:30:00',
                'description' => 'Day shift for older classes'
            ],
        ]);
    }
}
