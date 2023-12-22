<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.users.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('all-staff.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.name')
                        </h5>
                        <span>{{ $staff->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.gender')
                        </h5>
                        <span>{{ $staff->gender ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.mobile')
                        </h5>
                        <span>{{ $staff->mobile ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.email')
                        </h5>
                        <span>{{ $staff->email ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.profile_photo_path')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $staff->profile_photo_path ? \Storage::url($staff->profile_photo_path) : '' }}"
                            size="150"
                        />
                    </div>
                </div>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.roles.name')
                        </h5>
                        <div>
                            @forelse ($staff->roles as $role)
                            <div
                                class="
                                    inline-block
                                    p-1
                                    text-center text-sm
                                    rounded
                                    bg-blue-400
                                    text-white
                                "
                            >
                                {{ $role->name }}
                            </div>
                            <br />
                            @empty - @endforelse
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('all-staff.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Staff::class)
                    <a href="{{ route('all-staff.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
