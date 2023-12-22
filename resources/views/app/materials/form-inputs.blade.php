@php $editing = isset($material) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Name"
            label="Name"
            :value="old('Name', ($editing ? $material->Name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ItemCode"
            label="Item Code"
            :value="old('ItemCode', ($editing ? $material->ItemCode : ''))"
            maxlength="255"
            placeholder="Item Code"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="Description"
            label="Description"
            maxlength="255"
            required
            >{{ old('Description', ($editing ? $material->Description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="Quantity"
            label="Quantity"
            :value="old('Quantity', ($editing ? $material->Quantity : ''))"
            max="255"
            placeholder="Quantity"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="jet_position_id" label="Jet Position" required>
            @php $selected = old('jet_position_id', ($editing ? $material->jet_position_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Jet Position</option>
            @foreach($jetPositions as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="equipment_code_id"
            label="Equipment Code"
            required
        >
            @php $selected = old('equipment_code_id', ($editing ? $material->equipment_code_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Equipment Code</option>
            @foreach($equipmentCodes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="nature_id" label="Nature" required>
            @php $selected = old('nature_id', ($editing ? $material->nature_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Nature</option>
            @foreach($natures as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
