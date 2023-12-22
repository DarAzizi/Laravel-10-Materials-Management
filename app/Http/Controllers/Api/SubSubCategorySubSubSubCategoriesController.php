<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubSubSubCategoryResource;
use App\Http\Resources\SubSubSubCategoryCollection;

class SubSubCategorySubSubSubCategoriesController extends Controller
{
    public function index(
        Request $request,
        SubSubCategory $subSubCategory
    ): SubSubSubCategoryCollection {
        $this->authorize('view', $subSubCategory);

        $search = $request->get('search', '');

        $subSubSubCategories = $subSubCategory
            ->subSubSubCategories()
            ->search($search)
            ->latest()
            ->paginate();

        return new SubSubSubCategoryCollection($subSubSubCategories);
    }

    public function store(
        Request $request,
        SubSubCategory $subSubCategory
    ): SubSubSubCategoryResource {
        $this->authorize('create', SubSubSubCategory::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
        ]);

        $subSubSubCategory = $subSubCategory
            ->subSubSubCategories()
            ->create($validated);

        return new SubSubSubCategoryResource($subSubSubCategory);
    }
}
