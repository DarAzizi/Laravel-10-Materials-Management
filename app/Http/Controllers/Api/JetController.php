<?php

namespace App\Http\Controllers\Api;

use App\Models\Jet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\JetResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\JetCollection;
use App\Http\Requests\JetStoreRequest;
use App\Http\Requests\JetUpdateRequest;

class JetController extends Controller
{
    public function index(Request $request): JetCollection
    {
        $this->authorize('view-any', Jet::class);

        $search = $request->get('search', '');

        $jets = Jet::search($search)
            ->latest()
            ->paginate();

        return new JetCollection($jets);
    }

    public function store(JetStoreRequest $request): JetResource
    {
        $this->authorize('create', Jet::class);

        $validated = $request->validated();

        $jet = Jet::create($validated);

        return new JetResource($jet);
    }

    public function show(Request $request, Jet $jet): JetResource
    {
        $this->authorize('view', $jet);

        return new JetResource($jet);
    }

    public function update(JetUpdateRequest $request, Jet $jet): JetResource
    {
        $this->authorize('update', $jet);

        $validated = $request->validated();

        $jet->update($validated);

        return new JetResource($jet);
    }

    public function destroy(Request $request, Jet $jet): Response
    {
        $this->authorize('delete', $jet);

        $jet->delete();

        return response()->noContent();
    }
}
