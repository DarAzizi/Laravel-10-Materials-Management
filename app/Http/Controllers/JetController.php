<?php

namespace App\Http\Controllers;

use App\Models\Jet;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JetStoreRequest;
use App\Http\Requests\JetUpdateRequest;

class JetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Jet::class);

        $search = $request->get('search', '');

        $jets = Jet::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.jets.index', compact('jets', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Jet::class);

        return view('app.jets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JetStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Jet::class);

        $validated = $request->validated();

        $jet = Jet::create($validated);

        return redirect()
            ->route('jets.edit', $jet)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Jet $jet): View
    {
        $this->authorize('view', $jet);

        return view('app.jets.show', compact('jet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Jet $jet): View
    {
        $this->authorize('update', $jet);

        return view('app.jets.edit', compact('jet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        JetUpdateRequest $request,
        Jet $jet
    ): RedirectResponse {
        $this->authorize('update', $jet);

        $validated = $request->validated();

        $jet->update($validated);

        return redirect()
            ->route('jets.edit', $jet)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Jet $jet): RedirectResponse
    {
        $this->authorize('delete', $jet);

        $jet->delete();

        return redirect()
            ->route('jets.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
