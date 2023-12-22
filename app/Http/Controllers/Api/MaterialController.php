<?php

namespace App\Http\Controllers\Api;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\MaterialCollection;
use App\Http\Requests\MaterialStoreRequest;
use App\Http\Requests\MaterialUpdateRequest;

class MaterialController extends Controller
{
    public function index(Request $request): MaterialCollection
    {
        $this->authorize('view-any', Material::class);

        $search = $request->get('search', '');

        $materials = Material::search($search)
            ->latest()
            ->paginate();

        return new MaterialCollection($materials);
    }

    public function store(MaterialStoreRequest $request): MaterialResource
    {
        $this->authorize('create', Material::class);

        $validated = $request->validated();

        $material = Material::create($validated);

        return new MaterialResource($material);
    }

    public function show(Request $request, Material $material): MaterialResource
    {
        $this->authorize('view', $material);

        return new MaterialResource($material);
    }

    public function update(
        MaterialUpdateRequest $request,
        Material $material
    ): MaterialResource {
        $this->authorize('update', $material);

        $validated = $request->validated();

        $material->update($validated);

        return new MaterialResource($material);
    }

    public function destroy(Request $request, Material $material): Response
    {
        $this->authorize('delete', $material);

        $material->delete();

        return response()->noContent();
    }
}
