<?php

namespace App\Http\Controllers\Api;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\StaffResource;
use App\Http\Resources\StaffCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StaffStoreRequest;
use App\Http\Requests\StaffUpdateRequest;

class StaffController extends Controller
{
    public function index(Request $request): StaffCollection
    {
        $this->authorize('view-any', Staff::class);

        $search = $request->get('search', '');

        $allStaff = Staff::search($search)
            ->latest()
            ->paginate();

        return new StaffCollection($allStaff);
    }

    public function store(StaffStoreRequest $request): StaffResource
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

        return new StaffResource($staff);
    }

    public function show(Request $request, Staff $staff): StaffResource
    {
        $this->authorize('view', $staff);

        return new StaffResource($staff);
    }

    public function update(
        StaffUpdateRequest $request,
        Staff $staff
    ): StaffResource {
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

        return new StaffResource($staff);
    }

    public function destroy(Request $request, Staff $staff): Response
    {
        $this->authorize('delete', $staff);

        if ($staff->profile_photo_path) {
            Storage::delete($staff->profile_photo_path);
        }

        $staff->delete();

        return response()->noContent();
    }
}
