<?php

namespace App\Http\Controllers\Api;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WarehouseResource;
use App\Http\Resources\WarehouseCollection;
use App\Http\Requests\WarehouseStoreRequest;
use App\Http\Requests\WarehouseUpdateRequest;

class WarehouseController extends Controller
{
    public function index(Request $request): WarehouseCollection
    {
        $this->authorize('view-any', Warehouse::class);

        $search = $request->get('search', '');

        $warehouses = Warehouse::search($search)
            ->latest()
            ->paginate();

        return new WarehouseCollection($warehouses);
    }

    public function store(WarehouseStoreRequest $request): WarehouseResource
    {
        $this->authorize('create', Warehouse::class);

        $validated = $request->validated();

        $warehouse = Warehouse::create($validated);

        return new WarehouseResource($warehouse);
    }

    public function show(
        Request $request,
        Warehouse $warehouse
    ): WarehouseResource {
        $this->authorize('view', $warehouse);

        return new WarehouseResource($warehouse);
    }

    public function update(
        WarehouseUpdateRequest $request,
        Warehouse $warehouse
    ): WarehouseResource {
        $this->authorize('update', $warehouse);

        $validated = $request->validated();

        $warehouse->update($validated);

        return new WarehouseResource($warehouse);
    }

    public function destroy(Request $request, Warehouse $warehouse): Response
    {
        $this->authorize('delete', $warehouse);

        $warehouse->delete();

        return response()->noContent();
    }
}
