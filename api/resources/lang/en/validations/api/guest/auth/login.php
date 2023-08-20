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
        'required'  => 'Email is required.',
        'email'     => 'Email is invalid.'
    ],
    'password' => [
        'required'  => 'Password is required.',
        'string'    => 'Password is invalid.'
    ],
    'result' => [
        'error' => [
            'find'        => 'User not found',
            'credentials' => 'Email or password is invalid.'
        ],
        'success' => 'Logged in successfully!'
    ]
];
