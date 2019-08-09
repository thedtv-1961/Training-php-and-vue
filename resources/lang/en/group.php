<?php

return [
    'attribute' => [
        'id' => [
            'label' => 'ID'
        ],
        'description' => [
            'placeholder' => 'Input group description',
            'label' => 'Description'
        ],
        'name' => [
            'placeholder' => 'Input group name',
            'label' => 'Name',
        ],
        'image' => [
            'label' => 'Image',
        ]
    ],
    'control' => [
        'search' => [
            'placeholder' => 'Search by name',
        ],
    ],
    'page' => [
        'index' => 'List Groups',
        'create' => 'Creare Group',
        'edit' => 'Edit Group',
    ],
    'message' => [
        'create_success' => 'Create group successfully',
        'update_success' => 'Update group successfully',
        'destroy_success' => 'Destroy group successfully',
        'destroy_fail' => 'Destroy group unsuccessfully',
    ],
    'email' => [
        'title' => [
            'add' => '[Training-php-and-vue] Add member',
            'remove' => '[Training-php-and-vue] Remove member',
        ],
        'contain' => [
            'add' => 'Hi <strong>:name</strong>,<br> Welcome to <strong>:group</strong> group, We added you to <strong>:name</strong> group ,<br>If you have any question please let us know,<br><br>Thanks,',
            'remove' => 'Hi <strong>:name</strong>,<br> We removed you from <strong>:group</strong> group ,<br>If you have any question please let us know,<br><br>Thanks,',
        ],

    ],
];
