<?php

/*
 * ['THE URI ROUTE', 'CLASS@METHOD', ['MIDDLEWARE1', 'MIDDLEWARE2'], 'REQUESTVALIDATOR']
 */

return [
    ['/auth/register', 'AuthController@register', ['UserNotLoggedIn']],
    ['/auth/register/save', 'AuthController@registerSave', ['UserNotLoggedIn'], 'AuthRegisterRequest'],

    ['/auth/login', 'AuthController@login', ['UserNotLoggedIn']],
    ['/auth/login/save', 'AuthController@loginSave', ['UserNotLoggedIn'], 'AuthLoginRequest'],

    ['/auth/logout', 'AuthController@logout', ['UserLoggedIn']],
];