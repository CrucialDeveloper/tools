<?php

namespace App\Http\Controllers;

use App\Project;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Projects/All', [
            'projects' => Project::with('client')->where('user_id', auth()->user()->id)->get()
        ]);
    }
}
