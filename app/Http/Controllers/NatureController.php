<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\NatureStoreRequest;
use App\Http\Requests\NatureUpdateRequest;

class NatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Nature::class);

        $search = $request->get('search', '');

        $natures = Nature::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.natures.index', compact('natures', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Nature::class);

        return view('app.natures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NatureStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Nature::class);

        $validated = $request->validated();

        $nature = Nature::create($validated);

        return redirect()
            ->route('natures.edit', $nature)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Nature $nature): View
    {
        $this->authorize('view', $nature);

        return view('app.natures.show', compact('nature'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Nature $nature): View
    {
        $this->authorize('update', $nature);

        return view('app.natures.edit', compact('nature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        NatureUpdateRequest $request,
        Nature $nature
    ): RedirectResponse {
        $this->authorize('update', $nature);

        $validated = $request->validated();

        $nature->update($validated);

        return redirect()
            ->route('natures.edit', $nature)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Nature $nature): RedirectResponse
    {
        $this->authorize('delete', $nature);

        $nature->delete();

        return redirect()
            ->route('natures.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
