<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubSubCategoryResource;
use App\Http\Resources\SubSubCategoryCollection;
use App\Http\Requests\SubSubCategoryStoreRequest;
use App\Http\Requests\SubSubCategoryUpdateRequest;

class SubSubCategoryController extends Controller
{
    public function index(Request $request): SubSubCategoryCollection
    {
        $this->authorize('view-any', SubSubCategory::class);

        $search = $request->get('search', '');

        $subSubCategories = SubSubCategory::search($search)
            ->latest()
            ->paginate();

        return new SubSubCategoryCollection($subSubCategories);
    }

    public function store(
        SubSubCategoryStoreRequest $request
    ): SubSubCategoryResource {
        $this->authorize('create', SubSubCategory::class);

        $validated = $request->validated();

        $subSubCategory = SubSubCategory::create($validated);

        return new SubSubCategoryResource($subSubCategory);
    }

    public function show(
        Request $request,
        SubSubCategory $subSubCategory
    ): SubSubCategoryResource {
        $this->authorize('view', $subSubCategory);

        return new SubSubCategoryResource($subSubCategory);
    }

    public function update(
        SubSubCategoryUpdateRequest $request,
        SubSubCategory $subSubCategory
    ): SubSubCategoryResource {
        $this->authorize('update', $subSubCategory);

        $validated = $request->validated();

        $subSubCategory->update($validated);

        return new SubSubCategoryResource($subSubCategory);
    }

    public function destroy(
        Request $request,
        SubSubCategory $subSubCategory
    ): Response {
        $this->authorize('delete', $subSubCategory);

        $subSubCategory->delete();

        return response()->noContent();
    }
}
