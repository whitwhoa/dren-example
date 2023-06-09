<?php

/*
 * ['THE URI ROUTE', 'CLASS@METHOD', ['MIDDLEWARE1', 'MIDDLEWARE2'], 'REQUESTVALIDATOR']
 */

return [
    ['/', 'HomeController@welcome'],
    ['/form-array-element-example', 'HomeController@arrayElementForm', ['UserLoggedIn']],
    ['/form-array-element-example/save', 'HomeController@arrayElementFormSave', ['UserLoggedIn'], 'KeyValueSaveRequest']
];