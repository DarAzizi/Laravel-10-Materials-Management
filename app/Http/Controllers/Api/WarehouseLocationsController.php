<?php

namespace App\Http\Controllers\Api;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Http\Resources\LocationCollection;

class WarehouseLocationsController extends Controller
{
    public function index(
        Request $request,
        Warehouse $warehouse
    ): LocationCollection {
        $this->authorize('view', $warehouse);

        $search = $request->get('search', '');

        $locations = $warehouse
            ->locations()
            ->search($search)
            ->latest()
            ->paginate();

        return new LocationCollection($locations);
    }

    public function store(
        Request $request,
        Warehouse $warehouse
    ): LocationResource {
        $this->authorize('create', Location::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
        ]);

        $location = $warehouse->locations()->create($validated);

        return new LocationResource($location);
    }
}
