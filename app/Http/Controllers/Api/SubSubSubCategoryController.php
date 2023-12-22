<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SubSubSubCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubSubSubCategoryResource;
use App\Http\Resources\SubSubSubCategoryCollection;
use App\Http\Requests\SubSubSubCategoryStoreRequest;
use App\Http\Requests\SubSubSubCategoryUpdateRequest;

class SubSubSubCategoryController extends Controller
{
    public function index(Request $request): SubSubSubCategoryCollection
    {
        $this->authorize('view-any', SubSubSubCategory::class);

        $search = $request->get('search', '');

        $subSubSubCategories = SubSubSubCategory::search($search)
            ->latest()
            ->paginate();

        return new SubSubSubCategoryCollection($subSubSubCategories);
    }

    public function store(
        SubSubSubCategoryStoreRequest $request
    ): SubSubSubCategoryResource {
        $this->authorize('create', SubSubSubCategory::class);

        $validated = $request->validated();

        $subSubSubCategory = SubSubSubCategory::create($validated);

        return new SubSubSubCategoryResource($subSubSubCategory);
    }

    public function show(
        Request $request,
        SubSubSubCategory $subSubSubCategory
    ): SubSubSubCategoryResource {
        $this->authorize('view', $subSubSubCategory);

        return new SubSubSubCategoryResource($subSubSubCategory);
    }

    public function update(
        SubSubSubCategoryUpdateRequest $request,
        SubSubSubCategory $subSubSubCategory
    ): SubSubSubCategoryResource {
        $this->authorize('update', $subSubSubCategory);

        $validated = $request->validated();

        $subSubSubCategory->update($validated);

        return new SubSubSubCategoryResource($subSubSubCategory);
    }

    public function destroy(
        Request $request,
        SubSubSubCategory $subSubSubCategory
    ): Response {
        $this->authorize('delete', $subSubSubCategory);

        $subSubSubCategory->delete();

        return response()->noContent();
    }
}
