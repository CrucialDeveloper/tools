<?php

namespace Tests\Feature;

use App\Client;
use App\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_contact_has_attributes()
    {
        $contact = $this->make(Contact::class);

        $this->assertArrayHasKey('first_name', $contact);
        $this->assertArrayHasKey('last_name', $contact);
        $this->assertArrayHasKey('email', $contact);
        $this->assertArrayHasKey('address', $contact);
        $this->assertArrayHasKey('city', $contact);
        $this->assertArrayHasKey('state', $contact);
        $this->assertArrayHasKey('zip', $contact);
        $this->assertArrayHasKey('phone_number', $contact);

        $contact->save();

        $this->assertDatabaseHas('contacts', $contact->toArray());
    }

    /**
     * @test
     */
    public function a_contact_can_be_created_from_post_route()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $client = $this->create(Client::class);
        $contact = $this->raw(Contact::class);

        $response = $this->post("/clients/{$client->url_id}/contacts", $contact);

        $this->assertDatabaseHas('contacts', $contact);
    }

    /**
     * @test
     */
    public function a_client_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->signIn();
        $client = $this->create(Client::class);
        $contact = $this->create(Contact::class);
        $contact->order = 1;

        $response = $this->patch($client->path . "/contacts/" . $contact->id, $contact->toArray());

        $this->assertEquals(1, Contact::first()->order);
    }
}
