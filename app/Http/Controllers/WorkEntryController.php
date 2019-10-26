<?php

namespace App\Http\Controllers;

use App\Client;
use App\Project;
use App\WorkEntry;
use Illuminate\Http\Request;

class WorkEntryController extends Controller
{
    public function store(Request $request, Client $client, Project $project)
    {
        $entry = WorkEntry::make([
            'user_id' => auth()->user()->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'billable' => $request->billable
        ]);

        $project->work_entry()->save($entry);
    }

    public function update(Request $request, Client $client, Project $project, WorkEntry $entry)
    {
        $entry->update($request->all());
    }
}
