<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WarehouseResource;
use App\Http\Resources\WarehouseCollection;

class UserWarehousesController extends Controller
{
    public function index(Request $request, User $user): WarehouseCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $warehouses = $user
            ->warehouses()
            ->search($search)
            ->latest()
            ->paginate();

        return new WarehouseCollection($warehouses);
    }

    public function store(Request $request, User $user): WarehouseResource
    {
        $this->authorize('create', Warehouse::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
            'project_id' => ['required', 'exists:projects,id'],
        ]);

        $warehouse = $user->warehouses()->create($validated);

        return new WarehouseResource($warehouse);
    }
}
