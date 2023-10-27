<?php

namespace Tests\Feature;

use App\Models\Hospital;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HospitalTest extends TestCase
{
    use WithFaker;
    private string $endpoint = "api/hospitals/";

    public function testGetAllHospital(): void
    {
        $hospitals = Hospital::factory(10)->create();
        
        $this->json('GET', $this->endpoint)
            ->assertSee($hospitals[5]->title)
            ->assertStatus(200);
    }

    public function testHospitalCreate(): void
    {
        $payload = [
            'name' => 'hastane_hastane',
            'adress' => '123 Main St, City',
        ];

        $this->json('POST', $this->endpoint, $payload)
            ->assertSee($payload['name'])
            ->assertStatus(200);
    }

    public function testShowHospital(): void
    {
        $hospitals = Hospital::factory()->create();

        $this->json('GET', $this->endpoint.$hospitals->id)
            ->assertSee($hospitals->name)
            ->assertStatus(200);
    }

    public function testUpdateHospital(): void
    {
        $hospital = Hospital::factory()->create();
        $payload = [
            'name' => 'ahhaah',
            'adress' => 'adres_adres_adres',
        ];
    
        $this->json('put',$this->endpoint.$hospital->id, $payload)
            ->assertStatus(200)
            ->assertSee($payload['name']);
    
        $this->assertDatabaseHas('hospitals', [
            'id' => $hospital->id,
            'name' => $payload['name'],
            'adress' => $payload['adress'],
        ]);
    }

    public function testDeleteHospital(): void
    {
        $hospital = Hospital::factory()->create();

        $response = $this->delete($this->endpoint.$hospital->id);
        $response->assertStatus(204);

        $this->assertDatabaseMissing('hospitals', [
            'id' => $hospital->id
        ]);
    }
}
