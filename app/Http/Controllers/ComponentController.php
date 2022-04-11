<?php

namespace App\Http\Controllers;

use App\Component;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ComponentController extends Controller
{
    public function index()
    {
        return Inertia::render('Components/Index', [
            'components' => Component::all()
        ]);
    }

    public function update(Request $request, Component $component)
    {
        $component->assigned_to = $request->assigned_to;
        $component->status = $request->status;
        $component->notes = $request->notes;
        $component->experience_fragment_path = $request->experience_fragment_path;
        $component->save();

        return Redirect::route('components.index')->with(['components' => Component::all()]);
    }
}
