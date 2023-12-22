<?php

namespace App\Http\Controllers\Api;

use App\Models\SubLocation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubLocationResource;
use App\Http\Resources\SubLocationCollection;
use App\Http\Requests\SubLocationStoreRequest;
use App\Http\Requests\SubLocationUpdateRequest;

class SubLocationController extends Controller
{
    public function index(Request $request): SubLocationCollection
    {
        $this->authorize('view-any', SubLocation::class);

        $search = $request->get('search', '');

        $subLocations = SubLocation::search($search)
            ->latest()
            ->paginate();

        return new SubLocationCollection($subLocations);
    }

    public function store(SubLocationStoreRequest $request): SubLocationResource
    {
        $this->authorize('create', SubLocation::class);

        $validated = $request->validated();

        $subLocation = SubLocation::create($validated);

        return new SubLocationResource($subLocation);
    }

    public function show(
        Request $request,
        SubLocation $subLocation
    ): SubLocationResource {
        $this->authorize('view', $subLocation);

        return new SubLocationResource($subLocation);
    }

    public function update(
        SubLocationUpdateRequest $request,
        SubLocation $subLocation
    ): SubLocationResource {
        $this->authorize('update', $subLocation);

        $validated = $request->validated();

        $subLocation->update($validated);

        return new SubLocationResource($subLocation);
    }

    public function destroy(
        Request $request,
        SubLocation $subLocation
    ): Response {
        $this->authorize('delete', $subLocation);

        $subLocation->delete();

        return response()->noContent();
    }
}
