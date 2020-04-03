<?php

namespace App\Http\Controllers;

use App\Tools\HTMLCleaner;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HtmlCleanerController extends Controller
{
    public function index()
    {
        return Inertia::render('HtmlCleaner/Index');
    }

    public function store(Request $request, HTMLCleaner $cleaner)
    {
        return $cleaner->parse($request);
    }
}
