<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectCollection;

class CityProjectsController extends Controller
{
    public function index(Request $request, City $city): ProjectCollection
    {
        $this->authorize('view', $city);

        $search = $request->get('search', '');

        $projects = $city
            ->projects()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProjectCollection($projects);
    }

    public function store(Request $request, City $city): ProjectResource
    {
        $this->authorize('create', Project::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
            'contractor_id' => ['required', 'exists:contractors,id'],
        ]);

        $project = $city->projects()->create($validated);

        return new ProjectResource($project);
    }
}
