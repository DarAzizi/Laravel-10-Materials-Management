@php $editing = isset($contractor) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Name"
            label="Contractor Name"
            :value="old('Name', ($editing ? $contractor->Name : ''))"
            maxlength="255"
            placeholder="Ex: ABB , DANIELI, Saipem..."
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $contractor->Image ? \Storage::url($contractor->Image) : '' }}')"
        >
            <x-inputs.partials.label
                name="Image"
                label="Contractor Logo"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="Image"
                    id="Image"
                    @change="fileChosen"
                />
            </div>

            @error('Image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="Description"
            label="Contractor Description"
            maxlength="255"
            required
            >{{ old('Description', ($editing ? $contractor->Description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
