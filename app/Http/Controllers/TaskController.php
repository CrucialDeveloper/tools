<?php

namespace App\Http\Controllers;

use App\Task;
use App\Client;
use App\Project;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function create(Client $client, Project $project)
    {
        return Inertia::render('Tasks/Create', [
            'board' => $client,
            'project' => $project
        ]);
    }

    public function store(Request $request, Client $client, Project $project)
    {
        $this->validateRequest($request);

        $task = Task::make([
            'user_id' => auth()->user()->id,
            'client_id' => $client->id,
            'project_id' => $project->id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        $project->tasks()->save($task);

        return "/b/$client->slug/p/$project->slug";
    }

    public function show(Client $client, Project $project, Task $task)
    {
        return Inertia::render('Tasks/Show', [
            'board' => $client,
            'project' => $project,
            'task' => $task
        ]);
    }

    public function edit(Client $client, Project $project, Task $task)
    {
        return Inertia::render('Tasks/Edit', [
            'board' => $client,
            'project' => $project,
            'task' => $task
        ]);
    }

    public function update(Request $request, Client $client, Project $project, Task $task)
    {
        $this->validateRequest($request, $task);

        $task->update([
            'user_id' => auth()->user()->id,
            'project_id' => $project->id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $task->save();

        return "/b/$client->slug/p/$project->slug/t/$task->slug";
    }

    public function destroy(Request $request, Client $client, Project $project, Task $task)
    {
        $task->delete();

        return "/b/$client->slug/p/$project->slug";
    }

    public function validateRequest($request, $task = null)
    {
        $request->validate([
            'title' => ['required', $task ? Rule::unique('tasks', 'title')->ignore($task->id) : ''],
            'description' => 'required',
            'status' => 'required',
        ]);
    }
}
