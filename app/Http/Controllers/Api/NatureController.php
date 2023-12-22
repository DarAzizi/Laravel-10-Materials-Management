<?php

namespace App\Http\Controllers\Api;

use App\Models\Nature;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\NatureResource;
use App\Http\Resources\NatureCollection;
use App\Http\Requests\NatureStoreRequest;
use App\Http\Requests\NatureUpdateRequest;

class NatureController extends Controller
{
    public function index(Request $request): NatureCollection
    {
        $this->authorize('view-any', Nature::class);

        $search = $request->get('search', '');

        $natures = Nature::search($search)
            ->latest()
            ->paginate();

        return new NatureCollection($natures);
    }

    public function store(NatureStoreRequest $request): NatureResource
    {
        $this->authorize('create', Nature::class);

        $validated = $request->validated();

        $nature = Nature::create($validated);

        return new NatureResource($nature);
    }

    public function show(Request $request, Nature $nature): NatureResource
    {
        $this->authorize('view', $nature);

        return new NatureResource($nature);
    }

    public function update(
        NatureUpdateRequest $request,
        Nature $nature
    ): NatureResource {
        $this->authorize('update', $nature);

        $validated = $request->validated();

        $nature->update($validated);

        return new NatureResource($nature);
    }

    public function destroy(Request $request, Nature $nature): Response
    {
        $this->authorize('delete', $nature);

        $nature->delete();

        return response()->noContent();
    }
}
