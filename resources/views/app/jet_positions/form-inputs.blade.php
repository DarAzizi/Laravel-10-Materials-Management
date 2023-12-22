@php $editing = isset($jetPosition) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Position"
            label="Position"
            :value="old('Position', ($editing ? $jetPosition->Position : ''))"
            maxlength="255"
            placeholder="Position"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="Description"
            label="Description"
            maxlength="255"
            required
            >{{ old('Description', ($editing ? $jetPosition->Description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="jet_id" label="Jet" required>
            @php $selected = old('jet_id', ($editing ? $jetPosition->jet_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Jet</option>
            @foreach($jets as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
