<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class UserTest extends TestCase
{
    use WithFaker;
    private string $endpoint = "api/users/";
    protected string $UsersTable = 'users';

    public function testGetAllUser(): void
    {
        $users = User::factory(10)->create();
        
        $this->json('GET', $this->endpoint)
            ->assertSee($users[5]->title)
            ->assertStatus(200);
    }

    public function testUserCreate(): void
    {
        $payload = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone' => '1234567890',
            'email' => $this->faker->unique()->safeEmail,
            'adress' => '123 Main St, City',
            'role' => 'doctor',
        ];

        $this->json('POST', $this->endpoint, $payload)
            ->assertSee($payload['first_name'])
            ->assertStatus(200);
    }

    public function testShowUser(): void
    {
        $user = User::factory()->create();

        $this->json('GET', $this->endpoint.$user->id)
            ->assertSee($user->first_name)
            ->assertStatus(200);
    }

    public function testUpdateUser(): void
    {
        $user = User::factory()->create();
        $payload = [
            'first_name' => 'ahhaah',
            'last_name' => 'dkfsaflak',
            'phone' => '1234444444',
        ];
    
        $this->json('put',$this->endpoint.$user->id, $payload)
            ->assertStatus(200)
            ->assertSee($payload['first_name']);
    
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => $payload['first_name'],
            'last_name' => $payload['last_name'],
            'phone' => $payload['phone'],
        ]);
    }

    public function testDeleteUser(): void
    {
        $user = User::factory()->create();

        $response = $this->delete($this->endpoint.$user->id);
        $response->assertStatus(204);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }

    public function testGetAllDoctors(): void
    {
        User::factory(5)->create(['role' => 'doctor']);

        $this->json('GET', $this->endpoint . 'get-all-doctors')
            ->assertSee('doctor')
            ->assertStatus(200);

        $this->assertDatabaseCount($this->UsersTable, User::count());
    }

}