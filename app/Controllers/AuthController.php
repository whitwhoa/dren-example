<?php


namespace App\Controllers;


use App\Model\Entities\User;
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
        $uid = UserService::createNewUser($this->request->getPostData());
        $this->sessionManager->regenerate(true, $uid);
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
        $u = User::findByEmail($this->request->getPostData()->email);
        $this->sessionManager->regenerate(true, $u->id);

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