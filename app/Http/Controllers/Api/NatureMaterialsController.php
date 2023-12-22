<?php

namespace App\Http\Controllers\Api;

use App\Models\Nature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\MaterialCollection;

class NatureMaterialsController extends Controller
{
    public function index(Request $request, Nature $nature): MaterialCollection
    {
        $this->authorize('view', $nature);

        $search = $request->get('search', '');

        $materials = $nature
            ->materials()
            ->search($search)
            ->latest()
            ->paginate();

        return new MaterialCollection($materials);
    }

    public function store(Request $request, Nature $nature): MaterialResource
    {
        $this->authorize('create', Material::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
            'ItemCode' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
            'Quantity' => ['required', 'numeric'],
            'jet_position_id' => ['required', 'exists:jet_positions,id'],
            'equipment_code_id' => ['required', 'exists:equipment_codes,id'],
        ]);

        $material = $nature->materials()->create($validated);

        return new MaterialResource($material);
    }
}
