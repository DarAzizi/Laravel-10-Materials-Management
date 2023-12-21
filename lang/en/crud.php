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
            'Name' => 'Name',
            'Image' => 'Image',
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
            'Name' => 'Name',
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
            'Name' => 'Name',
            'Description' => 'Description',
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
            'Name' => 'Name',
            'Image' => 'Image',
            'Description' => 'Description',
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
