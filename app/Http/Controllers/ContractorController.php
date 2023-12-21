<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Contractor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ContractorStoreRequest;
use App\Http\Requests\ContractorUpdateRequest;

class ContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Contractor::class);

        $search = $request->get('search', '');

        $contractors = Contractor::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.contractors.index', compact('contractors', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Contractor::class);

        return view('app.contractors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContractorStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Contractor::class);

        $validated = $request->validated();
        if ($request->hasFile('Image')) {
            $validated['Image'] = $request->file('Image')->store('public');
        }

        $contractor = Contractor::create($validated);

        return redirect()
            ->route('contractors.edit', $contractor)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Contractor $contractor): View
    {
        $this->authorize('view', $contractor);

        return view('app.contractors.show', compact('contractor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Contractor $contractor): View
    {
        $this->authorize('update', $contractor);

        return view('app.contractors.edit', compact('contractor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ContractorUpdateRequest $request,
        Contractor $contractor
    ): RedirectResponse {
        $this->authorize('update', $contractor);

        $validated = $request->validated();
        if ($request->hasFile('Image')) {
            if ($contractor->Image) {
                Storage::delete($contractor->Image);
            }

            $validated['Image'] = $request->file('Image')->store('public');
        }

        $contractor->update($validated);

        return redirect()
            ->route('contractors.edit', $contractor)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Contractor $contractor
    ): RedirectResponse {
        $this->authorize('delete', $contractor);

        if ($contractor->Image) {
            Storage::delete($contractor->Image);
        }

        $contractor->delete();

        return redirect()
            ->route('contractors.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
