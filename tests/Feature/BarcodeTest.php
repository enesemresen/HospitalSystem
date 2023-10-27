<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Barcode;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BarcodeTest extends TestCase
{
    use WithFaker;

    private string $endpoint = "api/barcodes/";

    public function testGetAllBarcode(): void
    {
        $barcodes = Barcode::factory(10)->create();
        
        $this->json('GET', $this->endpoint)
            ->assertSee($barcodes[5]->title)
            ->assertStatus(200);
    }

    public function testBarcodeCreate(): void // create çalışmıyor
    {
        $payload = [
            'value'=> $this->faker->randomFloat,
            'appointment_id' => Appointment::factory()->create()->id,
        ];

        $this->json('POST', $this->endpoint, $payload)
            ->assertSee($payload['value'])
            ->assertStatus(200);
    }

    public function testShowBarcode(): void
    {
        $barcode = Barcode::factory()->create();

        $this->json('GET', $this->endpoint.$barcode->id)
            ->assertSee($barcode->first_name)
            ->assertStatus(200);
    }

    public function testUpdateBarcode(): void //update çalışmıyor
    {
        $barcode = Barcode::factory()->create();
        $payload = [
            'value' => $this->faker->randomFloat,
            'appointment_id' => Appointment::factory()->create()->id,
        ];
    
        $this->json('put',$this->endpoint.$barcode->id, $payload)
            ->assertStatus(200)
            ->assertSee($payload['value']);
    
        $this->assertDatabaseHas('barcodes', [
            'id' => $barcode->id,
            'value' => $payload['value'],
        ]);
    }

    public function testDeleteBarcode(): void
    {
        $barcode = Barcode::factory()->create();

        $response = $this->delete($this->endpoint.$barcode->id);
        $response->assertStatus(204);

        $this->assertDatabaseMissing('barcodes', [
            'id' => $barcode->id
        ]);
    }
}
