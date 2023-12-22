<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\SubCategoryCollection;

class CategorySubCategoriesController extends Controller
{
    public function index(
        Request $request,
        Category $category
    ): SubCategoryCollection {
        $this->authorize('view', $category);

        $search = $request->get('search', '');

        $subCategories = $category
            ->subCategories()
            ->search($search)
            ->latest()
            ->paginate();

        return new SubCategoryCollection($subCategories);
    }

    public function store(
        Request $request,
        Category $category
    ): SubCategoryResource {
        $this->authorize('create', SubCategory::class);

        $validated = $request->validate([
            'Name' => ['required', 'max:255', 'string'],
        ]);

        $subCategory = $category->subCategories()->create($validated);

        return new SubCategoryResource($subCategory);
    }
}
