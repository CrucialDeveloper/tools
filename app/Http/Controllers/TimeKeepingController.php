<?php

namespace App\Http\Controllers;

use App\Client;
use App\Project;
use App\TimeKeeping;
use Illuminate\Http\Request;

class TimeKeepingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client, Project $project)
    {
        $entry = TimeKeeping::make($request->all());
        $entry->duration = $entry->end_time->diffInRealMinutes($entry->start_time);
        $entry->client_url_id = $client->url_id;
        $entry->project_url_id = $project->url_id;
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
     * @param  \App\TimeKeeping  $timeKeeping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client, Project $project, TimeKeeping $entry)
    {
        $entry->start_time = $request->start_time;
        $entry->end_time = $request->end_time;
        $entry->description = $request->description;
        $entry->duration = $entry->end_time->diffInRealMinutes($entry->start_time);
        $entry->save();

        return $entry;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TimeKeeping  $timeKeeping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client, Project $project, TimeKeeping $entry)
    {
        $entry->delete();
    }
}
