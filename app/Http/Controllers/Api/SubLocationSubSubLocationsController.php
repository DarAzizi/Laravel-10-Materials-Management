<?php

namespace App\Http\Controllers\Api;

use App\Models\SubLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubSubLocationResource;
use App\Http\Resources\SubSubLocationCollection;

class SubLocationSubSubLocationsController extends Controller
{
    public function index(
        Request $request,
        SubLocation $subLocation
    ): SubSubLocationCollection {
        $this->authorize('view', $subLocation);

        $search = $request->get('search', '');

        $subSubLocations = $subLocation
            ->subSubLocations()
            ->search($search)
            ->latest()
            ->paginate();

        return new SubSubLocationCollection($subSubLocations);
    }

    public function store(
        Request $request,
        SubLocation $subLocation
    ): SubSubLocationResource {
        $this->authorize('create', SubSubLocation::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
        ]);

        $subSubLocation = $subLocation->subSubLocations()->create($validated);

        return new SubSubLocationResource($subSubLocation);
    }
}
