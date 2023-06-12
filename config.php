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
    'display_errors' => true, // TODO: not sure this is used anywhere ???
    'cache_routes' => false
];