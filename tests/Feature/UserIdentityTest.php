<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserIdentity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserIdentityTest extends TestCase
{
    use WithFaker;
    private string $endpoint = "api/user_identities/";
    
    public function testGetAllUser(): void
    {
        $userIdentity = UserIdentity::factory(10)->create();
        
        $this->json('GET', $this->endpoint)
            ->assertSee($userIdentity[5]->title)
            ->assertStatus(200);
    }

    public function testUserIdentityCreate(): void
    {
        $payload = [
            'tc_no' => $this->faker->unique()->numerify('##############'), 
            'mother_name' => 'John',
            'father_name' => 'Doe',
            'serial_no' => $this->faker->unique()->numerify('#########'),
            'birthday' => '2022-01-01',
            'birthplace' => 'manisa',
            'user_id' => User::factory()->create()->id,
            'insurance_number' => $this->faker->unique()->numerify('##########'),
        ];

        $this->json('POST', $this->endpoint, $payload)
            ->assertSee($payload['mother_name'])
            ->assertStatus(200);
    }

    public function testShowUserIdentity(): void
    {
        $userIdentity = UserIdentity::factory()->create();

        $this->json('GET', $this->endpoint.$userIdentity->id)
            ->assertSee($userIdentity->tc_no)
            ->assertStatus(200);
    }

    public function testUpdateUserIdentity(): void
    {
        $userIdentity = UserIdentity::factory()->create();
        $payload = [
            'mother_name' => 'ahhaah',
            'father_name' => 'dkfsaflak',
            'birthplace' => 'dalsgfk',
        ];
    
        $this->json('put',$this->endpoint.$userIdentity->id, $payload)
            ->assertStatus(200)
            ->assertSee($payload['mother_name']);
    
        $this->assertDatabaseHas('user_identities', [
            'id' => $userIdentity->id,
            'mother_name' => $payload['mother_name'],
            'father_name' => $payload['father_name'],
            'birthplace' => $payload['birthplace'],
        ]);
    }

    public function testDeleteUserIdentity(): void
    {
        $userIdentity = UserIdentity::factory()->create();

        $response = $this->delete($this->endpoint.$userIdentity->id);
        $response->assertStatus(204);

        $this->assertDatabaseMissing('user_identities', [
            'id' => $userIdentity->id
        ]);
    }

}
