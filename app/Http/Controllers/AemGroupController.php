<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Inertia\Response;

class AemGroupController extends Controller
{

    public function index(): Response
    {
        return Inertia::render('AemGroups/Index');
    }

    public function create(Request $request): array
    {
        $content = $this->generateContentGroups($request);
        $functional = $this->generateFunctionalGroups($request);
        return ['functional' => $functional, 'content' => $content];
    }

    protected function generateFunctionalGroups($request): array
    {
        $this->validateRequest($request);

        $parent = [
            'contentadmin' => 'https://author.panorama.charter.com/libs/granite/security/content/v2/groupeditor.html/home/groups/F/F1LHwuHU8FN9_sSQz7_J',
            'powereditor' => 'https://author.panorama.charter.com/libs/granite/security/content/v2/groupeditor.html/home/groups/T/T8qk-4tZ_9nS7oJRpC_k',
            'advancedauthor' => 'https://author.panorama.charter.com/libs/granite/security/content/v2/groupeditor.html/home/groups/I/If-4dFhBc6M_kY1kjq_b',
            'basicauthor' => 'https://author.panorama.charter.com/libs/granite/security/content/v2/groupeditor.html/home/groups/h/hE2m-f7jAl-o7w6y_vDr',
            'approver' => 'https://author.panorama.charter.com/libs/granite/security/content/v2/groupeditor.html/home/groups/R/R0elnsL_2Hn-q9FjCpuT',
            'reviewer' => 'https://author.panorama.charter.com/libs/granite/security/content/v2/groupeditor.html/home/groups/R/R0elnsL_2Hn-q9FjCpuT',
        ];
        $groups = [];
        $functionalRoles = ['Content Admin', 'Power Editor', 'Advanced Author', 'Basic Author', 'Approver', 'Reviewer'];

        foreach ($functionalRoles as $role) {
            $roleId = Str::of($role)->studly()->lower();
            $group = [
                'CMS-' . Str::title($request->site_name) . '-Function-' . $request['bu_long'] . ' ' . $role,
                'cms-' . Str::lower($request->site_name) . '-function-' . Str::of($role)->studly()->lower() . '-' . Str::of($request['bu_short'])->studly()->lower(),
                'cms-global-function-' . $roleId . '-generic',
                $parent["$roleId"]
            ];
            $groups[] = $group;
        }
        return $groups;
    }

    protected function generateContentGroups($request): array
    {
        $this->validateRequest($request);

        $groups = ['bu' => [], 'teams' => []];
        $contentPermissions = ['Read', 'Write'];

        $name = 'CMS-' . Str::title($request->site_name) . '-Content-' . $request['bu_long'];
        $id = 'cms-' . Str::lower($request->site_name) . '-content-' . Str::of($request['bu_short'])->slug()->lower();

        foreach ($contentPermissions as $permission) {
            $group = [
                $name . '-' . $permission,
                $id . '-' . Str::of($permission)->studly()->lower(),
                $permission === 'Read' ? 'cms-pan-content-generic-read' : $id . '-read'
            ];
            $groups['bu'][] = $group;
        }

        if (count($request->teams) > 0) {
            $groups['teams'] = $this->generateTeamGroups($request, $name, $id);
        }

        return $groups;
    }

    protected function generateTeamGroups($request, $name, $id): array
    {

        $groups = [];
        $contentPermissions = ['Read', 'Write'];

        foreach ($request->teams as $team) {
            foreach ($contentPermissions as $permission) {
                $group = [
                    $name . ' ' . Str::of($team)->title() . '-' . Str::of($permission)->title(),
                    $id . '-' . Str::of($team)->slug()->lower()->replace('&', '_') . '-' . Str::of($permission)->slug()->lower(),
                    $permission === 'Read' ? $id . '-read' : $id . '-' . $team . '-read',
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
