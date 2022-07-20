<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_getSetting()
    {
        $response = $this->get('api/settings');

        $response->assertStatus(200);
    }

    public function test_getEmployee()
    {
        $response = $this->get('api/employees');

        $response->assertStatus(200);
    }

    public function test_updateSetting()
    {
        $response = $this->patch('api/settings/', [
            'key' => 'overtime_method',
            'value' => '1',
        ]);

        $response->assertStatus(200);
    }

    public function test_storeEmployee()
    {
        $data = [
            'name' => 'test',
            'salary' => '5000000',
        ];
        $response = $this->json('POST', 'api/employees', $data, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $response->assertStatus(201);
    }

    public function test_getOvertime()
    {
        $response = $this->get('api/overtimes');

        $response->assertStatus(200);
    }

    public function test_storeOvertime()
    {
        $data = [
            'employee_id' => '1',
            'date' => '2020-01-01',
            'start_time' => '08:00',
            'end_time' => '17:00',
        ];
        $response = $this->json('POST', 'api/overtimes', $data, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $response->assertStatus(201);
    }

    public function test_overtimePaysCalculate()
    {
        $response = $this->get('api/overtime-pays/calculate');

        $response->assertStatus(200);
    }
}
