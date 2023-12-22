@php $editing = isset($nature) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="Nature" label="Nature">
            @php $selected = old('Nature', ($editing ? $nature->Nature : '')) @endphp
            <option value="Consumable" {{ $selected == 'Consumable' ? 'selected' : '' }} >Consumable</option>
            <option value="Bulk" {{ $selected == 'Bulk' ? 'selected' : '' }} >Bulk</option>
            <option value="Equipement" {{ $selected == 'Equipement' ? 'selected' : '' }} >Equipement</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
