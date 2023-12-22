<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SubSubLocation;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubSubLocationResource;
use App\Http\Resources\SubSubLocationCollection;
use App\Http\Requests\SubSubLocationStoreRequest;
use App\Http\Requests\SubSubLocationUpdateRequest;

class SubSubLocationController extends Controller
{
    public function index(Request $request): SubSubLocationCollection
    {
        $this->authorize('view-any', SubSubLocation::class);

        $search = $request->get('search', '');

        $subSubLocations = SubSubLocation::search($search)
            ->latest()
            ->paginate();

        return new SubSubLocationCollection($subSubLocations);
    }

    public function store(
        SubSubLocationStoreRequest $request
    ): SubSubLocationResource {
        $this->authorize('create', SubSubLocation::class);

        $validated = $request->validated();

        $subSubLocation = SubSubLocation::create($validated);

        return new SubSubLocationResource($subSubLocation);
    }

    public function show(
        Request $request,
        SubSubLocation $subSubLocation
    ): SubSubLocationResource {
        $this->authorize('view', $subSubLocation);

        return new SubSubLocationResource($subSubLocation);
    }

    public function update(
        SubSubLocationUpdateRequest $request,
        SubSubLocation $subSubLocation
    ): SubSubLocationResource {
        $this->authorize('update', $subSubLocation);

        $validated = $request->validated();

        $subSubLocation->update($validated);

        return new SubSubLocationResource($subSubLocation);
    }

    public function destroy(
        Request $request,
        SubSubLocation $subSubLocation
    ): Response {
        $this->authorize('delete', $subSubLocation);

        $subSubLocation->delete();

        return response()->noContent();
    }
}
