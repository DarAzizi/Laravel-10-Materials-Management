<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Models\SubSubSubCategory;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SubSubSubCategoryStoreRequest;
use App\Http\Requests\SubSubSubCategoryUpdateRequest;

class SubSubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SubSubSubCategory::class);

        $search = $request->get('search', '');

        $subSubSubCategories = SubSubSubCategory::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sub_sub_sub_categories.index',
            compact('subSubSubCategories', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SubSubSubCategory::class);

        $subSubCategories = SubSubCategory::pluck('Name', 'id');

        return view(
            'app.sub_sub_sub_categories.create',
            compact('subSubCategories')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        SubSubSubCategoryStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', SubSubSubCategory::class);

        $validated = $request->validated();

        $subSubSubCategory = SubSubSubCategory::create($validated);

        return redirect()
            ->route('sub-sub-sub-categories.edit', $subSubSubCategory)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        SubSubSubCategory $subSubSubCategory
    ): View {
        $this->authorize('view', $subSubSubCategory);

        return view(
            'app.sub_sub_sub_categories.show',
            compact('subSubSubCategory')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        SubSubSubCategory $subSubSubCategory
    ): View {
        $this->authorize('update', $subSubSubCategory);

        $subSubCategories = SubSubCategory::pluck('Name', 'id');

        return view(
            'app.sub_sub_sub_categories.edit',
            compact('subSubSubCategory', 'subSubCategories')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SubSubSubCategoryUpdateRequest $request,
        SubSubSubCategory $subSubSubCategory
    ): RedirectResponse {
        $this->authorize('update', $subSubSubCategory);

        $validated = $request->validated();

        $subSubSubCategory->update($validated);

        return redirect()
            ->route('sub-sub-sub-categories.edit', $subSubSubCategory)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SubSubSubCategory $subSubSubCategory
    ): RedirectResponse {
        $this->authorize('delete', $subSubSubCategory);

        $subSubSubCategory->delete();

        return redirect()
            ->route('sub-sub-sub-categories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
