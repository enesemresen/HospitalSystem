<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    use WithFaker;
    private string $endpoint = "api/appointments/";

    public function testGetAllAppointment(): void
    {
        $appointments = Appointment::factory(10)->create();
        
        $this->json('GET', $this->endpoint)
            ->assertSee($appointments[5]->title)
            ->assertStatus(200);
    }

    public function testAppointmentCreate(): void
    {
        $payload = [
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'patient_id' => User::factory()->create(['role' => 'patient'])->id,
            'personal_id' => User::factory()->create(['role' => 'doctor'])->id,
        ];

        $this->json('POST', $this->endpoint, $payload)
            ->assertSee($payload['time'])
            ->assertStatus(200);
    }

    public function testShowAppointment(): void
    {
        $appointment = Appointment::factory()->create();

        $this->json('GET', $this->endpoint.$appointment->id)
            ->assertSee($appointment->status)
            ->assertStatus(200);
    }

    public function testUpdateAppointment(): void
    {
        $appointment = Appointment::factory()->create();
        $payload = [
            'status' => 'cancelled'
        ];
    
        $this->json('put',$this->endpoint.$appointment->id, $payload)
            ->assertStatus(200)
            ->assertSee($payload['status']);
    
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => $payload['status'],
        ]);
    }

    public function testDeleteAppointment(): void
    {
        $appointment = Appointment::factory()->create();

        $response = $this->delete($this->endpoint.$appointment->id);
        $response->assertStatus(204);

        $this->assertDatabaseMissing('appointments', [
            'id' => $appointment->id
        ]);
    }
}
