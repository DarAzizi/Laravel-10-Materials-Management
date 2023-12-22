<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\JetPosition;
use Illuminate\Http\Request;
use App\Models\EquipmentCode;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EquipmentCodeStoreRequest;
use App\Http\Requests\EquipmentCodeUpdateRequest;

class EquipmentCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', EquipmentCode::class);

        $search = $request->get('search', '');

        $equipmentCodes = EquipmentCode::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.equipment_codes.index',
            compact('equipmentCodes', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', EquipmentCode::class);

        $jetPositions = JetPosition::pluck('Position', 'id');

        return view('app.equipment_codes.create', compact('jetPositions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EquipmentCodeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', EquipmentCode::class);

        $validated = $request->validated();

        $equipmentCode = EquipmentCode::create($validated);

        return redirect()
            ->route('equipment-codes.edit', $equipmentCode)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, EquipmentCode $equipmentCode): View
    {
        $this->authorize('view', $equipmentCode);

        return view('app.equipment_codes.show', compact('equipmentCode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, EquipmentCode $equipmentCode): View
    {
        $this->authorize('update', $equipmentCode);

        $jetPositions = JetPosition::pluck('Position', 'id');

        return view(
            'app.equipment_codes.edit',
            compact('equipmentCode', 'jetPositions')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        EquipmentCodeUpdateRequest $request,
        EquipmentCode $equipmentCode
    ): RedirectResponse {
        $this->authorize('update', $equipmentCode);

        $validated = $request->validated();

        $equipmentCode->update($validated);

        return redirect()
            ->route('equipment-codes.edit', $equipmentCode)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        EquipmentCode $equipmentCode
    ): RedirectResponse {
        $this->authorize('delete', $equipmentCode);

        $equipmentCode->delete();

        return redirect()
            ->route('equipment-codes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
