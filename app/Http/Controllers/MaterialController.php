<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use App\Models\Material;
use Illuminate\View\View;
use App\Models\JetPosition;
use Illuminate\Http\Request;
use App\Models\EquipmentCode;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MaterialStoreRequest;
use App\Http\Requests\MaterialUpdateRequest;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Material::class);

        $search = $request->get('search', '');

        $materials = Material::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.materials.index', compact('materials', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Material::class);

        $jetPositions = JetPosition::pluck('Position', 'id');
        $equipmentCodes = EquipmentCode::pluck('Name', 'id');
        $natures = Nature::pluck('id', 'id');

        return view(
            'app.materials.create',
            compact('jetPositions', 'equipmentCodes', 'natures')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Material::class);

        $validated = $request->validated();

        $material = Material::create($validated);

        return redirect()
            ->route('materials.edit', $material)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Material $material): View
    {
        $this->authorize('view', $material);

        return view('app.materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Material $material): View
    {
        $this->authorize('update', $material);

        $jetPositions = JetPosition::pluck('Position', 'id');
        $equipmentCodes = EquipmentCode::pluck('Name', 'id');
        $natures = Nature::pluck('id', 'id');

        return view(
            'app.materials.edit',
            compact('material', 'jetPositions', 'equipmentCodes', 'natures')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MaterialUpdateRequest $request,
        Material $material
    ): RedirectResponse {
        $this->authorize('update', $material);

        $validated = $request->validated();

        $material->update($validated);

        return redirect()
            ->route('materials.edit', $material)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Material $material
    ): RedirectResponse {
        $this->authorize('delete', $material);

        $material->delete();

        return redirect()
            ->route('materials.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
