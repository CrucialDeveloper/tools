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

    public function show(Client $client)
    {
        return Inertia::render('Clients/Show', [
            'clients' => auth()->user()->clients,
            'client' => $client->load(['projects' => function ($query) {
                $query->latest()->take(5);
            }])
        ]);
    }

    public function store(Request $request)
    {
        $client = Client::make($request->all());

        auth()->user()->clients()->save($client);

        return redirect()->route('clients.show', $client);
    }

    public function update(Request $request, Client $client)
    {
        $client->update($request->all());

        return redirect()->route('clients.show', $client);
    }
}
