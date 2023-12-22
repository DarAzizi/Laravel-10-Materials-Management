<?php

namespace App\Http\Controllers\Api;

use App\Models\JetPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\MaterialCollection;

class JetPositionMaterialsController extends Controller
{
    public function index(
        Request $request,
        JetPosition $jetPosition
    ): MaterialCollection {
        $this->authorize('view', $jetPosition);

        $search = $request->get('search', '');

        $materials = $jetPosition
            ->materials()
            ->search($search)
            ->latest()
            ->paginate();

        return new MaterialCollection($materials);
    }

    public function store(
        Request $request,
        JetPosition $jetPosition
    ): MaterialResource {
        $this->authorize('create', Material::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
            'ItemCode' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
            'Quantity' => ['required', 'numeric'],
            'equipment_code_id' => ['required', 'exists:equipment_codes,id'],
            'nature_id' => ['required', 'exists:natures,id'],
        ]);

        $material = $jetPosition->materials()->create($validated);

        return new MaterialResource($material);
    }
}
