<?php

namespace App\Http\Controllers;

use App\Client;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return Inertia::render('Clients/Index', [
            'clients' => auth()->user()->clients
        ]);
    }

    public function store(Request $request)
    {
        $client = Client::make($request->all());

        auth()->user()->clients()->save($client);

        return '';
    }

    public function update(Request $request, Client $client)
    {
        $client->update($request->all());

        return '';
    }
}
