<?php


namespace App\Controllers;


use App\DAOs\UserDAO;
use App\Services\UserService;
use Dren\App;
use Dren\Controller;

use Dren\RememberIdManager;
use Dren\Response;
use Exception;


class AuthController extends Controller
{
    private UserDAO $userDAO;
    private UserService $userService;
    private RememberIdManager $ridManager;

    public function __construct()
    {
        parent::__construct();

        $this->userDAO = new UserDAO();
        $this->userService = new UserService();
        $this->ridManager = App::get()->getRememberIdManager();

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
        $params = $this->request->getPostData();
        $params->ip = $this->request->getIp();

        $uid = $this->userService->createNewUser($params);
        $roles = $this->userDAO->getRoles($uid);

        $this->sessionManager->upgradeSession($uid, $roles);

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

        if(isset($this->request->getPostData()->remember) && $this->request->getPostData()->remember === 'true')
            $this->ridManager->createNewRememberId($u->id);

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
        // if user has remember_id, remove it from database
        // and send response to remove token from client
        $this->ridManager->clearRememberId();

        // send response to remove session_id from client, token stays on server until cleared by gc incase there
        // are any concurrent requests in the queue, AND since we're currently blocking on this file we could delete
        // it on unix systems and any concurrent requests waiting for locks would function just fine because of how
        // unix handles file pointers, windows is a different story and we need this to work across platforms, thus...
        // rely on gc.
        $this->sessionManager->removeClientSessionId();

        return $this->response->redirect('/');
    }

}