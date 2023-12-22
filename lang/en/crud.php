<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'gender' => 'Gender',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'password' => 'Password',
            'profile_photo_path' => 'Profile Photo Path',
        ],
    ],

    'countries' => [
        'name' => 'Countries',
        'index_title' => 'Countries List',
        'new_title' => 'New Country',
        'create_title' => 'Create Country',
        'edit_title' => 'Edit Country',
        'show_title' => 'Show Country',
        'inputs' => [
            'Name' => 'Country Name',
            'Image' => 'Flag',
        ],
    ],

    'cities' => [
        'name' => 'Cities',
        'index_title' => 'Cities List',
        'new_title' => 'New City',
        'create_title' => 'Create City',
        'edit_title' => 'Edit City',
        'show_title' => 'Show City',
        'inputs' => [
            'Name' => 'City Name',
            'country_id' => 'Country',
        ],
    ],

    'projects' => [
        'name' => 'Projects',
        'index_title' => 'Projects List',
        'new_title' => 'New Project',
        'create_title' => 'Create Project',
        'edit_title' => 'Edit Project',
        'show_title' => 'Show Project',
        'inputs' => [
            'Name' => 'Project Name',
            'Description' => 'Project Description',
            'city_id' => 'City',
            'contractor_id' => 'Contractor',
        ],
    ],

    'contractors' => [
        'name' => 'Contractors',
        'index_title' => 'Contractors List',
        'new_title' => 'New Contractor',
        'create_title' => 'Create Contractor',
        'edit_title' => 'Edit Contractor',
        'show_title' => 'Show Contractor',
        'inputs' => [
            'Name' => 'Contractor Name',
            'Image' => 'Contractor Logo',
            'Description' => 'Contractor Description',
        ],
    ],

    'warehouses' => [
        'name' => 'Warehouses',
        'index_title' => 'Warehouses List',
        'new_title' => 'New Warehouse',
        'create_title' => 'Create Warehouse',
        'edit_title' => 'Edit Warehouse',
        'show_title' => 'Show Warehouse',
        'inputs' => [
            'Name' => 'Warehouse Name',
            'Description' => 'Warehouse Description',
            'project_id' => 'Project Name',
            'user_id' => 'User',
            'Address' => 'Warehouse Address',
            'email' => 'Warehouse Email',
        ],
    ],

    'locations' => [
        'name' => 'Locations',
        'index_title' => 'Locations List',
        'new_title' => 'New Location',
        'create_title' => 'Create Location',
        'edit_title' => 'Edit Location',
        'show_title' => 'Show Location',
        'inputs' => [
            'Name' => 'Location',
            'Description' => 'Location Description',
        ],
    ],

    'sub_locations' => [
        'name' => 'Sub Locations',
        'index_title' => 'SubLocations List',
        'new_title' => 'New Sub location',
        'create_title' => 'Create SubLocation',
        'edit_title' => 'Edit SubLocation',
        'show_title' => 'Show SubLocation',
        'inputs' => [
            'Name' => 'Sub Location',
            'location_id' => 'Main Location',
        ],
    ],

    'sub_sub_locations' => [
        'name' => 'Sub Sub Locations',
        'index_title' => 'SubSubLocations List',
        'new_title' => 'New Sub sub location',
        'create_title' => 'Create SubSubLocation',
        'edit_title' => 'Edit SubSubLocation',
        'show_title' => 'Show SubSubLocation',
        'inputs' => [
            'Name' => 'Sub Sub Location',
            'sub_location_id' => 'Sub Location',
        ],
    ],

    'sub_sub_sub_locations' => [
        'name' => 'Sub Sub Sub Locations',
        'index_title' => 'SubSubSubLocations List',
        'new_title' => 'New Sub sub sub location',
        'create_title' => 'Create SubSubSubLocation',
        'edit_title' => 'Edit SubSubSubLocation',
        'show_title' => 'Show SubSubSubLocation',
        'inputs' => [
            'Name' => 'Sub Sub Sub Location',
            'sub_sub_location_id' => 'Sub Sub Location',
        ],
    ],

    'categories' => [
        'name' => 'Categories',
        'index_title' => 'Categories List',
        'new_title' => 'New Category',
        'create_title' => 'Create Category',
        'edit_title' => 'Edit Category',
        'show_title' => 'Show Category',
        'inputs' => [
            'Name' => 'Name',
            'Image' => 'Image',
            'Description' => 'Description',
        ],
    ],

    'sub_categories' => [
        'name' => 'Sub Categories',
        'index_title' => 'SubCategories List',
        'new_title' => 'New Sub category',
        'create_title' => 'Create SubCategory',
        'edit_title' => 'Edit SubCategory',
        'show_title' => 'Show SubCategory',
        'inputs' => [
            'Name' => 'Name',
            'category_id' => 'Category',
        ],
    ],

    'sub_sub_categories' => [
        'name' => 'Sub Sub Categories',
        'index_title' => 'SubSubCategories List',
        'new_title' => 'New Sub sub category',
        'create_title' => 'Create SubSubCategory',
        'edit_title' => 'Edit SubSubCategory',
        'show_title' => 'Show SubSubCategory',
        'inputs' => [
            'Name' => 'Name',
            'sub_category_id' => 'Sub Category',
        ],
    ],

    'sub_sub_sub_categories' => [
        'name' => 'Sub Sub Sub Categories',
        'index_title' => 'SubSubSubCategories List',
        'new_title' => 'New Sub sub sub category',
        'create_title' => 'Create SubSubSubCategory',
        'edit_title' => 'Edit SubSubSubCategory',
        'show_title' => 'Show SubSubSubCategory',
        'inputs' => [
            'Name' => 'Name',
            'sub_sub_category_id' => 'Sub Sub Category',
        ],
    ],

    'natures' => [
        'name' => 'Natures',
        'index_title' => 'Natures List',
        'new_title' => 'New Nature',
        'create_title' => 'Create Nature',
        'edit_title' => 'Edit Nature',
        'show_title' => 'Show Nature',
        'inputs' => [
            'Nature' => 'Nature',
        ],
    ],

    'equipment_codes' => [
        'name' => 'Equipment Codes',
        'index_title' => 'EquipmentCodes List',
        'new_title' => 'New Equipment code',
        'create_title' => 'Create EquipmentCode',
        'edit_title' => 'Edit EquipmentCode',
        'show_title' => 'Show EquipmentCode',
        'inputs' => [
            'Name' => 'Name',
            'Description' => 'Description',
            'Drawing' => 'Drawing',
            'jet_position_id' => 'Jet Position',
        ],
    ],

    'jets' => [
        'name' => 'Jets',
        'index_title' => 'Jets List',
        'new_title' => 'New Jet',
        'create_title' => 'Create Jet',
        'edit_title' => 'Edit Jet',
        'show_title' => 'Show Jet',
        'inputs' => [
            'Name' => 'Name',
            'Description' => 'Description',
        ],
    ],

    'jet_positions' => [
        'name' => 'Jet Positions',
        'index_title' => 'JetPositions List',
        'new_title' => 'New Jet position',
        'create_title' => 'Create JetPosition',
        'edit_title' => 'Edit JetPosition',
        'show_title' => 'Show JetPosition',
        'inputs' => [
            'Position' => 'Position',
            'Description' => 'Description',
            'jet_id' => 'Jet',
        ],
    ],

    'materials' => [
        'name' => 'Materials',
        'index_title' => 'Materials List',
        'new_title' => 'New Material',
        'create_title' => 'Create Material',
        'edit_title' => 'Edit Material',
        'show_title' => 'Show Material',
        'inputs' => [
            'Name' => 'Name',
            'ItemCode' => 'Item Code',
            'Description' => 'Description',
            'Quantity' => 'Quantity',
            'jet_position_id' => 'Jet Position',
            'equipment_code_id' => 'Equipment Code',
            'nature_id' => 'Nature',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
