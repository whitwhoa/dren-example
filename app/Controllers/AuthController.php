<?php


namespace App\Controllers;


use App\Model\DAOs\UserDAO;
use App\Model\Services\UserService;
use Dren\Controller;
use Dren\Response;
use Exception;


class AuthController extends Controller
{
    private UserDAO $userDAO;
    private UserService $userService;

    public function __construct()
    {
        parent::__construct();

        $this->userDAO = new UserDAO();
        $this->userService = new UserService();
    }

    /**
     * @return Response
     * @throws Exception
     *
     */
    public function register() : Response
    {
        return $this->response->html($this->viewCompiler->compile('auth.register'));
    }


    /**
     *
     *
     * @return Response
     * @throws Exception
     */
    public function registerSave() : Response
    {
        $uid = $this->userService->createNewUser($this->request->getPostData());
        $this->sessionManager->regenerate(true, $uid);
        return $this->response->redirect('/');
    }


    /**
     *
     *
     * @return Response
     * @throws Exception
     */
    public function login() : Response
    {
        return $this->response->html($this->viewCompiler->compile('auth.login'));
    }


    /**
     *
     *
     * @return Response
     * @throws Exception
     */
    public function loginSave() : Response
    {
        // authentication handled in form data validator, so if we're here, we know we're good
        $u = $this->userDAO->getUserByUsername($this->request->getPostData()->email);
        $roles = $this->userDAO->getRoles($u->id);

        $this->sessionManager->upgradeSession($u->id, $roles);

        return $this->response->redirect('/');
    }

    /**
     *
     *
     * @return Response
     * @throws Exception
     */
    public function logout() : Response
    {
        $this->sessionManager->regenerate();
        return $this->response->redirect('/');
    }

}