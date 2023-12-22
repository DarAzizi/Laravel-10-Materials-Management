<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SubSubSubLocation;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubSubSubLocationResource;
use App\Http\Resources\SubSubSubLocationCollection;
use App\Http\Requests\SubSubSubLocationStoreRequest;
use App\Http\Requests\SubSubSubLocationUpdateRequest;

class SubSubSubLocationController extends Controller
{
    public function index(Request $request): SubSubSubLocationCollection
    {
        $this->authorize('view-any', SubSubSubLocation::class);

        $search = $request->get('search', '');

        $subSubSubLocations = SubSubSubLocation::search($search)
            ->latest()
            ->paginate();

        return new SubSubSubLocationCollection($subSubSubLocations);
    }

    public function store(
        SubSubSubLocationStoreRequest $request
    ): SubSubSubLocationResource {
        $this->authorize('create', SubSubSubLocation::class);

        $validated = $request->validated();

        $subSubSubLocation = SubSubSubLocation::create($validated);

        return new SubSubSubLocationResource($subSubSubLocation);
    }

    public function show(
        Request $request,
        SubSubSubLocation $subSubSubLocation
    ): SubSubSubLocationResource {
        $this->authorize('view', $subSubSubLocation);

        return new SubSubSubLocationResource($subSubSubLocation);
    }

    public function update(
        SubSubSubLocationUpdateRequest $request,
        SubSubSubLocation $subSubSubLocation
    ): SubSubSubLocationResource {
        $this->authorize('update', $subSubSubLocation);

        $validated = $request->validated();

        $subSubSubLocation->update($validated);

        return new SubSubSubLocationResource($subSubSubLocation);
    }

    public function destroy(
        Request $request,
        SubSubSubLocation $subSubSubLocation
    ): Response {
        $this->authorize('delete', $subSubSubLocation);

        $subSubSubLocation->delete();

        return response()->noContent();
    }
}
