<?php

namespace App\Http\Controllers\Api;

use App\Models\JetPosition;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\JetPositionResource;
use App\Http\Resources\JetPositionCollection;
use App\Http\Requests\JetPositionStoreRequest;
use App\Http\Requests\JetPositionUpdateRequest;

class JetPositionController extends Controller
{
    public function index(Request $request): JetPositionCollection
    {
        $this->authorize('view-any', JetPosition::class);

        $search = $request->get('search', '');

        $jetPositions = JetPosition::search($search)
            ->latest()
            ->paginate();

        return new JetPositionCollection($jetPositions);
    }

    public function store(JetPositionStoreRequest $request): JetPositionResource
    {
        $this->authorize('create', JetPosition::class);

        $validated = $request->validated();

        $jetPosition = JetPosition::create($validated);

        return new JetPositionResource($jetPosition);
    }

    public function show(
        Request $request,
        JetPosition $jetPosition
    ): JetPositionResource {
        $this->authorize('view', $jetPosition);

        return new JetPositionResource($jetPosition);
    }

    public function update(
        JetPositionUpdateRequest $request,
        JetPosition $jetPosition
    ): JetPositionResource {
        $this->authorize('update', $jetPosition);

        $validated = $request->validated();

        $jetPosition->update($validated);

        return new JetPositionResource($jetPosition);
    }

    public function destroy(
        Request $request,
        JetPosition $jetPosition
    ): Response {
        $this->authorize('delete', $jetPosition);

        $jetPosition->delete();

        return response()->noContent();
    }
}
