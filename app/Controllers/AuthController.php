<?php


namespace App\Controllers;

use Dren\App;


use App\Model\Services\UserService;
use Dren\Response;


class AuthController
{

    /**
     * @return Response
     * @throws \Exception
     *
     */
    public function register() : Response
    {
        return (new Response())->html(App::$vc->compile('auth.register'));
    }


    /**
     *
     *
     * @return Response
     * @throws \Exception
     */
    public function registerSave() : Response
    {
        UserService::createNewUser(App::$request->getPostData());
        return (new Response())->redirect('/');
    }


    /**
     *
     *
     * @return Response
     * @throws \Exception
     */
    public function login() : Response
    {
        return (new Response())->html(App::$vc->compile('auth.login'));
    }


    /**
     *
     *
     * @return Response
     * @throws \Exception
     */
    public function loginSave() : Response
    {
        UserService::login(App::$request->getPostData()->email);
        return (new Response())->redirect('/');
    }

    /**
     *
     *
     * @return Response
     * @throws \Exception
     */
    public function logout() : Response
    {
        App::$sm->regenerate();
        return (new Response())->redirect('/');
    }

}