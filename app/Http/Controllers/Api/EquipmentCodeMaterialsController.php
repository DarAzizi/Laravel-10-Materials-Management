<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\EquipmentCode;
use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\MaterialCollection;

class EquipmentCodeMaterialsController extends Controller
{
    public function index(
        Request $request,
        EquipmentCode $equipmentCode
    ): MaterialCollection {
        $this->authorize('view', $equipmentCode);

        $search = $request->get('search', '');

        $materials = $equipmentCode
            ->materials()
            ->search($search)
            ->latest()
            ->paginate();

        return new MaterialCollection($materials);
    }

    public function store(
        Request $request,
        EquipmentCode $equipmentCode
    ): MaterialResource {
        $this->authorize('create', Material::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
            'ItemCode' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
            'Quantity' => ['required', 'numeric'],
            'jet_position_id' => ['required', 'exists:jet_positions,id'],
            'nature_id' => ['required', 'exists:natures,id'],
        ]);

        $material = $equipmentCode->materials()->create($validated);

        return new MaterialResource($material);
    }
}
