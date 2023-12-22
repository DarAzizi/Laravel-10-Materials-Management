<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubLocationResource;
use App\Http\Resources\SubLocationCollection;

class LocationSubLocationsController extends Controller
{
    public function index(
        Request $request,
        Location $location
    ): SubLocationCollection {
        $this->authorize('view', $location);

        $search = $request->get('search', '');

        $subLocations = $location
            ->subLocations()
            ->search($search)
            ->latest()
            ->paginate();

        return new SubLocationCollection($subLocations);
    }

    public function store(
        Request $request,
        Location $location
    ): SubLocationResource {
        $this->authorize('create', SubLocation::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
        ]);

        $subLocation = $location->subLocations()->create($validated);

        return new SubLocationResource($subLocation);
    }
}
