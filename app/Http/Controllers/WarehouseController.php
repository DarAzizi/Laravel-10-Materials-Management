<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Warehouse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WarehouseStoreRequest;
use App\Http\Requests\WarehouseUpdateRequest;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Warehouse::class);

        $search = $request->get('search', '');

        $warehouses = Warehouse::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.warehouses.index', compact('warehouses', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Warehouse::class);

        $projects = Project::pluck('Name', 'id');
        $users = User::pluck('name', 'id');

        return view('app.warehouses.create', compact('projects', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Warehouse::class);

        $validated = $request->validated();

        $warehouse = Warehouse::create($validated);

        return redirect()
            ->route('warehouses.edit', $warehouse)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Warehouse $warehouse): View
    {
        $this->authorize('view', $warehouse);

        return view('app.warehouses.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Warehouse $warehouse): View
    {
        $this->authorize('update', $warehouse);

        $projects = Project::pluck('Name', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.warehouses.edit',
            compact('warehouse', 'projects', 'users')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WarehouseUpdateRequest $request,
        Warehouse $warehouse
    ): RedirectResponse {
        $this->authorize('update', $warehouse);

        $validated = $request->validated();

        $warehouse->update($validated);

        return redirect()
            ->route('warehouses.edit', $warehouse)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Warehouse $warehouse
    ): RedirectResponse {
        $this->authorize('delete', $warehouse);

        $warehouse->delete();

        return redirect()
            ->route('warehouses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
