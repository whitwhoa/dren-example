<?php

return (object)[
    'app_name' => 'test',
    'display_errors' => true,

    // TODO: do we want to add additional php.ini parameters so that they can be set at application runtime instead
    // of having to keep track of them in the php.ini file? Probably, since that would make migrations easier since
    // we wouldn't be stressed out worrying that we missed some random php.ini setting in a separate location

    'session' => (object)[

        // The name of the cookie key that will be saved on the user's browser which stores session token for this
        // application. If left null, then the default value will be strtoupper(app_name) . '_SESSION'
        'name' => null,

        // This value can be either 'files' or 'redis' if the php redis extension is installed on the server and a
        // valid redis instance is available for connections
        'save_handler' => 'files',

        // These configuration properties are specific to the redis save_handler. They will only be taken into account
        // when the redis save_handler is in use.
        'redis' => [

            // Whether session locking should be enabled. To emulate the native php session functionality, we
            // default this to 1. If you wish to disable it (which is not recommended), set it to 0.
            'locking_enabled' => 1,

            // How long the lock should be valid in seconds. If left null, default value will be the max_execution_time
            // of the script
            'lock_expire' => null,

            // How long to wait before attempting to obtain a lock if the previous attempt failed, time in microseconds,
            // default is 20000 which equates to 0.02 seconds, or 20ms
            'lock_wait_time' => 20000,

            // How many times do we try to obtain a lock before giving up? -1 means infinite, and we have set that as
            // the default here, as to ensure that we never proceed without the lock.
            'lock_retries' => -1
        ],

        // Where should session data be stored. For the default files save_handler, this will be a directory path.
        // For the redis save_handler, this will be a tcp address to the redis server such as:
        // tcp://host:port
        // for more details see https://github.com/phpredis/phpredis/blob/develop/README.md
        'save_path' => '/storage/sessions',

        // This is the duration of inactivity in which a session can have before it's removed by the garbage collector.
        // For example if this value is set to 1440 seconds (24 minutes, the default setting in php.ini) and a user
        // loads a page, creating a new session at 12:00, then they leave their machine and come back at 12:30, the
        // session which they had originally generated at 12:00 could be (not guaranteed because the session garbage
        // collector may not have run yet) removed, and a new session will need to be generated. This value should
        // really only ever be used in the backend to clean up old sessions, other application logic should be handling
        // session regeneration, see other comments about other parameters below.
        'gc_maxlifetime' => 1440,

        // How long should a valid session last before it is required that it be re-generated. For example, if a user
        // generates a session and they are active on the site for this duration, we re-generate a new session token
        'lifetime' => 10,

        // Tells php to set secure flag when generating session cookie to ensure that cookie is only ever sent over
        // https.
        'cookie_secure' => 1,

        // Tells php to set httponly flag when generating session cookie to ensure that javascript cannot access the
        // contents of session cookie. Assists in combating xss, due to the fact that if any unauthorized javascript
        // is executed on the page, it will not have access to the user's session token
        'cookie_httponly' => 1,

        // Specifies how to handle sending user session token whenever the request is coming from a third party site:
        //
        // "Strict": Cookies will only be sent in a first-party context and not be sent along with requests initiated by
        // third party websites. This is the most secure setting, but it can interfere with some expected behavior.
        // For example, if a user is logged into your site and clicks a link on a different site that leads to your
        // site, they won't be recognized as logged in because the cookie won't be sent.
        //
        // "Lax": Cookies are withheld on cross-site sub-requests (such as loading images), but will be sent when a user
        // navigates to the URL from an external site, like from a link on another site. This is a compromise between
        // security and usability and is the default setting in modern browsers when SameSite is not specified.
        //
        // "None": Cookies will be sent in all requests, including from third-party websites. This used to be the
        // default, but it's less secure because it enables cross-site request forgery (CSRF) attacks. If you set
        // SameSite to None, you should also set Secure to true to enforce the transmission of cookies over HTTPS,
        // which helps to protect against man-in-the-middle attacks. Some modern browsers now require the Secure flag
        // to be set when SameSite is set to None.
        'cookie_samesite' => "Lax"

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