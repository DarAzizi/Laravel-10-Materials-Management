@php $editing = isset($subSubLocation) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Name"
            label="Sub Sub Location"
            :value="old('Name', ($editing ? $subSubLocation->Name : ''))"
            maxlength="255"
            placeholder="Sub Sub Location"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="sub_location_id" label="Sub Location" required>
            @php $selected = old('sub_location_id', ($editing ? $subSubLocation->sub_location_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sub Location</option>
            @foreach($subLocations as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
