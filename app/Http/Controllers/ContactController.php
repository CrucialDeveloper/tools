<?php

namespace App\Http\Controllers;

use App\Client;
use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request, Client $client)
    {
        $contact = Contact::make($request->all());

        $client->contacts()->save($contact);
    }

    public function update(Request $request, Client $client, Contact $contact)
    {
        $contact->update($request->all());
        $contact->save();
    }

    public function updateOrder(Request $request, Client $client)
    {
        $order = collect($request->order);
        $client->contacts->each(function ($contact) use ($order) {
            $contact->order = $order[$contact->id];
            $contact->save();
        });
    }
}
