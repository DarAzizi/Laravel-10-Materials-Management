@php $editing = isset($warehouse) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Name"
            label="Warehouse Name"
            :value="old('Name', ($editing ? $warehouse->Name : ''))"
            maxlength="255"
            placeholder="Warehouse Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="Description"
            label="Warehouse Description"
            maxlength="255"
            required
            >{{ old('Description', ($editing ? $warehouse->Description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="project_id" label="Project Name" required>
            @php $selected = old('project_id', ($editing ? $warehouse->project_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Project</option>
            @foreach($projects as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $warehouse->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Address"
            label="Warehouse Address"
            :value="old('Address', ($editing ? $warehouse->Address : ''))"
            maxlength="255"
            placeholder="Warehouse Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Warehouse Email"
            :value="old('email', ($editing ? $warehouse->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>
</div>
