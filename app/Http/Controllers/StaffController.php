<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StaffStoreRequest;
use App\Http\Requests\StaffUpdateRequest;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Staff::class);

        $search = $request->get('search', '');

        $allStaff = Staff::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_staff.index', compact('allStaff', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Staff::class);

        $roles = Role::get();

        return view('app.all_staff.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StaffStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Staff::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('profile_photo_path')) {
            $validated['profile_photo_path'] = $request
                ->file('profile_photo_path')
                ->store('public');
        }

        $staff = Staff::create($validated);

        $staff->syncRoles($request->roles);

        return redirect()
            ->route('all-staff.edit', $staff)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Staff $staff): View
    {
        $this->authorize('view', $staff);

        return view('app.all_staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Staff $staff): View
    {
        $this->authorize('update', $staff);

        $roles = Role::get();

        return view('app.all_staff.edit', compact('staff', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StaffUpdateRequest $request,
        Staff $staff
    ): RedirectResponse {
        $this->authorize('update', $staff);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('profile_photo_path')) {
            if ($staff->profile_photo_path) {
                Storage::delete($staff->profile_photo_path);
            }

            $validated['profile_photo_path'] = $request
                ->file('profile_photo_path')
                ->store('public');
        }

        $staff->update($validated);

        $staff->syncRoles($request->roles);

        return redirect()
            ->route('all-staff.edit', $staff)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Staff $staff): RedirectResponse
    {
        $this->authorize('delete', $staff);

        if ($staff->profile_photo_path) {
            Storage::delete($staff->profile_photo_path);
        }

        $staff->delete();

        return redirect()
            ->route('all-staff.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
