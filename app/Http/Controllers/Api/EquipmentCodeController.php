<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\EquipmentCode;
use App\Http\Controllers\Controller;
use App\Http\Resources\EquipmentCodeResource;
use App\Http\Resources\EquipmentCodeCollection;
use App\Http\Requests\EquipmentCodeStoreRequest;
use App\Http\Requests\EquipmentCodeUpdateRequest;

class EquipmentCodeController extends Controller
{
    public function index(Request $request): EquipmentCodeCollection
    {
        $this->authorize('view-any', EquipmentCode::class);

        $search = $request->get('search', '');

        $equipmentCodes = EquipmentCode::search($search)
            ->latest()
            ->paginate();

        return new EquipmentCodeCollection($equipmentCodes);
    }

    public function store(
        EquipmentCodeStoreRequest $request
    ): EquipmentCodeResource {
        $this->authorize('create', EquipmentCode::class);

        $validated = $request->validated();

        $equipmentCode = EquipmentCode::create($validated);

        return new EquipmentCodeResource($equipmentCode);
    }

    public function show(
        Request $request,
        EquipmentCode $equipmentCode
    ): EquipmentCodeResource {
        $this->authorize('view', $equipmentCode);

        return new EquipmentCodeResource($equipmentCode);
    }

    public function update(
        EquipmentCodeUpdateRequest $request,
        EquipmentCode $equipmentCode
    ): EquipmentCodeResource {
        $this->authorize('update', $equipmentCode);

        $validated = $request->validated();

        $equipmentCode->update($validated);

        return new EquipmentCodeResource($equipmentCode);
    }

    public function destroy(
        Request $request,
        EquipmentCode $equipmentCode
    ): Response {
        $this->authorize('delete', $equipmentCode);

        $equipmentCode->delete();

        return response()->noContent();
    }
}
