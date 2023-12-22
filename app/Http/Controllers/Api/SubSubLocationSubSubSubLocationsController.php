<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\SubSubLocation;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubSubSubLocationResource;
use App\Http\Resources\SubSubSubLocationCollection;

class SubSubLocationSubSubSubLocationsController extends Controller
{
    public function index(
        Request $request,
        SubSubLocation $subSubLocation
    ): SubSubSubLocationCollection {
        $this->authorize('view', $subSubLocation);

        $search = $request->get('search', '');

        $subSubSubLocations = $subSubLocation
            ->subSubSubLocations()
            ->search($search)
            ->latest()
            ->paginate();

        return new SubSubSubLocationCollection($subSubSubLocations);
    }

    public function store(
        Request $request,
        SubSubLocation $subSubLocation
    ): SubSubSubLocationResource {
        $this->authorize('create', SubSubSubLocation::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
        ]);

        $subSubSubLocation = $subSubLocation
            ->subSubSubLocations()
            ->create($validated);

        return new SubSubSubLocationResource($subSubSubLocation);
    }
}
