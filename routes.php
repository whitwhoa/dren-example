<?php

// Authentication routes
Router::web()
    ->get('/auth/register')
    ->controller('AuthController')
    ->method('register')
    ->middleware(['UserNotLoggedIn']);

Router::web()
    ->post('/auth/register/save')
    ->controller('AuthController')
    ->method('registerSave')
    ->middleware(['UserNotLoggedIn'])
    ->formDataValidator('AuthRegisterValidator');

Router::web()
    ->get('/auth/login')
    ->controller('AuthController')
    ->method('login')
    ->middleware(['UserNotLoggedIn']);

Router::web()
    ->post('/auth/login/save')
    ->controller('AuthController')
    ->method('loginSave')
    ->middleware(['UserNotLoggedIn'])
    ->formDataValidator('AuthLoginValidator');

Router::web()
    ->get('/auth/logout')
    ->controller('AuthController')
    ->method('logout')
    ->middleware(['UserLoggedIn']);

// Everything else
Router::web()
    ->get('/')
    ->controller('HomeController')
    ->method('welcome');

Router::web()
    ->get('/optional-form-element-example')
    ->controller('HomeController')
    ->method('optionalFormElementExample')
    ->middleware(['UserLoggedIn']);

Router::web()
    ->post('/optional-form-element-example/save')
    ->controller('HomeController')
    ->method('optionalFormElementExampleSave')
    ->middleware(['UserLoggedIn'])
    ->formDataValidator('OptionalFormElementValidator');

Router::web()
    ->get('/form-array-element-example')
    ->controller('HomeController')
    ->method('arrayElementForm')
    ->middleware(['UserLoggedIn']);

Router::web()
    ->post('/form-array-element-example/save')
    ->controller('HomeController')
    ->method('arrayElementFormSave')
    ->middleware(['UserLoggedIn'])
    ->formDataValidator('KeyValueSaveValidator');

Router::web()
    ->get('/route-parameter-example/{id}')
    ->controller('HomeController')
    ->method('routeParameterExample');

Router::web()
    ->get('/httpclient-example')
    ->controller('HomeController')
    ->method('httpClientExample');

Router::web()
    ->get('/file-upload-example')
    ->controller('HomeController')
    ->method('fileUploadExample')
    ->middleware(['UserLoggedIn']);

Router::web()
    ->post('/file-upload-example/save')
    ->controller('HomeController')
    ->method('fileUploadExampleSave')
    ->middleware(['UserLoggedIn'])
    ->formDataValidator('FileUploadValidator');

Router::web()
    ->get('/custom-html-element')
    ->controller('HomeController')
    ->method('customHtmlElement');

Router::web()
    ->get('/ajax-form-example')
    ->controller('HomeController')
    ->method('ajaxFormExample')
    ->middleware(['UserLoggedIn']);

Router::web()
    ->post('/ajax-form-example/save')
    ->controller('HomeController')
    ->method('ajaxFormExampleSave')
    ->middleware(['UserLoggedIn'])
    ->formDataValidator('AjaxFormExampleSaveValidator');