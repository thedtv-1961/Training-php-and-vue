<?php
return [
    'attribute' => [
        'id' => [
            'placeholder_filter' => 'Filter by ID',
            'label' => 'ID',
        ],
        'email' => [
            'placeholder_filter' => 'Filter by email',
            'placeholder' => 'Input email address',
            'label' => 'Email',
        ],
        'name' => [
            'placeholder_filter' => 'Filter by name',
            'placeholder' => 'Input user name',
            'label' => 'Name',
        ],
        'password' => [
            'placeholder' => 'Input password',
            'label' => 'Password',
        ],
        'password_confirmation' => [
            'placeholder' => 'Input password confirmation',
            'label' => 'Password Confirmation',
        ],
        'birthday' => [
            'label' => 'Birthday',
        ],
        'phone' => [
            'placeholder' => 'Input phone number',
            'label' => 'Phone Number',
        ],
        'gender' => [
            'label' => 'Gender',
        ],
        'avatar' => [
            'label' => 'Avatar',
        ],
        'address' => [
            'placeholder' => 'Input address',
            'label' => 'Address',
        ],
    ],
    'control' => [
        'button' => [
            'save' => 'Save',
            'update' => 'Update',
            'delete' => 'Delete',
        ],
        'link' => [
            'edit' => 'Edit',
            'create' => 'Add new',
        ],
    ],
    'variable' => [
        'gender' => [
            'male' => 'Male',
            'female' => 'Female',
            'other_gender' => 'Other Gender',
        ],
        'short_link' => '?id=:id&name=:name&email=:email&gender=:gender&birthday=:birthday&field=:field&sort=:sort',
        'all' => 'All',
    ],
    'message' => [
        'object_inserted_success' => '{0}Create user successfully',
        'object_updated_success' => '{0}Update user successfully',
        'object_deleted_success' => '{0}Delete user successfully',
        'object_inserted_fail' => '{0}Create user failed',
        'object_updated_fail' => '{0}Update user failed',
        'object_deleted_fail' => '{0}Delete user failed',
        'confirm_delete' => 'Are you sure?',
    ],
    'page' => [
        'title' => 'User Management',
        'create' => 'Create new User',
        'edit' => 'Edit User',
    ],
    'profile' => [
        'title' => 'Profile',
        'change_avatar' => 'Change avatar',
        'update' => [
            'success' => 'Update successfully!',
            'avatar' => [
                'success' => 'Change avatar successfully!',
            ],
        ],
    ],
];
