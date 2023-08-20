<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Api Auth Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error
    | messages used by the validator class
    |
    */

    'email' => [
        'required' => 'Email is required.',
        'email'    => 'Email is invalid.',
        'unique'   => 'Email exists already.'
    ],
    'password' => [
        'required'  => 'Password is required.',
        'min'       => 'Password must consist of 6 characters minimum.',
        'confirmed' => 'Password confirmation is invalid'
    ],
    'result' => [
        'error' => [
            'create'      => 'Failed to create a user',
        ],
        'success' => 'Successfully registered.'
    ]
];
