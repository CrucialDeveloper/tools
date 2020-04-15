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
                "cms-" . $request->site_name . "-function-" . Str::of($role)->slug()->lower() . "-" . Str::of($request['bu_short'])->slug()->lower(),
                // "CMS-" . $request->site_name . "-Function-" . $request['business_unit'] . " " . $role
            ];
            $groups[] = $group;
        }
        return $groups;
    }

    public function generateContentGroups($request)
    {
        $this->validateRequest($request);

        $groups = ['bu' => [], 'teams' => []];
        $contentPermissions = ['Read', 'Write'];

        $name = "CMS-" . Str::title($request->site_name) .  "-Content-" . $request['bu_long'];
        $id = "cms-" . $request->site_name . "-content-" . Str::of($request['bu_short'])->slug()->lower();

        foreach ($contentPermissions as $permission) {
            $group = [
                $name  . "-" . $permission,
                $id . "-" . Str::of($permission)->studly()->lower(),
                // "CMS-" . $request->site_name . "-Function-" . $request['business_unit'] . " " . $permission
            ];
            $groups['bu'][] = $group;
        }

        if (count($request->teams) > 0) {
            $teams = $this->generateTeamGroups($request, $name, $id);
            $groups['teams'] = $teams;
        }

        return $groups;
    }

    public function generateTeamGroups($request, $name, $id)
    {
        $groups = [];
        $contentPermissions = ['Read', 'Write'];

        foreach ($request->teams as $team) {
            foreach ($contentPermissions as $permission) {
                $group = [
                    $name . " " . Str::of($team) . "-" . Str::of($permission)->title(),
                    $id . "-" . Str::of($team)->slug()->lower()->replace('&', '_') . "-" . Str::of($permission)->slug()->lower(),
                ];
                $groups[] = $group;
            }
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
