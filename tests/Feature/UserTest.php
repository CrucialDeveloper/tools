<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function users_have_a_first_name()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'first_name' => 'John'
        ]);

        $this->assertDatabaseHas('users', [
            'first_name' => 'John'
        ]);
    }

    /**
     * @test
     */
    public function users_have_a_last_name()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'last_name' => 'Lowery'
        ]);

        $this->assertDatabaseHas('users', [
            'last_name' => 'Lowery'
        ]);
    }

    /**
     * @test
     */
    public function users_can_be_created_from_the_register_route()
    {
        $this->withoutExceptionHandling();

        $user = $this->raw(User::class);

        $response = $this->post('/register', array_merge(
            $user,
            ['password_confirmation' => $user['password']]
        ));

        $this->assertDatabaseHas('users', [
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
        ]);
    }
}
