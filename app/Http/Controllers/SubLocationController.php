<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\View\View;
use App\Models\SubLocation;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SubLocationStoreRequest;
use App\Http\Requests\SubLocationUpdateRequest;

class SubLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SubLocation::class);

        $search = $request->get('search', '');

        $subLocations = SubLocation::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sub_locations.index',
            compact('subLocations', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SubLocation::class);

        $locations = Location::pluck('Name', 'id');

        return view('app.sub_locations.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubLocationStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', SubLocation::class);

        $validated = $request->validated();

        $subLocation = SubLocation::create($validated);

        return redirect()
            ->route('sub-locations.edit', $subLocation)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, SubLocation $subLocation): View
    {
        $this->authorize('view', $subLocation);

        return view('app.sub_locations.show', compact('subLocation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SubLocation $subLocation): View
    {
        $this->authorize('update', $subLocation);

        $locations = Location::pluck('Name', 'id');

        return view(
            'app.sub_locations.edit',
            compact('subLocation', 'locations')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SubLocationUpdateRequest $request,
        SubLocation $subLocation
    ): RedirectResponse {
        $this->authorize('update', $subLocation);

        $validated = $request->validated();

        $subLocation->update($validated);

        return redirect()
            ->route('sub-locations.edit', $subLocation)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SubLocation $subLocation
    ): RedirectResponse {
        $this->authorize('delete', $subLocation);

        $subLocation->delete();

        return redirect()
            ->route('sub-locations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
