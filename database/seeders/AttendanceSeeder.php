<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attendance::query()->create([
            'user_id'              => 1,
            'date'                 => '2024-03-01',
            'check_in'             => '12:33:44',
            'check_out'            => '13:33:44',
            'number_working_hours' => 1,
        ]);
    }
}
