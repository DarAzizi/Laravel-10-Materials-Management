<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\SubSubLocation;
use App\Models\SubSubSubLocation;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SubSubSubLocationStoreRequest;
use App\Http\Requests\SubSubSubLocationUpdateRequest;

class SubSubSubLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SubSubSubLocation::class);

        $search = $request->get('search', '');

        $subSubSubLocations = SubSubSubLocation::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sub_sub_sub_locations.index',
            compact('subSubSubLocations', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SubSubSubLocation::class);

        $subSubLocations = SubSubLocation::pluck('Name', 'id');

        return view(
            'app.sub_sub_sub_locations.create',
            compact('subSubLocations')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        SubSubSubLocationStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', SubSubSubLocation::class);

        $validated = $request->validated();

        $subSubSubLocation = SubSubSubLocation::create($validated);

        return redirect()
            ->route('sub-sub-sub-locations.edit', $subSubSubLocation)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        SubSubSubLocation $subSubSubLocation
    ): View {
        $this->authorize('view', $subSubSubLocation);

        return view(
            'app.sub_sub_sub_locations.show',
            compact('subSubSubLocation')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        SubSubSubLocation $subSubSubLocation
    ): View {
        $this->authorize('update', $subSubSubLocation);

        $subSubLocations = SubSubLocation::pluck('Name', 'id');

        return view(
            'app.sub_sub_sub_locations.edit',
            compact('subSubSubLocation', 'subSubLocations')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SubSubSubLocationUpdateRequest $request,
        SubSubSubLocation $subSubSubLocation
    ): RedirectResponse {
        $this->authorize('update', $subSubSubLocation);

        $validated = $request->validated();

        $subSubSubLocation->update($validated);

        return redirect()
            ->route('sub-sub-sub-locations.edit', $subSubSubLocation)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SubSubSubLocation $subSubSubLocation
    ): RedirectResponse {
        $this->authorize('delete', $subSubSubLocation);

        $subSubSubLocation->delete();

        return redirect()
            ->route('sub-sub-sub-locations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
