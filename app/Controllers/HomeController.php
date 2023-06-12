<?php


namespace App\Controllers;



use App\Model\DAOs\UserDAO;

use Dren\App;
use Dren\Controller;
use Dren\Response;
use Exception;


class HomeController extends Controller
{
    private UserDAO $userDAO;

    public function __construct()
    {
        parent::__construct();

        $this->userDAO = new UserDAO();
    }

    public function welcome() : Response
    {
        // Return html response
        $user = null;
        if($this->sessionManager->getUserId())
            $user = $this->userDAO->getUserById($this->sessionManager->getUserId());

        return $this->response->html($this->viewCompiler->compile('welcome', [
            'user' => $user
        ]));
    }

    public function arrayElementForm() : Response
    {
        return $this->response->html($this->viewCompiler->compile('form-array-element-example', [
            'user' => $this->userDAO->getUserById($this->sessionManager->getUserId()),
            'userKeyVals' => $this->userDAO->getKeyValsWithNotes($this->sessionManager->getUserId())
        ]));
    }

    public function arrayElementFormSave() : Response
    {
        $this->userDAO->setKeyValsWithNotes($this->sessionManager->getUserId(), $this->request->getPostData()->keyValPair);
        return $this->response->redirect($this->request->getReferrer());
    }

    public function routeParameterExample() : Response
    {
        return $this->response->html($this->request->getRouteParam('id'));
    }

    public function httpClientExample() : Response
    {
        return $this->response->json(
            App::get()->getHttpClient()
                ->setUrl('https://dummyjson.com/products/1')
                ->send()
                ->getResponse(),
            App::get()->getHttpClient()->getHttpStatus()
        );
    }

}