<?php

return [
    'avatar_default_path' => 'images/avatar_default.png',
    'avatar_path' => 'uploads/avatars',
    'gender' => [
        'male' => 1,
        'female' => 0,
        'other_gender' => 2,
    ],
    'address' => [
        'cols' => 50,
        'rows' => 3,
        'max' => 255,
    ],
    'name' => [
        'max' => 255,
        'regex' => "/^[A-Za-z\x{00C0}-\x{00FF}][A-Za-z\x{00C0}-\x{00FF}\'\-]+([\ A-Za-z\x{00C0}-\x{00FF}][A-Za-z\x{00C0}-\x{00FF}\'\-]+)*/u",
    ],
    'password' => [
        'min' => 6,
    ],
    'phone' => [
        'max' => 15,
    ],
    'avatar' =>[
        'max' => 2048,
    ],
    'row_per_page' => 10,
];
