<?php

namespace App\Http\Controllers;

use App\Components;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function index()
    {
        return Inertia::render('Components/Index', [
            'components' => Components::all()
        ]);
    }
}
