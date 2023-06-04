<?php


namespace App\Controllers;


use App\Model\Services\UserService;
use Dren\Controller;
use Dren\Response;


class AuthController extends Controller
{

    /**
     * @return Response
     * @throws \Exception
     *
     */
    public function register() : Response
    {
        return (new Response())->html($this->viewCompiler->compile('auth.register'));
    }


    /**
     *
     *
     * @return Response
     * @throws \Exception
     */
    public function registerSave() : Response
    {
        UserService::createNewUser($this->request->getPostData());
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
        return (new Response())->html($this->viewCompiler->compile('auth.login'));
    }


    /**
     *
     *
     * @return Response
     * @throws \Exception
     */
    public function loginSave() : Response
    {
        UserService::login($this->request->getPostData()->email);
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
        $this->sessionManager->regenerate();
        return (new Response())->redirect('/');
    }

}