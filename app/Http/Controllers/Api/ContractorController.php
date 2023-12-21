<?php

namespace App\Http\Controllers\Api;

use App\Models\Contractor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ContractorResource;
use App\Http\Resources\ContractorCollection;
use App\Http\Requests\ContractorStoreRequest;
use App\Http\Requests\ContractorUpdateRequest;

class ContractorController extends Controller
{
    public function index(Request $request): ContractorCollection
    {
        $this->authorize('view-any', Contractor::class);

        $search = $request->get('search', '');

        $contractors = Contractor::search($search)
            ->latest()
            ->paginate();

        return new ContractorCollection($contractors);
    }

    public function store(ContractorStoreRequest $request): ContractorResource
    {
        $this->authorize('create', Contractor::class);

        $validated = $request->validated();
        if ($request->hasFile('Image')) {
            $validated['Image'] = $request->file('Image')->store('public');
        }

        $contractor = Contractor::create($validated);

        return new ContractorResource($contractor);
    }

    public function show(
        Request $request,
        Contractor $contractor
    ): ContractorResource {
        $this->authorize('view', $contractor);

        return new ContractorResource($contractor);
    }

    public function update(
        ContractorUpdateRequest $request,
        Contractor $contractor
    ): ContractorResource {
        $this->authorize('update', $contractor);

        $validated = $request->validated();

        if ($request->hasFile('Image')) {
            if ($contractor->Image) {
                Storage::delete($contractor->Image);
            }

            $validated['Image'] = $request->file('Image')->store('public');
        }

        $contractor->update($validated);

        return new ContractorResource($contractor);
    }

    public function destroy(Request $request, Contractor $contractor): Response
    {
        $this->authorize('delete', $contractor);

        if ($contractor->Image) {
            Storage::delete($contractor->Image);
        }

        $contractor->delete();

        return response()->noContent();
    }
}
