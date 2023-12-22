<?php

namespace App\Http\Controllers\Api;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\SubCategoryCollection;
use App\Http\Requests\SubCategoryStoreRequest;
use App\Http\Requests\SubCategoryUpdateRequest;

class SubCategoryController extends Controller
{
    public function index(Request $request): SubCategoryCollection
    {
        $this->authorize('view-any', SubCategory::class);

        $search = $request->get('search', '');

        $subCategories = SubCategory::search($search)
            ->latest()
            ->paginate();

        return new SubCategoryCollection($subCategories);
    }

    public function store(SubCategoryStoreRequest $request): SubCategoryResource
    {
        $this->authorize('create', SubCategory::class);

        $validated = $request->validated();

        $subCategory = SubCategory::create($validated);

        return new SubCategoryResource($subCategory);
    }

    public function show(
        Request $request,
        SubCategory $subCategory
    ): SubCategoryResource {
        $this->authorize('view', $subCategory);

        return new SubCategoryResource($subCategory);
    }

    public function update(
        SubCategoryUpdateRequest $request,
        SubCategory $subCategory
    ): SubCategoryResource {
        $this->authorize('update', $subCategory);

        $validated = $request->validated();

        $subCategory->update($validated);

        return new SubCategoryResource($subCategory);
    }

    public function destroy(
        Request $request,
        SubCategory $subCategory
    ): Response {
        $this->authorize('delete', $subCategory);

        $subCategory->delete();

        return response()->noContent();
    }
}
