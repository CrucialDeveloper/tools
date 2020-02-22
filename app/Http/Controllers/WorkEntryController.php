<?php

namespace App\Http\Controllers;

use App\Client;
use App\Project;
use App\WorkEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkEntryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client, Project $project)
    {
        $this->validateEntry($request);
        $start = is_numeric($request->start_time) ? Carbon::createFromTimestampMs($request->start_time) : Carbon::parse($request->start_time);
        $end = is_numeric($request->end_time) ?  Carbon::createFromTimestampMs($request->end_time) : Carbon::parse($request->end_time);

        $entry = WorkEntry::make([
            "start_time" => $start,
            "end_time" => $end,
            "work_type" => $request->work_type,
            "description" => $request->description,
            "billable" => $request->billable,
            "billed" => $request->billed,
            "work_time" => $request->work_time,
            "work_rate" => $request->work_rate,
            "client_url_id" => $client->url_id,
            "project_url_id" => $project->url_id
        ]);
        $entry->owner()->associate(auth()->user());
        $entry->client()->associate($client->id);
        $entry->project()->associate($project->id);

        $entry->save();

        return $entry;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkEntry  $timeKeeping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client, Project $project, WorkEntry $entry)
    {
        $entry->start_time = $request->start_time;
        $entry->end_time = $request->end_time;
        $entry->description = $request->description;
        $entry->work_time = $request->work_time;
        $entry->work_type = $request->work_type;
        $entry->work_rate = $request->work_rate;

        $entry->save();
        return $entry;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkEntry  $timeKeeping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client, Project $project, WorkEntry $entry)
    {
        $entry->delete();
    }

    public function validateEntry($request)
    {
        $request->validate([
            "start_time" => "required",
            "end_time" => "required",
            "work_type" => "required",
            "description" => "required",
            "billable" => "required",
            "work_time" => "required",
            "work_rate" => "required",
        ]);
    }
}
