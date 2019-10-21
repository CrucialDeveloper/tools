<?php

namespace App\Http\Controllers;

use App\Client;
use App\Project;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{

    public function create(Client $client)
    {
        return Inertia::render('Projects/Create', [
            'board' => $client,
        ]);
    }

    public function store(Request $request, Client $client)
    {

        $this->validateRequest($request);

        $project = Project::make([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'description' => $request->description,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'available_status' => $request->available_status,
        ]);
        $client->projects()->save($project);

        return "/b/$client->slug/";
    }

    public function show(Client $client, Project $project)
    {
        return Inertia::render('Projects/Show', [
            'board' => $client,
            'project' => $project->load(['tasks', 'comments.commenter:id,first_name,last_name', 'files'])
        ]);
    }

    public function edit(Client $client, Project $project)
    {
        return Inertia::render('Projects/Edit', [
            'board' => $client,
            'project' => $project,
        ]);
    }

    public function update(Request $request, Client $client, Project $project)
    {
        $this->validateRequest($request, $project);

        $project->update([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'client_id' => $client->id,
            'description' => $request->description,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'available_status' => $request->available_status
        ]);

        $project->save();

        return "/clients/$client->url_id/projects/$project->url_id";
    }

    public function destroy(Request $request, Client $client, Project $project)
    {
        $project->delete();

        return "/clients/$client->slug/";
    }

    public function validateRequest($request, $project = null)
    {
        $request->validate([
            'title' => ['required', $project ? Rule::unique('projects', 'title')->ignore($project->id) : ''],
            'description' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'due_date' => 'required',
            'priority' => 'required',
            'available_status' => 'required',
        ]);
    }
}
