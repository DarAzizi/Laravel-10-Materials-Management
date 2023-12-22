<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SubSubCategoryStoreRequest;
use App\Http\Requests\SubSubCategoryUpdateRequest;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SubSubCategory::class);

        $search = $request->get('search', '');

        $subSubCategories = SubSubCategory::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sub_sub_categories.index',
            compact('subSubCategories', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SubSubCategory::class);

        $subCategories = SubCategory::pluck('Name', 'id');

        return view('app.sub_sub_categories.create', compact('subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubSubCategoryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', SubSubCategory::class);

        $validated = $request->validated();

        $subSubCategory = SubSubCategory::create($validated);

        return redirect()
            ->route('sub-sub-categories.edit', $subSubCategory)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, SubSubCategory $subSubCategory): View
    {
        $this->authorize('view', $subSubCategory);

        return view('app.sub_sub_categories.show', compact('subSubCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SubSubCategory $subSubCategory): View
    {
        $this->authorize('update', $subSubCategory);

        $subCategories = SubCategory::pluck('Name', 'id');

        return view(
            'app.sub_sub_categories.edit',
            compact('subSubCategory', 'subCategories')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SubSubCategoryUpdateRequest $request,
        SubSubCategory $subSubCategory
    ): RedirectResponse {
        $this->authorize('update', $subSubCategory);

        $validated = $request->validated();

        $subSubCategory->update($validated);

        return redirect()
            ->route('sub-sub-categories.edit', $subSubCategory)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SubSubCategory $subSubCategory
    ): RedirectResponse {
        $this->authorize('delete', $subSubCategory);

        $subSubCategory->delete();

        return redirect()
            ->route('sub-sub-categories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
