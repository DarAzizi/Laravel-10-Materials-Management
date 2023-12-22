<?php

namespace App\Http\Controllers;

use App\Models\Jet;
use Illuminate\View\View;
use App\Models\JetPosition;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JetPositionStoreRequest;
use App\Http\Requests\JetPositionUpdateRequest;

class JetPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', JetPosition::class);

        $search = $request->get('search', '');

        $jetPositions = JetPosition::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.jet_positions.index',
            compact('jetPositions', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', JetPosition::class);

        $jets = Jet::pluck('Name', 'id');

        return view('app.jet_positions.create', compact('jets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JetPositionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', JetPosition::class);

        $validated = $request->validated();

        $jetPosition = JetPosition::create($validated);

        return redirect()
            ->route('jet-positions.edit', $jetPosition)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, JetPosition $jetPosition): View
    {
        $this->authorize('view', $jetPosition);

        return view('app.jet_positions.show', compact('jetPosition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, JetPosition $jetPosition): View
    {
        $this->authorize('update', $jetPosition);

        $jets = Jet::pluck('Name', 'id');

        return view('app.jet_positions.edit', compact('jetPosition', 'jets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        JetPositionUpdateRequest $request,
        JetPosition $jetPosition
    ): RedirectResponse {
        $this->authorize('update', $jetPosition);

        $validated = $request->validated();

        $jetPosition->update($validated);

        return redirect()
            ->route('jet-positions.edit', $jetPosition)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        JetPosition $jetPosition
    ): RedirectResponse {
        $this->authorize('delete', $jetPosition);

        $jetPosition->delete();

        return redirect()
            ->route('jet-positions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
