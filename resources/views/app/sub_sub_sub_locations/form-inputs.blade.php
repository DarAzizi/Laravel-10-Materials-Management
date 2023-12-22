@php $editing = isset($subSubSubLocation) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Name"
            label="Sub Sub Sub Location"
            :value="old('Name', ($editing ? $subSubSubLocation->Name : ''))"
            maxlength="255"
            placeholder="Ex: Roof A"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="sub_sub_location_id"
            label="Sub Sub Location"
            required
        >
            @php $selected = old('sub_sub_location_id', ($editing ? $subSubSubLocation->sub_sub_location_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sub Sub Location</option>
            @foreach($subSubLocations as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
