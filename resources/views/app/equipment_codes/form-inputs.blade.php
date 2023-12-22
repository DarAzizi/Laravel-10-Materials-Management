@php $editing = isset($equipmentCode) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Name"
            label="Name"
            :value="old('Name', ($editing ? $equipmentCode->Name : ''))"
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
            >{{ old('Description', ($editing ? $equipmentCode->Description :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Drawing"
            label="Drawing"
            :value="old('Drawing', ($editing ? $equipmentCode->Drawing : ''))"
            maxlength="255"
            placeholder="Drawing"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="jet_position_id" label="Jet Position" required>
            @php $selected = old('jet_position_id', ($editing ? $equipmentCode->jet_position_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Jet Position</option>
            @foreach($jetPositions as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
