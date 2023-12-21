<?php

namespace App\Http\Controllers\Api;

use App\Models\Contractor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectCollection;

class ContractorProjectsController extends Controller
{
    public function index(
        Request $request,
        Contractor $contractor
    ): ProjectCollection {
        $this->authorize('view', $contractor);

        $search = $request->get('search', '');

        $projects = $contractor
            ->projects()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProjectCollection($projects);
    }

    public function store(
        Request $request,
        Contractor $contractor
    ): ProjectResource {
        $this->authorize('create', Project::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
            'city_id' => ['required', 'exists:cities,id'],
        ]);

        $project = $contractor->projects()->create($validated);

        return new ProjectResource($project);
    }
}
