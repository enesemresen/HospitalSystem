<?php

namespace Tests\Feature;

use App\Models\Hospital;
use App\Models\Polyclinic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PolyclinicTest extends TestCase
{
    use WithFaker;
    private string $endpoint = "api/polyclinics/";

    public function testGetAllPolycilinic(): void
    {
        $polyclinic = Polyclinic::factory(10)->create();
        
        $this->json('GET', $this->endpoint)
            ->assertSee($polyclinic[5]->title)
            ->assertStatus(200);
    }

    public function testPolyclinicCreate(): void
    {
        $payload = [
            'name' => 'John',
            'personal_id' => User::factory()->create(['role' => 'personal'])->id,
            'hospital_id' => Hospital::factory()->create()->id,
        ];

        $this->json('POST', $this->endpoint, $payload)
            ->assertSee($payload['name'])
            ->assertStatus(200);
    }

    public function testShowPolyclinic(): void
    {
        $polyclinic = Polyclinic::factory()->create();

        $this->json('GET', $this->endpoint.$polyclinic->id)
            ->assertSee($polyclinic->first_name)
            ->assertStatus(200);
    }

    public function testUpdatePolyclinic(): void
    {
        $polyclinic = Polyclinic::factory()->create();
        $payload = [
            'name' => 'ahhaah',
        ];
    
        $this->json('put',$this->endpoint.$polyclinic->id, $payload)
            ->assertStatus(200)
            ->assertSee($payload['name']);
    
        $this->assertDatabaseHas('polyclinics', [
            'id' => $polyclinic->id,
            'name' => $payload['name'],
        ]);
    }

    public function testDeletePolyclinic(): void
    {
        $polyclinic = Polyclinic::factory()->create();

        $response = $this->delete($this->endpoint.$polyclinic->id);
        $response->assertStatus(204);

        $this->assertDatabaseMissing('polyclinics', [
            'id' => $polyclinic->id
        ]);
    }
}
