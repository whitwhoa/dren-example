<?php

// Authentication routes
Dren\Router::web()
    ->get('/auth/register')
    ->controller('AuthController')
    ->method('register')
    ->middleware(['UserNotLoggedIn']);

Dren\Router::web()
    ->post('/auth/register/save')
    ->block()
    ->controller('AuthController')
    ->method('registerSave')
    ->middleware(['UserNotLoggedIn'])
    ->formDataValidator('AuthRegisterValidator');

Dren\Router::web()
    ->get('/auth/login')
    ->controller('AuthController')
    ->method('login')
    ->middleware(['UserNotLoggedIn']);

Dren\Router::web()
    ->post('/auth/login/save')
    ->block()
    ->controller('AuthController')
    ->method('loginSave')
    ->middleware(['UserNotLoggedIn'])
    ->formDataValidator('AuthLoginValidator');

Dren\Router::web()
    ->get('/auth/logout')
    ->controller('AuthController')
    ->method('logout')
    ->middleware(['UserLoggedIn']);

// Everything else
Dren\Router::web()
    ->get('/')
    ->controller('HomeController')
    ->method('welcome');

Dren\Router::web()
    ->get('/optional-form-element-example')
    ->controller('HomeController')
    ->method('optionalFormElementExample')
    ->middleware(['UserLoggedIn']);

Dren\Router::web()
    ->post('/optional-form-element-example/save')
    ->block()
    ->controller('HomeController')
    ->method('optionalFormElementExampleSave')
    ->middleware(['UserLoggedIn'])
    ->formDataValidator('OptionalFormElementValidator');

Dren\Router::web()
    ->get('/form-array-element-example')
    ->controller('HomeController')
    ->method('arrayElementForm')
    ->middleware(['UserLoggedIn']);

Dren\Router::web()
    ->post('/form-array-element-example/save')
    ->block()
    ->controller('HomeController')
    ->method('arrayElementFormSave')
    ->middleware(['UserLoggedIn'])
    ->formDataValidator('KeyValueSaveValidator');

Dren\Router::web()
    ->get('/route-parameter-example/{id}')
    ->controller('HomeController')
    ->method('routeParameterExample');

Dren\Router::web()
    ->get('/httpclient-example')
    ->controller('HomeController')
    ->method('httpClientExample');

Dren\Router::web()
    ->get('/file-upload-example')
    ->controller('HomeController')
    ->method('fileUploadExample')
    ->middleware(['UserLoggedIn']);

Dren\Router::web()
    ->post('/file-upload-example/save')
    ->block()
    ->controller('HomeController')
    ->method('fileUploadExampleSave')
    ->middleware(['UserLoggedIn'])
    ->formDataValidator('FileUploadValidator');

Dren\Router::web()
    ->get('/custom-html-element')
    ->controller('HomeController')
    ->method('customHtmlElement');

Dren\Router::web()
    ->get('/ajax-form-example')
    ->controller('HomeController')
    ->method('ajaxFormExample')
    ->middleware(['UserLoggedIn']);

Dren\Router::web()
    ->post('/ajax-form-example/save')
    ->block()
    ->controller('HomeController')
    ->method('ajaxFormExampleSave')
    ->middleware(['UserLoggedIn'])
    ->formDataValidator('AjaxFormExampleSaveValidator');