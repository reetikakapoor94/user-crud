<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'required' => 'The :attribute field is required.',
    'email'    => 'The :attribute must be a valid email address.',
    'unique'   => 'The :attribute has already been taken.',
    'max'      => [
        'string' => 'The :attribute may not be greater than :max characters.',
    ],
    'min'      => [
        'string' => 'The :attribute must be at least :min characters.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Messages
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'first_name' => [
            'required' => 'Please enter a first name.',
            'max'      => 'First name cannot exceed 100 characters.',
        ],
        'last_name' => [
            'max' => 'Last name cannot exceed 100 characters.',
        ],
        'email' => [
            'required' => 'Please enter an email address.',
            'email'    => 'Please enter a valid email address.',
            'unique'   => 'This email address is already registered.',
            'max'      => 'Email cannot exceed 191 characters.',
        ],
        'password' => [
            'required' => 'Please enter a password.',
            'min'      => 'Password must be at least :min characters.',
            'max'      => 'Password cannot exceed :max characters.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'first_name' => 'first name',
        'last_name'  => 'last name',
        'email'      => 'email',
        'password'   => 'password',
    ],

];
