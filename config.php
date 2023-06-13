<?php

return (object)[
    'app_name' => 'test',
    'session' => (object)[
        'enabled' => true, // are we using sessions or not
        'type' => 'file', // or redis...eventually
        'name' => null, // strtoupper(app_name) . '_SESSION' if set to null
        'lifetime' => 8035200, // destroy session after this many seconds of inactivity (8035200 === ~3 months)
        //'regenerate_token_after' => 300, // regenerate cookie token after this many seconds | if null then never
        //'remove_stale_after' =>  15, // remove stale sessions after this many seconds (gives) | can be null if regenerate_token_after is null
        'directory' => '/storage/sessions' // this will be prepended with the value of $privateDirectory fron index.php
    ],
    'databases'  => [
        [
            'host'  => 'localhost',
            'user'  => 'root',
            'pass'  => 'rootpass',
            'db'    => 'drencrom_test'
        ]
    ],

    // if this is set to true, then a routes.php file will be added to /cache and used for deducing routes instead of
    // recreating the regex strings and mappings for every request. This should be enabled in production, but remember
    // that if any changes are uploaded that affect routes, the /cache/routes.php file must be cleared before they will
    // take effect.
    'cache_routes' => false,

    // mapping of 'mime/type' => 'ext' of any/all mime types you wish a client to be able to upload
    'allowed_file_upload_mimes' => [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif'
    ]
];