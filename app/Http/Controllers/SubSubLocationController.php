<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\SubLocation;
use Illuminate\Http\Request;
use App\Models\SubSubLocation;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SubSubLocationStoreRequest;
use App\Http\Requests\SubSubLocationUpdateRequest;

class SubSubLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SubSubLocation::class);

        $search = $request->get('search', '');

        $subSubLocations = SubSubLocation::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sub_sub_locations.index',
            compact('subSubLocations', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SubSubLocation::class);

        $subLocations = SubLocation::pluck('Name', 'id');

        return view('app.sub_sub_locations.create', compact('subLocations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubSubLocationStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', SubSubLocation::class);

        $validated = $request->validated();

        $subSubLocation = SubSubLocation::create($validated);

        return redirect()
            ->route('sub-sub-locations.edit', $subSubLocation)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, SubSubLocation $subSubLocation): View
    {
        $this->authorize('view', $subSubLocation);

        return view('app.sub_sub_locations.show', compact('subSubLocation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SubSubLocation $subSubLocation): View
    {
        $this->authorize('update', $subSubLocation);

        $subLocations = SubLocation::pluck('Name', 'id');

        return view(
            'app.sub_sub_locations.edit',
            compact('subSubLocation', 'subLocations')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SubSubLocationUpdateRequest $request,
        SubSubLocation $subSubLocation
    ): RedirectResponse {
        $this->authorize('update', $subSubLocation);

        $validated = $request->validated();

        $subSubLocation->update($validated);

        return redirect()
            ->route('sub-sub-locations.edit', $subSubLocation)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SubSubLocation $subSubLocation
    ): RedirectResponse {
        $this->authorize('delete', $subSubLocation);

        $subSubLocation->delete();

        return redirect()
            ->route('sub-sub-locations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
