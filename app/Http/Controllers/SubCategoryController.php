<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SubCategoryStoreRequest;
use App\Http\Requests\SubCategoryUpdateRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SubCategory::class);

        $search = $request->get('search', '');

        $subCategories = SubCategory::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sub_categories.index',
            compact('subCategories', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SubCategory::class);

        $categories = Category::pluck('Name', 'id');

        return view('app.sub_categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', SubCategory::class);

        $validated = $request->validated();

        $subCategory = SubCategory::create($validated);

        return redirect()
            ->route('sub-categories.edit', $subCategory)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, SubCategory $subCategory): View
    {
        $this->authorize('view', $subCategory);

        return view('app.sub_categories.show', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SubCategory $subCategory): View
    {
        $this->authorize('update', $subCategory);

        $categories = Category::pluck('Name', 'id');

        return view(
            'app.sub_categories.edit',
            compact('subCategory', 'categories')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SubCategoryUpdateRequest $request,
        SubCategory $subCategory
    ): RedirectResponse {
        $this->authorize('update', $subCategory);

        $validated = $request->validated();

        $subCategory->update($validated);

        return redirect()
            ->route('sub-categories.edit', $subCategory)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SubCategory $subCategory
    ): RedirectResponse {
        $this->authorize('delete', $subCategory);

        $subCategory->delete();

        return redirect()
            ->route('sub-categories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
