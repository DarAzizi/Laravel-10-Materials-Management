<?php

namespace App\Http\Controllers\Api;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WarehouseResource;
use App\Http\Resources\WarehouseCollection;

class StaffWarehousesController extends Controller
{
    public function index(Request $request, Staff $staff): WarehouseCollection
    {
        $this->authorize('view', $staff);

        $search = $request->get('search', '');

        $warehouses = $staff
            ->warehouses()
            ->search($search)
            ->latest()
            ->paginate();

        return new WarehouseCollection($warehouses);
    }

    public function store(Request $request, Staff $staff): WarehouseResource
    {
        $this->authorize('create', Warehouse::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
            'project_id' => ['required', 'exists:projects,id'],
            'Address' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
        ]);

        $warehouse = $staff->warehouses()->create($validated);

        return new WarehouseResource($warehouse);
    }
}
