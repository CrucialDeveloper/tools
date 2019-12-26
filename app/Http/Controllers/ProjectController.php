<?php

namespace App\Http\Controllers;

use App\Project;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Projects/All', [
            'projects' => Project::with('client')->where('user_id', auth()->user()->id)->get()
        ]);
    }
}
