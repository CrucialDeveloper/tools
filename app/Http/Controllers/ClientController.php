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
            'clients' => auth()->user()->clients()->latest()->get()
        ]);
    }

    public function show(Client $client)
    {
        return Inertia::render('Clients/Show', [
            'clients' => auth()->user()->clients()->latest()->get(),
            'client' => $client->load(['projects' => function ($query) {
                $query->latest()->take(5);
            }, 'contacts'])
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $client = Client::make($request->all());

        auth()->user()->clients()->save($client);

        return  $client->path;
    }

    public function update(Request $request, Client $client)
    {
        $this->validateRequest($request);

        $client->update($request->all());

        return $client->path;
    }

    public function validateRequest(Request $request)
    {
        $request->validate([
            'company_name' => 'sometimes|required',
            'address' => 'sometimes|required',
            'city' => 'sometimes|required',
            'state' => 'sometimes|required',
            'zip' => 'sometimes|required',
            'country' => 'sometimes|required',
            'phone_number' => 'sometimes|required',
        ]);
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return '/clients';
    }
}
