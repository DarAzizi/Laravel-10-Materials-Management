<?php

namespace App\Http\Controllers\Api;

use App\Models\JetPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EquipmentCodeResource;
use App\Http\Resources\EquipmentCodeCollection;

class JetPositionEquipmentCodesController extends Controller
{
    public function index(
        Request $request,
        JetPosition $jetPosition
    ): EquipmentCodeCollection {
        $this->authorize('view', $jetPosition);

        $search = $request->get('search', '');

        $equipmentCodes = $jetPosition
            ->equipmentCodes()
            ->search($search)
            ->latest()
            ->paginate();

        return new EquipmentCodeCollection($equipmentCodes);
    }

    public function store(
        Request $request,
        JetPosition $jetPosition
    ): EquipmentCodeResource {
        $this->authorize('create', EquipmentCode::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
            'Drawing' => ['required', 'max:255', 'string'],
        ]);

        $equipmentCode = $jetPosition->equipmentCodes()->create($validated);

        return new EquipmentCodeResource($equipmentCode);
    }
}
