<?php

namespace Tests\Feature;

use App\Models\Analyse;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnalyseTest extends TestCase
{
    use WithFaker;
    private string $endpoint = "api/analyses/";
    
    public function testGetAllAnalyse(): void
    {
        $analyses = Analyse::factory(10)->create();
        
        $this->json('GET', $this->endpoint)
            ->assertSee($analyses[5]->title)
            ->assertStatus(200);
    }

    public function testAnalyseCreate(): void
    {
        $payload = [
            'type' => $this->faker->randomElement(['blood', 'urine', 'x-ray']),
            'result' => $this->faker->text(255),
            'created_id' => User::factory()->create(['role' => 'personal'])->id,
            'patient_id' => User::factory()->create(['role' => 'patient'])->id,
            'personal_id' => User::factory()->create(['role' => 'doctor'])->id,
        ];

        $this->json('POST', $this->endpoint, $payload)
            ->assertSee($payload['result'])
            ->assertStatus(200);
    }

    public function testShowAnalyse(): void
    {
        $analyse = Analyse::factory()->create();

        $this->json('GET', $this->endpoint.$analyse->id)
            ->assertSee($analyse->type)
            ->assertStatus(200);
    }

    public function testUpdateAnalyse(): void
    {
        $analyse = Analyse::factory()->create();
        $payload = [
            'type' => 'x-ray',
            'result' => 'dkfsaflak',
        ];
    
        $this->json('put',$this->endpoint.$analyse->id, $payload)
            ->assertStatus(200)
            ->assertSee($payload['result']);
    
        $this->assertDatabaseHas('analyses', [
            'id' => $analyse->id,
            'type' => $payload['type'],
            'result' => $payload['result'],
        ]);
    }

    public function testDeleteAnalyse(): void
    {
        $analyse = Analyse::factory()->create();

        $response = $this->delete($this->endpoint.$analyse->id);
        $response->assertStatus(204);

        $this->assertDatabaseMissing('analyses', [
            'id' => $analyse->id
        ]);
    }
}
