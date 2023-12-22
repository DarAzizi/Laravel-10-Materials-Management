@php $editing = isset($subSubSubCategory) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Name"
            label="Name"
            :value="old('Name', ($editing ? $subSubSubCategory->Name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="sub_sub_category_id"
            label="Sub Sub Category"
            required
        >
            @php $selected = old('sub_sub_category_id', ($editing ? $subSubSubCategory->sub_sub_category_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sub Sub Category</option>
            @foreach($subSubCategories as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
