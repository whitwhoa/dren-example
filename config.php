<?php

return (object)[
    'app_name' => 'test',
    'display_errors' => true,
    'session' => (object)[

        'directory' => '/storage/sessions', // this will be prepended with the value of $privateDirectory from index.php

        // This is the duration (in seconds) in which the session_id is allowed to live for before being re-issued
        // to the user
        'valid_for' => 600, // 10min

        // The duration (in seconds) which a session_id remains active after having been re-issued to the user. This
        // mitigates issues where a user might have a bad connection and a new token is issued, but the response is
        // dropped. It also mitigates issues with race conditions where multiple requests could be in flight at the same
        // time, where the first request updates the session_id and begins writing to the new data store. Since the
        // in-flight requests would still contain the old session_id, if they were to attempt to update the session
        // data, they would be updating the old data store OR attempt to re-issue yet another session_id. The logic
        // within IdentityManager blocks all requests on the issued device_id, updates the session_id, then adds
        // the new session_id as a parameter within the data store of the old session_id. Each request first checks
        // this 'new_token' field in its data store before attempting to re-issue the token. If it exists, the
        // new token is used.
        'liminal_time' => 60,

        // The amount of time (in seconds) a user is allowed to be inactive before their session expires, requiring them
        // to re-authenticate via either username/password or remember_id token. This differs from 'valid_for'.
        // 'valid_for' is concerned with how long any token can be used whether the user is inactive or active for
        // security purposes. 'allowed_inactivity' dictates how long a user can go without making a request before
        // re-authentication is required. I hope that is clear.
        //
        // This value is also used when issuing browser cookies as the amount of time the token will remain in the
        // users browser data store, since if the allowed_inactivity period has expired, the token must be re-issued
        // and the user must re-authenticate either via username/password or remember_id
        //
        // This value is also used within the session garbage collector. Any session files existing within 'directory'
        // that have not been written to (since each request containing a session_id will update the session.last_used
        // property) within this amount of time will be deleted from the filesystem whenever the garbage collector is
        // run
        'allowed_inactivity' => 1200,

        // Whether to run the session_id garbage collector or not. If you want to handle session garbage collection via
        // external means such as a background job, set this to false, and the rest of the gc parameters will be ignored
        'use_garbage_collector' => true,

        // These properties work together whenever 'use_garbage_collector' is set to true. They are used to determine
        // the approximate percentage chance that the request runs the session garbage collector. With the default
        // settings of 1/100, there is approximately 1% chance of gc occurring
        'gc_probability' => 1,
        'gc_divisor' => 100

    ],
    'databases'  => [
        [
            'host'  => 'localhost',
            'user'  => 'root',
            'pass'  => 'rootpass',
            'db'    => 'drencrom_test'
        ]
    ],

    // mapping of 'mime/type' => 'ext' of any/all mime types you wish a client to be able to upload
    'allowed_file_upload_mimes' => [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/bmp' => 'bmp'
    ]
];