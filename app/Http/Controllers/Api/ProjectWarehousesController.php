<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WarehouseResource;
use App\Http\Resources\WarehouseCollection;

class ProjectWarehousesController extends Controller
{
    public function index(
        Request $request,
        Project $project
    ): WarehouseCollection {
        $this->authorize('view', $project);

        $search = $request->get('search', '');

        $warehouses = $project
            ->warehouses()
            ->search($search)
            ->latest()
            ->paginate();

        return new WarehouseCollection($warehouses);
    }

    public function store(Request $request, Project $project): WarehouseResource
    {
        $this->authorize('create', Warehouse::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
            'Address' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
        ]);

        $warehouse = $project->warehouses()->create($validated);

        return new WarehouseResource($warehouse);
    }
}
