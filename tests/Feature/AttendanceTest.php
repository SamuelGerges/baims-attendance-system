<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AttendanceTest extends TestCase
{

    protected $attendance;
    protected $dates ;

    public function setUp(): void
    {
        parent::setUp();
        $this->attendance = [
            'user_id'              => 1,
            'date'                 => now()->format('Y-m-d'),
            'check_in'             => now()->format('H:i:s'),
            'check_out'            => null,
            'number_working_hours' => null,
        ];


        $this->dates = [
            'from_date' => '2024-09-01',
            'to_date'   => '2024-09-10',
        ];

    }

    public function test_check_in(): void
    {
        $user     = User::query()->latest()->first();
        $response = $this->actingAs($user)->post('/api/v1/attendances/check-in', $this->attendance);

        $response->assertStatus(200);

        $this->assertDatabaseHas('attendances', [
            'user_id' => 1,
            'date'    => now()->format('Y-m-d'),
        ]);
    }

    public function test_check_in_before_check_out(): void
    {
        $user     = User::query()->latest()->first();
        $response = $this->actingAs($user)->post('/api/v1/attendances/check-in', $this->attendance);

        $response->assertStatus(406);

        $this->assertDatabaseHas('attendances', [
            'user_id' => 1,
            'date'    => now()->format('Y-m-d'),
        ]);
    }


    public function test_check_out(): void
    {
        $user     = User::query()->latest()->first();
        $response = $this->actingAs($user)->patch('/api/v1/attendances/check-out');

        $response->assertStatus(200);

        $this->assertDatabaseHas('attendances', [
            'user_id'   => 1,
            'date'      => now()->format('Y-m-d'),
            'check_out' => now()->format('H:i:s'),
        ]);
    }

    public function test_check_out_before_check_in(): void
    {
        $user     = User::query()->latest()->first();
        $response = $this->actingAs($user)->patch('/api/v1/attendances/check-out');

        $response->assertStatus(404);
    }


    public function test_get_total_hours_between_two_dates(): void
    {
        $user     = User::query()->latest()->first();

        $response = $this->withHeaders(['is_api_call' => 'yes'])
            ->actingAs($user)->post('/api/v1/attendances/get-total-hours-between-two-dates', $this->dates);

        $response->assertStatus(200);
    }
}
