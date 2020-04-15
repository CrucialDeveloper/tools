<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AemGroupController extends Controller
{

    public function index()
    {
        return Inertia::render('AemGroups/Index');
    }

    public function create(Request $request)
    {
        $content = $this->generateContentGroups($request);
        $functional = $this->generateAuthorGroups($request);
        return ['functional' => $functional, 'content' => $content];
    }

    public function generateAuthorGroups($request)
    {
        $this->validateRequest($request);

        $groups = [];
        $functionalRoles = ['Content Admin', 'Power Editor', 'Advanced Author', 'Basic Author', 'Approver', 'Reviewer'];
        foreach ($functionalRoles as $role) {
            $group = [
                "CMS-" . Str::title($request->site_name) .  "-Function-" . $request['bu_long'] . " " . $role,
                "cms-" . $request->site_name . "-function-" . Str::of($role)->studly()->lower() . "-" . Str::of($request['bu_short'])->studly()->lower(),
                // "CMS-" . $request->site_name . "-Function-" . $request['business_unit'] . " " . $role
            ];
            $groups[] = $group;
        }
        return $groups;
    }

    public function generateContentGroups($request)
    {
        $this->validateRequest($request);

        $groups = [];
        $contentRoles = ['Read', 'Write'];
        foreach ($contentRoles as $role) {
            $group = [
                "CMS-" . Str::title($request->site_name) .  "-Content-" . $request['bu_long'] . "-" . $role,
                "cms-" . $request->site_name . "-content-" . Str::of($request['bu_short'])->studly()->lower() . "-" . Str::of($role)->studly()->lower(),
                // "CMS-" . $request->site_name . "-Function-" . $request['business_unit'] . " " . $role
            ];
            $groups[] = $group;
        }
        return $groups;
    }

    public function validateRequest($request)
    {
        $request->validate([
            'type' => 'required',
            'site_name' => 'required',
            'bu_long' => 'required',
            'bu_short' => 'required'
        ]);
    }
}
