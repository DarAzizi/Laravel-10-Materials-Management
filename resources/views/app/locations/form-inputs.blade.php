@php $editing = isset($location) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Name"
            label="Location"
            :value="old('Name', ($editing ? $location->Name : ''))"
            maxlength="255"
            placeholder="Location ( Ex: Zone A )"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="Description"
            label="Location Description"
            maxlength="255"
            required
            >{{ old('Description', ($editing ? $location->Description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
