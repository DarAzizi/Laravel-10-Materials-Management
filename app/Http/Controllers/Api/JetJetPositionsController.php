<?php

namespace App\Http\Controllers\Api;

use App\Models\Jet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JetPositionResource;
use App\Http\Resources\JetPositionCollection;

class JetJetPositionsController extends Controller
{
    public function index(Request $request, Jet $jet): JetPositionCollection
    {
        $this->authorize('view', $jet);

        $search = $request->get('search', '');

        $jetPositions = $jet
            ->jetPositions()
            ->search($search)
            ->latest()
            ->paginate();

        return new JetPositionCollection($jetPositions);
    }

    public function store(Request $request, Jet $jet): JetPositionResource
    {
        $this->authorize('create', JetPosition::class);

        $validated = $request->validate([
            'Position' => ['required', 'max:255', 'string'],
            'Description' => ['required', 'max:255', 'string'],
        ]);

        $jetPosition = $jet->jetPositions()->create($validated);

        return new JetPositionResource($jetPosition);
    }
}
