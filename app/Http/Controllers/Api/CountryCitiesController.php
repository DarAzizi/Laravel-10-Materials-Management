<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityCollection;

class CountryCitiesController extends Controller
{
    public function index(Request $request, Country $country): CityCollection
    {
        $this->authorize('view', $country);

        $search = $request->get('search', '');

        $cities = $country
            ->cities()
            ->search($search)
            ->latest()
            ->paginate();

        return new CityCollection($cities);
    }

    public function store(Request $request, Country $country): CityResource
    {
        $this->authorize('create', City::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
        ]);

        $city = $country->cities()->create($validated);

        return new CityResource($city);
    }
}
