<?php

namespace Tests\Unit;

use App\User;
use App\Client;
use Tests\TestCase;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_client_factory_has_attributes()
    {
        $this->withoutExceptionHandling();

        $client = $this->create(Client::class);

        $this->assertDatabaseHas('clients', $client->setAppends([])->toArray());
    }

    /**
     * @test
     */
    public function clients_have_a_hashid_for_a_urlid()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $client = $this->create(Client::class);

        $this->assertSame(Hashids::connection('client')->encode(1), $client->fresh()->url_id);
    }

    /**
     * @test
     */
    public function a_user_can_have_many_clients()
    {
        $this->withoutExceptionHandling();

        $user = $this->create(User::class);

        $client = $this->make(Client::class);

        $user->clients()->save($client);

        $this->assertCount(1, Client::all());

        $this->assertCount(1, $user->fresh()->clients);
    }

    /**
     * @test
     */
    public function a_client_belongs_to_a_user()
    {
        $this->withoutExceptionHandling();

        $user = $this->create(User::class);

        $client = $this->make(Client::class);

        $client->user()->associate($user)->save();
        $this->assertCount(1, $client->user()->get());
    }

    /**
     * @test
     */
    public function users_can_view_their_clients()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $clients = $this->create(Client::class, [], 3);

        $response = $this->get('/clients');

        $this->assertArrayHasKey('clients', $response->getOriginalContent()->getData()['page']['props']);
        $this->assertEqualsCanonicalizing($user->clients, $response->getOriginalContent()->getData()['page']['props']['clients']);
    }

    /**
     * @test
     */
    public function guests_cannot_create_clients()
    {
        $client = $this->raw(Client::class);
        $response = $this->post('/clients', $client);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /**
     * @test
     */
    public function a_user_can_create_a_client()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $client = $this->raw(Client::class);

        $response = $this->post('/clients', $client);

        $this->assertDatabaseHas('clients', $client);
    }

    /**
     * @test
     */
    public function a_user_can_update_their_clients()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $client = $this->create(Client::class);

        $response = $this->patch("/clients/$client->url_id", [
            'company_name' => 'New Name'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('clients', [
            'company_name' => 'New Name'
        ]);
    }

    /**
     * @test
     */
    public function a_client_is_soft_deleted_upon_deletion_by_user()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $client = $this->create(Client::class);

        $this->assertCount(1, Client::all());

        $client->delete();

        $this->assertCount(0, Client::all());
        $this->assertCount(1, Client::withTrashed()->get());
        $this->assertNotNull(Client::withTrashed()->first()->deleted_at);
    }

    /**
     * @test
     */
    public function a_client_can_be_deleted_through_a_delete_request()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $client = $this->create(Client::class);

        $this->assertCount(1, Client::all());

        $response = $this->delete($client->path);

        $this->assertCount(0, Client::all());
        $this->assertCount(1, Client::withTrashed()->get());
        $this->assertNotNull(Client::withTrashed()->first()->deleted_at);
    }
}
