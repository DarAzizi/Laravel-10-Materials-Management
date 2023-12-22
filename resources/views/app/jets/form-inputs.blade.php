@php $editing = isset($jet) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Name"
            label="Name"
            :value="old('Name', ($editing ? $jet->Name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="Description"
            label="Description"
            maxlength="255"
            required
            >{{ old('Description', ($editing ? $jet->Description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
