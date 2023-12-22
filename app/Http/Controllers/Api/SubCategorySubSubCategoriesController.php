<?php

namespace App\Http\Controllers\Api;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubSubCategoryResource;
use App\Http\Resources\SubSubCategoryCollection;

class SubCategorySubSubCategoriesController extends Controller
{
    public function index(
        Request $request,
        SubCategory $subCategory
    ): SubSubCategoryCollection {
        $this->authorize('view', $subCategory);

        $search = $request->get('search', '');

        $subSubCategories = $subCategory
            ->subSubCategories()
            ->search($search)
            ->latest()
            ->paginate();

        return new SubSubCategoryCollection($subSubCategories);
    }

    public function store(
        Request $request,
        SubCategory $subCategory
    ): SubSubCategoryResource {
        $this->authorize('create', SubSubCategory::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
        ]);

        $subSubCategory = $subCategory->subSubCategories()->create($validated);

        return new SubSubCategoryResource($subSubCategory);
    }
}
