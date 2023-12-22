@php $editing = isset($subLocation) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Name"
            label="Sub Location"
            :value="old('Name', ($editing ? $subLocation->Name : ''))"
            maxlength="255"
            placeholder="Sub Location Ex: Row N.3"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="location_id" label="Main Location" required>
            @php $selected = old('location_id', ($editing ? $subLocation->location_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Main Location</option>
            @foreach($locations as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
