<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class ImageManipulationController extends Controller
{
    public function index()
    {
        Inertia::setRootView('public');
        return Inertia::render('ImagesManipulation/Index');
    }
}
