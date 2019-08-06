<?php

return [
    'success_code' => [
        'success' => 200,
        'created' => 201,
    ],
    'error_code' => [
        'unauthorized' => 401,
        'not_found' => 404,
        'unprocessable_entity' => 422,
        'user_oauth2_fail' => 1000,
        'invalid_jwt_token' => 1001,
        'invalid_social_app_key' => 1002,
        'miss_match_uri' => 1003,
        'communication_fail' => 1004,
        'jwt_token_blacklisted' => 1005,
        'token_not_provided' => 1006,
        'unauthenticated' => 1007,
        'user_not_found' => 1008,
        'duplicate_sns' => 2000,
    ],
];
