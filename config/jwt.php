<?php

return [

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Secret
    |--------------------------------------------------------------------------
    | This secret is used by the JWT library to sign your tokens.
    |
    */

    'secret' => env('JWT_SECRET', 'secret'),

    /*
    |--------------------------------------------------------------------------
    | JWT Issuer
    |--------------------------------------------------------------------------
    | This is the name of the issuer of the token.
    |
    */

    'iss' => env('JWT_ISSUER', 'professor-grading-app'),

    /*
    |--------------------------------------------------------------------------
    | JWT Audience
    |--------------------------------------------------------------------------
    | This is the name of the audience that the token is intended for.
    |
    */

    'aud' => env('JWT_AUDIENCE', 'professor-grading-app'),

    /*
    |--------------------------------------------------------------------------
    | JWT Expiration Minutes
    |--------------------------------------------------------------------------
    | This is the number of minutes that the token will be valid for.
    |
    */

    'exp' => env('JWT_EXPIRATION_MINUTES', 60),

];
