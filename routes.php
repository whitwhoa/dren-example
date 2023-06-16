<?php

/*
 * ['THE URI ROUTE', 'CLASS@METHOD', ['MIDDLEWARE1', 'MIDDLEWARE2'], 'REQUESTVALIDATOR']
 */

return
[
    // Landing page and example routes
    ['/', 'HomeController@welcome'],
    ['/optional-form-element-example', 'HomeController@optionalFormElementExample', ['UserLoggedIn']],
    ['/optional-form-element-example/save', 'HomeController@optionalFormElementExampleSave', ['UserLoggedIn'], 'OptionalFormElementRequest'],
    ['/form-array-element-example', 'HomeController@arrayElementForm', ['UserLoggedIn']],
    ['/form-array-element-example/save', 'HomeController@arrayElementFormSave', ['UserLoggedIn'], 'KeyValueSaveRequest'],
    ['/route-parameter-example/{id}', 'HomeController@routeParameterExample'],
    ['/httpclient-example', 'HomeController@httpClientExample'],
    ['/file-upload-example', 'HomeController@fileUploadExample', ['UserLoggedIn']],
    ['/file-upload-example/save', 'HomeController@fileUploadExampleSave', ['UserLoggedIn'], 'FileUploadRequest'],

    // Authentication routes, register/login/logout
    ['/auth/register', 'AuthController@register', ['UserNotLoggedIn']],
    ['/auth/register/save', 'AuthController@registerSave', ['UserNotLoggedIn'], 'AuthRegisterRequest'],

    ['/auth/login', 'AuthController@login', ['UserNotLoggedIn']],
    ['/auth/login/save', 'AuthController@loginSave', ['UserNotLoggedIn'], 'AuthLoginRequest'],

    ['/auth/logout', 'AuthController@logout', ['UserLoggedIn']],
];