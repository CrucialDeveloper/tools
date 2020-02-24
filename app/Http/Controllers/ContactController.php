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
}
